<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class AuthDeviceMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        Log::info('Authorization Token:', ['token' => $token]);

        if (!$this->isDeviceAuthorized($token)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }

    private function isDeviceAuthorized($token): bool
    {
        if (strpos($token, 'Bearer ') === 0) {
            $token = substr($token, 7);
        }

        if ($token !== env('DEVICE_TOKEN')) {
            Log::warning('Unauthorized Device', ['token' => $token]);
            return false;
        }

        return true;
    }
}
