<?php

class Auth
{
    public static $user;

    public static function isAuth()
    {
        if (!isset($_SESSION["auth_user_id"]) || !isset($_SESSION["auth_user_token"]))
            return false;

        $id = $_SESSION["auth_user_id"];
        $token = $_SESSION["auth_user_token"];

        $user = User::byID($id);

        if (!is_null($user))
        {
            if ($user->token != $token) return false;

            self::$user = $user;
            return true;
        }

        return false;
    }

    public static function user()
    {
        return self::$user;
    }
}