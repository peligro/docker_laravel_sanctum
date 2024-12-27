<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomAuthMiddleware
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
        try {
            // Verifica si el token es válido
            JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            // Token expirado
            return response()->json(['error' => 'El token ha expirado'], 401);
        } catch (TokenInvalidException $e) {
            // Token inválido
            return response()->json(['error' => 'El token es inválido'], 401);
        } catch (JWTException $e) {
            // Token no proporcionado
            return response()->json(['error' => 'Token no proporcionado'], 401);
        } catch (Exception $e) {
            // Otro error relacionado con el token
            return response()->json(['error' => 'Error de autenticación'], 401);
        }

        return $next($request);
    }
}
