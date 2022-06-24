<?php 

namespace App\Models;

use PDO;


class Category extends BaseModel {

    //jedna kategorija po njenom id
    public function getCategory($id)
    {

        $sql = "SELECT * FROM categories WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        $categories = $query->fetch(PDO::FETCH_OBJ);
        return $categories;

    }

    //sve iz tabele
    public function selectAll($table) 
    {

        $sql = "SELECT * FROM {$table}";
        $query = $this->db->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);
        
    }

}