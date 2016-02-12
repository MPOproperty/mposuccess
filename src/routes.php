<?php
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 21.08.2015
 * Time: 0:31
 */

Route::controllers([
    'auth' => 'MPOproperty\Mposuccess\Http\Auth\AuthController',
    'password' => 'MPOproperty\Mposuccess\Http\Auth\PasswordController',
]);

Route::group(['domain' => config('mposuccess.landing_host')], function()
{
    Route::get('/', array(
        'as'    => 'landing',
        'uses'  => 'MPOproperty\Mposuccess\Controllers\LandingController@index'
    ));
});

Route::group(['domain' => config('mposuccess.site_host')], function() {

    Route::get('/', array(
        'as' => 'home',
        'uses' => 'MPOproperty\Mposuccess\Controllers\FrontController@index',
    ));


    Route::get('success/structure', array(
        'as' => 'structure',
        'uses' => 'MPOproperty\Mposuccess\Controllers\FrontController@structure',
    ));
    Route::get('success/bonus', array(
        'as' => 'bonus',
        'uses' => 'MPOproperty\Mposuccess\Controllers\FrontController@bonus',
    ));


    Route::get('news', array(
        'as' => 'news',
        'uses' => 'MPOproperty\Mposuccess\Controllers\FrontController@news',
    ));

    Route::get('news/{id}', array(
        'as' => 'news.post',
        'uses' => 'MPOproperty\Mposuccess\Controllers\FrontController@postNewsTypeCompany',
    ));

    Route::get('articles', array(
        'as' => 'articles',
        'uses' => 'MPOproperty\Mposuccess\Controllers\FrontController@articles',
    ));

    Route::get('article/{id}', array(
        'as' => 'article',
        'uses' => 'MPOproperty\Mposuccess\Controllers\FrontController@article',
    ));

    Route::group(['prefix' => 'about'], function () {

        Route::get('/', array(
            'as' => 'about',
            'uses' => 'MPOproperty\Mposuccess\Controllers\FrontController@about',
        ));

        Route::any('contacts', array(
            'as' => 'contacts',
            'uses' => 'MPOproperty\Mposuccess\Controllers\FrontController@contacts',
        ));

        Route::get('rights', array(
            'as' => 'rights',
            'uses' => 'MPOproperty\Mposuccess\Controllers\FrontController@rights',
        ));

        Route::get('charter', array(
            'as' => 'charter',
            'uses' => 'MPOproperty\Mposuccess\Controllers\FrontController@charter',
        ));

        Route::get('regdocs', array(
            'as' => 'regdocs',
            'uses' => 'MPOproperty\Mposuccess\Controllers\FrontController@regdocs',
        ));
        Route::get('statement', array(
            'as' => 'statement',
            'uses' => 'MPOproperty\Mposuccess\Controllers\FrontController@statement',
        ));

    });
});


