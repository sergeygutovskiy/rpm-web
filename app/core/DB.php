<?php

namespace App\Core;

use PDO;

class DB
{
	private static PDO $conn; 
	private static string $query_str;
	private static array $query_params;


	public static function connect($servername = "localhost", $db = "todo", $username = "root", $password = "root")
	{
		self::$conn = new PDO("mysql:host=" . $servername. ";dbname=" . $db, $username, $password);
	}

	// public function insert(string $table, array $params)
	// {
	// 	$columns = implode(", ", array_keys($params));
	// 	$prepare_values = ":" . implode(",:", array_keys($params));

	// 	$query = $this->conn->prepare("INSERT INTO $table ($columns) VALUES ($prepare_values)");

	// 	foreach ($params as $key => $value)
	// 		$query->bindValue(":" . $key, $value);

	// 	$query->execute();
	// }

	public static function insert(string $table, array $params)
	{
		$columns = implode(", ", array_keys($params));
		$prepare_values = ":" . implode(",:", array_keys($params));

		self::$query_str = "INSERT INTO $table ($columns) VALUES ($prepare_values)";
		self::$query_params = $params;
	}

	public static function update(string $table, array $params)
	{
		$query_str = "UPDATE $table SET";

		foreach ($params as $key => $value) {
			$query_str .= " $key=:$key";
		}

		self::$query_str = $query_str;
		self::$query_params = $params;
	}

	public static function where(string $column, string $cond = "", string $value)
	{
		$query_str = " WHERE $column $cond $value";
		self::$query_str .= $query_str;
	}

	public static function execute()
	{
		$query = self::$conn->prepare(self::$query_str);

		foreach (self::$query_params as $key => $value)
			$query->bindValue(":" . $key, $value);

		$query->execute();		
	}
}