<?php

include '../functions/login.inc.php';
session_start();

if (isset($_POST['login-submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    function test($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

    $nameErr = $pwdErr = "";
    $mailuid = test($_POST['mailuid']);
    $pwd = test($_POST['pwd']);

        if (empty($pwd)) {
            $pwdErr = "pwd cannot be empty";
        }

        if (empty($mailuid)) {
            $nameErr = "username cannot be empty";
        }
        
        if (!empty($nameErr) || !empty($pwdErr)) {
            header("Location: http://localhost:8080/camagru/login/index.php?nameErr={$nameErr}&pwdErr={$pwdErr}");
        return;
        }

        if ($val = login($mailuid, $pwd) == -1){
            $loginErr = "user not found. try another user or sign up";
            header("Location: http://localhost:8080/camagru/login/index.php?loginErr={$loginErr}");
            return;
        } else{
            $_SESSION['id'] = $val['id'];
            $_SESSION['username'] = $val['Username'];
        }

        header("Location: http://localhost:8080/camagru/login/index.php");
    }