<?php

namespace App\Core;
use App\Core\DB;
use PDO;


class Model
{
	public static ?array $fillable = null;
	public static ?string $table = null;

	public static function get()
	{
		return DB
			::select(static::$table, static::$fillable)
			::execute_select()->fetchAll(PDO::FETCH_CLASS, static::class);
	}

	public function hasOne(string $class_name)
	{
		$user = new $class_name();
		return DB::select($user::$table, $user::$fillable)
			::where("id", "=", $this->user_id)
			::execute_select()->fetchAll(PDO::FETCH_CLASS, $user::class)[0];
	}
}