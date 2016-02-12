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
use MPOproperty\Mposuccess\BinaryTree\Sheet;
use MPOproperty\Mposuccess\BinaryTree\SheetManager;
use MPOproperty\Mposuccess\Repositories\User\UserRepository;
use MPOproperty\Mposuccess\Repositories\News\NewsRepository;
use DB;
/**
 * Handles all requests related to managing the data models
 */
class LandingController extends Controller {
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
    protected $layout = "mposuccess::layouts.landing.index";

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
    public function index()
    {
        $this->layout->title = trans('mposuccess::front.home');
        return $this->layout;
    }
}