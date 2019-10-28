<?php //script for the signing up page
    require "includes/signup.inc.php";
   
    
?>
<head><link rel="stylesheet" href="styles/styela.css"></head>
    <main>
        <div>
            <section><h1>Sign up</h1><a href="login.php">Home</a>
            <p><span style="color: red;">* required field</span></p>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    Name: <input type="text" name="name" placeholder="Username" value="<?php echo $name;?>">
                    <span style="color: red;">* <?php echo $nameErr;?></span>
                    <br><br>
                   Email: <input type="text" name="email" placeholder="e-mail" value="<?php echo $email;?>">
                   <span style="color: red;">* <?php echo $mailErr;?></span>
                   <br><br>
                   Prefered username: <input type="text" name="uid" placeholder="uid" value="<?php echo $uid;?>">
                   <span style="color: red;">* <?php echo $uidErr;?></span>
                   <br><br>
                   Password(min len: 8 char) <input type="password" name="pwd" placeholder="password">
                   <span style="color: red;">* <?php echo $pwdErr;?></span>
                   <br><br>
                   Repeat password: <input type="password" name="pwd-repeat" placeholder="repeat password">
                   <span style="color: red;">* <?php echo $pwdDiff;?></span>
                   <br><br>
                    <button type="submit" name="signup-submit">SignUp</button> <!--clicks the submit button once all info is filled-->
                </form>
            </section>
        </div>
    </main>

<?php
    require "footer.php";
?>