<?php

namespace App\Helper;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{
    public static function CreateToken($userEmail):string
    {
        $key=  env('JWT_KEY');
        $payload = [
            'iss' => env('JWT_ISSUER'),
            'iat' => time(),
            'exp' => time() + 3600,
            'userEmail' => $userEmail,
        ];
        return JWT::encode($payload, $key, 'HS256');
    }
    public static function VerifyToken($token):string
    {
        try{
            $key=  env('JWT_KEY');
            $decoded =  JWT::decode($token, new Key($key, 'HS256'));
            return $decoded->userEmail;
        }
        catch (Exception $exception){
             return 'unauthorized';
        }
    }

}
