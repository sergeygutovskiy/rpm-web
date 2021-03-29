<?php

namespace App;

use App\Core\DB;
use App\Core\Route;
use App\Core\Path;
use App\Core\Auth; 

use App\Models\Post;
use App\Models\User;

use App\Controllers\UserController;
use App\Controllers\PostController;

use PDO;

// home

Route::get("", function() {
	$posts = Post::all();

	require Path::view("home");
});

// users

Route::get("register", function() {
	$controller = new UserController();
	return $controller->register();
});

Route::post("register", function() {
	$controller = new UserController();
	return $controller->store();	
});

Route::get("account", function() {
	$controller = new UserController();
	return $controller->index();
});

Route::get("logout", function() {
	$controller = new UserController();
	return $controller->logout();
});

Route::get("login", function() {
	$controller = new UserController();
	return $controller->login();
});

Route::post("login", function() {
	$controller = new UserController();
	return $controller->auth();
});

// posts

Route::get("posts/{id}", function() {
	$controller = new PostController();
	return $controller->index();
});

Route::post("posts", function() {
	$controller = new PostController();
	return $controller->store();
});