<?php
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 21.08.2015
 * Time: 21:11
 */
namespace MPOproperty\Mpouspehm\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MPOproperty\Mpouspehm\Repositories\Payment\ConclusionTypeRepository;
use MPOproperty\Mpouspehm\Repositories\Payment\PaymentRepository;
use MPOproperty\Mpouspehm\Repositories\Payment\WithdrawalRepository;
use MPOproperty\Mpouspehm\Repositories\Transaction\StatusTransactionRepository;
use MPOproperty\Mpouspehm\Repositories\Transaction\TypeTransactionRepository;
use MPOproperty\Mpouspehm\Requests\AccountTransferRequest;
use MPOproperty\Mpouspehm\Requests\DeductionExternalRequest;
use MPOproperty\Mpouspehm\Requests\IntakeExternalRequest;
use Request as RequestDefault;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Session\SessionManager as Session;
use Illuminate\Support\Facades\View;
use Illuminate\View\ViewServiceProvider;
use MPOproperty\Mpouspehm\Models\Transaction;
use MPOproperty\Mpouspehm\Repositories\Notification\NotificationRepository;
use MPOproperty\Mpouspehm\Repositories\Transaction\TransactionRepository;
use MPOproperty\Mpouspehm\Repositories\User\UserRepository;
use MPOproperty\Mpouspehm\Repositories\News\NewsRepository;
use MPOproperty\Mpouspehm\Repositories\Catalog\ProductRepository;
use MPOproperty\Mpouspehm\Repositories\Catalog\EntityRepository;
use MPOproperty\Mpouspehm\Repositories\Role\RoleRepository;
use MPOproperty\Mpouspehm\Repositories\Country\CountryRepository;
use MPOproperty\Mpouspehm\Repositories\Program\ProgramRepository;

use MPOproperty\Mpouspehm\Repositories\Tree\TreeSettingsRepository;
use Auth;
use DB as DBTransaction;
use Validator;
use Assets;


/**
 * Handles all requests related to managing the data models
 */
class AdminController extends ProfileController {

    /**
     * @var null
     */
    protected $id = null;

    /**
     * @var mixed|null
     */
    protected $user = null;

