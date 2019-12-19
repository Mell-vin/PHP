<?php
session_start();
    //require 'database.php';
    include 'includes/mail.inc.php';
    //require 'includes/signup.inc.php';

    function get_UserID($user)
    {
        if (!empty($user)){
            try {
                $conn = new PDO("mysql:host=localhost;dbname=lwazCamagru", "root", "000000");
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql = $conn->prepare("SELECT * FROM camUsers WHERE Username=:user");
                $sql->bindParam(":user", $user);
                $sql->execute();

                $ret = $sql->fetchAll();
                if (sizeof($ret) > 0)
                {
                    $id = $ret[0];
                    return ($id);
                } else if ($ret == 0){
                    return (-2);
                }
            }catch (PDOException $e) {
                return (-1);
            }
        }
    }
    function signupFunc ($name, $email, $pwd){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=lwazCamagru", "root", "000000");
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            // $sql = $conn->prepare("INSERT INTO CamUsers (username, email, pwd) VALUES (:username, :email, :pwd, :token)");
            $toke = uniqid(rand(), TRUE);
            $hash = hash("md5", $pwd);
            // $sql->execute(array(':username' => $name, ':email' => $email, ':pwd' => $pwd, ':token' => $toke));

            // Bind Param
            $sql = $conn->prepare("INSERT INTO CamUsers (Username, email, pwd, token) VALUES (:username, :email, :pwd, :token)");            
            
            $sql->bindParam(":username", $name);
            $sql->bindParam(":email", $email);
            $sql->bindParam(":pwd", $hash);
            $sql->bindParam(":token", $toke);
            $sql->execute();

            $url = "http://localhost:8080/camagru/login/verify.php?username=$email&token=$toke";
            Email_verify($email, $name, $toke, $url);
            $success = "sign up success. please check your email address";
            $_SESSION['success'] = $success;
            header("Location: http://localhost:8080/camagru/login/index.php");
            return;

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    function UpdateProfile ($user, $pwd) {

        $pwdSuccess = $failure = "";
        try {
            $conn = new PDO("mysql:host=localhost;dbname=lwazCamagru", "root", "000000");
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $hash = hash("md5", $pwd);
            $sqlResult = $conn->prepare("UPDATE camUsers SET pwd=:pwd WHERE email=:id");
            $sqlExec = $sqlResult->execute(array(":pwd"=>$hash, ":id"=>$user));
            if ($sqlExec) {
            $pwdSuccess = "Password updated!!";
            header("Location: http://localhost:8080/camagru/login/profile.php?pwdErr={$pwdSuccess}");
            return;
            }
            else
            {
                $failure =  "Error: Password not updated";
                header("Location: http://localhost:8080/camagru/login/profile.php?pwdErr={$failure}");
                return;
            }
            } catch(PDOException $e) {
                $failure = "wow";
                header("Location: http://localhost:8080/camagru/login/profile.php?pwdErr={$failure}");
                return;
            }
    }

    function deleteAcc($user) {
        if (!empty($user)) {
            try {
                $conn = new PDO("mysql:host=localhost;dbname=lwazCamagru", "root", "000000");
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql = $conn->prepare("DELETE FROM camUsers WHERE email=:email");
                $sql->bindParam(":email", $user);
                $del = $sql->execute();

                if ($del){
                    $_SESSION['error'] = null;
                    $_SESSION['id'] = null;
                    $_SESSION['mailuid'] = null;
                    $_SESSION['success'] = "Account deleted";
                    header("Location: http://localhost:8080/camagru/login/index.php");
                    return;
                }
            } catch (PDOException $e) {
                $failure = $e->getMessage();
                header("Location: http://localhost:8080/camagru/login/profile.php?pwdErr={$failure}");
                return;
            }
        }
    }
?>