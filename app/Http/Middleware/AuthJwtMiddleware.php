<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthJwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(request()->is("docs/api") || request()->is("api/loginUser") ||request()->is("api/registerUser") ){
            return $next($request);
        }elseif(request()->is("api/")){
            try{

                $userLogged = JWTAuth::parseToken()->authenticate();

            }catch (\Exception $e){
                return response([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
            }
        }
        return $next($request);





    }
}
