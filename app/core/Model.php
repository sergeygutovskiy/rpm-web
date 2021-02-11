<?php

namespace App\Core;
use App\Core\DB;
use PDO;

require_once "DB.php";


class Model
{
	public static ?array $fillable = null;
	public static ?string $table = null;

	public static function get()
	{
		return DB::select(static::$table, static::$fillable)::execute_select()->fetchAll(PDO::FETCH_CLASS, static::class);
	}
}