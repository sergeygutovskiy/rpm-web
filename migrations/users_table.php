<?php

namespace App\DB\Migrations;
use App\Core\DB;


DB::migration(function () {
	$drop_table = "DROP TABLE IF EXISTS users"; 
	$create_table = "CREATE TABLE users(" 	. 
		"id       int          not null auto_increment,". 
		"name     varchar(256) not null,".
		"password varchar(256) not null,".
		"token    varchar(256) not null,".
		"primary key(id)".
	")";

	return $drop_table . ";" . $create_table;
});