Route::group([
    'middleware' => 'MPOproperty\Mposuccess\Http\Middleware\AdminMiddleware',
    'prefix' => config('mposuccess.panel_admin_url')
],
    function () {
        /*
         * Роуты для админа. Проверка на админа в MPOproperty\Mposuccess\Http\Middleware\Admin и если нет прав перенапровление а лучше 404
         */
        Route::get('news', array(
            'as' => config('mposuccess.admin_prefix') . '.news',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@news'
        ));

        Route::get('news/post/{id}', array(
            'as' => config('mposuccess.panel_url') . 'news.post',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@post',
        ));

        Route::match(['get', 'post'], 'news/update/{id?}', array(
            'as' => config('mposuccess.admin_prefix') . '.news.update',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@updateNews'
        ));

        Route::post('news/delete/{id}', array(
            'as' => config('mposuccess.admin_prefix') . '.news.delete',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@deleteNews'
        ));

        //Страница платежей
        Route::match(['get', 'post'], 'payments', array(
            'as' => config('mposuccess.admin_prefix') . '.payments',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@payments'
        ));

        //Форма выполнения денежных операций
        Route::get('payments/create', array(
            'as' => config('mposuccess.admin_prefix') . '.payments.create',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@createPayments'
        ));

        //Внешнее поступление
        Route::post('payments/intakeExternalPayment', array(
            'as' => config('mposuccess.admin_prefix') . '.payments.intakeExternalPayment',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@intakeExternalPayment'
        ));

        //Внешнее отчисление
        /*Route::post('payments/deductionExternalPayment', array(
            'as' => config('mposuccess.admin_prefix') . '.payments.deductionExternalPayment',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@deductionExternalPayment'
        ));*/

        //Внутренний перевод
        Route::post('payments/accountTransferPayment', array(
            'as' => config('mposuccess.admin_prefix') . '.payments.accountTransferPayment',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@accountTransferPayment'
        ));


        /*Route::match(['get', 'post'], 'payments/update/{id?}', array(
            'as'    => config('mposuccess.admin_prefix') . '.payments.update',
            'uses'  => 'MPOproperty\Mposuccess\Controllers\AdminController@updatePayments'
        ));*/

        /*Route::post('payments/delete/{id}', array(
            'as'    => config('mposuccess.admin_prefix') . '.payments.delete',
            'uses'  => 'MPOproperty\Mposuccess\Controllers\AdminController@deletePayments'
        ));*/

        Route::get('reports', array(
            'as' => config('mposuccess.admin_prefix') . '.reports',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@reports'
        ));

        //вывод средств таблица
        Route::match(['get', 'post'], 'withdrawal', array(
            'as' => config('mposuccess.admin_prefix') . '.withdrawal',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@withdrawal'
        ));

        //изменение статуса в таблице вывода средств на "Оплачено"
        Route::post('withdrawal/{id}/paid', array(
            'as' => config('mposuccess.admin_prefix') . '.withdrawalStatusPaid',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@withdrawalStatusPaid'
        ));

        //изменение статуса в таблице вывода средств на "Отклонено"
        Route::post('withdrawal/{id}/rejected', array(
            'as' => config('mposuccess.admin_prefix') . '.withdrawalStatusRejected',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@withdrawalStatusRejected'
        ));

        Route::get('helperSettings', array(
            'as' => config('mposuccess.admin_prefix') . '.helperSettings',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@helperSettings'
        ));

        Route::match(['get', 'post'], 'users', array(
            'as' => config('mposuccess.admin_prefix') . '.users',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@users'
        ));

        Route::match(['get', 'post'], 'user/{id}/{action}', array(
            'as' => config('mposuccess.admin_prefix') . '.user',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@userAction'
        ));

        Route::get('products', array(
             'as'    => config('mposuccess.admin_prefix') . '.products',
             'uses'  => 'MPOproperty\Mposuccess\Controllers\AdminController@products'
        ));
        Route::match(['get', 'post'],'entities', array(
            'as'    => config('mposuccess.admin_prefix') . '.entities',
            'uses'  => 'MPOproperty\Mposuccess\Controllers\AdminController@entities'
        ));
        Route::match(['get', 'post'], 'entity/{id?}/{action}', array(
            'as'    => config('mposuccess.admin_prefix') . '.entity',
            'uses'  => 'MPOproperty\Mposuccess\Controllers\AdminController@entityAction'
        ));
        Route::match(['get', 'post'], 'product/update/{id?}', array(
            'as' => config('mposuccess.admin_prefix') . '.product.update',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@updateProduct'
        ));
        Route::post('product/delete/{id}', array(
            'as' => config('mposuccess.admin_prefix') . '.product.delete',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@deleteProduct'
        ));

        Route::get('tree_settings', array(
            'as' => config('mposuccess.admin_prefix') . '.tree_settings',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@tree_settings'
        ));
    }
);

