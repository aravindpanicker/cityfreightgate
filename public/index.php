<?php

/**
 * Register The Auto Loader
 *
 * Composer provides a convenient, automatically generated class loader for
 * this application. We'll simply require it into the script here so we
 * don't need to manually load our classes.
 */
require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../core/bootstrap.php';
require __DIR__.'/../app/constants.php';

use App\Core\{Router, Request};

/**
 * Load the configured routes and route incoming requests
 * to the right controller method.
 */
Router::load('../app/routes.php')
    ->direct(Request::uri(), Request::method());

/**
 * Clean the validation data from session.
 */
session()->clean();
