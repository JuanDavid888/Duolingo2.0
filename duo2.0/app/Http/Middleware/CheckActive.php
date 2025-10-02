<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckActive
{

    /**
     * Se espera que el usuario este activo para proseguir
     * 'is_active' = true = 1
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            // Obtener el modelo y su información
            $user = $request->user();

            $stateUser = $user->is_active;

            // Verificar el estado
            if(!$stateUser) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Usuario inactivo'
                ], 401);
            }

            return $next($request);

        } catch (\Throwable $th) {
            // Devolver mensaje de error
            return response()->json([
                'status' => 'error',
                'message' => 'Error interno del servidor en verificación de roles'
            ], 500);
        }
    }
}
