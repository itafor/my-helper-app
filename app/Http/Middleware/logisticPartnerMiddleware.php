<?php

namespace App\Http\Middleware;

use Closure;

class logisticPartnerMiddleware
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
        if(authUser()->userType == 'Logistic'){

        return $next($request);

    }else{

        return redirect('/home');

    }
    }
}
