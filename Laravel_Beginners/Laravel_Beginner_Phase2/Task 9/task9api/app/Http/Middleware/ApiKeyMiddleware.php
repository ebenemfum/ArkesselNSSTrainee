<?php

// ApiKeyMiddleware.php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class ApiKeyMiddleware
{
    public function handle($request, Closure $next)
    {
        $apiKey = $request->header('Authorization'); // Get the API key from the header

        if (!$apiKey || !User::where('api_key', $apiKey)->exists()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
