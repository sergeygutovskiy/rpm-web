<?php

namespace App\Models;
use App\Core\Model;


class User extends Model 
{
	public static ?array $fillable = [
		"id",
		"name",
		"password",
		"token"
	]; 

	public static ?string $table = "users";
}
