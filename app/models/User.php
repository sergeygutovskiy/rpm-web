<?php

require_once "Model.php";

class User extends Model
{
    public $id;
    public $name;
    public $password;
    public $token;

    public array $mysqlFields = [
      "name",
      "password",
      "token"
    ];

    public function tasks()
    {
        return DB::query(
            "SELECT * FROM tasks JOIN users ON tasks.user_id = users.id WHERE users.id = " . $this->id
        )->toClass(Task::class);
    }
}