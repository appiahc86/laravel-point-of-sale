<?php

namespace App\Http\Middleware;

use App\Company;
use Closure;

class CompanyMiddleware
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
        if (Company::all()->count() < 1){
            return redirect(route('add-company'));
        }

        return $next($request);
    }
}
