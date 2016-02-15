<?php
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 21.08.2015
 * Time: 21:11
 */
namespace MPOproperty\Mpouspehm\Controllers;

use Illuminate\Http\Request;
use MPOproperty\Mpouspehm\Repositories\Payment\WithdrawalRepository;
use MPOproperty\Mpouspehm\Requests\ProfileTransferRequest;
use Request as RequestDefault;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Session\SessionManager as Session;

use MPOproperty\Mpouspehm\BinaryTree\Sheet;

use MPOproperty\Mpouspehm\Repositories\Notification\NotificationRepository;
use MPOproperty\Mpouspehm\Repositories\Payment\PaymentRepository;

use MPOproperty\Mpouspehm\Repositories\Tree\TreeRepository;
use MPOproperty\Mpouspehm\Repositories\Tree\TreeUserSettings;
use MPOproperty\Mpouspehm\Repositories\User\UserRepository;
use MPOproperty\Mpouspehm\WalletOne\Request as WalletoneRequest;
use Auth;
use Assets;

use Response;

/**
 * Handles all requests related to managing the data models
 */
class ProfileController extends UserController {

    protected $id = null;

    protected $user = null;

    /**
     * @param \Illuminate\Http\Request           $request
     * @param \Illuminate\Session\SessionManager $session
     * @param UserRepository                     $user
     * @param NotificationRepository             $notification
     * @param PaymentRepository                  $payment
     */
    public function __construct(Request $request,
        Session $session,
        UserRepository $user,
        NotificationRepository $notification,
        PaymentRepository $payment
    ){

        $this->id = Auth::user()->id;

        $this->user = $user->find($this->id);

        $this->request = $request;
        if (!is_null($this->layout)) {
            $this->layout = view($this->layout);
            if ($this->user->is('user')) {
                $this->layout->slidebar = view('mpouspehm::profile.layout.slidebar');
                $this->layout->r_slidebar = view('mpouspehm::profile.layout.r_slidebar');
            } else {
                $this->layout->slidebar = view('mpouspehm::admin.layout.slidebar');
                $this->layout->r_slidebar = view('mpouspehm::profile.layout.r_slidebar');
            }

            $this->layout->notifications = $notification->findAllBySid($this->id);
            $this->layout->notification_count = $notification->allCount($this->id);
            $this->layout->notification_new = $notification->newCount($this->id);

            $this->layout->balance = $payment->getUserBalance($this->user->id);
        }
    }

    /**
     * The main view for any of the data models
     *
     * @return Response
     */
    public function index()
    {
    }


    /**
     * Бонусные программы
     *
     * @return Response
     */
    public function bonus()
    {
        $this->layout->content = view("mpouspehm::profile.bonus");
        $this->layout->title = trans('mpouspehm::profile.bonus');
        return $this->layout;
    }
    /**
     * Помощник
     *
     * @return Response
     */
    public function helper()
    {
        $this->layout->content = view("mpouspehm::profile.helper");
        $this->layout->title = trans('mpouspehm::profile.helper');
        return $this->layout;
    }

    /**
     * Структуры пользавателей
     *
     * @param                  $id
     * @param null             $sid
     *
     * @param TreeUserSettings $settings
     *
     * @return Response
     * @internal param TreeRepository $tree
     */
    public function structures(TreeUserSettings $settings, $id, $sid = null)
    {
        Assets::add('structures');

        TreeRepository::setTable('MPOproperty\Mpouspehm\Models\Tree' . $id);
        $tree = app('MPOproperty\Mpouspehm\Repositories\Tree\TreeRepository');

        if($id % 3) {
            $listPlaces = $tree->getListPlaces($this->id);
            // if current user not have $sid place in structure - security
            if ($sid && !in_array($sid, $listPlaces)) {
                abort(404);
            }
        } else {
            $listPlaces = $tree->getListPlacesNumber($this->id);
            $testPlaces = $tree->getListPlaces($this->id);
            // if current user not have $sid place in structure - security
            if ($sid && !in_array($sid, $testPlaces)) {
                abort(404);
            }
        }


        $currentPlace = $settings->getPlace($this->id, $id);
        $firstPlaceId = $tree->findFirstPlaceByUserId($this->id);
        if(! is_null($currentPlace) && is_null($sid)) {
            return \Redirect::to(route(config('mpouspehm.panel_url') . '.structures', [
                'id' => $id,
                'sid' => $currentPlace
            ]));
        }

        $sid = $sid ? $sid : $firstPlaceId;
        if(isset($firstPlaceId)){
            $sheet = new Sheet($id, $this->id, $sid);
        }
        $this->layout->content = view("mpouspehm::profile.structures", [
            'sheet'        => isset($sheet) ? '' : 'Этап пока не доступен.',
            'listPlaces'   => $listPlaces,
            'currentPlace' => $currentPlace,
            'sid'          => $sid ? $sid : null,
            'level'        => $id,
            'data'         => isset($sheet) ? $sheet->toJson() : ''
        ]);

        $this->layout->title = trans('mpouspehm::profile.structures.' . $id) . ' ' . trans('mpouspehm::profile.structures.one');
        return $this->layout;
    }

