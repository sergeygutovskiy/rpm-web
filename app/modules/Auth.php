<?php

class Auth
{
    public static function isAuth()
    {
        if (!isset($_SESSION["auth_user_id"]) || !isset($_SESSION["auth_user_remember_token"]))
            return false;

        $id = $_SESSION["auth_user_id"];
        $token = $_SESSION["auth_user_remember_token"];

        if ($user = User::byID($id))
        {
            if ($user->token == $token) return true;
        }

        return false;
    }
}