    /**
     * @param Request $request
     * @param Session $session
     * @param UserRepository $user
     * @param NotificationRepository $notification
     * @param PaymentRepository $payment
     */
    public function __construct(
        Request $request,
        Session $session,
        UserRepository $user,
        NotificationRepository $notification,
        PaymentRepository $payment
    )
    {
        $this->id = Auth::user()->id;

        $this->user = $user->find($this->id);

        $this->request = $request;
        if ( ! is_null($this->layout))
        {
            $this->layout = view($this->layout);
            $this->layout->slidebar = view('mpouspehm::admin.layout.slidebar');
            $this->layout->r_slidebar = null;

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
     * Управление статьями
     *
     * @return Response
     */
    public function article()
    {
        $this->layout->content = view("mpouspehm::admin.article");
        $this->layout->title = trans('mpouspehm::admin.article');
        return $this->layout;
    }

    /**
     * Управление новостями
     *
     * @return Response
     */
    public function news(NewsRepository $newsRepository)
    {
        \Assets::add('news-table');

        $news = $newsRepository->all(['id', 'img', 'name', 'preview', 'type', 'display', 'created_at', 'updated_at']);

        $this->setNewsBackLink('news-admin-link-back');

        $this->layout->content = view("mpouspehm::admin.news", [
            'news' => $news
        ]);
        $this->layout->title = trans('mpouspehm::admin.news');
        return $this->layout;
    }

    /**
     * Просмотр новости (поста)
     *
     * @return Response
     */
    public function post($id, NewsRepository $newsRepository)
    {
        $news = $newsRepository->findByIdAndType($id, null);

        if (!$news) {
            abort(404);
        }

        \Assets::add('post');

        $this->layout->content = view("mpouspehm::profile.post", [
            'news' => $news,
            'back' => $this->getNewsBackLink('news-admin-link-back')
        ]);
        $this->layout->title = $news->name;
        return $this->layout;
    }

    // TODO: Вынесть данные функции (set- и getNewsBackLink) в общий класс, изаются в User-, Admin-, FrontController
    /**
     * Получение ссылки "назад" при просмотре новости (поста)
     */
    private function getNewsBackLink($cookie_name)
    {
        return \Cookie::get($cookie_name);
    }

    /**
     * Формирование ссылки "назад" при просмотре новости (поста)
     */
    private function setNewsBackLink($cookie_name)
    {
        \Cookie::queue($cookie_name, \URL::to('/') . \Request::server('REQUEST_URI'));
    }

    /**
     * Добавление/изменение новостей
     *
     * @return Response
     */
    public function updateNews(Request $request, NewsRepository $newsRepository, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = [
                'headLine'   =>  $this->request->input('name'),
                'content'    =>  html_entity_decode($this->request->input('content')),
                'preview'    =>  html_entity_decode($this->request->input('preview')),
            ];

            $v = Validator::make($data, [
                'headLine'   => 'required|min:2|max:100',
                'content'    => 'required',
                'preview'    => 'required',
            ]);

            if ($v->fails())
            {
                return ['status' => "error", 'data' => $v->errors()];
            }

            if ($newsRepository->updateData($data, $request)) {
                return ['status' => "success"];
            } else {
                return ['status' => "error"];
            }
        } else { /* get method - get start data*/

            \Assets::reset()->add('news-form-editable');

            if ($id) { /* edit */
                $headerTitle = trans('mpouspehm::panel.news.edit');
                $news = $newsRepository->find($id);
            } else { /* add */
                $headerTitle = trans('mpouspehm::panel.news.add');
                $news = null;
            }

            return view('mpouspehm::admin.newsUpdate', [
                'news' => $news,
                'headerTitle' => $headerTitle
            ]);
        }
    }

    /**
     * Удаление новости
     *
     * @return Response
     */
    public function deleteNews(NewsRepository $newsRepository, $id)
    {
        return $newsRepository->delete($id);
    }

    /**
     * Просмотр списка транзакций
     *
     * @param TransactionRepository $transactionRepository
     * @param TypeTransactionRepository $typeTransactionRepository
     * @param StatusTransactionRepository $statusTransactionRepository
     * @param Request $request
     * @return View|void
     */
    public function payments(TransactionRepository $transactionRepository, TypeTransactionRepository $typeTransactionRepository,
        StatusTransactionRepository $statusTransactionRepository,  Request $request)
    {
        if ($request->isMethod('get')) {

            Assets::add('payments-base');
            Assets::add('admin-payments');

            $this->layout->content = view("mpouspehm::admin.payment.payments", [
                'types'     => $typeTransactionRepository->getTypesToTransactionTable(),
                'statuses' => $statusTransactionRepository->all()
            ]);
            $this->layout->title = trans('mpouspehm::payment.transactions');
            return $this->layout;

        } else { /* post - get ajax users */
            return $transactionRepository->findByParamsForTable($request->all());
        }
    }

    /**
     * Отображение формы выполнения денежных операций
     *
     * @param UserRepository $user
     * @param TransactionRepository $transaction
     * @return \Illuminate\Http\RedirectResponse|View
     */
    public function createPayments(UserRepository $user)
    {
        \Assets::add('payment-create');

        $data = [
            'users' => $user->lists('sid', 'id'),
        ];

        $this->layout->content = view("mpouspehm::admin.payment.create", $data);

        $this->layout->title = trans('mpouspehm::admin.payments.create');

        return $this->layout;
    }

    /**
     * Внешнее поступление средств
     *
     * @param PaymentRepository $payment
     * @param TransactionRepository $transaction
     * @param TypeTransactionRepository $type
     * @param StatusTransactionRepository $status
     * @param IntakeExternalRequest $validator
     * @return \Illuminate\Http\RedirectResponse
     */
    public function intakeExternalPayment(
        PaymentRepository $payment,
        TransactionRepository $transaction,
        TypeTransactionRepository $type,
        StatusTransactionRepository $status,
        IntakeExternalRequest $validator
    )
    {
        $data = RequestDefault::input();

        DBTransaction::transaction(function() use ($data, $status, $payment, $type, $transaction) {

            $payment->changeBalance($data['user_to'], $data['price_intake'], $type::TYPE_INTAKE_INTERNAL, $type);

            $transactionData = [
                'status' => $status::STATUS_PAID,
                'type' => $type::TYPE_INTAKE_INTERNAL, //TODO поступления общие, TYPE_INTAKE_EXTERNAL - убран
                'user' => $this->user->id,
                'description' => trans('mpouspehm::payment.descriptions.INTAKE_EXTERNAL'),
                'price' => $data['price_intake'],
                'from' => 0,
                'to' => $data['user_to']
            ];

            $transaction->createTransaction($transactionData);

            $payment->setPaymentNotification(
                $data['user_to'],
                trans('mpouspehm::payment.notificationNames.INTAKE_EXTERNAL'),
                trans('mpouspehm::payment.notificationMessages.INTAKE_EXTERNAL', array('sum' => $data['price_intake']))
            );
        });

        RequestDefault::session()->reflash();
        RequestDefault::session()->flash('alert-success', trans('mpouspehm::payment.success-flash-operation'));

        return redirect()->back();
    }

    /**
     * Внешнее отчисление средств
     *
     * @param PaymentRepository $payment
     * @param TransactionRepository $transaction
     * @param TypeTransactionRepository $type
     * @param StatusTransactionRepository $status
     * @param DeductionExternalRequest $validator
     * @return \Illuminate\Http\RedirectResponse
     */
    /*public function deductionExternalPayment(
        PaymentRepository $payment ,
        TransactionRepository $transaction,
        TypeTransactionRepository $type,
        StatusTransactionRepository $status,
        DeductionExternalRequest $validator
    )
    {
        $data = RequestDefault::input();

        DBTransaction::transaction(function() use ($data, $status, $payment, $type, $transaction) {
            $payment->changeBalance($data['user_from'], $data['price_deduction'], $type::TYPE_DEDUCTION_EXTERNAL, $type);

            $transactionData = [
                'status' => $status::STATUS_PAID,
                'type' => $type::TYPE_DEDUCTION_EXTERNAL,
                'user' => $this->user->id,
                'description' => trans('mpouspehm::payment.descriptions.DEDUCTION_EXTERNAL'),
                'price' => $data['price_deduction'],
                'from' => $data['user_from'],
                'to' => 0
            ];

            $transaction->createTransaction($transactionData);

            $payment->setPaymentNotification(
                $data['user_from'],
                trans('mpouspehm::payment.notificationNames.DEDUCTION_EXTERNAL'),
                trans('mpouspehm::payment.notificationMessages.DEDUCTION_EXTERNAL', array('sum' => $data['price_deduction']))
            );
        });

        RequestDefault::session()->reflash();
        RequestDefault::session()->flash('alert-success', trans('mpouspehm::payment.success-flash-operation'));

        return redirect()->back();
    }*/

    /**
     * Внутренний перевод средств
     *
     * @param PaymentRepository $payment
     * @param TransactionRepository $transaction
     * @param TypeTransactionRepository $type
     * @param StatusTransactionRepository $status
     * @param AccountTransferRequest $validator
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accountTransferPayment(
        PaymentRepository $payment,
        TransactionRepository $transaction,
        TypeTransactionRepository $type,
        StatusTransactionRepository $status,
        AccountTransferRequest $validator
    )
    {
        $data = RequestDefault::input();

        DBTransaction::transaction(function() use ($data, $status, $payment, $type, $transaction) {

            //Снимаем деньги у первого пользователя
            $payment->changeBalance($data['user_transfer_from'], $data['price_transfer'], $type::TYPE_DEDUCTION_INTERNAL, $type);

            //Начисляем деньги второму пользователю
            $payment->changeBalance($data['user_transfer_to'], $data['price_transfer'], $type::TYPE_INTAKE_INTERNAL, $type);

            $transactionData = [
                'status' => $status::STATUS_PAID,
                'type' => $type::TYPE_ACCOUNT_TRANSFER,
                'user' => $this->user->id,
                'description' => trans('mpouspehm::payment.descriptions.ACCOUNT_TRANSFER'),
                'price' => $data['price_transfer'],
                'from' => $data['user_transfer_from'],
                'to' => $data['user_transfer_to']
            ];

            $transaction->createTransaction($transactionData);

            $payment->setPaymentNotification(
                $data['user_transfer_from'],
                trans('mpouspehm::payment.notificationNames.ACCOUNT_TRANSFER'),
                trans('mpouspehm::payment.notificationMessages.ACCOUNT_TRANSFER_FROM', array('sum' => $data['price_transfer']))
            );

            $payment->setPaymentNotification(
                $data['user_transfer_to'],
                trans('mpouspehm::payment.notificationNames.ACCOUNT_TRANSFER'),
                trans('mpouspehm::payment.notificationMessages.ACCOUNT_TRANSFER_TO', array('sum' => $data['price_transfer']))
            );
        });

        RequestDefault::session()->reflash();
        RequestDefault::session()->flash('alert-success', trans('mpouspehm::payment.success-flash-operation'));

        return redirect()->back();
    }

    /**
     * Управление бухгалтерскими отчётами
     *
     * @return Response
     */
    public function reports()
    {
        $this->layout->content = view("mpouspehm::admin.reports");
        $this->layout->title = trans('mpouspehm::admin.reports');
        return $this->layout;
    }

    /**
     * Управление ролями пользователей
     *
     * @return Response
     */
    public function helperSettings()
    {
        $this->layout->content = view("mpouspehm::admin.helperSettings");
        $this->layout->title = trans('mpouspehm::admin.helperSettings');
        return $this->layout;
    }
    /**
     * Управление пользователями
     *
     * @return Response
     */
    public function users(Request $request, UserRepository $userRepository, RoleRepository $roleRepository)
    {
        if ($request->isMethod('get')) {

            Assets::add('admin-users');

            $this->layout->content = view("mpouspehm::admin.users", [
                'roles' => $roleRepository->all()
            ]);
            $this->layout->title = trans('mpouspehm::admin.user');
            return $this->layout;

        } else { /* post - get ajax users */
            return $userRepository->findByParamsForTable($request->all());
        }
    }

    /**
     * Управление пользователем (просмотр, редактирование, удаление)
     *
     * @return Response
     */
    public function userAction(Request $request, RoleRepository $roleRepository, ProgramRepository $programRepository, CountryRepository $countryRepository, UserRepository $userRepository, $id, $action)
    {
        switch($action) {
            case 'view':
                return view("mpouspehm::admin.user.view", [
                    'user' => $userRepository->find($id)
                ]);
            case 'edit':
                return view("mpouspehm::admin.user.edit", [
                    'user'      => $userRepository->find($id),
                    'countries' => $countryRepository->all(),
                    'programs'  => $programRepository->all(),
                    'roles'     => $roleRepository->all()
                ]);
            case 'save':
                $v = Validator::make($request->all(), [
                    'name'       => 'required|min:2|max:32',
                    'surname'    => 'required|min:2|max:32',
                    'patronymic' => 'required|min:2|max:32',
                    'birthday'   => 'required|date',
                    'email'      => 'required|email|max:255|unique:users,email,' . $id,
                    'role'       => 'required',
                ]);

                if ($v->fails())
                {
                    return ['status' => "error", 'data' => $v->errors()];
                }

                $result = $userRepository->update([
                    'name'       => $request->input('name'),
                    'surname'    => $request->input('surname'),
                    'patronymic' => $request->input('patronymic'),
                    'birthday'   => date_format(date_create($request->input('birthday')), 'Y-m-d'),
                    'email'      => $request->input('email'),
                    'phone'      => $request->input('phone'),
                    'country'    => $request->input('country'),
                    'program'    => $request->input('program')
                ], $id);

                if ($result) {
                    $user = $userRepository->find($id);
                    $user->detachAllRoles();
                    $role = $roleRepository->find($request->input('role'));
                    $user->attachRole($role);

                    return ['status' => "success"];
                } else {
                    return ['status' => "error"];
                }
            case 'delete':
                return $userRepository->delete($id);

            default:
                return 'unknown';
        }
    }

    /**
     * Управление продуктами (из каталога)
     *
     * @return View
     */
    public function products(ProductRepository $productRepository)
    {
        Assets::add('products-table');

        $products = $productRepository->all();

        $this->layout->content = view("mpouspehm::admin.products", [
            'products' => $products
        ]);
        $this->layout->title = trans('mpouspehm::admin.products');
        return $this->layout;
    }

    /**
     * Управление выводом средств
     *
     * @param WithdrawalRepository $withdrawal
     * @param StatusTransactionRepository $statusTransactionRepository
     * @param ConclusionTypeRepository $types
     * @param Request $request
     * @return View|void
     */
    public function withdrawal(
        WithdrawalRepository $withdrawal,
        StatusTransactionRepository $statusTransactionRepository,
        ConclusionTypeRepository $types,
        Request $request
    ) {
        if ($request->isMethod('get')) {

            Assets::add('payments-base');
            Assets::add('admin-withdrawal');

            $this->layout->content = view("mpouspehm::admin.withdrawal", [
                'statuses' => $statusTransactionRepository->getWithdrawalStatus(),
                'methods' => $types->lists('name', 'id'),
            ]);

            $this->layout->title = trans('mpouspehm::admin.withdrawal');

            return $this->layout;

        } else { /* post - get ajax users */
            return $withdrawal->findByParamsForTable($request->all());
        }
    }

    /**
     * Изменение статуса на Оплачено в списке запросов на вывод
     *
     * @param WithdrawalRepository $withdrawal
     * @param $id
     * @return array
     */
    public function withdrawalStatusPaid(WithdrawalRepository $withdrawal, $id)
    {
        $status = app('MPOproperty\Mpouspehm\Repositories\Transaction\StatusTransactionRepository');
        $payment = app('MPOproperty\Mpouspehm\Repositories\Payment\PaymentRepository');
        $type = app('MPOproperty\Mpouspehm\Repositories\Transaction\TypeTransactionRepository');
        $transaction = $user = app('MPOproperty\Mpouspehm\Repositories\Transaction\TransactionRepository');

        if($withdrawalModel = $withdrawal->changeWithdrawalStatus($id, $status::STATUS_PAID)){


            DBTransaction::transaction(function() use ($withdrawalModel, $status, $transaction, $type, $payment) {
                $payment->changeBalance($withdrawalModel->user_id, $withdrawalModel->price, $type::TYPE_WITHDRAWAL, $type);

                $transactionData = [
                    'status' => $status::STATUS_PAID,
                    'type' => $type::TYPE_WITHDRAWAL,
                    'user' => $withdrawalModel->user_id,
                    'description' => trans('mpouspehm::payment.notificationNames.WITHDRAWAL'),
                    'price' => $withdrawalModel->price,
                    'from' => 0,
                    'to' => $withdrawalModel->user_id
                ];

                $transaction->createTransaction($transactionData);

                $payment->setPaymentNotification(
                    $this->user->id,
                    trans('mpouspehm::payment.notificationNames.WITHDRAWAL'),
                    trans('mpouspehm::payment.notificationMessages.WITHDRAWAL_PAYMENT', array('sum' => $withdrawalModel->price))
                );
            });

            return ['status' => "success"];
        }

        return ['status' => "error"];
    }

    /**
     * Изменение статуса на Отклонено в списке запросов на вывод
     *
     * @param WithdrawalRepository $withdrawal
     * @param $id
     * @return array
     */
    public function withdrawalStatusRejected(WithdrawalRepository $withdrawal, PaymentRepository $payment, $id)
    {
        $status = app('MPOproperty\Mpouspehm\Repositories\Transaction\StatusTransactionRepository');

        if($price = $withdrawal->changeWithdrawalStatus($id, $status::STATUS_REJECTED)) {
            $payment->setPaymentNotification(
                $this->user->id,
                trans('mpouspehm::payment.notificationNames.WITHDRAWAL'),
                trans('mpouspehm::payment.notificationMessages.WITHDRAWAL_REJECTED', array('sum' => $price))
            );

            return ['status' => "success"];
        }

        return ['status' => "error"];
    }

    /**
     * Управление товарами (для продуктов)
     *
     * @return View
     */
    public function entities(Request $request, EntityRepository $entityRepository)
    {
        if ($request->isMethod('get')) {

            Assets::add('admin-entities');

            $this->layout->content = view("mpouspehm::admin.entities");
            $this->layout->title = trans('mpouspehm::admin.entities');
            return $this->layout;

        } else { /* post - get ajax entities */
            return $entityRepository->findByParamsForTable($request->all());
        }
    }
    /**
     * Управление продуктами (просмотр, редактирование, удаление)
     *
     * @return Response
     */
    public function entityAction(Request $request, EntityRepository $entityRepository, $id, $action)
    {
        switch($action) {
            case 'add':
                return view("mpouspehm::admin.entity.add");
            case 'edit':
                return view("mpouspehm::admin.entity.edit", [
                    'entity'      => $entityRepository->find($id)
                ]);
            case 'save':
                $data = [
                    'title'         => $request->input('name'),
                    'description'   => $request->input('description')
                ];

                $v = Validator::make($data, [
                    'title'         => 'required|max:100',
                    'description'   => 'required'
                ]);

                if ($v->fails())
                {
                    return ['status' => "error", 'data' => $v->errors()];
                }

                $result = $entityRepository->updateData([
                    'name'          => $request->input('name'),
                    'description'   => $request->input('description')
                ], $request, $id);


                if ($result) {
                    return ['status' => "success"];
                } else {
                    return ['status' => "error"];
                }
            case 'delete':
                return $entityRepository->delete($id);
            case 'delete-image':
                return $entityRepository->deleteImage($id);

            default:
                return 'unknown';
        }
    }

    /**
     * Добавление/изменение продукта
     *
     * @return Response
     */
    public function updateProduct(Request $request, ProductRepository $productRepository, EntityRepository $entityRepository, $id = null)
    {
        if ($request->isMethod('post')) {
            $data = [
                'title'     =>  $this->request->input('name'),
                'des'       =>  $this->request->input('desc'),
                'url'       =>  $this->request->input('url')
            ];

            $v = Validator::make($data, [
                'title'     => 'required',
                'des'       => 'required',
                'url'       => 'required|unique:products,url,'.$this->request->input('id'),
            ]);

            $v->after(function($v) {
                if (is_array($this->request->input('entities')) && is_array($this->request->input('counts')) && count($this->request->input('entities')) > 0 && count($this->request->input('entities')) != count($this->request->input('counts')) ) {
                    $v->errors()->add('Товары', 'Набор товаров и их количество не соответстует друг другу');
                }

                /*if (!is_array($this->request->input('entities')) || !count($this->request->input('entities'))) {
                    $v->errors()->add('Товары', 'Не выбрано ни одного товара');
                }*/
            });

            if ($v->fails())
            {
                return ['status' => "error", 'data' => $v->errors()];
            }

            if ($productRepository->updateData($data, $request)) {
                return ['status' => "success"];
            } else {
                return ['status' => "error"];
            }
        } else { /* get method - get start data*/

            Assets::reset()->add('product-form-editable');

            if ($id) { /* edit */
                $headerTitle = trans('mpouspehm::panel.products.edit');
                $product = $productRepository->find($id);
            } else { /* add */
                $headerTitle = trans('mpouspehm::panel.products.add');
                $product = null;
            }

            return view('mpouspehm::admin.productUpdate', [
                'product'       => $product,
                'headerTitle'   => $headerTitle,
                'entities'      => $entityRepository->all()
            ]);
        }
    }

    /**
     * Удаление продукта
     *
     * @return Response
     */
    public function deleteProduct(ProductRepository $productRepository, $id)
    {
        return $productRepository->delete($id);
    }

    /**
     * @param TreeSettingsRepository $settings
     * @return View
     */
    public function tree_settings(TreeSettingsRepository $settings)
    {
        $this->layout->content = view("mpouspehm::admin.tree_settings", [
            'settings' => $settings->getSettings()->toArray()
        ]);
        $this->layout->title = trans('mpouspehm::admin.tree_settings');
        return $this->layout;
    }

    public function postSettings(TreeSettingsRepository $settings)
    {
        $v = Validator::make($this->request->all(), [
            'cells_to_fill' => 'required|numeric',
            'first_pay'     => 'required|numeric',
            'next_pay'      => 'required|numeric',
            'sum_pay'       => 'required|numeric',
            'invited'       => 'required|numeric',
        ]);

        if($v->fails())
        {
            return redirect()->back()->withErrors($v)->withInput();
        }

        $settings->updateSettings([
            'cells_to_fill' => $this->request->input('cells_to_fill'),
            'first_pay'     => $this->request->input('first_pay'),
            'next_pay'      => $this->request->input('next_pay'),
            'sum_pay'       => $this->request->input('sum_pay'),
            'invited'       => $this->request->input('invited')
        ], $this->request->input('level'));

        return redirect('panel/admin/tree_settings');
    }
}