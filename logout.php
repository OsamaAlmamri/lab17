<?php
session_start();
session_destroy();
echo " <script>location.replace('index.php') </script> ";
//header('location:login.php');

?>
