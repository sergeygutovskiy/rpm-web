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

	public static function css(string $path) : string
	{
		return "/public/css/" 
			. str_replace(".", "/", $path)
			. ".css";
	}

	public static function template(string $path) : string
	{
		return $_SERVER['DOCUMENT_ROOT']
			. "/public/templates/_"
			. $path . ".php";
	}
}