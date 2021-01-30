<?php

Route::get("register", function () {
	if (Auth::isAuth())
		header("Location: home");
	else
		Path::view("users/register");		
});

Route::post("register", function () {
    $name = $_POST["name"];
    $password = $_POST["password"];
    $passwordConfirm = $_POST["password_again"];

    if ($password != $passwordConfirm || empty($password) || empty($passwordConfirm))
    {
        header("Location: register");
    }
    else
    {
        $token = bin2hex(random_bytes(56));

        $user = new User();
        $user->name = $name;
        $user->password = $password;
        $user->token = $token;

        $user->save();

        $_SESSION["auth_user_id"] = DB::lastID();
        $_SESSION["auth_user_token"] = $token;

        header("Location: home");
    }
});

Route::get("login", function () {
	if (Auth::isAuth())
		header("Location: home");
	else
		Path::view("users/login");		
});

Route::post("login", function () {
    $name = $_POST["name"];
    $password = $_POST["password"];

    if (empty($name))
        header("Location: login");
    else
    {
        $user = DB::query(
            "SELECT * FROM users WHERE name = '" . $name . "'"
        )->toClass(User::class);
        
        if (count($user))
        {
            $user = $user[0];
            
            // var_dump($user->password, $password);
            if ($user->password != $password)
                header("Location: login");
            else
            {
                $token = bin2hex(random_bytes(56));
                $user->token = $token;

                $user->save();

                $_SESSION["auth_user_id"] = DB::lastID();
                $_SESSION["auth_user_token"] = $token;
            
                header("Location: home");
            }
        }
        else
            header("Location: login");
    }
});

Route::get("logout", function () {
    if (Auth::isAuth())
    {
        unset($_SESSION["auth_user_id"]);
        unset($_SESSION["auth_user_token"]);

        header("Location: login");
    }
    else
        header("Location: login");    
});

Route::get("home", function () {
	if (Auth::isAuth())
		Path::view("users/user");
	else
		header("Location: login");	
});

Route::get("", function () use ($tasks) {   
    $tasks = DB::query(
        "SELECT * FROM tasks WHERE visible = '1'"
    )->toClass(Task::class);

    Path::view("home", ["tasks" => $tasks]);
});