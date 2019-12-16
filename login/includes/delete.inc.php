<?php
session_start();
    include 'setupFunc.php';

    if ($_SESSION['id']) {
        $user = "";
        $user = $_SESSION['id'];
        deleteAcc($user);
    }
?>