Route::group([
    'middleware' => 'MPOproperty\Mposuccess\Http\Middleware\UserMiddleware',
    'prefix' => config('mposuccess.panel_url')
],
    function () {
        Route::get('/', array(
            'as' => config('mposuccess.panel_url') . '.panel',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@dashboard',
        ));


        /*
         * Мой профиль
         */
        Route::get('personal', array(
            'as' => config('mposuccess.panel_url') . '.personal',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@personal',
        ));

        Route::get('user/{id}', array(
            'as' => config('mposuccess.panel_url') . '.user',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@user',
        ));

        Route::get('partner', array(
            'as' => config('mposuccess.panel_url') . '.partner',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@partner',
        ));


        Route::post('changeData', array(
            'as' => config('mposuccess.panel_url') . '.changeData',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@changeData',
        ));

        Route::post('changeAvatar', array(
            'as' => config('mposuccess.panel_url') . '.changeAvatar',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@changeAvatar',
        ));

        Route::get('removeAvatar', array(
            'as' => config('mposuccess.panel_url') . '.removeAvatar',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@removeAvatar',
        ));

        Route::post('changePassword', array(
            'as' => config('mposuccess.panel_url') . '.changePassword',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@changePassword',
        ));

        /*
         * Личные данные
         */
        Route::get('dashboard', array(
            'as' => config('mposuccess.panel_url') . '.dashboard',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@dashboard',
        ));

        Route::get('news', array(
            'as' => config('mposuccess.panel_url') . '.news',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@newsPrivate',
        ));

        Route::get('post/{id}', array(
            'as' => config('mposuccess.panel_url') . '.post',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@postPrivate',
        ));

/*        Route::get('score/refill', array(
            'as' => config('mposuccess.panel_url') . '.refill',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@refill',
        ));*/

        //todo from
        //Страница с выбором типа денежной операции для пользователя
        Route::match(['get', 'post'],'score/operations', array(
            'as' => config('mposuccess.panel_url') . '.operations',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@operations',
        ));

        //Загрузка формы внутреннего перевода для пользователя
        Route::get('score/operation-transfer', array(
            'as' => config('mposuccess.panel_url') . '.payments.transfer',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@operationTransfer'
        ));

        //Загрузка формы пополнения баланса
        Route::get('score/operation-refill', array(
            'as' => config('mposuccess.panel_url') . '.payments.refill',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@operationRefill'
        ));

        //Загрузка формы вывода средств
        Route::get('score/conclusion', array(
            'as' => config('mposuccess.panel_url') . '.payments.conclusion',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@operationСonclusion'
        ));

        //Внутренний перевод
        Route::post('score/profileTransferPayment', array(
            'as' => config('mposuccess.panel_url') . '.payments.profileTransferPayment',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@profileTransferPayment'
        ));

        //Покупки пользователя
        Route::match(['get', 'post'], 'score/purchases', array(
            'as' => config('mposuccess.panel_url') . '.purchases',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@purchases',
        ));

        //Бонусы пользователя
        Route::match(['get', 'post'], 'score/bonuses', array(
            'as' => config('mposuccess.panel_url') . '.bonuses',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@bonuses',
        ));

        //Другие платежные операции пользователя
        Route::match(['get', 'post'], 'score/myOperations', array(
            'as' => config('mposuccess.panel_url') . '.myOperations',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@myOperations',
        ));

        //Внутреннее пополнение баланса
        Route::post('score/refillBalance', array(
            'as'    => config('mposuccess.panel_url') . '.payments.refillBalance',
            'uses'  => 'MPOproperty\Mposuccess\Controllers\UserController@refillBalance',
        ));

        //Запрос на вывод средств
        Route::post('score/withdrawal', array(
            'as'    => config('mposuccess.panel_url') . '.payments.withdrawalPayment',
            'uses'  => 'MPOproperty\Mposuccess\Controllers\UserController@withdrawalPayment',
        ));
        //todo to

        Route::get('score/places', array(
            'as' => config('mposuccess.panel_url') . '.places',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@places',
        ));

        Route::get('catalog', array(
            'as' => config('mposuccess.panel_url') . '.catalog',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@catalog',
        ));

        Route::get('balance', array(
            'as' => config('mposuccess.panel_url') . '.balance',
            'uses' => 'MPOproperty\Mposuccess\Controllers\UserController@balance',
        ));

        /*
         * помощник
         */
        Route::get('helper', array(
            'as' => config('mposuccess.panel_url') . '.helper',
            'uses' => 'MPOproperty\Mposuccess\Controllers\ProfileController@helper',
        ));
        /*
         * Бонусные программы
         */
        Route::get('bonus', array(
            'as' => config('mposuccess.panel_url') . '.bonus',
            'uses' => 'MPOproperty\Mposuccess\Controllers\ProfileController@bonus',
        ));


        /*
         * Настройки структур
         */
        Route::post('postSettings', array(
            'as' => config('mposuccess.panel_admin_url') . '.postSettings',
            'uses' => 'MPOproperty\Mposuccess\Controllers\AdminController@postSettings',
        ));

    }
);


