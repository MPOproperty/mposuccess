<?php

namespace MPOproperty\Mposuccess\Requests;

use Illuminate\Foundation\Http\FormRequest;
use MPOproperty\Mposuccess\Models\Payment;
use MPOproperty\Mposuccess\Models\User;
use MPOproperty\Mposuccess\Repositories\Payment\PaymentRepository;
use MPOproperty\Mposuccess\Repositories\User\UserRepository;
use Validator;
use Auth;

abstract class AbstractRequest extends FormRequest
{
    /**
     * Текущий пользователь
     *
     * @var
     */
    protected  $user;

    /**
     * Баланс переданного в параметрах пользователя
     *
     * @var PaymentRepository
     */
    protected $balanceModel;

    function __construct()
    {
        $this->init();

        $this->validatorRules();
        $this->validatorMessages();
    }

    function init()
    {
        $user = app(UserRepository::class);
        $this->user = $user->find(Auth::user()->id);

        $this->balanceModel = app(PaymentRepository::class);
    }

    /**
     * Пользовательские правила валидации
     */
    private function validatorRules()
    {
        Validator::extend('isMoney', function ($attribute, $value, $parameters, $validator) {
            $userId = $parameters[0];
            $userBalance = $this->balanceModel->findBalanceById($userId);

            return $this->balanceModel->checkIsIssetMoney($userBalance->balance, $value);
        });

        Validator::extend('transfer', function ($attribute, $value, $parameters, $validator) {
            $userFrom = $parameters[0];
            $userTo = $parameters[1];

            return $userFrom === $userTo ? false : true;
        });
    }

    /**
     * Пользовательские сообщения об ошибках валидации
     */
    private function validatorMessages()
    {
        Validator::replacer('isMoney', function ($message, $attribute, $rule, $parameters) {
            return trans('mposuccess::payment.errors.notMoney');
        });

        Validator::replacer('transfer', function ($message, $attribute, $rule, $parameters) {
            return trans('mposuccess::payment.errors.transfer');
        });
    }
}