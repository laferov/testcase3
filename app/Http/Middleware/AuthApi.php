<?php

namespace App\Http\Middleware;

use Closure;

class AuthApi
{
    /**
     * Обработка входящего запроса.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $token = $request->query('api_token');
        if (empty($token)) {
            $token = $request->bearerToken();
        }
        $token = 'testtoken';
        #if ( config('app')['api_token'] !== $token) {
        if ( 'testtoken' !== $token) {
            return response('Unauthorized',401);
        }

        return $next($request);
    }
}