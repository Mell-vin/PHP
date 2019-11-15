<?php //script for the updating user profile
require 'includes/update.inc.php';
include 'frag/header.php';
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="styles/styela.css"></head>
    <main>
        <div>
            <section><h1>My profile</h1><a href="index.php">Home</a>
            <br><br>
            <?php if (isset($_SESSION['id'])) { ?>
                <p><span style="color: red;">* required field</span></p>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                   old Password(min len: 8 char) <input type="password" name="pwd" placeholder="password">
                   <span style="color: red;">* <?= isset($_GET['pwdErr']) ? $_GET['pwdErr'] : "";?></span>
                   <br><br>
                   new password: <input type="password" name="newpwd" placeholder="repeat password">
                   <span style="color: red;">* <?= isset($_GET['pwdDiff']) ? $_GET['pwdDiff'] : "";?></span>
                   <br><br>
                   repeat new password: <input type="password" name="pwd-repeat" placeholder="repeat password">
                   <span style="color: red;">* <?= isset($_GET['pwdStrength']) ? $_GET['pwdStrength'] : "";?></span>
                   <br><br>
                   <button type="submit" name="update-submit">update</button>
                </form>
            <?php } else { ?>
            <strong><?php echo "You need to login first before updating"; ?></strong>
            <?php } ?>
            </section>
        </div>
    </main>
</html>
<?php
    include "frag/footer.php";
?>