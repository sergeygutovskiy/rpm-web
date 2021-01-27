<?php

require_once "Model.php";

class User extends Model
{
    public $id;
    public $name;
    public $password;
    public $token;
}