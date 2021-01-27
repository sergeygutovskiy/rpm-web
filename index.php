<?php

require_once "app/modules/DB.php";
require_once "app/modules/Path.php";
require_once "app/modules/Auth.php";

require_once "app/models/User.php";

if (!DB::connect())
{
    Path::view("error");
    return;
}

if ($_REQUEST["path"] == "home")
{
    if (!Auth::isAuth()) header("Location: /register");

    echo "Hi";
    return;
}

if ($_REQUEST["path"] == "register")
{
    Path::view("register");
    return;
}