    public function build(Request $request, $level, $sid, $currentSid){

        if(!Auth::check() && !$request->ajax()) {
            return Response::json(array('massage' => ''), 401);
        }

        if(0 == $sid){
            return array(
                'message' => [
                    'type' => 'warning',
                    'name' => 'Это место является верхним',
                    'message' => ''
                ]
            );
        }

        TreeRepository::setTable('MPOproperty\Mpouspehm\Models\Tree' . $level);
        $tree = app('MPOproperty\Mpouspehm\Repositories\Tree\TreeRepository');
        $uid = $tree->findUser($sid);

        $user = app('MPOproperty\Mpouspehm\Repositories\User\UserRepository');

        $newSid = 0;
        if($sid < $currentSid){
            $newSid = $tree->findBeforePlaceByUserSid($this->id, $currentSid);

            if (!$newSid) {
                return array(
                    'message' => [
                        'type' => 'warning',
                        'name' => 'Запрещено просматривать структуру выше вашего места',
                        'message' => ''
                    ]
                );
            }
        }
       /* if(!($this->user->refer == $uid || $this->id == $uid || $user->findChild($uid, $this->id))){
            return array(
                'message' => [
                    'type' => 'warning',
                    'name' => 'Недостатосно привелегий',
                    'message' => 'Пользаватель не является вашим рефералом или лично приглашонным.'
                ]
            );
        }*/

        $sheet = new Sheet($level, $uid, $sid);

        return Response::json(array(
            'data' => $sheet->toJson(),
            'sid'  => $newSid ? $newSid : ''
        ));
    }

    /**
     * @param TreeUserSettings $settings
     * @param                  $level
     * @param                  $sid
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function setPlace(TreeUserSettings $settings, $level,$sid){
        if(is_null($settings->newPlace($sid, $this->id, $level))) {
            $data = [
                'message' => [
                    'type' => 'success',
                    'name' => 'Место активиравано',
                    'message' => ''
                ]
            ];
        } else {
            $data = [
                'message' => [
                    'type' => 'error',
                    'name' => 'Произошла ошибка',
                    'message' => ''
                ]
            ];
        }

        return Response::json($data);
    }

    /**
     * Дерево приглашенных
     *
     * @return Response
     */
    public function tree()
    {
        Assets::add('tree');

        $this->layout->content = view("mpouspehm::profile.tree");
        $this->layout->title = trans('mpouspehm::profile.tree');



        return $this->layout;
    }

    public function getTreeData(Request $request, UserRepository $user, $data = array()){

        $parent = $request->input('parent');

        if('#' == $parent) {
            $parent = $this->user->id;
        }

        $users = $user->findChildRef($parent);

        if(! empty($users)) {
            foreach($users as $id) {
                $name = $user->getName($id);
                $data[] = [
                    "id" => $id,
                    "icon" => "fa fa-child icon-state-success icon-lg",
                    "text" => '<a href="/panel/user/' . $id . '" data-target="#ajax" data-toggle="modal">' . $name . '</a>',
                    "children" => true
                ];
            }
        } else {
            $data[] = [
                "id" => "no_childs_" . $parent,
                "icon" => "fa fa-child icon-state-success icon-lg",
                "text" => "Нет лично приглашенных",
                "state" => array("disabled" => true),
                "children" => false
            ];
        }

        return Response::json($data);
    }

    /**
     * @param Request $request
     * @param NotificationRepository $notificationRepository
     * @return \Illuminate\View\View|void
     */
    public function notifications(Request $request, NotificationRepository $notificationRepository)
    {
        if ($request->isMethod('get')) {

            Assets::add('panel-notifications');

            $this->layout->content = view("mpouspehm::profile.notifications");
            $this->layout->title = trans('mpouspehm::panel.notification.title');
            return $this->layout;

        } else { /* post - get ajax users */
            return $notificationRepository->findByParamsForTable($request->all());
        }
    }

    public function notificationDelete(NotificationRepository $notificationRepository, $id)
    {
        return $notificationRepository->delete($id);
    }

    public function notification(Request $request, $count){

        if(!Auth::check() && !$request->ajax()) {
            return Response::json(array('massage' => ''), 401);
        }

        $notifications = app('MPOproperty\Mpouspehm\Repositories\Notification\NotificationRepository');
        $currentCount = $notifications->newCount($this->id);
        $data = array();
        if($currentCount > $count){
            $notifications = $notifications->newNotification($this->id, $count, $currentCount - $count);
            foreach($notifications as $notification){
                array_push($data, array(
                    'type' => 'info',
                    'id' => $notification->id,
                    'name' => $notification->name,
                    'message' => $notification->text
                ));
            }
            array_push($data, array(
                'type' => 'notification_count',
                'count' => $currentCount
            ));
        }


        return Response::json($data);
    }

    public function notificationMark($id, NotificationRepository $notificationRepository)
    {
        return Response::json($notificationRepository->markAsRead($id));
    }

    public function notificationMarkAll(NotificationRepository $notificationRepository)
    {
        return Response::json($notificationRepository->markAsReadAll());
    }

}