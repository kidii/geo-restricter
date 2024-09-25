<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpFoundation\Response;
use Torann\GeoIP\Facades\GeoIP;

class BlockCaliforniaUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     *
     * @throws \Exception
     */
    public function handle(Request $request, Closure $next): Response
    {
        $agent = new Agent;

        if ($agent->isRobot()) {
            return $next($request);
        }

        $geo = GeoIP::getLocation($request->ip());

        if ($geo && $geo->state == 'CA') {
            abort(code: 404, message: 'Sorry, California users are not allowed to access this website.');
        }

        return $next($request);
    }
}
