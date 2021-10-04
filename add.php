<?php
include "header.php";
if (!is_login()) {
    echo " <script>location.replace('index.php') </script> ";

}

 ?>
<ul class="breadcrumb">

    <li class="breadcrumb-item  "><a href="index.php">الرئيسية</a></li>
    <li class="breadcrumb-item active "><a href="#">اضافة منتج</a></li>
    </li>
</ul>

<?php
// define variables and set to empty values

try {
    $nameErr   = $descErr = $imageErr = $catErr = "";
    $name      = $description = $image = $category = "";
    $vaildated = 1;
$categories2 = ['man', 'women', 'child'];
    $stmt = $conn->prepare("SELECT * FROM categories");
    $stmt->execute();
    $result     = $stmt->setFetchMode(PDO::FETCH_OBJ);
    $categories = $stmt->fetchAll();




    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr   = "Name is required";
            $vaildated = 0;
        } else {
            $name = test_input($_POST["name"]);
        }
//    description,category,image,name
        if (empty($_POST["description"])) {
            $descErr   = "description is required";
            $vaildated = 0;
        } else {
            $description = test_input($_POST["description"]);
        }

        if (empty($_POST["category"])) {
            $vaildated = 0;
            $catErr = "category is required";
        } else {

            $category = $_POST["category"];
        }
        $image_path = "";
        
        $types = array('image/jpeg', 'image/gif', 'image/png');
        if (isset ($_FILES))
           {

            
        
            
            if (in_array( $_FILES["image"] ['type'], $types)) {
                $image_path = 'images/' .  $_FILES["image"] ['name'];
                move_uploaded_file($_FILES["image"] ['tmp_name'], $image_path);
            }
           }


        if ($vaildated) {
            // prepare sql and bind parameters
            $stmt = $conn->prepare("INSERT INTO products ( name,id, category, image, description)
    VALUES (:name,NULL , :category, :image,:description)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image_path);

            // insert a row
//        $firstname = "John";
//        $lastname  = "Doe";
//        $email     = "john@example.com";
            $stmt->execute();
            echo " <script>location.replace('index.php') </script> ";
            //	header('location:index.php');

        }
    }
} catch (Exception $x) {
    print_r($x);
    die();
}




?>

<div class="">

    <form method="post" enctype="multipart/form-data"   action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
          class=" shadow m-4 p-4 mx-auto  col-md-6 needs-validation <?php echo ($vaildated==0)?"was-validated":'' ?> "  novalidate>
        <h4 class="text-center">اضافة منتج جديد </h4>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" value="<?php echo $name; ?>" placeholder="Enter name"
                   name="name" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="form-group">
            <label for="name">Category:</label>
            <select name="category" class="custom-select" required>
                <option selected>Custom Select Menu</option>
             
             <?php foreach ($categories as $cat) { ?>
                <option value="<?php echo $cat->id ?>"  <?php echo ($cat->id == $category) ? 'selected' : '' ?>><?php echo $cat->name ?></option>";
            <?php } ?>

               
            </select>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="form-group">
            <label for="description">description:</label>
            <textarea class="form-control" id="description" placeholder="Enter password"
                      name="description" required><?php echo $description; ?></textarea>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="custom-file">
            <input type="file" value="<?php echo $image; ?>" accept=".png, .jpeg,.pdf" name="image"
                   class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>

        <button type="submit" class="btn btn-primary m-4">Submit</button>
    </form>

</div>

<script>
    // Disable form submissions if there are invalid fields
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            // Get the forms we want to add validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>


<?php include "footer.php"; ?>

