<?php
session_start();
include 'functions/login.inc.php';
include 'setupFunc.php';

if (isset($_POST['login-submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    $nameErr = $pwdErr = "";
    $mailuid = strtolower(test($_POST['mailuid']));
    $pwd = test($_POST['pwd']);

        if (empty($pwd)) {
            $pwdErr = "password cannot be empty";
        }

        if (empty($mailuid)) {
            $nameErr = "username cannot be empty";
        }
        
        if (!empty($nameErr) || !empty($pwdErr)) {
            header("Location: http://localhost:8080/camagru/login/index.php?nameErr={$nameErr}&pwdErr={$pwdErr}");
        return;
        }

        if (!empty($mailuid) && !empty($pwd)){
        try{
            $conn = new PDO ("mysql:host=localhost;dbname=lwazCamagru","root","000000");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("SELECT email, pwd FROM CamUsers WHERE email=:username AND pwd=:pwd"); // add verifications Y thing
            // $sql->exec(array(':username' => $name, ':email' => $email));
            $hash = hash("md5", $pwd);
            $sql->bindParam(":username", $mailuid);
            $sql->bindParam(":pwd", $hash);
            $sql->execute();
    
    
            $ret = $sql->fetchAll();
    
            if (sizeof($ret) > 0) {
                $_SESSION['id'] = $mailuid;
                $_SESSION['success'] = null;
                header("Location: http://localhost:8080/camagru/login/index.php");
                return;
            }else{
                $nameErr = "User not found/password incorrect/not verified";
                header("Location: http://localhost:8080/camagru/login/index.php?nameErr={$nameErr}");
                return;
            }
        } catch(PDOException $e){
            echo "\n";
            echo "Error: Oops! Couldn't check user account";
        }
    }
        /*if ($log == 0){
            $loginErr = "user not found. try another user or sign up";
            header("Location: http://localhost:8080/camagru/login/index.php?loginErr={$loginErr}");
            return;
        } else{
            $_SESSION['username'] = $mailuid;
        }
        header("Location: http://localhost:8080/camagru/login/index.php?success=$signup");*/
    }