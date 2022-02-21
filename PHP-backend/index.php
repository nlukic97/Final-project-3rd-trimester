<?php

use App\Core\Request;
use App\Core\Router;

require_once "vendor/autoload.php";
require_once "core/bootstrap.php"; //this lifts up the application (db..)

// CORS permissions - currently allowing all (*) 
require_once "core/AllowCors.php";

Router::loadRoutes()
    ->direct(Request::uri(), Request::method());
