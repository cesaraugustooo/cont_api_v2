<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try{
            $token = $request->cookie('jwt_token') ?? null;

            if(!$token){
                return response()->json(['message'=>'Token inexistente'],401);
            }

            $user = JWTAuth::setToken($token)->authenticate();

            if(!$user){
                return response()->json(['message'=>'Token Invalido'],401);
            }

            auth()->setUser($user);

            return $next($request);
        }catch(TokenInvalidException $e){
            return response()->json(['message'=>'Token Invlaido'],401);
        }catch(TokenExpiredException $e){
            return response()->json(['message'=>'Token Expirado'],401);
        }catch(Exception $e){
            return response()->json(['message'=>'Erro na authenticacao'],401);
        }
    }
}
