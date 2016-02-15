<?php
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 21.08.2015
 * Time: 0:31
 */

Route::controllers([
    'auth' => 'MPOproperty\Mpouspehm\Http\Auth\AuthController',
    'password' => 'MPOproperty\Mpouspehm\Http\Auth\PasswordController',
]);

Route::group(['domain' => config('mpouspehm.landing_host')], function()
{
    Route::get('/', array(
        'as'    => 'landing',
        'uses'  => 'MPOproperty\Mpouspehm\Controllers\LandingController@index'
    ));
});

Route::group(['domain' => config('mpouspehm.site_host')], function() {

    Route::get('/', array(
        'as' => 'home',
        'uses' => 'MPOproperty\Mpouspehm\Controllers\FrontController@index',
    ));


    Route::get('success/structure', array(
        'as' => 'structure',
        'uses' => 'MPOproperty\Mpouspehm\Controllers\FrontController@structure',
    ));
    Route::get('success/bonus', array(
        'as' => 'bonus',
        'uses' => 'MPOproperty\Mpouspehm\Controllers\FrontController@bonus',
    ));


    Route::get('news', array(
        'as' => 'news',
        'uses' => 'MPOproperty\Mpouspehm\Controllers\FrontController@news',
    ));

    Route::get('news/{id}', array(
        'as' => 'news.post',
        'uses' => 'MPOproperty\Mpouspehm\Controllers\FrontController@postNewsTypeCompany',
    ));

    Route::get('articles', array(
        'as' => 'articles',
        'uses' => 'MPOproperty\Mpouspehm\Controllers\FrontController@articles',
    ));

    Route::get('article/{id}', array(
        'as' => 'article',
        'uses' => 'MPOproperty\Mpouspehm\Controllers\FrontController@article',
    ));

    Route::group(['prefix' => 'about'], function () {

        Route::get('/', array(
            'as' => 'about',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\FrontController@about',
        ));

        Route::any('contacts', array(
            'as' => 'contacts',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\FrontController@contacts',
        ));

        Route::get('rights', array(
            'as' => 'rights',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\FrontController@rights',
        ));

        Route::get('charter', array(
            'as' => 'charter',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\FrontController@charter',
        ));

        Route::get('regdocs', array(
            'as' => 'regdocs',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\FrontController@regdocs',
        ));
        Route::get('statement', array(
            'as' => 'statement',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\FrontController@statement',
        ));

    });
});


