<?php
/**
 * Created by PhpStorm.
 * User: MPOproperty
 * Date: 23.09.2015
 * Time: 20:42
 */
namespace MPOproperty\Mposuccess\Event;

use Bican\Roles\Models\Role;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use MPOproperty\Mposuccess\BinaryTree\Sheet;
use MPOproperty\Mposuccess\Models\Notification;
use MPOproperty\Mposuccess\Repositories\Payment\PaymentRepository;
use MPOproperty\Mposuccess\Repositories\Tree\TreeRepository;
use MPOproperty\Mposuccess\Repositories\Tree\TreeUserSettings;
use MPOproperty\Mposuccess\Repositories\User\UserRepository;

class TreeEventHandler {//implements ShouldQueue {
    //use InteractsWithQueue;
    private $one = 1;
    private $two = 2;
    private $three = 3;
    private $four = 4;
    private $five = 5;
    private $six = 6;
    /**
     * @var TreeRepository
     */
    private $tree;

    /**
     * @var UserRepository
     */
    private $user;

    private $start = 3;
    private $interval = 4;

    private $number = 2;

    private $price = null;

    private $level;

    /**
     * @var PaymentRepository;
     */
    private $payment;

    public function __construct(){
        $this->user = app('MPOproperty\Mposuccess\Repositories\User\UserRepository');
        $this->payment = app('MPOproperty\Mposuccess\Repositories\Payment\PaymentRepository');
    }

    /**
     * @param $name
     * @param $sid
     * @param $uid
     * @param $pid
     *
     * @internal param $event
     */
    public function onTreeOneBye($name, $sid, $uid, $pid)
    {
        $this->onTreeBye($name, $sid, $uid, $pid, $this->one, $this->two);
    }

    /**
     * @param $name
     * @param $sid
     * @param $uid
     * @param $pid
     *
     * @internal param $event
     */
    public function onTreeTwoBye($name, $sid, $uid, $pid)
    {
        $this->onTreeBye($name, $sid, $uid, $pid, $this->two, $this->three);
    }

    /**
     * @param $name
     * @param $sid
     * @param $uid
     * @param $pid
     *
     * @internal param $event
     */
    public function onTreeThreeBye($name, $sid, $uid, $pid)
    {
        $this->onTreeBye($name, $sid, $uid, $pid, $this->three, $this->three);
    }

    /**
     * @param $name
     * @param $sid
     * @param $uid
     * @param $pid
     *
     * @internal param $event
     */
    public function onTreeFourBye($name, $sid, $uid, $pid)
    {
        $this->onTreeBye($name, $sid, $uid, $pid, $this->four, $this->five);
    }

    /**
     * @param $name
     * @param $sid
     * @param $uid
     * @param $pid
     *
     * @internal param $event
     */
    public function onTreeFiveBye($name, $sid, $uid, $pid)
    {
        $this->onTreeBye($name, $sid, $uid, $pid, $this->five, $this->six);
    }

    /**
     * @param $name
     * @param $sid
     * @param $uid
     * @param $pid
     *
     * @internal param $event
     */
    public function onTreeSixBye($name, $sid, $uid, $pid)
    {
        $this->onTreeBye($name, $sid, $uid, $pid, $this->six, $this->six);
    }

    /**
     * @param $level
     */
    protected function init($level) {
        $settings = app('MPOproperty\Mposuccess\Repositories\Tree\TreeSettingsRepository');

        $this->start = $settings->getStart($level);
        $this->interval = $settings->getInterval($level);
        $this->number = $settings->getNumber($level);
        $this->price = $settings->getPrice($level);
        $this->level = $level;
    }

    /**
     * @param      $name
     * @param      $sid
     * @param      $uid
     * @param      $pid
     * @param      $current
     * @param      $next
     *
     * @internal param bool $reborn
     */
    private function onTreeBye($name, $sid, $uid, $pid, $current, $next){
        $this->init($current);

        $user = $this->user->find($uid);

        /**
         * Todo добавить поверку на места в структуре
         */
        if($user->is('bad.user')) {
            $user->detachAllRoles();
            $user->attachRole(
                Role::where(['slug' => 'user'])->first()
            );

            $settings = app('MPOproperty\Mposuccess\Repositories\Tree\TreeUserSettings');
            $settings->newPlace($sid, $uid, $current);
        }

        if(! ($current % 3)) {
            $settings = app('MPOproperty\Mposuccess\Repositories\Tree\TreeUserSettings');

            if(is_null($settings->getTop($current))) {
                $settings->setTop($uid, $current);
            }
        }

        TreeRepository::setTable('MPOproperty\Mposuccess\Models\Tree' . $current);
        $this->tree = app('MPOproperty\Mposuccess\Repositories\Tree\TreeRepository');


        $this->addNotificationEndBye($uid, $pid, $name, $current, $next, $sid);
    }

