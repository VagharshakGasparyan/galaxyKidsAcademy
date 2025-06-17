<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $params = explode('/', $request->getPathInfo());
        // Dump the first element (empty string) as getPathInfo() always returns a leading slash
        array_shift($params);
        if (\count($params) > 0) {
            $locale = $params[0];
            if (app('laravellocalization')->checkLocaleInSupportedLocales($locale)) {
                app()->setLocale($locale);
            }
        }

        return $next($request);
    }
}
