<?php 

namespace App\Database;

use PDO;
use PDOException;

class Connection {

    private static $instance;

    private function __construct() {

        

    }

    public static function connect($database){

        
        if( ! self::$instance) {
            self::$instance = new PDO('mysql:host='.$database['host'].';dbname='.$database['dbname'],$database['user'],$database['password']);
        }
        
        return self::$instance;
        
    }    
}
?>