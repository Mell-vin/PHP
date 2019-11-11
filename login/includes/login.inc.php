<?php
session_start();
include 'functions/login.inc.php';

if (isset($_POST['login-submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    function test($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

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

        //$log = login($mailuid, $pwd);
        if (!empty($mailuid) && !empty($pwd)){
        try{
            $conn = new PDO ("mysql:host=localhost;dbname=lwazCamagru","root","");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("SELECT email, pwd FROM CamUsers WHERE email=:username AND pwd=:pwd");
            // $sql->exec(array(':username' => $name, ':email' => $email));
            $hash = hash("md5", $pwd);
            $sql->bindParam(":username", $mailuid);
            $sql->bindParam(":pwd", $hash);
            $sql->execute();
    
            // $res = $sql->setFetchMode(PDO::FETCH_ASSOC);
        
            // $ret = $sql->fetchAll();
            //<br /><b>Notice</b>:  Undefined variable: name in <b>C:\xampp\htdocs\camagru\login\signup.php</b> on line <b>12</b><br />
            // for ($i = 0; $i < sizeof($ret); $i++) {
            //     foreach ($ret[$i] as $k => $v) {
            //         echo "{$k}: {$v}<br/>";
            //     }
            // }
    
            $ret = $sql->fetchAll();
    
            if (sizeof($ret) > 0) {
                $_SESSION['id'] = $mailuid;
                header("Location: http://localhost:8080/camagru/login/index.php");
                return;
            }else{
                $nameErr = "User not found ? password incorrect";
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