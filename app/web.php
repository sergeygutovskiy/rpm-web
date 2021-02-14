<?php

namespace App;
use App\Core\Route; 
use App\Core\Path; 
use App\Models\Post;

Route::get("/", function() {
	$posts = Post::get();

	// var_dump($posts[0]->user());

	require Path::view("home");
});