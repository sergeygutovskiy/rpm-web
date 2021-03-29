<?php

namespace App\Core;
use PDO;


class DB
{
	private static PDO $conn; 
	private static string $query_str;
	private static array $query_params;
	private static array $migations;


	public static function connect($servername = "localhost", $db = "blog", $username = "root", $password = "root")
	{
		self::$conn = new PDO("mysql:host=" . $servername. ";dbname=" . $db, $username, $password);
	}

	public static function query($q)
	{
		self::$query_str = $q;
		self::$query_params = [];

		self::execute();
	}

	public static function insert(string $table, array $params)
	{
		$columns = implode(", ", array_keys($params));
		$prepare_values = ":" . implode(",:", array_keys($params));

		self::$query_str = "INSERT INTO $table ($columns) VALUES ($prepare_values)";
		self::$query_params = $params;

		return new self;
	}

	public static function select(string $table, array $params)
	{
		self::$query_str = "SELECT " . implode(", ", array_values($params)) . " FROM $table";
		self::$query_params = [];

		return new self;
	}

	public static function execute_select()
	{
		// var_dump(self::$query_str);
		return self::$conn->query(self::$query_str);
	}

	public static function last_id()
	{
		return self::$conn->lastInsertId();
	}

	public static function update(string $table, array $params)
	{
		$query_str = "UPDATE $table SET";
		$new_params = [];

		foreach ($params as $key => $value) {
			$new_params[] = "$key=:$key";
		}

		self::$query_str = $query_str . " " . implode(", ", $new_params);
		self::$query_params = $params;

		return new self;
	}

	public static function where(string $column, string $cond, string $value)
	{
		$query_str = " WHERE $column $cond $value";
		self::$query_str .= $query_str;

		return new self;
	}

	public static function execute()
	{
		$query = self::$conn->prepare(self::$query_str);

		foreach (self::$query_params as $key => $value)
			$query->bindValue(":" . $key, $value);

		return $query->execute();
	}

	public static function migration($callback)
	{
		self::$migations[] = $callback;
	}

	public static function run_migrations()
	{
		foreach (self::$migations as $m)
		{
			self::query($m());
		}
	}
}