    /**
     * @param $uid
     * @param $pid
     * @param $name
     * @param $level
     *
     * @param $next
     * @param $sid
     * @return bool
     */
    private function addNotificationEndBye($uid, $pid, $name, $level, $next, $sid){

        $userPlaceThisTree = $this->tree->findUserCount($uid) - 1;

        $users = $this->user->findChildRef($uid);
        $count_uid = $this->tree->getCountUsersById($users);

        if($userPlaceThisTree > 0) {
            $count_uid += $userPlaceThisTree;
        }

        $count_pid = 0;

        if($userPlaceThisTree == 0) {
            $users = $this->user->findChildRef($pid);
            $count_pid = $this->tree->getCountUsersById($users);
            $count_pid += ($this->tree->findUserCount($pid)) ? $this->tree->findUserCount($pid) - 1 : 0;
        }

        foreach([$uid, $pid] as $id) {
            $user = $this->user->find($id);

            if($user) {
                $user->notifications()->save(
                    new Notification([
                        'name' => $level . '-й этап',
                        'text' => 'Пользователь ' . $name . ' попал в ' . $level . '-й этап' .
                            '$count_pid:'. $count_pid . '$count_uid:'. $count_uid
                    ])
                );
            }
        }

        if($level%3) {
            if ($count_pid != 0 && !(($count_pid - $this->start) % $this->interval)) {
                $this->beyUser($pid, $name);
            }

            if ($count_uid != 0 && !(($count_uid - $this->start) % $this->interval)) {
                $this->beyUser($uid, $name);
            }

            if(! (($sid - 3) % 4) && $sid != 3) {
                if(! is_null($this->tree->findUser($sid-2))) {
                    $uid = $this->tree->findUser(($sid - 3) / 4);
                    $this->tree = new Sheet($next, $uid);
                    $this->tree->insert();
                }
            } elseif(! (($sid - 1) % 4)  && $sid != 1) {
                if(! is_null($this->tree->findUser($sid+2))) {
                    $uid = $this->tree->findUser(($sid - 1) / 4);
                    $this->tree = new Sheet($next, $uid);
                    $this->tree->insert();
                }
            }

        } else {

            if(! (($sid - 3) % 4) && $sid != 3) {
                $uid = $this->tree->findUser($sid-2);
                $sid = ($sid - 3) / 4;
                if(is_null($uid)) {
                    $uid = $this->tree->findUser($sid);
                    if(0 == $uid) {
                        return true;
                    }

                    $userPlaceThisTree = $this->tree->findUserCount($uid) - 1;

                    $users = $this->user->findChildRef($uid);
                    $count_uid = $this->tree->getCountUsersById($users);

                    if($userPlaceThisTree > 0) {
                        $count_uid += $userPlaceThisTree;
                    }

                    if($count_uid >= $this->number) {
                        $this->beyUser($uid, $name);
                    }
                } else {
                    $uid = $this->tree->findUser($sid);
                    if(0 == $uid) {
                        return true;
                    }
                    $this->tree = new Sheet($level, $uid);
                    $this->tree->insert($sid, true);
                }
            } elseif(! (($sid - 1) % 4)) {
                $uid = $this->tree->findUser($sid+2);
                $sid = ($sid - 1) / 4;
                if(is_null($uid)) {
                    $uid = $this->tree->findUser($sid);
                    if(0 == $uid) {
                        return true;
                    }
                    $userPlaceThisTree = $this->tree->findUserCount($uid) - 1;

                    $users = $this->user->findChildRef($uid);
                    $count_uid = $this->tree->getCountUsersById($users);

                    if($userPlaceThisTree > 0) {
                        $count_uid += $userPlaceThisTree;
                    }

                    if ($count_uid >= $this->number) {
                        $this->beyUser($uid, $name);
                    }
                } else {
                    $uid = $this->tree->findUser($sid);
                    if(0 == $uid) {
                        return true;
                    }
                    $this->tree = new Sheet($level, $uid);
                    $this->tree->insert($sid, true);
                }
            } elseif(! (($sid - 2) % 4)) {
                $sid = ($sid - 2) / 4;
                $uid = $this->tree->findUser($sid);
                if(0 == $uid) {
                    return true;
                }
                if(! is_null($uid)) {
                    $userPlaceThisTree = $this->tree->findUserCount($uid) - 1;

                    $users = $this->user->findChildRef($uid);
                    $count_uid = $this->tree->getCountUsersById($users);

                    if($userPlaceThisTree > 0) {
                        $count_uid += $userPlaceThisTree;
                    }
                    if ($count_uid >= $this->number) {
                        $this->beyUser($uid, $name);
                    }
                }
            } elseif(! ($sid % 4)) {
                $sid = $sid / 4;
                $uid = $this->tree->findUser($sid);
                if(0 == $uid) {
                    return true;
                }
                if(! is_null($uid)) {
                    $userPlaceThisTree = $this->tree->findUserCount($uid) - 1;

                    $users = $this->user->findChildRef($uid);
                    $count_uid = $this->tree->getCountUsersById($users);

                    if($userPlaceThisTree > 0) {
                        $count_uid += $userPlaceThisTree;
                    }
                    if ($count_uid >= $this->number) {
                        $this->beyUser($uid, $name);
                    }
                }
            }

        }
    }

    private function beyUser($id, $name){
        $user = $this->user->find($id);

        if ($user) {

            $text = 'Пользователь ' . $name . ' принес вам ' . $this->price . 'Р';

            $this->payment->intakeExternalPayment($this->price, $user->id, $text);

            $user->notifications()->save(
                new Notification([
                    'name' => 'Поступление ' . $this->level . 'й эп.',
                    'text' => $text
                ])
            );
        }
    }


    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('tree.one.bye', '\MPOproperty\Mposuccess\Event\TreeEventHandler@onTreeOneBye');
        $events->listen('tree.two.bye', '\MPOproperty\Mposuccess\Event\TreeEventHandler@onTreeTwoBye');
        $events->listen('tree.three.bye', '\MPOproperty\Mposuccess\Event\TreeEventHandler@onTreeThreeBye');

        $events->listen('tree.four.bye', '\MPOproperty\Mposuccess\Event\TreeEventHandler@onTreeFourBye');
        $events->listen('tree.five.bye', '\MPOproperty\Mposuccess\Event\TreeEventHandler@onTreeFiveBye');
        $events->listen('tree.six.bye', '\MPOproperty\Mposuccess\Event\TreeEventHandler@onTreeSixBye');
    }

}
