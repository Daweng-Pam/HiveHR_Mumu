<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyIsEmployeeMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        if (auth()->user()->role == 2 && auth()->user()->career_role == 1 && auth()->user()->approved == 1){
            return redirect('/project-manager');
        }
        if (auth()->user()->role == 2 && auth()->user()->career_role != 1 && auth()->user()->approved == 1){
            return $next($request);
        }
        if (auth()->user()->role == 1){
            return redirect('/company');

        }
        return abort(403, 'Please Wait Till Your Account is Approved.');
    }
}
