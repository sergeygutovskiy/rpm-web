<?php

namespace App\DB\Migrations;
use App\Core\DB;


DB::migration(function () {
	return "DROP TABLE IF EXISTS users" . 
		"; CREATE TABLE users(" . 
		"id int not null auto_increment," . 
		"name varchar(256) not null," .
		"token varchar(256) not null," .
		"primary key(id)" .
	")";
});