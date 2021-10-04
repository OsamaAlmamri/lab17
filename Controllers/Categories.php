<?php


class Categories
{

    public function getAll()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM categories");
        $stmt->execute();
        $result     = $stmt->setFetchMode(PDO::FETCH_OBJ);
        return $stmt->fetchAll();
    }
}