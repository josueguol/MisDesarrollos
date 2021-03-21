<?php

class AUTHORIZATION
{
    public static function validateTimestamp($auth)
    {
        $CI =& get_instance();
        $token = self::validateToken($auth);
        if ($token != false && (now() - $token->timestamp < ($CI->config->item('token_timeout') * 60))) {
            return $token;
        }

        return false;
    }

    public static function validateToken($auth)
    {
        $CI =& get_instance();
        list($token) = sscanf($auth, 'Bearer %s');

        return JWT::decode($token, $CI->config->item('jwt_key'));
    }

    public static function generateToken($data)
    {
        $CI =& get_instance();

        return JWT::encode($data, $CI->config->item('jwt_key'));
    }

}