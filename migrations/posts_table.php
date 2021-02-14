<?php

namespace App\DB\Migrations;
use App\Core\DB;


DB::migration(function () {
	$drop_table = "DROP TABLE IF EXISTS posts"; 
	$create_table = "CREATE TABLE posts(" 	. 
		"id       int          not null auto_increment,". 
		"title    varchar(256) not null,".
		"text 	  text         not null,".
		"user_id  int          not null,".
		"primary  key(id)".
	")";

	return $drop_table . ";" . $create_table;
});