Route::group([
    'middleware' => 'MPOproperty\Mpouspehm\Http\Middleware\AdminMiddleware',
    'prefix' => config('mpouspehm.panel_admin_url')
],
    function () {
        /*
         * Роуты для админа. Проверка на админа в MPOproperty\Mpouspehm\Http\Middleware\Admin и если нет прав перенапровление а лучше 404
         */
        Route::get('news', array(
            'as' => config('mpouspehm.admin_prefix') . '.news',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@news'
        ));

        Route::get('news/post/{id}', array(
            'as' => config('mpouspehm.panel_url') . 'news.post',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@post',
        ));

        Route::match(['get', 'post'], 'news/update/{id?}', array(
            'as' => config('mpouspehm.admin_prefix') . '.news.update',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@updateNews'
        ));

        Route::post('news/delete/{id}', array(
            'as' => config('mpouspehm.admin_prefix') . '.news.delete',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@deleteNews'
        ));

        //Страница платежей
        Route::match(['get', 'post'], 'payments', array(
            'as' => config('mpouspehm.admin_prefix') . '.payments',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@payments'
        ));

        //Форма выполнения денежных операций
        Route::get('payments/create', array(
            'as' => config('mpouspehm.admin_prefix') . '.payments.create',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@createPayments'
        ));

        //Внешнее поступление
        Route::post('payments/intakeExternalPayment', array(
            'as' => config('mpouspehm.admin_prefix') . '.payments.intakeExternalPayment',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@intakeExternalPayment'
        ));

        //Внешнее отчисление
        /*Route::post('payments/deductionExternalPayment', array(
            'as' => config('mpouspehm.admin_prefix') . '.payments.deductionExternalPayment',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@deductionExternalPayment'
        ));*/

        //Внутренний перевод
        Route::post('payments/accountTransferPayment', array(
            'as' => config('mpouspehm.admin_prefix') . '.payments.accountTransferPayment',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@accountTransferPayment'
        ));


        /*Route::match(['get', 'post'], 'payments/update/{id?}', array(
            'as'    => config('mpouspehm.admin_prefix') . '.payments.update',
            'uses'  => 'MPOproperty\Mpouspehm\Controllers\AdminController@updatePayments'
        ));*/

        /*Route::post('payments/delete/{id}', array(
            'as'    => config('mpouspehm.admin_prefix') . '.payments.delete',
            'uses'  => 'MPOproperty\Mpouspehm\Controllers\AdminController@deletePayments'
        ));*/

        Route::get('reports', array(
            'as' => config('mpouspehm.admin_prefix') . '.reports',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@reports'
        ));

        //вывод средств таблица
        Route::match(['get', 'post'], 'withdrawal', array(
            'as' => config('mpouspehm.admin_prefix') . '.withdrawal',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@withdrawal'
        ));

        //изменение статуса в таблице вывода средств на "Оплачено"
        Route::post('withdrawal/{id}/paid', array(
            'as' => config('mpouspehm.admin_prefix') . '.withdrawalStatusPaid',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@withdrawalStatusPaid'
        ));

        //изменение статуса в таблице вывода средств на "Отклонено"
        Route::post('withdrawal/{id}/rejected', array(
            'as' => config('mpouspehm.admin_prefix') . '.withdrawalStatusRejected',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@withdrawalStatusRejected'
        ));

        Route::get('helperSettings', array(
            'as' => config('mpouspehm.admin_prefix') . '.helperSettings',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@helperSettings'
        ));

        Route::match(['get', 'post'], 'users', array(
            'as' => config('mpouspehm.admin_prefix') . '.users',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@users'
        ));

        Route::match(['get', 'post'], 'user/{id}/{action}', array(
            'as' => config('mpouspehm.admin_prefix') . '.user',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@userAction'
        ));

        Route::get('products', array(
             'as'    => config('mpouspehm.admin_prefix') . '.products',
             'uses'  => 'MPOproperty\Mpouspehm\Controllers\AdminController@products'
        ));
        Route::match(['get', 'post'],'entities', array(
            'as'    => config('mpouspehm.admin_prefix') . '.entities',
            'uses'  => 'MPOproperty\Mpouspehm\Controllers\AdminController@entities'
        ));
        Route::match(['get', 'post'], 'entity/{id?}/{action}', array(
            'as'    => config('mpouspehm.admin_prefix') . '.entity',
            'uses'  => 'MPOproperty\Mpouspehm\Controllers\AdminController@entityAction'
        ));
        Route::match(['get', 'post'], 'product/update/{id?}', array(
            'as' => config('mpouspehm.admin_prefix') . '.product.update',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@updateProduct'
        ));
        Route::post('product/delete/{id}', array(
            'as' => config('mpouspehm.admin_prefix') . '.product.delete',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@deleteProduct'
        ));

        Route::get('tree_settings', array(
            'as' => config('mpouspehm.admin_prefix') . '.tree_settings',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@tree_settings'
        ));
    }
);

