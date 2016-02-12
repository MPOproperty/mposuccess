<?php
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 21.08.2015
 * Time: 21:11
 */
namespace MPOproperty\Mposuccess\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Session\SessionManager as Session;
use MPOproperty\Mposuccess\Repositories\Catalog\ProductRepository;
use MPOproperty\Mposuccess\Repositories\Notification\NotificationRepository;
use MPOproperty\Mposuccess\Repositories\Payment\ConclusionRepository;
use MPOproperty\Mposuccess\Repositories\Payment\ConclusionTypeRepository;
use MPOproperty\Mposuccess\Repositories\Payment\PaymentRepository;
use MPOproperty\Mposuccess\Repositories\Payment\WithdrawalRepository;
use MPOproperty\Mposuccess\Repositories\Transaction\StatusTransactionRepository;
use MPOproperty\Mposuccess\Repositories\Transaction\TransactionRepository;
use MPOproperty\Mposuccess\Repositories\Transaction\TypeTransactionRepository;
use MPOproperty\Mposuccess\Repositories\Tree\TreeRepository;
use MPOproperty\Mposuccess\Repositories\User\Criteria\Current;
use MPOproperty\Mposuccess\Repositories\User\UserRepository;
use MPOproperty\Mposuccess\Repositories\Country\CountryRepository;
use MPOproperty\Mposuccess\Repositories\Program\ProgramRepository;
use MPOproperty\Mposuccess\Repositories\News\NewsRepository;
use Hash;
use MPOproperty\Mposuccess\Requests\ProfileTransferRequest;
use Validator;
use Assets;
use DB as DBTransaction;
use Illuminate\Support\Facades\View;
use Request as RequestDefault;
use Illuminate\Pagination\Paginator;
use MPOproperty\Mposuccess\WalletOne\Request as WalletoneRequest;

/**
 * Handles all requests related to managing the data models
 */
