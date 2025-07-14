<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class VerifSalle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
       // dd($user);
        if($user && $user->salle_id && $user->role!="superadmin" )
        {
            $salle = DB::table("salles")->where("id",$user->salle_id)->first();

            if($salle->etat=="active")
            {
                return $next($request);
            }
            elseif($salle->etat=="inactive")
            {
                return redirect("/bloque");
            }

        }

        return $next($request);
    }
}
