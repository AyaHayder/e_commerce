<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWTTokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token =$request->header('Authorization');
        if(!$token)
            return response()->json(
                [
                'errors'=>'Invalid token'
                ], 22);

        try{
            $user = JWTAuth::toUser($token);
            if(!$user)
                return response()->json(['errors'=>['Invalid Token']],401);
        }
        catch(JWTException $exception){
            return response()->json(['error' => 'Invalid Token'], 401);
        }

        return $next($request);
    }
}
