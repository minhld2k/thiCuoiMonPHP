<?php

namespace App\Http\Middleware;

use Closure;

class ghilog
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
        fwrite($stdout,"Start ". date("Y-m-d H:i:s")."\n");
        $r = $next($request);
        fwrite($stdout,"End ". date("Y-m-d H:i:s")."\n");

        return redirect('kocoquyen');
    }
}
