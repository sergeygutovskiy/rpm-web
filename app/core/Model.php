<?php

namespace App\Core;
use App\Core\DB;
use PDO;


class Model
{
	public static ?array $fillable = null;
	public static ?string $table = null;

	public static function all()
	{
		return DB
			::select(static::$table, static::$fillable)
			::execute_select()->fetchAll(PDO::FETCH_CLASS, static::class);
	}

	public static function id($id)
	{
		$model = DB
			::select(static::$table, static::$fillable)
			::where("id", "=", $id)
			::execute_select()->fetchAll(PDO::FETCH_CLASS, static::class);

		if (count($model)) return $model[0];
		return null;
	}

	public static function create($params)
	{
		DB::insert(static::$table, $params)::execute();

		$model = new static();
		$model->id = DB::last_id();
		foreach ($params as $p => $v) 
			$model->{$p} = $v;

		return $model;
	}

	public function hasOne(string $class_name, string $foreign_key)
	{
		$model = new $class_name();
		return $model::id($this->{$foreign_key});
	}

	public function hasMany(string $class_name, string $foreign_key)
	{
		$model = new $class_name();
		return DB
			::select($model::$table, $model::$fillable)
			::where($foreign_key, "=", $this->id)
			::execute_select()->fetchAll(PDO::FETCH_CLASS, $class_name); 
		
	}
}