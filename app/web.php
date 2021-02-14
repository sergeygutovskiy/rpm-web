<?php

namespace App;
use App\Core\DB;
use App\Core\Route;
use App\Core\Path;
use App\Core\Auth; 
use App\Models\Post;
use App\Models\User;
use PDO;

Route::get("", function() {
	$posts = Post::all();

	require Path::view("home");
});

Route::get("register", function() {
	if (Auth::is_quest())
		require Path::view("user.register");
	else
		header("Location: /account");
});

Route::post("register", function() {
	$name = $_POST["name"];
	$password = $_POST["password"];
	$token = bin2hex(random_bytes(56));

	$user = User::create([
		"name" => $name,
		"password" => $password,
		"token" => $token
	]);

	$_SESSION["auth_user_id"] = $user->id;
    $_SESSION["auth_user_token"] = $token;

	header("Location: /account");
});

Route::get("account", function() {
	if (Auth::is_auth())
	{
		$user = Auth::user();
		require Path::view("user.home");		
	}
	else
		header("Location: /register");
});

Route::get("logout", function() {
	unset($_SESSION["auth_user_id"]);
	unset($_SESSION["auth_user_token"]);

	echo "Вы вышли из аккаунта";
});

Route::get("login", function() {
	if (Auth::is_quest())
		require Path::view("user.login");
	else
		header("Location: /account");	
});

Route::post("login", function() {
	$name = $_POST["name"];
	$password = $_POST["password"];
	// $token = bin2hex(random_bytes(56));

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
		}
	}


	header("Location: /login");
});

Route::post("posts", function() {
	$title = $_POST["post_title"];
	$text = $_POST["post_text"];

	Post::create([
		"title" => $title,
		"text" => $text,
		"user_id" => Auth::user()->id
	]);

	header("Location: /account");
});