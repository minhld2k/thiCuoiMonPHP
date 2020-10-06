<?php

namespace App\Http\Middleware;

use Closure;

class saferequest
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
        $stdout = fopen('php://stdout','w');
        //fwrite($stdout,"Start ".Route::currentRouteName() . " ". date("Y-m-d H:i:s")."\n");
        $r = $next($request);
       // fwrite($stdout,"End ".Route::currentRouteName() . " ". date("Y-m-d H:i:s")."\n");
        foreach($_REQUEST as $key=>$value){
            if (strpos($value,"/")) {
                
                return redirect('manhinhthemmoi');
            }
        }
        return $r;
    }
}
