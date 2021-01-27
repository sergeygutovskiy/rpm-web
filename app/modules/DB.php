<?php

class DB
{
    private static $conn = null;

    public static function connect($servername = "localhost", $db = "todo", $username = "root", $password = "root")
    {
        try {
            self::$conn = new PDO("mysql:host=" . $servername. ";dbname=" . $db, $username, $password);
            return true;
        }
        catch(PDOException $e) {
            return false;
        }
    }

    public static function query($queryStr)
    {
        if (is_null(self::$conn)) return false;

        return new Query(self::$conn->query($queryStr));
    }
}

class Query
{
    private $query = null;

    public function __construct($query)
    {
        $this->query = $query;
    }

    public function toClass($className)
    {
        return $this->query->fetchAll(PDO::FETCH_CLASS, $className);
    }
}