<?php

namespace App\Commands;

require_once "../app/core/DB.php";
require_once "../migrations/users_table.php";

use App\Core\DB;


DB::connect();
DB::run_migrations();