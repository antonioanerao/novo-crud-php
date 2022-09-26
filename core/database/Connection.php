<?php

namespace Core\Databas;
use PDO;

abstract class Connection extends PDO
{
    public function __construct() {
        parent::__construct("mysql:host=laura-mysql;dbname=laura", "laura", "laura");
    }
}