<?php

namespace MPOproperty\Mpouspehm\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MPOproperty\Mpouspehm\Models\TypeTransaction;
use MPOproperty\Mpouspehm\Repositories\Transaction\TransactionRepository;
use MPOproperty\Mpouspehm\Repositories\Transaction\TypeTransactionRepository;
use MPOproperty\Mpouspehm\WalletOne\Request as WelletonRequest;
use MPOproperty\Mpouspehm\WalletOne\Response;

class PaymentController extends UserController {

    /**
     * @param Request $request
     * @return \Illuminate\View\View|string
     */
    public function payment(Request $request, TransactionRepository $transaction)
    {
        $params = [
            'type' => TypeTransactionRepository::TYPE_INTAKE_EXTERNAL,
            'price' => 999.99,
            'user' => $this->user->id,
            'from' => $this->user->id,
            'to' => TransactionRepository::COMPANY_ID
        ];
        $transaction->createTransaction($params);

        /*$wallet = new WelletonRequest($this->user);
        $wallet->setDescription('Какое-то описание...');
        $wallet->setPaymentAmount(1.00);

        $refer = $wallet->send();
        $url = $wallet->parseCheckoutResponse($refer);

        $this->layout->title = trans('mpouspehm::profile.payment');
        $this->layout->content = view("mpouspehm::profile.payment", [
            'url' => $url
        ]);

        return $this->layout;*/
    }

    public function paymentSuccess(Request $request)
    {
        //todo
    }

    public function paymentFail(Request $request)
    {
        //todo
    }

    public function transactionResult(Request $request)
    {
        $response = new Response();
        $response->checkResponse($request);
    }

}