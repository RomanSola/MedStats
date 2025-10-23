<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UsuarioPerfil;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user && in_array('guest', $roles)) {
            return $next($request);
        }

        if ($user && is_null($user->role) && in_array('guest', $roles)) {
            return $next($request);
        }

        $perfiles = UsuarioPerfil::all();
        foreach( $perfiles as $perfil ){
            $rolMap [ $perfil->id ] = $perfil->perfil;
        }
            
        // $rolMap = [
        //     1 => 'administrador',
        //     2 => 'coordinador',
        //     3 => 'medico',
        //     4 => 'enfermeroQ',// Quirofano
        //     5 => 'enfermeroCI',// Cirugia
        //     6 => 'enfermeroP',// Pediatria
        //     7 => 'enfermeroCL'// Clinica
        // ];
        //dd($rolMap);
        $userRoleName = $rolMap[$user->role ?? 0] ?? null;
   
        if (in_array($userRoleName, $roles)) {
            return $next($request);
        }

        abort(403, 'Acceso no autorizado.');
    }
}
