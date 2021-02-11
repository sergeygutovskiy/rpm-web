<?php

namespace App\Models;
use App\Core\Model;

require_once "app/core/Model.php";


class User extends Model 
{

	public static ?array $fillable = [
		"id",
		"name",
		"token"
	]; 

	public static ?string $table = "users";
}