Route::group([
    'middleware' => 'MPOproperty\Mpouspehm\Http\Middleware\UserMiddleware',
    'prefix' => config('mpouspehm.panel_url')
],
    function () {
        Route::get('/', array(
            'as' => config('mpouspehm.panel_url') . '.panel',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@dashboard',
        ));


        /*
         * Мой профиль
         */
        Route::get('personal', array(
            'as' => config('mpouspehm.panel_url') . '.personal',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@personal',
        ));

        Route::get('user/{id}', array(
            'as' => config('mpouspehm.panel_url') . '.user',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@user',
        ));

        Route::get('partner', array(
            'as' => config('mpouspehm.panel_url') . '.partner',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@partner',
        ));


        Route::post('changeData', array(
            'as' => config('mpouspehm.panel_url') . '.changeData',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@changeData',
        ));

        Route::post('changeAvatar', array(
            'as' => config('mpouspehm.panel_url') . '.changeAvatar',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@changeAvatar',
        ));

        Route::get('removeAvatar', array(
            'as' => config('mpouspehm.panel_url') . '.removeAvatar',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@removeAvatar',
        ));

        Route::post('changePassword', array(
            'as' => config('mpouspehm.panel_url') . '.changePassword',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@changePassword',
        ));

        /*
         * Личные данные
         */
        Route::get('dashboard', array(
            'as' => config('mpouspehm.panel_url') . '.dashboard',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@dashboard',
        ));

        Route::get('news', array(
            'as' => config('mpouspehm.panel_url') . '.news',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@newsPrivate',
        ));

        Route::get('post/{id}', array(
            'as' => config('mpouspehm.panel_url') . '.post',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@postPrivate',
        ));

/*        Route::get('score/refill', array(
            'as' => config('mpouspehm.panel_url') . '.refill',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@refill',
        ));*/

        //todo from
        //Страница с выбором типа денежной операции для пользователя
        Route::match(['get', 'post'],'score/operations', array(
            'as' => config('mpouspehm.panel_url') . '.operations',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@operations',
        ));

        //Загрузка формы внутреннего перевода для пользователя
        Route::get('score/operation-transfer', array(
            'as' => config('mpouspehm.panel_url') . '.payments.transfer',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@operationTransfer'
        ));

        //Загрузка формы пополнения баланса
        Route::get('score/operation-refill', array(
            'as' => config('mpouspehm.panel_url') . '.payments.refill',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@operationRefill'
        ));

        //Загрузка формы вывода средств
        Route::get('score/conclusion', array(
            'as' => config('mpouspehm.panel_url') . '.payments.conclusion',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@operationСonclusion'
        ));

        //Внутренний перевод
        Route::post('score/profileTransferPayment', array(
            'as' => config('mpouspehm.panel_url') . '.payments.profileTransferPayment',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@profileTransferPayment'
        ));

        //Покупки пользователя
        Route::match(['get', 'post'], 'score/purchases', array(
            'as' => config('mpouspehm.panel_url') . '.purchases',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@purchases',
        ));

        //Бонусы пользователя
        Route::match(['get', 'post'], 'score/bonuses', array(
            'as' => config('mpouspehm.panel_url') . '.bonuses',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@bonuses',
        ));

        //Другие платежные операции пользователя
        Route::match(['get', 'post'], 'score/myOperations', array(
            'as' => config('mpouspehm.panel_url') . '.myOperations',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@myOperations',
        ));

        //Внутреннее пополнение баланса
        Route::post('score/refillBalance', array(
            'as'    => config('mpouspehm.panel_url') . '.payments.refillBalance',
            'uses'  => 'MPOproperty\Mpouspehm\Controllers\UserController@refillBalance',
        ));

        //Запрос на вывод средств
        Route::post('score/withdrawal', array(
            'as'    => config('mpouspehm.panel_url') . '.payments.withdrawalPayment',
            'uses'  => 'MPOproperty\Mpouspehm\Controllers\UserController@withdrawalPayment',
        ));
        //todo to

        Route::get('score/places', array(
            'as' => config('mpouspehm.panel_url') . '.places',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@places',
        ));

        Route::get('catalog', array(
            'as' => config('mpouspehm.panel_url') . '.catalog',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@catalog',
        ));

        Route::get('balance', array(
            'as' => config('mpouspehm.panel_url') . '.balance',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\UserController@balance',
        ));

        /*
         * помощник
         */
        Route::get('helper', array(
            'as' => config('mpouspehm.panel_url') . '.helper',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\ProfileController@helper',
        ));
        /*
         * Бонусные программы
         */
        Route::get('bonus', array(
            'as' => config('mpouspehm.panel_url') . '.bonus',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\ProfileController@bonus',
        ));


        /*
         * Настройки структур
         */
        Route::post('postSettings', array(
            'as' => config('mpouspehm.panel_admin_url') . '.postSettings',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\AdminController@postSettings',
        ));

    }
);


