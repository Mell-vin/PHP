<?php
    session_start();

    if ($_SESSION['id'] != null) {
        $username = $_SESSION['id'];
    }
?>

