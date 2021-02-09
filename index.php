<?php

require_once "app/core/DB.php";

use App\Core\DB;

DB::connect();

DB::insert("users", [
	"name" => "1",
	"password" => "2",
	"token" => "3",
]);

// DB::$query_str = "INSERT INTO users (name, password, token) VALUES (:name, :password, :token)";
// DB::$query_params = [
// 	"name" => "1",
// 	"password" => "2",
// 	"token" => "3",
// ];

DB::execute();