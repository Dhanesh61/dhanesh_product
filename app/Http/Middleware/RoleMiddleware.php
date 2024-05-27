<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     protected $prefixName;

    public function __construct($prefixName)
    {
        $this->prefixName = $prefixName;
    }

    public function handle($request, Closure $next)
    {
        $prefix = $this->prefixName;

        //  dd("D");

         if (! $request->user()->hasRole($role)) {
            // Handle unauthorized access
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
