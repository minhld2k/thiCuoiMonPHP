<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class authencation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $chucnang = DB::table('chucnangs')
        ->where('routename',Route::currentRouteName())
        ->first();
        if (isset($chucnang->id)) {
            $quyen = DB::table('chucnang_users')
            ->where('chucnang_id',$chucnang->id)
            ->where('user_id',Auth::user()->id)
            ->first();
            if ($quyen && $quyen->user_id == Auth::user()->id) {
                return $next($request);
            }else{
                return redirect('kocoquyen');
            }
        }else{
            return redirect('kocoquyen');
        }
    }
}
