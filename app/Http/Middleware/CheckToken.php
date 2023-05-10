<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if($guard != null){
            auth()->shouldUse($guard); //shoud you user guard / table
            $token = $request->header('auth-token');
            $request->headers->set('auth-token', (string) $token, true);
//            $request->headers->set('Authorization', 'Bearer '.$token, true);
            try {
//                $user = $this->auth->authenticate($request);  //check authenticted user
//                $user = Auth::id();
//                $user = JWTAuth::parseToken()->authenticate();
                JWTAuth::parseToken()->authenticate();
                $request->merge(['user' => auth('api')->user()]);
            } catch (TokenExpiredException $e) {
                return  response()->json($e->getMessage(),$e->getCode());
            } catch (JWTException $e) {
                return  response()->json($e->getMessage(),$e->getCode());
            }

        }
        return $next($request);
    }
}
