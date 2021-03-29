<?php

namespace App\Core;


class Route
{
	static private array $get_callbacks = [];  
	static private array $post_callbacks = [];  

	public static function get($url, $callback)
	{
		self::$get_callbacks[$url] = $callback;
		// preg_match_all("/\{(.*?)\}/", $url, $res);
		// var_dump($url, $res);
	}

	public static function post($url, $callback)
	{
		self::$post_callbacks[$url] = $callback;
	}

	public static function handle($url)
	{
		if (count($_POST))
		{
			return self::$post_callbacks[$url]();
		}
		else
		{
			return self::$get_callbacks[$url]();
		}
	}
}