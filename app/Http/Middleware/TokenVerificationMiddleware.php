<?php

namespace App\Http\Middleware;

use App\Helper\JWTToken;
use Closure;
use Firebase\JWT\ExpiredException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->cookie('token');
        if (!$token) {
            return redirect('/')->cookie('token', '', -1);
        }

        try{
            $result = JWTToken::VerifyToken($token);

            if($result == 'unauthorized'){
                return  redirect('/')->cookie('token', '', -1);
            }
            else{
                $request->headers->set('email', $result);
                return $next($request);
            }
        }catch (ExpiredException $e) {
            // Token is expired — logout
            return redirect('/')->cookie('token', '', -1);
        } catch (\Exception $e) {
            // Other JWT issues (e.g., malformed token)
            return redirect('/')->cookie('token', '', -1);
        }


    }
}
