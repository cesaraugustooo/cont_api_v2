<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DiretorRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->nivel_user == '3'){
            return $next($request);
        }

        return response()->json(['message'=>'Rota protegida apenas para Diretores'],401);
    }
}
