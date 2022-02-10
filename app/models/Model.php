<?php

namespace App\Models;

use App\Core\App;
use App\Core\Database\Database;

/**
 * Abstract Model
 */
abstract class Model
{
    /**
     * @var Database|mixed
     */
    protected Database $db;

    /**
     * Constructor of the abstract model class.
     *
     * Get the preconfigured db object from the app container
     * and assign it to the db data member. Other models in the
     * system will inherit the db data member and use it for
     * communicating to the mariadb database.
     *
     */
    public function __construct()
    {
        $this->db = App::get('database');
    }
}