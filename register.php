<?php
include "header.php";
if (is_login()) {
    echo " <script>location.replace('index.php') </script> ";

}
// define variables and set to empty values

echo "<h1> ".$_COOKIE['lang']." </h1>";
echo "<h1> ". $_SESSION['lang2']." </h1>";
try {
    $email      = $name = $password = "";
    $vaildated  = 1;
    $email_used = 0;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["name"])) {
            $vaildated = 0;
        } else {
            $name = test_input($_POST["name"]);
        }

        if (empty($_POST["email"])) {
            $vaildated = 0;
        }
        else {
            $email = test_input($_POST["email"]);
            $stmt  = $conn->prepare("SELECT id from users where email like '$email' ");
            $stmt->execute();
         //   $result = $stmt->setFetchMode(PDO::FETCH_OBJ);
            $users  = $stmt->rowCount();
            if ($users > 0) {
                $vaildated  = 0;
                $email_used = 1;
            }

        }

        if (empty($_POST["password"])) {
            $vaildated = 0;
        } else {
            $password = test_input($_POST["password"]);
        }
        if ($vaildated==1) {
            $encPass = md5($password);
            $sql     = "INSERT INTO users ( name, email,password)
                      VALUES ('$name', '$email','$encPass')";
            $conn->exec($sql);


            $stmt    = $conn->prepare(" SELECT * from users where email like '$email' ");
            $stmt->execute();
            $result = $stmt->setFetchMode(PDO::FETCH_OBJ);
            $user   = $stmt->fetch();

            $_SESSION["user"] = $user;
            echo " <script>location.replace('index.php') </script> ";
            //	header('location:select_bllog.php');

        }
    }
} catch (Exception $x) {
    print_r($x);
    die();
}


?>

    <form method="post"
          action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
          class=" shadow m-4 p-4 mx-auto  col-md-6 needs-validation <?php echo ($vaildated == 0 or $email_used == 1) ? "was-validated" : '' ?> "
          novalidate>
        <h4 class="text-center"> التسجيل بالموقع</h4>
        <div class="form-group">
            <label for="name">الاسم:</label>
            <input type="text" class="form-control" id="name" value="<?php echo $name; ?>" placeholder="Enter name"
                   name="name" required>
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>
        <div class="form-group  ">
            <label for="emil">الايميل  : </label>
            <input type="email" class="form-control" value="<?php echo $email ?>" id="email" required name="email">
            <div class="valid-feedback">
                Valid.<?php if ($email_used == 1) echo "<span style='color: red'> الايميل مستخدم من قبل قم بتسجيل الدخول او تغيير الايميل</span>" ?> </div>

            <div class="invalid-feedback">Please fill out this field.</div>
        </div>

        <div class="form-group  ">
            <label for="password">كلمة السر : </label>
            <input type="password" class="form-control " id="password" required name="password">
            <div class="valid-feedback">Valid.</div>
            <div class="invalid-feedback">Please fill out this field.</div>
        </div>


        <button type="submit" class="btn btn-primary m-4"> دخول</button>
    </form>


<?php include "footer.php";
?>