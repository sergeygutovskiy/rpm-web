<?php

class Model
{
    public array $mysqlFields = [];

    public static function all()
    {
        return DB::query("SELECT * FROM " . self::getTableName())->toClass(static::class);
    }

    public static function getTableName()
    {
        return strtolower(static::class) . "s";
    }

    public static function byID($id)
    {
        $models = DB::query(
            "SELECT * FROM " . self::getTableName() . " WHERE id = " . $id
        )->toClass(static::class);

        if (count($models)) return $models[0];
        return null;
    }

    public function save()
    {
        $sqlParams = implode(", ", $this->mysqlFields);

        $arr = [];
        foreach ($this->mysqlFields as $f) { $arr[] = $this->{$f}; }

        $sqlValues = "'" . implode("', '", $arr) . "'";

        $sqlStr = "INSERT INTO " . $this->getTableName() . " ($sqlParams) VALUES($sqlValues)";
        DB::query($sqlStr);
    }
}