Route::group([
    'middleware' => 'MPOproperty\Mpouspehm\Http\Middleware\ProfileMiddleware',
    'prefix' => config('mpouspehm.panel_url')
],
    function () {
        Route::get('score/places', array(
            'as' => config('mpouspehm.panel_url') . '.places',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\ProfileController@places',
        ));

        Route::get('structures/{id}/{sid?}', array(
            'as' => config('mpouspehm.panel_url') . '.structures',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\ProfileController@structures',
        ));

        Route::get('tree', array(
            'as' => config('mpouspehm.panel_url') . '.tree',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\ProfileController@tree',
        ));


        Route::post('notification/{id}/mark', array(
            'as' => config('mpouspehm.panel_url') . '.notification.mark',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\ProfileController@notificationMark',
        ));

        Route::post('notification/markAll', array(
            'as' => config('mpouspehm.panel_url') . '.notification.markAll',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\ProfileController@notificationMarkAll',
        ));

        Route::match(['get', 'post'], 'notifications', array(
            'as' => config('mpouspehm.panel_url') . '.notifications',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\ProfileController@notifications',
        ));

        Route::post('notification/{id}/delete', array(
            'as' => config('mpouspehm.panel_url') . '.notification.delete',
            'uses' => 'MPOproperty\Mpouspehm\Controllers\ProfileController@notificationDelete',
        ));
    }
);


/**
 * Api
 */

Route::post('bye/tree/{url}/{count?}', array(
    'as' => 'bye.tree',
    'uses' => 'MPOproperty\Mpouspehm\Controllers\ByeController@buy',
));

Route::get('tree/build/{level}/{sid}/{currentSid}', array(
    'as' => 'tree.build',
    'uses' => 'MPOproperty\Mpouspehm\Controllers\ProfileController@build',
));

Route::post('/panel/notification/{count}', array(
    'as' => 'panel.notification',
    'uses' => 'MPOproperty\Mpouspehm\Controllers\ProfileController@notification',
));

Route::get('catalog/payment', array(
    'as' => 'panel.payment',
    'uses' => 'MPOproperty\Mpouspehm\Controllers\PaymentController@payment',
));

Route::get('catalog/payment/success', array(
    'as' => 'panel.payment',
    'uses' => 'MPOproperty\Mpouspehm\Controllers\PaymentController@paymentSuccess',
));

Route::get('catalog/payment/fail', array(
    'as' => 'panel.payment',
    'uses' => 'MPOproperty\Mpouspehm\Controllers\PaymentController@paymentFail',
));

Route::post('catalog/payment/transactionResult', array(
    'as' => 'panel.payment',
    'uses' => 'MPOproperty\Mpouspehm\Controllers\PaymentController@transactionResult',
));

//Walletone routes
Route::get('walletone/log', array(
    'as'    => 'walletone',
    'uses'  => 'MPOproperty\Mpouspehm\Controllers\WalletoneController@paymentLog',
));

Route::any('walletone/transactionResult', array(
    'as'    => 'walletone',
    'uses'  => 'MPOproperty\Mpouspehm\Controllers\WalletoneController@transactionResult',
));

Route::get('api/set/place/{id}/{sid}', array(
    'as' => 'api.set.place',
    'uses' => 'MPOproperty\Mpouspehm\Controllers\ProfileController@setPlace',
));

Route::get('api/get/tree', array(
    'as' => 'api.get.tree',
    'uses' => 'MPOproperty\Mpouspehm\Controllers\ProfileController@getTreeData',
));
