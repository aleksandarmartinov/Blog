<?php 

namespace App\Models;

use PDO;


class Category extends BaseModel {

    public function getCategory($id)
    {

        $sql = "SELECT * FROM categories WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        $categories = $query->fetch(PDO::FETCH_OBJ);
        return $categories;

    }

}