Route::group([
    'middleware' => 'MPOproperty\Mposuccess\Http\Middleware\ProfileMiddleware',
    'prefix' => config('mposuccess.panel_url')
],
    function () {
        Route::get('score/places', array(
            'as' => config('mposuccess.panel_url') . '.places',
            'uses' => 'MPOproperty\Mposuccess\Controllers\ProfileController@places',
        ));

        Route::get('structures/{id}/{sid?}', array(
            'as' => config('mposuccess.panel_url') . '.structures',
            'uses' => 'MPOproperty\Mposuccess\Controllers\ProfileController@structures',
        ));

        Route::get('tree', array(
            'as' => config('mposuccess.panel_url') . '.tree',
            'uses' => 'MPOproperty\Mposuccess\Controllers\ProfileController@tree',
        ));


        Route::post('notification/{id}/mark', array(
            'as' => config('mposuccess.panel_url') . '.notification.mark',
            'uses' => 'MPOproperty\Mposuccess\Controllers\ProfileController@notificationMark',
        ));

        Route::post('notification/markAll', array(
            'as' => config('mposuccess.panel_url') . '.notification.markAll',
            'uses' => 'MPOproperty\Mposuccess\Controllers\ProfileController@notificationMarkAll',
        ));

        Route::match(['get', 'post'], 'notifications', array(
            'as' => config('mposuccess.panel_url') . '.notifications',
            'uses' => 'MPOproperty\Mposuccess\Controllers\ProfileController@notifications',
        ));

        Route::post('notification/{id}/delete', array(
            'as' => config('mposuccess.panel_url') . '.notification.delete',
            'uses' => 'MPOproperty\Mposuccess\Controllers\ProfileController@notificationDelete',
        ));
    }
);


/**
 * Api
 */

Route::post('bye/tree/{url}/{count?}', array(
    'as' => 'bye.tree',
    'uses' => 'MPOproperty\Mposuccess\Controllers\ByeController@buy',
));

Route::get('tree/build/{level}/{sid}/{currentSid}', array(
    'as' => 'tree.build',
    'uses' => 'MPOproperty\Mposuccess\Controllers\ProfileController@build',
));

Route::post('/panel/notification/{count}', array(
    'as' => 'panel.notification',
    'uses' => 'MPOproperty\Mposuccess\Controllers\ProfileController@notification',
));

Route::get('catalog/payment', array(
    'as' => 'panel.payment',
    'uses' => 'MPOproperty\Mposuccess\Controllers\PaymentController@payment',
));

Route::get('catalog/payment/success', array(
    'as' => 'panel.payment',
    'uses' => 'MPOproperty\Mposuccess\Controllers\PaymentController@paymentSuccess',
));

Route::get('catalog/payment/fail', array(
    'as' => 'panel.payment',
    'uses' => 'MPOproperty\Mposuccess\Controllers\PaymentController@paymentFail',
));

Route::post('catalog/payment/transactionResult', array(
    'as' => 'panel.payment',
    'uses' => 'MPOproperty\Mposuccess\Controllers\PaymentController@transactionResult',
));

//Walletone routes
Route::get('walletone/log', array(
    'as'    => 'walletone',
    'uses'  => 'MPOproperty\Mposuccess\Controllers\WalletoneController@paymentLog',
));

Route::any('walletone/transactionResult', array(
    'as'    => 'walletone',
    'uses'  => 'MPOproperty\Mposuccess\Controllers\WalletoneController@transactionResult',
));

Route::get('api/set/place/{id}/{sid}', array(
    'as' => 'api.set.place',
    'uses' => 'MPOproperty\Mposuccess\Controllers\ProfileController@setPlace',
));

Route::get('api/get/tree', array(
    'as' => 'api.get.tree',
    'uses' => 'MPOproperty\Mposuccess\Controllers\ProfileController@getTreeData',
));
