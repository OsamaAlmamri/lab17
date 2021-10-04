<?php
// define variables and set to empty values

try {
    $email =  $password = "";
    $vaildated = 1;
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
            print_r($stmt);
                die();
            if($user)
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

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">تسجيل الدخول</h4>
                <button type="button" class="close" data-dismiss="modal"> &times;</button>
            </div>
            <div class="modal-body">
                <form  id="login_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                      >
                    <div class="form-group  ">
                        <label for="emil">اسم المستخدم : </label>
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
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">رجوع</button>
                <button type="submit" id="login" class="btn btn-primary m-4">Submit</button>

            </div>

        </div>
    </div>
</div>

