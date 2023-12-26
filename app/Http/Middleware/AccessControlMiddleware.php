<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessControlMiddleware
{
    use AuthorizesRequests;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()->getName();
        $ignorePermissions = config('accesslistexception')['ignore.permissions'];

        if (!in_array($routeName, $ignorePermissions)) {
            $this->authorize($routeName);
        }
       
        $this->authorize($routeName);

        return $next($request);
    }
}
