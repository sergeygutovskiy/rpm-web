<?php

session_start();

require_once "app/modules/DB.php";
require_once "app/modules/Path.php";
require_once "app/modules/Auth.php";
require_once "app/modules/Route.php";

require_once "app/models/User.php";
require_once "app/models/Task.php";


if (!DB::connect())
{
    Path::view("error");
    return;
}

require_once "web.php";

Route::go($_REQUEST["path"])();

// if ($_REQUEST["path"] == "home")
// {
//     if (!Auth::isAuth()) header("Location: /register");

//     Path::view("users/user");
//     return;
// }

// if ($_REQUEST["path"] == "register" && !count($_POST))
// {
//     Path::view("users/register");
//     return;
// }

// if ($_REQUEST["path"] == "register" && count($_POST))
// {
//     $name = $_POST["name"];
//     $password = $_POST["password"];

//     $token = bin2hex(random_bytes(56));

//     $user = new User();
//     $user->name = $name;
//     $user->password = $password;
//     $user->token = $token;

//     $user->save();

//     $_SESSION["auth_user_id"] = DB::lastID();
//     $_SESSION["auth_user_token"] = $token;

//     header("Location: /home");
// }