<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;
class SaveCurrentRouteName
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!$request->header('X-Livewire')) {
            $currentRouteName = Route::currentRouteName();
            if ($currentRouteName !== 'livewire.update') {
                Session::put('current_route_name', $currentRouteName);
            }
        }

        return $next($request);
    }
}
