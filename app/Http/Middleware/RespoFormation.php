<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RespoFormation
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
        if (Auth::check()) {

            $nom_formation = $request->route('nom_formation');

            //dd($nom_formation);

            $user = Auth::user();
            if (!$user->estResponsableFormation($nom_formation)) {
                return redirect('/home');
            }

            return $next($request);
        }
        return redirect('/login');
    }
}
