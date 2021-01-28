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

    public array $mysqlFields = [
        "text",
        "user_id",
        "end_date",
        "status",
        "visible"
    ];
}