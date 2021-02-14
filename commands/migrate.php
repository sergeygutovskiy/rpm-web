<?php

namespace App\Commands;
use App\Core\DB;

require_once "../app/core/DB.php";
require_once "../migrations/users_table.php";
require_once "../migrations/posts_table.php";


DB::connect();
DB::run_migrations();