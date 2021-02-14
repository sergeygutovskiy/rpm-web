<?php

// start session
session_start();

// require core
require_once "app/core/Auth.php";
require_once "app/core/DB.php";
require_once "app/core/Model.php";
require_once "app/core/Path.php";
require_once "app/core/Route.php";
// require models
require_once "app/models/User.php";
require_once "app/models/Post.php";
// require routes
require_once "app/web.php";

use App\Core\DB;
use App\Core\Auth;
use App\Core\Route;


// connect to db 
DB::connect();

// check auth
Auth::check_auth();

// handle request
Route::handle(isset($_REQUEST["path"]) ? $_REQUEST["path"] : "");