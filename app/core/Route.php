<?php

namespace App\Core;

class Route
{
	static private array $get_callbacks = [];  
	static private array $post_callbacks = [];  

	public static function get($url, $callback)
	{
		self::$get_callbacks[$url] = $callback;
	}

	public static function post($url, $callback)
	{
		self::$post_callbacks[$url] = $callback;
	}

	public static function handle($url)
	{
		if (count($_POST))
		{
			self::$post_callbacks[$url]();
		}
		else
		{
			self::$get_callbacks[$url]();
		}
	}
}