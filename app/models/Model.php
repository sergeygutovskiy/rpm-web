<?php

class Model
{
    public static function all()
    {
        return DB::query("SELECT * FROM " . strtolower(static::class) . "s")->toClass(static::class);
    }

    public static function byID($id)
    {
        $users = DB::query(
            "SELECT * FROM " . strtolower(static::class) . "s"
            . " WHERE id = " . $id
        )->toClass(static::class);

        if (count($users)) return $users[0];
        return false;
    }
}