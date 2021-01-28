<?php

session_start();

require_once "app/modules/DB.php";
require_once "app/modules/Path.php";
require_once "app/modules/Auth.php";

require_once "app/models/User.php";
require_once "app/models/Task.php";


if (!DB::connect())
{
    Path::view("error");
    return;
}

if ($_REQUEST["path"] == "home")
{
    if (!Auth::isAuth()) header("Location: /register");

    // var_dump(
    //    DB::query("SELECT * FROM tasks JOIN users ON tasks.user_id = users.id")->toClass(Task::class)
    // );

    Path::view("user");
    return;
}

if ($_REQUEST["path"] == "register" && !count($_POST))
{
    Path::view("register");
    return;
}

function show_user($id)
{
    //
}

if ($_REQUEST["path"] == "register" && count($_POST))
{
    $name = $_POST["name"];
    $password = $_POST["password"];

    $token = bin2hex(random_bytes(56));

    $user = new User();
    $user->name = $name;
    $user->password = $password;
    $user->token = $token;

    $user->save();

    $_SESSION["auth_user_id"] = DB::lastID();
    $_SESSION["auth_user_token"] = $token;

    header("Location: /home");
}