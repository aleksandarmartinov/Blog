<?php

namespace App\Models;

use App\Database\Connection;

abstract class BaseModel {

    protected $db;

    public function __construct()
    {
        $this->db = Connection::connect([
            "host"      => $_ENV['DB_HOST'],
            "user"      => $_ENV['DB_USER'],
            "password"  => $_ENV['DB_PASSWORD'],
            "dbname"    => $_ENV['DB_NAME'],
        ]);
    }

}