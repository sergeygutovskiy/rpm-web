<?php

namespace App\Core;
use App\Models\User;


class Auth
{
	private static ?User $user;

	public static function check_auth() : bool
	{
		if (!isset($_SESSION["auth_user_id"]) || !isset($_SESSION["auth_user_token"]) || !strlen($_SESSION["auth_user_id"]))
		{
			self::$user = null;
			return false;
		}

		$id = $_SESSION["auth_user_id"];
		$token = $_SESSION["auth_user_token"];

		$user = User::id($id);

		if (!is_null($user))
		{
			if ($user->token == $token) 
			{
				self::$user = $user;
				return true;
			}
		}
		else
		{
			unset($_SESSION["auth_user_id"]);
			unset($_SESSION["auth_user_token"]);
		}

		self::$user = null;
		return false;
	}

	public static function is_auth()
	{
		return is_null(self::$user) ? false : true;
	}

	public static function is_quest()
	{
		return is_null(self::$user);
	}

	public static function user()
	{
		return self::$user;
	}
}