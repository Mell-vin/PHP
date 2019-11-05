<?php //script for the signing up page
session_start();
require_once 'includes/signup.inc.php';
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="styles/styela.css"></head>
    <main>
        <div>
            <section><h1>Sign up</h1><a href="login.php">Home</a>
            <p><span style="color: red;">* required field</span></p>
                <form method="post" action="includes/signup.inc.php">
                    Name: <input type="text" name="name" placeholder="Username">
                    <span style="color: red;"></span>
                    <br><br>
                   Email: <input type="text" name="email" placeholder="e-mail">
                   <span style="color: red;"></span>
                   <br><br>
                   Password(min len: 8 char) <input type="password" name="pwd" placeholder="password">
                   <span style="color: red;"></span>
                   <br><br>
                   Repeat password: <input type="password" name="pwd-repeat" placeholder="repeat password">
                   <span style="color: red;"></span>
                   <br><br>
                    <button type="submit" name="signup-submit">SignUp</button> <!--clicks the submit button once all info is filled-->
                    <span>
                        <?php
                            $_SESSION['error'] = null;
                            if (isset($_SESSION['signup_success'])) {
                                echo "Signup success please check your mail box";
                                $_SESSION['signup_success'] = null;
                            }
                        ?>
                    </span>
                </form>
            </section>
        </div>
    </main>
</html>
<?php
    require "footer.php";
?>