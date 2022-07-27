<?php

namespace App\Models;
use \PDO;

class Tag extends BaseModel
{

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id): \stdClass
    {
        $sql = "SELECT * FROM tags WHERE id = ?";
        $query = $this->db->prepare($sql);
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * @param array $names
     * @return array
     */
    public function getTagsByNameArray(array $names): array
    {
        $sql = "SELECT * FROM tags WHERE name in (" . implode(',', array_fill(0, count($names), '?')) .")";
        $query = $this->db->prepare($sql);
        $query->execute($names);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function createTag(string $name)
    {
        $sql = "INSERT INTO tags (name) VALUES (?)";
        $query = $this->db->prepare($sql);
        $query->execute([$name]);
        return $this->getById($this->db->lastInsertId());
    }

    public function getOrCreate(array $namesArray): array
    {

        // Niz imena koji postoji u bazi ["Sport", "Razno"] na osnovu $namesArray i vraca
        // niz objekata npr. [ {id: 1, name: Sport}, {id: 2, name "Razno} ]
        $existingTags = $this->getTagsByNameArray($namesArray);

        // Niz imena dobijen iz $existingTags objekata ["Sport", "Razno"]
        $databaseNames = array_map(function($item) {
            return $item->name;
        }, $existingTags);

        // Razlika izmedju dva niza ["Sport", "Razno", "Nesto novo"] i ["Sport", "Razno"]
        $missing = array_diff($namesArray, $databaseNames);

        foreach ($missing as $name) {

            $newTag = $this->createTag($name);
            $existingTags[] = $newTag;

        }

        return $existingTags;
    }
}