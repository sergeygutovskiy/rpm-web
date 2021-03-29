<?php

namespace App\Controllers;
use App\Core\Controller;
use App\Core\Auth;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        
    }

    public function store()
    {
        $title = $_POST["post_title"];
        $text = $_POST["post_text"];
    
        Post::create([
            "title" => $title,
            "text" => $text,
            "user_id" => Auth::user()->id
        ]);
    
        header("Location: /account");    
    }
}