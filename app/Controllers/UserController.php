<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Path;
use App\Core\DB;
use PDO;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::is_auth())
        {
            $user = Auth::user();
            require Path::view("user.home");
        }
        else
            header("Location: /register");
    }

    public function register()
    {
        if (Auth::is_quest())
		    require Path::view("user.register");
	    else
		    header("Location: /account");
    }

    public function store()
    {
        $name = $_POST["name"];
        $password = $_POST["password"];
        $token = bin2hex(random_bytes(56));
    
        if(!strlen($name) || !strlen($password))
        {
            header("Location: /register");
            return;
        }

        $user = User::create([
            "name" => $name,
            "password" => $password,
            "token" => $token
        ]);
    
        $_SESSION["auth_user_id"] = $user->id;
        $_SESSION["auth_user_token"] = $token;
    
        header("Location: /account");
    }

    public function login()
    {
        if (Auth::is_quest())
		    require Path::view("user.login");
	    else
		    header("Location: /account");
    }

    public function auth()
    {
        $name = $_POST["name"];
        $password = $_POST["password"];
    
        $user = DB
            ::select(User::$table, User::$fillable)
            ::where("name", "=", "'" . $name . "'")
            ::execute_select()->fetchAll(PDO::FETCH_CLASS, User::class);
    
        if (count($user))
        {
            $user = $user[0];
            
            if ($user->password == $password)
            {
                $_SESSION["auth_user_id"] = $user->id;
                $_SESSION["auth_user_token"] = $user->token;
    
                header("Location: /account");
                return;
            }
        }
    
        header("Location: /login");
    } 

    public function logout()
    {
        unset($_SESSION["auth_user_id"]);
        unset($_SESSION["auth_user_token"]);
    
        header("Location: /");
    }
}