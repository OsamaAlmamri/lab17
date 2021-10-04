<?php
include "connDb.php";
if (isset($_GET['id'])) {
    $id  = $_GET['id'];
    $sql = "DELETE FROM products WHERE id=$id ";
    $conn->exec($sql);
}
echo " <script>location.replace('index.php') </script> ";
?>
