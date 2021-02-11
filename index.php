<?php

require_once "app/core/DB.php";
require_once "app/core/Route.php";
require_once "app/models/User.php";

use App\Core\DB;
use App\Models\User;
use App\Core\Route;


Route::get("/", function() {
	$a = 10;
	require "public/views/home.php";
});


DB::connect();


Route::handle(isset($_REQUEST["path"]) ? $_REQUEST["path"] : "/");

// $users = User::get();
// foreach ($users as $u)
// {
// 	var_dump($u->id, $u->name, $u->token);
// }