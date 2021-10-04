<?php
echo $_SERVER['PHP_SELF'];
echo "<br>";
echo $_SERVER['SERVER_NAME'];
echo "<br>";
echo $_SERVER['HTTP_HOST'];
echo "<br>";
echo $_SERVER['HTTP_REFERER'];
echo "<br>";
echo $_SERVER['HTTP_USER_AGENT'];
echo "<br>";
echo $_SERVER['SCRIPT_NAME'];
?>


<?php foreach ($categories as $cat) { ?>
                    <option value="<?php echo $cat->id ?>" <?php echo ($cat->id == $category) ? 'selected' : '' ?> ><?php echo $cat->name ?></option>";
                <?php } ?>