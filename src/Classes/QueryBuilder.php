<?php 

namespace App\Classes;

use PDO;

class QueryBuilder {

    protected $db;

    public function __construct($db){

        $this->db = $db;
    }

    public function selectAll($table) {

        $sql = "SELECT * FROM {$table}";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);

    }
}


?>