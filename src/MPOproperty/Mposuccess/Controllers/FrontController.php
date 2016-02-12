<?php
/**
 * Created by PhpStorm.
 * User: Andersen_user
 * Date: 21.08.2015
 * Time: 21:11
 */
namespace MPOproperty\Mposuccess\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Session\SessionManager as Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use MPOproperty\Mposuccess\BinaryTree\Sheet;
use MPOproperty\Mposuccess\BinaryTree\SheetManager;
use MPOproperty\Mposuccess\Repositories\User\UserRepository;
use MPOproperty\Mposuccess\Repositories\News\NewsRepository;
use DB;
/**
 * Handles all requests related to managing the data models
 */
class FrontController extends Controller {
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
    protected $layout = "mposuccess::layouts.front.main";

    /**
     * @param \Illuminate\Http\Request              $request
     * @param \Illuminate\Session\SessionManager    $session
     */
    public function __construct(Request $request, Session $session)
    {
        $this->request = $request;
        if ( ! is_null($this->layout))
        {
            $this->layout = view($this->layout);
            $this->layout->page = false;
            $this->layout->dashboard = false;
        }
        $this->layout->slider = null;
    }

    /**
     * The main view for any of the data models
     *
     * @return Response
     */
    public function index(NewsRepository $newsRepository)
    {
        $lastNews = $newsRepository->findNumberLastPublic(4);

        $this->layout->content = view("mposuccess::front.index", [
            'lastNews' => $lastNews
        ]);
        $this->layout->slider = view("mposuccess::layouts.front.slider");
        $this->layout->title = trans('mposuccess::front.home');
        return $this->layout;
    }

    public function structure()
    {
        $this->layout->content = view("mposuccess::front.success.structure");
        $this->layout->title = trans('mposuccess::front.success.structure');
        return $this->layout;
    }
    public function bonus()
    {
        $this->layout->content = view("mposuccess::front.success.bonus");
        $this->layout->title = trans('mposuccess::front.success.bonus');
        return $this->layout;
    }
    public function news(NewsRepository $newsRepository)
    {
        \Assets::add('news-front');

        $news = $newsRepository->findByTypeAndPaginate(config('mposuccess.news_type_company'), 10);

        $this->setNewsBackLink('news-front-news-link-back');

        $this->layout->content = view("mposuccess::front.news", [
            'news'      => $news,
            'urlPost'   => 'news'
        ]);
        $this->layout->title = trans('mposuccess::front.news');
        return $this->layout;
    }

    public function postNewsTypeCompany($id, NewsRepository $newsRepository)
    {
        $news = $newsRepository->findByIdAndType($id, config('mposuccess.news_type_company'));

        if (!$news) {
            abort(404);
        }

        \Assets::add('post');

        $this->layout->content = view("mposuccess::profile.post", [
            'news' => $news,
            'back' => $this->getNewsBackLink('news-front-news-link-back')
        ]);
        $this->layout->title = $news->name;
        return $this->layout;
    }

    public function articles(NewsRepository $newsRepository)
    {
        \Assets::add('news-front');

        $news = $newsRepository->findByTypeAndPaginate(config('mposuccess.news_type_world'), 10);

        $this->setNewsBackLink('news-front-articles-link-back');

        $this->layout->content = view("mposuccess::front.news", [
            'news'      => $news,
            'urlPost'   => 'article'
        ]);
        $this->layout->title = trans('mposuccess::front.article');
        return $this->layout;
    }

    public function article($id, NewsRepository $newsRepository)
    {
        $news = $newsRepository->findByIdAndType($id, config('mposuccess.news_type_world'));

        if (!$news) {
            abort(404);
        }

        \Assets::add('post');

        $this->layout->content = view("mposuccess::profile.post", [
            'news' => $news,
            'back' => $this->getNewsBackLink('news-front-articles-link-back')
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

    public function about()
    {
        $this->layout->content = view("mposuccess::front.about.about");
        $this->layout->title = trans('mposuccess::front.about.title');
        return $this->layout;
    }

    public function contacts($data = [])
    {

        if(\Request::isMethod('post')) {

            $validator = \Validator::make(
                [
                    'name' =>  \Request::input('name'),
                    'email' => \Request::input('email'),
                    'phone' => \Request::input('phone'),
                    'message' => \Request::input('message')
                ],
                [
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required',
                    'message' => 'required'
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors());
            }

            Mail::send('mposuccess::emails.mail', [
                'name' =>  \Request::input('name'),
                'email' => \Request::input('email'),
                'phone' => \Request::input('phone'),
                'text' => \Request::input('message')
            ], function($message)
            {
                $message->to('mpo-uspeh-m@yandex.ru', \Request::input('name'))->subject('Обратная связь');
            });

            $data['success'] = true;
        }
        $this->layout->content = view("mposuccess::front.about.contacts", $data);
        $this->layout->title = trans('mposuccess::front.about.contacts');
        return $this->layout;
    }

    public function rights()
    {
        $this->layout->content = view("mposuccess::front.about.rights");
        $this->layout->title = trans('mposuccess::front.about.rights');
        return $this->layout;
    }

    public function charter()
    {
        $this->layout->content = view("mposuccess::front.about.docs.charter");
        $this->layout->title = trans('mposuccess::front.about.docs.charter');
        return $this->layout;
    }

    public function regdocs()
    {
        $this->layout->content = view("mposuccess::front.about.docs.regdocs");
        $this->layout->title = trans('mposuccess::front.about.docs.regdocs');
        return $this->layout;
    }
    public function statement()
    {
        $this->layout->content = view("mposuccess::front.about.docs.statement");
        $this->layout->title = trans('mposuccess::front.about.docs.statement');
        return $this->layout;
    }

    public function test(Request $request){

        if ($request->has('submit')) {
            $tree = new SheetManager($request->input('id'), $request->input('tree'));
            $tree->create();
        }

        $this->layout->title = Null;
        $this->layout->content = view('mposuccess::home');
        return $this->layout;
    }
}
