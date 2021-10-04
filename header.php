<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <link rel="stylesheet" href="../lect8/assest/bootstrap/4.4.1/css/bootstrap.css">  -->
    <link rel="stylesheet" href="bootstrap-rtl/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.css">
    <!-- <script src="../lect8/assest/bootstrap/4.4.1/js/bootstrap.js"></script> -->

    <style>
        footer {
            position: relative;
            bottom: 0;

            margin: 15px -15px;

        }

        body {
            height: 100vh; /* For 100% screen height */

        }
    </style>
</head>
<body dir="rtl">
<div class="container-fluid">
    <nav class="navbar navbar-expand-sm bg-dark   ">
        <a href="#" class="navbar-brand">

            <?php echo isset($_SESSION["user"]) ? $_SESSION["user"]->name : ""; ?>
            <img class="img-fluid rounded-circle" style="width: 40px;" src="images/avatar3.png">
        </a>
        <button type="button" class="text-light navbar-toggler" data-target="#mymenu" data-toggle="collapse">
            <span class="bg-success navbar-toggler-icon"></span>
        </button>
        <div id="mymenu" class="collapse navbar-collapse ">
            <ul class="navbar-nav  d-flex justify-content-between">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">news</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Link 1</a>
                        <a class="dropdown-item" href="#">Link 2</a>
                        <a class="dropdown-item" href="#">Link 3</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">about us</a>
                </li>
                <!--                print_r($_SESSION['user']);-->
                <?php if (is_login()) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">تسجيل الخروج</a>
                    </li>
                <?php } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login_page.php">تسجيل الدخول</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">التسجيل بالموقع </a>
                    </li>
                <?php } ?>

                <!--                <li class="nav-item">-->
                <!--                    <a class="nav-link" data-toggle="modal" href="#myModal">تسجيل الدخول</a>-->
                <!--                </li>-->
                <li class="nav-item">
                    <form class=" row" action="/action_page.php">
                        <div class="input-group ">
                            <input type="search" class="form-control" placeholder="بحث">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit">بحث</button>
                            </div>
                        </div>
                    </form>
                </li>


            </ul>
        </div>


    </nav>


    <?php include "connDb.php";
    function test_input($data)
    {

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    function is_login()
    {
        return (isset($_SESSION['user']) and $_SESSION['user'] != null);
    }


    //setcookie('lang', 'ar', time() + 1000 * 20);
    $_SESSION['lang2'] = "ar";

    include "Controllers/Categories.php";
    include "Controllers/Product.php";

    ?>


