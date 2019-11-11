<?php
    session_start();
    require 'includes/login.inc.php';
    include 'frag/header.php';
    //include_once 'forgot.php';
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="This is an example of meta description">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <title></title>
    </head>
    <body style="background-color: white;">
        <header>
            <nav>
                <a href="#">
                    <link rel="stylesheet" href="styles/styela.css">
                    <img src="img/cam.png" alt="Logo" title="Logo">
                    <ul>
                    <li><a href="index.php">Home</a></li>
                    </ul>
                </a>
            </nav>
            <?php
                if (isset($_SESSION['success'])) {
                    print_r(htmlspecialchars($_SESSION['success']));
                }
            ?>
            <div>
                <?php if (isset($_SESSION['id'])) { ?>
                    You are logged in as: <?php print_r(htmlspecialchars($_SESSION['id']))?>
                <br><br>
                <?php }else  if (isset($_SESSION['mail']) && isset($_GET['sent'])) { ?>
                    email sent to: <?php print_r(htmlspecialchars($_SESSION['mail']))?>.
                <br>
                    <?php print_r(htmlspecialchars($_GET['sent']))?>
                <?php } else { ?> 
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        Email: <input type="text" name="mailuid" placeholder="email..." >
                        <span style="color: red;">* <?= isset($_GET['nameErr']) ? $_GET['nameErr'] : "";?></span>
                        <br><br>
                        Password: <input type="password" name="pwd" placeholder="Password...">
                        <span style="color: red;">* <?= isset($_GET['pwdErr']) ? $_GET['pwdErr'] : "";?></span>
                        <br><br>
                        <button type="submit" name="login-submit">Login</button>
                        <br><br> 
                        <li><a href="forgot.php">forgot password</a></li>
               </form>
                <?php } ?>
                <form action="signup.php">
                    <button>Sign Up</button>
                </form>
               <br><br>
               <form action="includes/logout.inc.php" method="post">
               </form>
            </div>
        </header>
        <?php include 'frag/footer.php'; ?>
    </body>
</html>