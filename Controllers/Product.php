<?php


class Product
{
    public $name;
    public $description;
    public $image;
    public $category;

    public function __construct()
    {
        $this->image       = '';
        $this->name        = '';
        $this->description = '';
        $this->category    = '';
    }

    public function getAll()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM products");
        $stmt->execute();
        $result   = $stmt->setFetchMode(PDO::FETCH_OBJ);
        $products = $stmt->fetchAll();

        return $products;
    }

    public function add($request)
    {
        try {
            global $conn;
            $vaildated = 1;
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["description"])) {
                    $descErr   = "description is required";
                    $vaildated = 0;
                } else {
                    $this->description = test_input($_POST["description"]);
                }

                if (empty($_POST["name"])) {
                    $vaildated = 0;
                } else {
                    $this->name = test_input($_POST["name"]);
                }

                if (empty($_POST["category"])) {
                    $vaildated = 0;
                    $catErr    = "category is required";
                } else {
                    $this->category = $_POST["category"];
                }
                $image_path = $this->saveImage('image');
                if ($vaildated) {
                    // prepare sql and bind parameters
                    $stmt = $conn->prepare("INSERT INTO products ( name,id, category, image, description)
    VALUES (:name,NULL , :category, :image,:description)");
                    $stmt->bindParam(':name', $this->name);
                    $stmt->bindParam(':category', $this->category);
                    $stmt->bindParam(':description', $this->description);
                    $stmt->bindParam(':image', $image_path);
                    $stmt->execute();
                    echo " <script>location.replace('index.php') </script> ";
                    //	header('location:index.php');

                }
            }
        } catch (Exception $x) {
            print_r($x);
            die();
        }

        return $vaildated;
    }

    public function saveImage($name)
    {
        $image_path = '';
        $types      = array('image/jpeg', 'image/gif', 'image/png');
        if (isset ($_FILES)) {
            if (in_array($_FILES["$name"] ['type'], $types)) {
                $image_path = 'images/' . $_FILES["image"] ['name'];
                move_uploaded_file($_FILES["image"] ['tmp_name'], $image_path);
            }
        }

        return $image_path;

    }

}