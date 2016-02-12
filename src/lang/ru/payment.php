<?php

return [
    'payments' => 'Платежи',
    'transactions' => 'Транзакции',
    'selectUser' => 'Выберите пользователя',
    'selectMethod' => 'Выберите способ',
    'saveChanges' => 'Сохранить',
    'transferButton' => 'Перевести',
    'refillButton' => 'Пополнить',
    'conclusionButton' => 'Вывести',
    'back' => 'Отмена',
    'paymentForm' => [
        'price' => 'Цена RUB',
        'user' => 'Пользователь',
        'user_from' => 'От пользователя',
        'user_to' => 'К пользователю',
        'description' => 'Описание',
        'method' => 'Способ',
        'date' => 'Дата',
        'tax' => 'Сумма к оплате RUB'
    ],
    'descriptions' => [
        'INTAKE_EXTERNAL' => 'Внешнее пополнение',
        'INTAKE_INTERNAL' => 'Внутреннее пополнение',
        'DEDUCTION_EXTERNAL' => 'Внешнее отчисление',
        'ACCOUNT_TRANSFER' => 'Внутренний перевод',
        'DEDUCTION_INTERNAL' => 'Внутреннее отчисление',
        'TYPE_WITHDRAWAL' => 'Вывод средств'
    ],
    'errors' => [
        'notMoney' => 'Недостаточно средств',
        'transfer'  => 'Пользователи, от которого переводят и которому, должны быть разными'
    ],
    'notificationNames' => [
        'INTAKE_EXTERNAL' => 'Внешнее пополнение',
        'INTAKE_INTERNAL' => 'Внутреннее пополнение',
        'DEDUCTION_EXTERNAL' => 'Внешнее отчисление',
        'ACCOUNT_TRANSFER' => 'Внутренний перевод',
        'DEDUCTION_INTERNAL' => 'Внутреннее отчисление',
        'WITHDRAWAL' => 'Вывод средств',
    ],
    'notificationMessages' => [
        'INTAKE_EXTERNAL' => 'На ваш счёт зачислено :sum рублей',
        'INTAKE_INTERNAL' => 'На ваш счёт поступило :sum рублей',
        'DEDUCTION_EXTERNAL' => 'С вашего счёта списано :sum рублей',
        'ACCOUNT_TRANSFER_FROM' => 'С вашего счёта было переведено :sum рублей',
        'ACCOUNT_TRANSFER_TO' => 'На ваш счёта было переведено :sum рублей',
        'DEDUCTION_INTERNAL' => 'С вашего счёта была произведена оплата на сумму :sum рублей',
        'EXPULSION_COMPANY' => 'На ваш счет поступило :sum рублей',
        'WITHDRAWAL' => 'Вы сделали запрос на вывод средств в размере :sum рублей',
        'WITHDRAWAL_PAYMENT' => 'Ваш запрос на вывод средств  в размере :sum рублей принят',
        'WITHDRAWAL_REJECTED' => 'Ваш запрос на вывод средств  в размере :sum рублей отклонен',
    ],
    'createPayment' => 'Создание платежа',
    'intakeExternalPayment' => 'Внешнее пополнение',
    'deductionExternalPayment' => 'Внешнее отчисление',
    'accountTransferPayment' => 'Внутренний перевод',
    'success-flash-operation' => 'Операция прошла успешно!',
    'level' => [
        'level1' => 'первой структуры',
        'level2' => 'второй структуры',
        'level4' => 'четвертой структуры',
        'level5' => 'пятой структуры',
    ],
    'paymentProduct' => 'Покупка',
    'placeCount' => 'мест',
    'linkText' => 'Для продолжения оплаты перейдите по этой ссылке',
    'descriptionRefillBalance' => 'Пополнение счета',
    'descriptionTransfer' => 'Перевод средств',
    'descriptionTax' => 'При внесении платежа взывается комиссия в размере 10% - сумма к оплате ',
    'refillDescriptionTax' => 'При внесении платежа взывается комиссия в размере 10% - сумма к оплате :sum рублей',
    'transferSuccess' => 'Перевод произошел успешно'
];