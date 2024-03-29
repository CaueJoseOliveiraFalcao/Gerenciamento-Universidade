<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->can('admin') || auth()->user()->can('coordinator')) {
            return $next($request);
        }
        abort(403, 'Você não tem permissão para acessar esta página.');
    }
}
