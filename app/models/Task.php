<?php

require_once "Model.php";

class Task extends Model
{
    public $id;
    public $text;
    public $user_id;
    public $end_date;
    public $status;
    public $visible;

    private $user;

    public array $mysqlFields = [
        "text",
        "user_id",
        "end_date",
        "status",
        "visible"
    ];

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }
}