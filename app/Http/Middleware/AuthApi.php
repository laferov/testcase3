<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class AuthApi extends Middleware
{
    protected function authenticate($request, array $guards) 
    {
        $token = $request->query('api_token');
        if (empty($token)) {
            $token = $request->bearerToken();
        }
        if ( config('app')['api_token'] === $token) return;
        $this->unauthenticated($request,$guards);
    }
}
