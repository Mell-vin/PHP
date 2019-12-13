<?php
session_start();
    require 'config/database.php';
    include 'includes/mail.inc.php';
    //require 'includes/signup.inc.php';

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
            //echo "Error: oops!! Something went wrong";
            //exit();
        }
    }

    function UpdateProfile ($user, $pwd) {

        $pwdSuccess = $failure = "";
        try {
            $conn = new PDO("mysql:host=localhost;dbname=lwazCamagru", "root", "000000");
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $username = $_SESSION['id'];
            $hash = hash("md5", $newpwd);
            $sqlResult = $conn->prepare("UPDATE camUsers SET pwd=:pwd WHERE Username=:user"); // finish off // Get_id function so you can use it to update because woooow
            $sqlExec = $sqlResult->execute(array(":pwd"=>$hash, ":user"=>$username));
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
?>