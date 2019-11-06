<?php
session_start();
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="This is an example of meta description">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <title></title>
    </head>
    <body>


        <header>
            <nav>
                <a href="#">
                    <img src="img/cam.png" alt="Logo" title="Logo">
                    <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Portfolio</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact us</a></li>
                    </ul>
                </a>
            </nav>
            <div>
                <?php if (isset($_SESSION['id'])) { ?>
                    You are logged in as: <?php print_r(htmlspecialchars($_SESSION['username']))?>
                <?php } else { ?> 
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <input type="text" name="mailuid" placeholder="email...">
                        <span style="color: red;">* <?= isset($_GET['nameErr']) ? $_GET['nameErr'] : "";?></span>
                        <br><br>
                        <input type="password" name="pwd" placeholder="Password...">
                        <span style="color: red;">* <?= isset($_GET['nameErr']) ? $_GET['nameErr'] : "";?></span>
                        <br><br>
                        <button type="submit" name="login-submit">Login</button>
                        <span>
                             <?php
				            if ($_SESSION['error']) {
					            echo $_SESSION['error'];
				            }
                            $_SESSION['error'] = null;
                            ?>
                        </span>
               </form>
                <?php } ?>
               <br><br>
               <form action="signup.php">
                <button>Sign Up</button>
               </form>
               <form action="includes/logout.inc.php" method="post">
               </form>
            </div>
        </header>
</html>