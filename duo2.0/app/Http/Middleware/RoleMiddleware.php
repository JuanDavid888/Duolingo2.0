<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Espera lista de roles separados por ':' en la declaración del middleware: 'role:admin|editor'
     */
    public function handle($request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        // roles permitidos separados por |
        $allowed = explode('|', $roles);

        // Ajusta la comprobación según tu estructura: role (singular) o roles (many)
        $userRoleNames = [];

        if (method_exists($user, 'roles')) {
            // muchos a muchos
            $userRoleNames = $user->roles()->pluck('name')->map(fn($n)=>strtolower($n))->toArray();
        } elseif (method_exists($user, 'role') && $user->role) {
            $userRoleNames = [strtolower($user->role->name)];
        } elseif (!empty($user->role_name)) {
            $userRoleNames = [strtolower($user->role_name)];
        }

        foreach ($allowed as $r) {
            if (in_array(strtolower($r), $userRoleNames)) {
                return $next($request);
            }
        }

        // Si no tiene permiso, puedes devolver 403 o redirigir
        abort(403, 'No tienes permiso para ver esta página.');
    }
}
