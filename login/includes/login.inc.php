<?php

if (isset($_POST['login-submit'])) {

    require 'dbh.inc.php';

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

   // if (empty($mailuid) || empty($password)) {
        if (empty($mailuid) && empty($password)) {
            header("Location: http://localhost/camagru/login/login.php?error=Emptyfields");
            exit();
        }
        else if (empty($mailuid)) {
            header("Location: http://localhost/camagru/login/login.php?error=emptyUsername");
            exit ();
        } else if (empty($password)) {
            header("Location: http://localhost/camagru/login/login.php?error=emptyPassword&mailuid=".$mailuid);
            exit ();
        }

    } 
    else {

        header("Location: http://localhost/camagru/login/login.php?error=emptyfields&name=");
    }

//} 