class UserController extends Controller {
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
    /**
     * @var string
     */
    protected $layout = "mposuccess::layouts.panel.main";

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
    ) {

        $this->id = Auth::user()->id;

        $this->user = $user->find($this->id);

        if ($this->user->refer == '') {
            $this->user->refer = config('mposuccess.company_id');
        }

        $this->request = $request;
        if ( ! is_null($this->layout))
        {
            $this->layout = view($this->layout);
            if($this->user->is('bad.user')){
                $this->layout->slidebar = view('mposuccess::profile.layout.user.slidebar');
                $this->layout->r_slidebar = null;
            }elseif($this->user->is('user')){
                $this->layout->slidebar = view('mposuccess::profile.layout.slidebar');
                $this->layout->r_slidebar = view('mposuccess::profile.layout.r_slidebar');
            }else{
                $this->layout->slidebar = view('mposuccess::admin.layout.slidebar');
                $this->layout->r_slidebar = view('mposuccess::profile.layout.r_slidebar');
            }

            $this->layout->notifications = $notification->findAllBySid($this->id);
            $this->layout->notification_count = $notification->allCount($this->id);
            $this->layout->notification_new = $notification->newCount($this->id);

            $this->layout->balance = $payment->getUserBalance($this->user->id);
        }
    }

    /**
     * Данные пользавателя
     *
     * @return Response
     */
    public function personal(CountryRepository $country, ProgramRepository $program, UserRepository $userRepository)
    {
        \Assets::add('profile');

        TreeRepository::setTable('MPOproperty\Mposuccess\Models\Tree1');
        $treeRepository = app('MPOproperty\Mposuccess\Repositories\Tree\TreeRepository');

        $data = [
            'user'          => $this->user,
            'countries'     => $country->all(),
            'program'       => $program->find($this->user->program),
            'countPlaces'   => $treeRepository->getCountReferralPlaces($this->user->id)
        ];

        if ($this->id != 1) {
            $data['refer'] = $userRepository->getRefer($this->user->refer);
        }

        $this->layout->content = view("mposuccess::profile.personal", $data);
        $this->layout->title = trans('mposuccess::profile.myProfile');
        return $this->layout;
    }

    /**
     * Данные другого пользавателя
     *
     * @return Response
     */
    public function user($id, CountryRepository $countryRepository, ProgramRepository $programRepository, UserRepository $userRepository)
    {
        $user = $userRepository->find($id);
        if (!$user) {
            abort(404);
        }

        if ($user->refer == '') {
            $user->refer = config('mposuccess.company_id');
        }

        if ($user->birthday == "0000-00-00") {
            $user->birthday = null;
        } else {
            $user->birthday = date_format(date_create($user->birthday), 'd M Y');
        }

        $data = [
            'user'          => $user,
            'country'       => $countryRepository->findby('code', $user->country),
            'program'       => $programRepository->find($user->program)
        ];

        if ($this->id != 1) {
            $data['refer'] =  app('MPOproperty\Mposuccess\Repositories\User\UserRepository')->getRefer();
        }

        \Assets::add('profile-other');

        return view("mposuccess::profile.user", $data);

        /*$this->layout->content =
        $this->layout->title = trans('mposuccess::profile.user') . ' ' . $user->name;
        return $this->layout;*/
    }

    /**
     * Изменение личных данных
     *
     * @return Response
     */
    public function changeData(UserRepository $user)
    {
        $v = Validator::make($this->request->all(), [
            'name'       => 'required|min:2|max:32',
            'surname'    => 'required|min:2|max:32',
            'patronymic' => 'required|min:2|max:32',
            'birthday'   => 'required|date',
            'email'      => 'required|email|max:255|unique:users,email,' . $this->user->id,
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput()->with('tab', 1);
        }

        $user->update([
            'name'       => $this->request->input('name'),
            'surname'    => $this->request->input('surname'),
            'patronymic' => $this->request->input('patronymic'),
            'birthday'   => date_format(date_create($this->request->input('birthday')), 'Y-m-d'),
            'email'      => $this->request->input('email'),
            'phone'      => $this->request->input('phone')
        ], $this->user->id);

        return redirect()->back();
    }

    /**
     * Измение аватара
     *
     * @return Response
     */
    public function changeAvatar(UserRepository $user)
    {
        $user->changeAvatar($this->request, $this->user);

        return redirect()->back();
    }

    /**
     * Удаление аватара
     *
     * @return Response
     */
    public function removeAvatar(UserRepository $user)
    {
        $user->removeAvatar($this->user->id, $this->user->url_avatar);

        return redirect()->back();
    }

    /**
     * Изменение пароля
     *
     * @return Response
     */
    public function changePassword(UserRepository $user)
    {
        $v = Validator::make($this->request->all(), [
            'password'              => 'required|confirmed|min:8',
            'password_confirmation' => 'same:password',
        ]);

        $v->after(function($v) {
            if (!Hash::check($this->request->input('current'), $this->user->password)) {
                $v->errors()->add('current', 'Неправильный пароль!');
            }
        });

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors())->withInput()->with('tab', 3);
        }

        $user->update([
            'password' => bcrypt($this->request->input('password'))
        ], $this->user->id);

        return redirect()->back();
    }

    /**
     * Личные данные
     *
     * @return Response
     */
    public function dashboard(UserRepository $userRepository)
    {
        $hour = date('H')+3;
        if ($hour >= 0 && $hour < 6) {
            $time = "Доброй ночи";
        } elseif($hour>=6 && $hour<12) {
            $time = "Доброе утро";
        } elseif($hour>=12 && $hour<18) {
            $time = "Добрый день";
        } else {
            $time = "Добрый вечер";
        }

        $data = [
            'user'               => $this->user,
            'time'               => $time,
            'myPersonalChilds'   => $userRepository->findChilds($this->user->id),
            'myChilds'           => $userRepository->findAllChilds($this->user->id),
            'profit'             => $userRepository->sumProfit($this->user->id),
            'transactions'       => $userRepository->findAllTransactions($this->user->id),
        ];

        $this->layout->content = view("mposuccess::profile.dashboard", $data);
        $this->layout->title = trans('mposuccess::profile.personal');
        return $this->layout;
    }

    /**
     * Закрытые новости профиля
     *
     * @return Response
     */
    public function newsPrivate(NewsRepository $newsRepository)
    {
        \Assets::add('news-private');

        $perPage = $this->request->input('perPage') ? $this->request->input('perPage') : 3;

        $news = $newsRepository->findByTypeAndPaginate(config('mposuccess.news_type_private'), $perPage);

        $this->setNewsBackLink('news-panel-link-back');

        $this->layout->content = view("mposuccess::profile.news", [
            'news' => $news
        ]);
        $this->layout->title = trans('mposuccess::profile.news');
        return $this->layout;
    }

    /**
     * Просмотр новости (поста)
     *
     * @return Response
     */
    public function postPrivate($id, NewsRepository $newsRepository)
    {
        $news = $newsRepository->findByIdAndType($id, config('mposuccess.news_type_private'));

        if (!$news) {
            abort(404);
        }

        Assets::add('post');

        $this->layout->content = view("mposuccess::profile.post", [
            'news' => $news,
            'back' => $this->getNewsBackLink('news-panel-link-back')
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
     * пополнения счета
     *
     * @return Response
     */
    /*public function refill()
    {
        $this->layout->content = view("mposuccess::profile.score.refill");
        $this->layout->title = trans('mposuccess::profile.score.refill');
        return $this->layout;
    }*/

    /**
     * Каталог товаров для покупки
     *
     * @param ProductRepository $products
     *
     * @return Response
     */
    public function catalog(ProductRepository $products)
    {
        \Assets::add('catalog');

        $this->layout->content = view("mposuccess::profile.catalog", [
            'products' => $products->all()
        ]);

        foreach($products->all() as $p) {
            $ttt = $p->entities_all;
        }

        $this->layout->title = trans('mposuccess::profile.catalog');
        return $this->layout;
    }

    /**
     * Get current user balance
     *
     * @param PaymentRepository $payment
     * @return mixed
     */
    public function balance(PaymentRepository $payment)
    {
        return $payment->getUserBalance($this->user->id);
    }

    public function partner(CountryRepository $country, ProgramRepository $program, UserRepository $userRepository)
    {
        \Assets::add('profile');

        TreeRepository::setTable('MPOproperty\Mposuccess\Models\Tree1');
        $treeRepository = app('MPOproperty\Mposuccess\Repositories\Tree\TreeRepository');

        $data = [
            'user'          => $this->user,
            'countries'     => $country->all(),
            'program'       => $program->find($this->user->program),
            'countPlaces'   => $treeRepository->getCountReferralPlaces($this->user->id)
        ];

        if ($this->id != 1) {
            $data['refer'] = $userRepository->getRefer($this->user->refer);
        }

        $this->layout->content = view("mposuccess::profile.partner", $data);
        $this->layout->title = trans('mposuccess::profile.partnerProgram.title');
        return $this->layout;
    }

    /**
     * Страница денежных операций для пользователя
     *
     * @return View|string
     */
    public function operations()
    {
        \Assets::add('profile-operations');
        $user = app('MPOproperty\Mposuccess\Repositories\User\UserRepository');

        $data = [
            'users' => $user->lists('sid', 'id')
        ];

        $this->layout->content = view("mposuccess::profile.score.operations", $data);
        $this->layout->title = trans('mposuccess::profile.score.operations');

        return $this->layout;
    }

    /**
     * Загрузка модального окна перевода средств
     *
     * @param UserRepository $user
     * @return View
     */
    public function operationTransfer(UserRepository $user)
    {
        $data = [
            'users' => $user->lists('sid', 'id'),
            'descriptionTransfer' => trans('mposuccess::payment.descriptionTransfer'),
        ];

        return view("mposuccess::profile.score.transfer", $data);
    }

    /**
     * Загрузка модального окна вывода средств
     *
     * @param ConclusionTypeRepository $types
     * @return View
     */
    public function operationСonclusion(ConclusionTypeRepository $types )
    {
        $data = [
            'methods' => $types->lists('name', 'id'),
        ];

        return view("mposuccess::profile.score.conclusion", $data);
    }

    /**
     * Загрузка модального окна пополнения баланса
     *
     * @param UserRepository $user
     * @param PaymentRepository $payment
     * @return View
     */
    public function operationRefill(UserRepository $user, PaymentRepository $payment)
    {
        $data = [
            'users' => $user->lists('sid', 'id'),
            'descriptionRefill' => trans('mposuccess::payment.descriptionRefillBalance'),
            'descriptionTax' => trans('mposuccess::payment.descriptionTax'),
            'tax' => PaymentRepository::TAX
        ];

        return view("mposuccess::profile.score.refill", $data);
    }

    /**
     * Покупки пользавателя
     *
     * @param TransactionRepository $transactionRepository
     * @param TypeTransactionRepository $typeTransactionRepository
     * @param StatusTransactionRepository $statusTransactionRepository
     * @param Request $request
     * @return View|void
     */
    public function purchases(
        TransactionRepository $transactionRepository,
        TypeTransactionRepository $typeTransactionRepository,
        StatusTransactionRepository $statusTransactionRepository,
        Request $request
    )
    {
        if ($request->isMethod('get')) {

            Assets::add('payments-base');
            Assets::add('profile-payments');

            $this->layout->content = view("mposuccess::profile.score.purchases");
            $this->layout->title = trans('mposuccess::profile.score.purchases');

            return $this->layout;

        } else { /* post - get ajax users */
            return $transactionRepository->findByParamsForTable(
                $request->all(),
                $this->user->id,
                [TypeTransactionRepository::TYPE_DEDUCTION_INTERNAL],
                false
            );
        }
    }

    /**
     * Бонусы пользавателя
     *
     * @param TransactionRepository $transactionRepository
     * @param TypeTransactionRepository $typeTransactionRepository
     * @param StatusTransactionRepository $statusTransactionRepository
     * @param Request $request
     * @return View|void
     */
    public function bonuses(
        TransactionRepository $transactionRepository,
        TypeTransactionRepository $typeTransactionRepository,
        StatusTransactionRepository $statusTransactionRepository,
        Request $request
    )
    {
        if ($request->isMethod('get')) {

            Assets::add('payments-base');
            Assets::add('my-bonuses');

            $this->layout->content = view("mposuccess::profile.score.bonus");
            $this->layout->title = trans('mposuccess::profile.score.bonuses');

            return $this->layout;

        } else { /* post - get ajax users */
            return $transactionRepository->findByParamsForTable(
                $request->all(),
                $this->user->id,
                [TypeTransactionRepository::TYPE_EXPULSION_FROM_COMPANY],
                false
            );
        }
    }

    /**
     * Все денеженые операции пользавателя, кроме покупок и бонусов
     *
     * @param TransactionRepository $transactionRepository
     * @param TypeTransactionRepository $typeTransactionRepository
     * @param StatusTransactionRepository $statusTransactionRepository
     * @param Request $request
     * @return View|void
     */
    public function myOperations(
        TransactionRepository $transactionRepository,
        TypeTransactionRepository $typeTransactionRepository,
        StatusTransactionRepository $statusTransactionRepository,
        Request $request
    )
    {
        $userTypes = [
            TypeTransactionRepository::TYPE_INTAKE_INTERNAL,
            TypeTransactionRepository::TYPE_ACCOUNT_TRANSFER,
            TypeTransactionRepository::TYPE_WITHDRAWAL
        ];

        if ($request->isMethod('get')) {

            Assets::add('payments-base');
            Assets::add('my-operations');

            $this->layout->content = view("mposuccess::admin.payment.payments", [
                'types' => $typeTransactionRepository->getTypesByIds($userTypes),
                'statuses' => $statusTransactionRepository->all()
            ]);

            $this->layout->title = trans('mposuccess::profile.score.myOperations');

            return $this->layout;

        } else { /* post - get ajax users */
            return $transactionRepository->findByParamsForTable(
                $request->all(),
                $this->user->id,
                $userTypes,
                true
            );
        }
    }

    /**
     * Личные места пользавателя
     *
     * @return Response
     */
    public function places()
    {
        $this->layout->content = view("mposuccess::profile.score.places");
        $this->layout->title = trans('mposuccess::profile.score.places');
        return $this->layout;
    }

    /**
     * Внутренний перевод средств для пользователя
     *
     * @param PaymentRepository $payment
     * @param TransactionRepository $transaction
     * @param TypeTransactionRepository $type
     * @param StatusTransactionRepository $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profileTransferPayment(
        PaymentRepository $payment,
        TransactionRepository $transaction,
        TypeTransactionRepository $type,
        StatusTransactionRepository $status
    )
    {
        $data = RequestDefault::input();

        DBTransaction::transaction(function() use ($data, $status, $payment, $type, $transaction) {

            //Снимаем деньги у текущего пользователя
            $payment->changeBalance($this->user->id, $data['price_transfer'], $type::TYPE_DEDUCTION_INTERNAL, $type);

            //Начисляем деньги второму пользователю
            $payment->changeBalance($data['user_transfer_to'], $data['price_transfer'], $type::TYPE_INTAKE_INTERNAL, $type);

            $transactionData = [
                'status' => $status::STATUS_PAID,
                'type' => $type::TYPE_ACCOUNT_TRANSFER,
                'user' => $this->user->id,
                'description' => $data['description'],//trans('mposuccess::payment.descriptions.ACCOUNT_TRANSFER'),
                'price' => $data['price_transfer'],
                'from' => $this->user->id,
                'to' => $data['user_transfer_to']
            ];

            $transaction->createTransaction($transactionData);

            $payment->setPaymentNotification(
                $this->user->id,
                trans('mposuccess::payment.notificationNames.ACCOUNT_TRANSFER'),
                trans('mposuccess::payment.notificationMessages.ACCOUNT_TRANSFER_FROM', array('sum' => $data['price_transfer']))
            );

            $payment->setPaymentNotification(
                $data['user_transfer_to'],
                trans('mposuccess::payment.notificationNames.ACCOUNT_TRANSFER'),
                trans('mposuccess::payment.notificationMessages.ACCOUNT_TRANSFER_TO', array('sum' => $data['price_transfer']))
            );
        });

        return redirect(config('mposuccess.panel_url') . '/score/operations')->with([
            'status' => 'success',
            'message' => trans('mposuccess::payment.transferSuccess'),
            'name' => trans('mposuccess::payment.notificationNames.ACCOUNT_TRANSFER'),
        ]);
    }

    /**
     * Пополнение баланса. Создание транзакции и получение формы оплаты Walletone
     *
     * @return View
     */
    public function refillBalance()
    {
        $data = RequestDefault::input();

        /** @var TransactionRepository  $transaction */
        $transaction = app('MPOproperty\Mposuccess\Repositories\Transaction\TransactionRepository');
        $payment = app('MPOproperty\Mposuccess\Repositories\Payment\PaymentRepository');

        $wallet = new WalletoneRequest($this->user);
        $wallet->setDescription($data['description_refill']);
        $priceWithTax = $payment->calculatePriceWithTax($data['price_refill']);
        $wallet->setPaymentAmount($priceWithTax);

        $transactionSid = $transaction->transactionRefillBalance($this->user->id, $wallet->getPaymentAmount(), $data['description_refill']);

        if(!$transactionSid) {
            throw new \InvalidArgumentException("Что-то пошло не так...");
        }
        $refer = $wallet->send($transactionSid);
        $url = $wallet->parseCheckoutResponse($refer);


        $this->layout->title = trans('mposuccess::profile.payment');
        $this->layout->content = view("mposuccess::profile.payment", [
            'url' => $url,
            'redirectUrl' => '/panel/score/operations',
            'text' => trans('mposuccess::payment.linkText'),
            'sumDescription' => trans('mposuccess::payment.refillDescriptionTax', array('sum' => $priceWithTax)),
        ]);

        return $this->layout;
    }

    /**
     * Запрос на вывод средств
     *
     * @param WithdrawalRepository $withdrawal
     * @param PaymentRepository $payment
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function withdrawalPayment(
        WithdrawalRepository $withdrawal,
        PaymentRepository $payment
    )
    {
        $data = RequestDefault::input();

        $params = [
            'user_id' => $this->user->id,
            'description' => $data['description_conclusion'],
            'price' => $data['price_conclusion'],
            'method_id' => $data['method_conclusion'],
            'date' => $data['date_conclusion'],
        ];

        $withdrawal->createWithdrawal($params);


        $payment->setPaymentNotification(
            $this->user->id,
            trans('mposuccess::payment.notificationNames.WITHDRAWAL'),
            trans('mposuccess::payment.notificationMessages.WITHDRAWAL', array('sum' => $data['price_conclusion']))
        );

        return redirect(config('mposuccess.panel_url') . '/score/operations');
    }
}
