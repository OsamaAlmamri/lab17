<?php
include "header.php";
if (is_login()) {
    echo " <script>location.replace('index.php') </script> ";

}
try {
    $email       = $password = "";
    $login_vaild = 0;
    $vaildated   = 1;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["email"])) {
            $vaildated = 0;
        } else {
            $email = test_input($_POST["email"]);
        }
        if (empty($_POST["password"])) {
            $vaildated = 0;
        } else {
            $password = test_input($_POST["password"]);
        }
        if ($vaildated) {
            $encPass = md5($password);
            $stmt    = $conn->prepare("SELECT id,email, name FROM users where email like '$email' and password like '$encPass'");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_OBJ);
            $user   = $stmt->fetch();


            if ($user != null) {
                $_SESSION["user"] = $user;
                echo " <script>location.replace('index.php') </script> ";
            } else {
                $login_vaild = 1;
            }
            //	header('location:select_bllog.php');

        }
    }
} catch (Exception $x) {
    print_r($x);
    die();
}


?>
<?php if ($login_vaild == 1) {

    ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>ُخطاء!</strong>  اسم المستخجم او كلمة السر غير صحيحين.
    </div>
<?php } ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
          class=" shadow m-4 p-4 mx-auto  col-md-6 needs-validation <?php echo ($vaildated == 0) ? "was-validated" : '' ?> "
          novalidate>
        <h4 class="text-center">تسجيل الدخول</h4>

        <div class="form-group  ">
            <label for="emil">الايميل  : </label>
            <input type="email" class="form-control " id="email" required name="email">
            <div class="valid-feedback">Valid. nkhihi</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group  ">
            <label for="password">كلمة السر : </label>
            <input type="password" class="form-control " id="password" required name="password">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group form-check">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> تذكرني
            </label>
        </div>

        <button type="submit" class="btn btn-primary m-4"> دخول</button>
    </form>


<?php include "footer.php";
?>