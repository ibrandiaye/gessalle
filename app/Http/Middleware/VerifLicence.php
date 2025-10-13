<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifLicence
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $user = Auth::user();

        // Le super admin n'est pas lié à une salle
        if ($user->role === 'superadmin') {
            return $next($request);
        }
        
        $salle = $user->salle;
        
        if (!$salle || !$salle->licences()->where('statut', 'active')->where("type","abonnement")->exists()) {
            return redirect()->back()->withErrors(['licence' => "Vous ne disposez pas d'une licence active pour effectuer cette action. "]);
        }

        return $next($request);
    }
}
