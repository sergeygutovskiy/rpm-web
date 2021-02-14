<?php

namespace App\Models;
use App\Core\Model;
use App\Models\Post;

class User extends Model 
{
	public static ?array $fillable = [
		"id",
		"name",
		"password",
		"token"
	]; 

	public static ?string $table = "users";


	public function posts()
	{
		return $this->hasMany(Post::class, "user_id");
	}
}
