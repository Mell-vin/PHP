<?php
include 'functions/verify.php';
?>
<!DOCTYPE html>
<HTML>
  <header>
    <link rel="stylesheet" type="text/css" href="styles/styela.css">
    <meta charset="UTF-8">
    <title>CAMAGRU - VERIFY</title>
  </header>
  <body style="background-color: grey">
    <?php include('frag/header.php') ?>
    <?php include('frag/footer.php') ?>
    <div id="login">
    <div class="title">VERIFY</div>
    <br>
    <?php if(isset($_GET['token'])) { ?>
    <?php print_r("123"); ?>
    <?php } ?>
    <?php if (verifyFunc($_GET["token"]) == 0) { ?>
      <strong>
        Your account as been verified. You can login.
      </strong>
    <?php } else { ?>
      <strong>
        Account not found
      </strong>
    <?php } ?>
    </div>
  </body>
</HTML>