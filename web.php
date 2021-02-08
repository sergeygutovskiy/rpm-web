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
            
            if ($user->password != $password)
                header("Location: login");
            else
            {
                $token = bin2hex(random_bytes(56));
                $user->token = $token;

                DB::query(
                	"UPDATE users SET token='" . $token . "' WHERE id=" . $user->id
            	);

                $_SESSION["auth_user_id"] = $user->id;
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

Route::get("", function () {   
    $tasks = DB::query(
        "SELECT tasks.id as task_id, tasks.text as task_text," 
        . " tasks.end_date as task_end_date, tasks.status as task_status,"
        . " users.id as user_id, users.name as user_name, users.password as user_password"
        . " FROM tasks JOIN users" 
        . " ON tasks.user_id = users.id" 
        . " WHERE tasks.visible = '1'"
    )->get();

    $tasksWithUsers = [];

    foreach ($tasks as $sqlTask) {
        $task = new Task();

        $task->id       = $sqlTask["task_id"];
        $task->text     = $sqlTask["task_text"];
        $task->end_date = $sqlTask["task_end_date"];
        $task->status   = $sqlTask["task_status"];

        $user = new User();
        $user->id       = $sqlTask["user_id"];   
        $user->name     = $sqlTask["user_name"];   
        $user->password = $sqlTask["user_password"];           

        $task->setUser($user);

        $tasksWithUsers[] = $task;
    }

    Path::view("home", ["tasks" => $tasksWithUsers]);
});

Route::post("tasks/create", function () {
	$text = $_POST["task_text"];
	$endDate = $_POST["task_end_date"];
	$status = $_POST["task_status"];
	$visible = $_POST["task_visible"];
	// $userID = Auth::user()->id;

	if (empty($text) || empty($endDate) || empty($status) || empty($visible))
	{
		echo json_encode("error");
		return;
	}

	$task = new Task();
	$task->text = $text;
	$task->user_id = 28;  
	$task->end_date = $endDate . " 00:00:00";
	$task->status = $status;
	$task->visible = $visible;  

	$task->save();

	echo json_encode($task);
	return;
});