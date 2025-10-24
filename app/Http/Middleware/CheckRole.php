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

        if (!$user) {
            abort(403, 'Usuario no autenticado.');
        }

        // Buscar el perfil del usuario
        $perfil = UsuarioPerfil::find($user->role);

        // dd($perfil);
        if (!$perfil) {
            abort(403, 'Perfil no encontrado.');
        }
        //dd($roles);
        // Verificar si el perfil tiene permiso para el módulo solicitado
        foreach ($roles as $rol) {
            if (isset($perfil->$rol) && $perfil->$rol) {
                return $next($request);
            }
            // if (!isset($perfil->$rol) || !$perfil->$rol) {
            //     abort(403, "El perfil '{$perfil->perfil}' no tiene acceso a este módulo.");
            // }
        }

        abort(403, "El perfil '{$perfil->perfil}' no tiene acceso a este módulo.");

        // if (!$user && in_array('guest', $roles)) {
        //     return $next($request);
        // }

        // if ($user && is_null($user->role) && in_array('guest', $roles)) {
        //     return $next($request);
        // }

        // $perfiles = UsuarioPerfil::all();
        // foreach( $perfiles as $perfil ){
        //     $rolMap [ $perfil->id ] = $perfil->perfil;
        // }

        // $userRoleName = $rolMap[$user->role ?? 0] ?? null;

        // if (in_array($userRoleName, $roles)) {
        //     return $next($request);
        // }

        // abort(403, 'Acceso no autorizado.');
    }
}
