<?php
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 21.08.2015
 * Time: 21:11
 */
namespace MPOproperty\Mposuccess\Controllers;

use Auth;
use MPOproperty\Mposuccess\BinaryTree\SheetManager;
use MPOproperty\Mposuccess\Repositories\Catalog\ProductRepository;
use MPOproperty\Mposuccess\Repositories\Payment\PaymentRepository;
use MPOproperty\Mposuccess\Repositories\Transaction\TransactionRepository;
use Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Session\SessionManager as Session;
use MPOproperty\Mposuccess\Repositories\User\UserRepository;


/**
 * Handles all requests related to managing the data models
 */
class ByeController extends Controller {
    /**
     * user id
     */
    protected $id;
    /**
     * user all unfo
     */
    protected $user;
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * @var \Illuminate\Session\SessionManager
     */
    protected $session;

    protected $data;

    /**
     * @var
     */
    protected $payment;

    /**
     * @var
     */
    protected $product;

    /**
     * @var
     */
    protected $transaction;

    private $one = 1;
    private $two = 2;
    private $three = 3;
    private $four = 4;
    private $five = 5;
    private $six = 6;

    /**
     * @param Request $request
     * @param Session $session
     * @param UserRepository $user
     * @param ProductRepository $product
     * @param PaymentRepository $payment
     */
    public function __construct(Request $request,
        Session $session,
        UserRepository $user,
        ProductRepository $product,
        PaymentRepository $payment,
        TransactionRepository $transaction
    )
    {
        if(!Auth::check() && !$request->ajax()) {
            return Response::json(array('massage' => ''), 401);
        }
        $this->id = Auth::user()->id;

        $this->user = $user->find($this->id);

        $this->request = $request;

        $this->payment = $payment;
        $this->product = $product;
        $this->transaction = $transaction;

        $this->data = array(
            0 => [
                'type' => 'success',
                'name' => 'Место успешно создано',
                'message' => ''
            ]
        );
    }

    /**
     * @param $fun
     *
     * @return mixed
     */
    public function action($fun){
        return $this->$fun();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    private function one(){
        return $this->bey($this->one);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    private function two(){
        return $this->bey($this->two);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    private function three(){
        return $this->bey($this->three);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    private function four(){
        return $this->bey($this->four);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    private function five(){
        return $this->bey($this->five);
    }

    /**
     * @param $level
     *
     * @return \Illuminate\Http\JsonResponse
     */
/*    private function bey($level ){
        $tree = new SheetManager($this->id, $level);

        $levelPrice = $this->product->getPriceByLevel($level);
        $currentBalance = $this->payment->findBalanceById($this->user->id);

        if(!$this->payment->checkIsIssetMoney($currentBalance->balance, $levelPrice*$count)) {
            $this->data[0]['type'] = 'error';
            $this->data[0]['name'] = 'Не достаточно средств на счету';

            return Response::json($this->data);
        }

        $countSuccess = 0;
        $countError = 0;

        for($i=0; $i < $count; $i+=1) {
            if($tree->create()) {
                $countSuccess +=1;
            } else {
                $countError +=1;
            }
        }

        if ($count == 1) {
            if ($countError == 1) {
                $this->data[0]['type'] = 'error';
                $this->data[0]['name'] = 'Не удалось создать место';
            } else if ($countError > 1) {
                $this->data[0]['type'] = 'success';
                $this->data[0]['name'] = 'Место успешно создано';
            }
        } else {
            if ($countSuccess) {
                $this->data[0]['type'] = 'success';
                $this->data[0]['name'] = 'Местa (' . $countSuccess . ') успешно созданы';
            }

            if ($countError) {
                if ($countSuccess) $this->data[0]['type'] = 'warning';
                else $this->data[0]['type'] = 'error';

                $this->data[0]['name'] .= '. ' . $countError . ' создать не удалось';
            }
        }

        $this->payment->internalPayment($levelPrice*$countSuccess, $this->user->id);

        return Response::json($this->data);
    }*/



    /**
     * @param $url
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function buy($url, $count = null){
        $product = $this->product->findBy('url', $url);

        if (!$product) {
            $this->data[0]['type'] = 'error';
            $this->data[0]['name'] = 'Продукт не найден';
            return Response::json($this->data);
        }

        $level = $product->level;
        if (!in_array($level, [1,2,4,5])) {
            $this->data[0]['type'] = 'error';
            $this->data[0]['name'] = 'Этап для продукта не определён';
            return Response::json($this->data);
        }

        if ($product->count) {
            $count = $product->count;
            $coast = $product->coast;
        } else {
            $count = $count ? $count : 1;
            $coast = $count * $product->coast;
        }

        $currentBalance = $this->payment->findBalanceById($this->user->id);
        if(!$this->payment->checkIsIssetMoney($currentBalance->balance, $coast)) {
            $this->data[0]['type'] = 'error';
            $this->data[0]['name'] = 'Не достаточно средств на счету';

            return Response::json($this->data);
        }

        $tree = new SheetManager($this->id, $level);

        $countSuccess = 0;
        $countError = 0;

        for($i=0; $i < $count; $i+=1) {
            if($tree->create()) {
                $countSuccess +=1;
            } else {
                $countError +=1;
            }
        }

        if ($count == 1) {
            if ($countError == 1) {
                $this->data[0]['type'] = 'error';
                $this->data[0]['name'] = 'Не удалось создать место';
            } else if ($countError > 1) {
                $this->data[0]['type'] = 'success';
                $this->data[0]['name'] = 'Место успешно создано';
            }
        } else {
            if ($countSuccess) {
                $this->data[0]['type'] = 'success';
                $this->data[0]['name'] = 'Местa (' . $countSuccess . ') успешно созданы';
            }

            if ($countError) {
                if ($countSuccess) $this->data[0]['type'] = 'warning';
                else $this->data[0]['type'] = 'error';

                $this->data[0]['name'] .= '. ' . $countError . ' создать не удалось';
            }
        }

        $res_coast = $count == $countSuccess ? $coast : $coast/$count*$countSuccess;
        if ($res_coast) {
            $description = ProductRepository::getDescriptionByLevel($level, $count);
            $this->payment->internalPayment($res_coast, $this->user->id, $description);
        }

        return Response::json($this->data);
    }
}