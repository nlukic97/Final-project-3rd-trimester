<?php

use App\Core\Request;
use App\Core\Router;

require_once "vendor/autoload.php";
require_once "core/bootstrap.php"; //this lifts up the application (db..)


// ---------- Adding access control origin so that the vue frontend can access the backend
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
// ----------

Router::loadRoutes()
    ->direct(Request::uri(), Request::method());
