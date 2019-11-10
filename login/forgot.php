<?php
    session_start();
    require 'includes/forgot.inc.php';
    include 'frag/header.php';
?>
<!DOCTYPE html>
<HTML>
    <header>
        <link rel="stylesheet" href="styles/styela.css">
        <meta charset="UTF-8">
        <title>CAMAGRU - FORGOT</title>
    </header>
    <body>
        <?php //include('header.php') ?>
        <div class="title">FORGOT</div>
        <div id="red">
            <form method="post" style="position: relative;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                Email: <input id="email" name="email" placeholder="email..." type="mail">
                <span style="color: red;">* <?= isset($_GET['mailErr']) ? $_GET['mailErr'] : "";?></span>
                <br><br>
                <button type="submit" name="login-submit">Submit</button>
            </form>
        </div>
        <?php include 'frag/footer.php'; ?>
    </body>
</HTML>