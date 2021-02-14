<?php

namespace App\Models;
use App\Core\Model;
use App\models\User;

class Post extends Model 
{
	public static ?array $fillable = [
		"id",
		"title",
		"text",
		"user_id"
	]; 

	public static ?string $table = "posts";

	public function user()
	{
		return $this->hasOne(User::class, "user_id");
	}
}
