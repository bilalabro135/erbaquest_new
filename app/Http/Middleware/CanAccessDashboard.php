<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Bouncer;
use Auth;
use Redirect;
class CanAccessDashboard
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

        $user= Auth::user();
        if(Bouncer::can('accessDashboard')){
              return $next($request);
        }
        else if(Bouncer::is($user)->an('Organizer')){
            return Redirect::route('events.create');
        }
        else if(Bouncer::is($user)->an('Vendor')) {
            return Redirect::route('public.profile');
        }
        else{
            return Redirect::route('home');
        }
    }
}
