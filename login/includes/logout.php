<?php
    session_start();
    $_SESSION['error'] = null;
    $_SESSION['id'] = null;
    $_SESSION['mailuid'] = null;
    header("Location: http://localhost/camagru/login/index.php");
?>