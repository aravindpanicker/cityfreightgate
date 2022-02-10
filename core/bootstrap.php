<?php

use App\Core\App;
use App\Core\Request;
use App\Core\Auth\AuthManager;
use App\Core\Database\Database;
use App\Core\Session\SessionManager;
use App\Core\Database\Connection;

App::bind('config', require __DIR__ . './../config.php');
App::bind('database', new Database(
    Connection::make(App::get('config')['database'])
));

App::bind('session', new SessionManager());
App::bind('auth', new AuthManager());
App::bind('request', new Request());
