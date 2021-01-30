<?php

class Route 
{
	private static $getCallbacks = [];
	private static $postCallbacks = [];

	public static function get($url, $callback)
	{
		self::$getCallbacks[$url] = $callback;
	}

	public static function post($url, $callback)
	{
		self::$postCallbacks[$url] = $callback;
	}

	public static function go($url)
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			if (isset(self::$postCallbacks[$url]))
				return self::$postCallbacks[$url];	
			else
				return Path::view("error");
		}
		else if ($_SERVER["REQUEST_METHOD"] == "GET")
		{
			if (isset(self::$getCallbacks[$url]))
				return self::$getCallbacks[$url];	
			else
				return Path::view("error");
		}
	} 
}