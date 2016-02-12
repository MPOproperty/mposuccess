<?php
/**
 * Created by PhpStorm.
 * User: MPOproperty
 * Date: 31.08.2015
 * Time: 12:51
 */

namespace MPOproperty\Mposuccess\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use MPOproperty\Mposuccess\Models\User;

class AdminMiddleware{
    public function handle($request, Closure $next){
        if(Auth::check()) {
            $user = User::find(Auth::user()->id);

            if(!$user->is('admin')) {
                abort('404');
            }
            return $next($request);
        }
        abort('404');
    }
}