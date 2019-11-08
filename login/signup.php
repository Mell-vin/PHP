<?php //script for the signing up page
require 'includes/signup.inc.php';
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="styles/styela.css"></head>
    <main>
        <div>
            <section><h1>Sign up</h1><a href="index.php">Home</a>
            <p><span style="color: red;">* required field</span></p>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    Name: <input type="text" name="name" placeholder="Username" value="<?php echo $name;?>">
                    <span style="color: red;">* <?= isset($_GET['nameErr']) ? $_GET['nameErr'] : "";?></span>
                    <br><br>
                   Email: <input type="text" name="email" placeholder="e-mail" value="<?php echo $email;?>">
                   <span style="color: red;">* <?= isset($_GET['mailErr']) ? $_GET['mailErr'] : "";?></span>
                   <br><br>
                   Password(min len: 8 char) <input type="password" name="pwd" placeholder="password">
                   <span style="color: red;">* <?= isset($_GET['pwdErr']) ? $_GET['pwdErr'] : "";?></span>
                   <br><br>
                   Repeat password: <input type="password" name="pwd-repeat" placeholder="repeat password">
                   <span style="color: red;">* <?= isset($_GET['pwdDiff']) ? $_GET['pwdDiff'] : "";?></span>
                   <br><br>
                   <button type="submit" name="signup-submit">Signup</button>
                </form>
            </section>
        </div>
    </main>
</html>
<?php
    require "footer.php";
?>