<?php

namespace App\Core;


class Path
{
	public static function view(string $path) : string
	{
		return $_SERVER['DOCUMENT_ROOT'] 
		. "/public/views/" 
		. str_replace(".", "/", $path)
		. ".php";
	}
}