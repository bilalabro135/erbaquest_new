<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Settings;
class shouldVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $allow = Settings::get('registration');
        if(isset($allow['email_verification_on_reg']) && $allow['email_verification_on_reg'] == 1){ 
            return $next($request);   
        }
        else{
            return redirect('/');
        }
    }
}
