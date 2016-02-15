<?php

namespace MPOproperty\Mpouspehm\Http\Auth;

use Illuminate\Support\Facades\Lang;
use MPOproperty\Mpouspehm\Models\User;
use MPOproperty\Mpouspehm\Repositories\User\UserRepository;
use MPOproperty\Mpouspehm\Repositories\Country\CountryRepository;
use MPOproperty\Mpouspehm\Repositories\Program\ProgramRepository;
use MPOproperty\Mpouspehm\Models\RoleCustom;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Redirect path after auth
     */
    protected $redirectPath = 'panel';


    /**
     * Todo пока в конструктор запихнул userRepository
     */
    protected $userRepository;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
        $this->middleware('guest', ['except' => ['getLogout', 'getRegister', 'getRefers']]);
        $this->userRepository = $repository;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        Validator::extend('cyrillic', function ($attribute, $value, $parameters) {
            return preg_match("/^[^-]{1}[А-Яа-яЁё-]+$/u", $value);
        });
        $data['name'] = trim($data['name']);
        $data['surname'] = trim($data['surname']);
        $data['patronymic'] = trim($data['patronymic']);
        $data['email'] = trim($data['email']);

        return Validator::make($data, [
            'name'                  => 'required|min:2|max:32|cyrillic',
            'surname'               => 'required|min:2|max:32|cyrillic',
            'patronymic'            => 'required|min:2|max:32|cyrillic',
            'email'                 => 'required|email|max:255|unique:users',
            'password'              => 'required|confirmed|min:8',
            'password_confirmation' => 'same:password',
            'birthday'              => 'required|date',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        /**
         * Todo не получилось заюзать репу
         */
        $user = User::create([
            'name'       => $data['name'],
            'surname'    => $data['surname'],
            'patronymic' => $data['patronymic'],
            'email'      => $data['email'],
            /*
             * remove hash password (replace in set attribute model User)
             */
            'password'   => $data['password'],
            'birthday'   => date_format(date_create($data['birthday']), 'Y-m-d'),
            'program'    => $data['program'],
            'country'    => $data['country'],
            'phone'      => $data['phone'],
            'refer'      => $data['refer'] ? $data['refer'] : config('mpouspehm.company_id')
        ]);

        $id = $user->id;
        $newUser = User::find($id);
        $newUser->sid = '';
        $newUser->save();

        $badUserRole = RoleCustom::where('slug', 'bad.user')->firstOrFail();
        $user->attachRole($badUserRole);

        return $user;
    }

    public function getLogin()
    {
        return view('mpouspehm::auth.login');
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
            ? Lang::get('auth.failed')
            : Lang::get('mpouspehm::front.auth.failed');
    }

    public function getRegister(ProgramRepository $program, CountryRepository $country, UserRepository $user, $sid = null)
    {
        $refer = $user->findBy('sid', $sid, ['id']);

        $data = [
            'countries' => $country->all(),
            'programs'  => $program->all(),
            'referID'   => $refer ? $refer->id : null
        ];

        return view('mpouspehm::auth.register', $data);
    }

    /*
     * Get list users (refers) by email or sid
     */
    public function getRefers(Request $request)
    {
        $q = '%' . $request->query('q') . '%';
        return User::select('id', DB::raw('CONCAT(name, " ", surname, "(", email, ")") AS name'))
            ->whereRaw('email like ? or sid like ? or id like ? or name like ? or surname like ?', [$q, $q, $q, $q, $q])
            ->take(10)->get();
    }
}
