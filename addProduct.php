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
$categories_obj = new Categories;
$product        = new Product();
$categories     = $categories_obj->getAll();
$vaildated      = 1;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vaildated = $product->add($_POST);
}
?>

<div class="">
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
          class=" shadow m-4 p-4 mx-auto  col-md-6 needs-validation <?php echo ($vaildated == 0) ? "was-validated" : '' ?> "
          novalidate>
        <h4 class="text-center">اضافة منتج جديد </h4>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" value="<?php echo $product->name; ?>"
                   placeholder="Enter name"
                   name="name" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group">
            <label for="name">Category:</label>
            <select name="category" class="custom-select" required>
                <option selected>Custom Select Menu</option>
                <?php foreach ($categories as $cat) { ?>
                    <option value="<?php echo $cat->id ?>" <?php echo ($cat->id == $product->category) ? 'selected' : '' ?>><?php echo $cat->name ?></option>";
                <?php } ?>
            </select>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="form-group">
            <label for="description">description:</label>
            <textarea class="form-control" id="description" placeholder="Enter password"
                      name="description" required><?php echo $product->description; ?></textarea>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="custom-file">
            <input type="file" value="<?php echo $product->image; ?>" accept=".png, .jpeg,.pdf" name="image"
                   class="custom-file-input" id="customFile">
            <label class="custom-file-label" for="customFile">Choose file</label>
        </div>

        <button type="submit" class="btn btn-primary m-4">Submit</button>
    </form>
</div>
<?php include "footer.php"; ?>

