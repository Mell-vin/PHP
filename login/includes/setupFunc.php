<?php
    require_once 'database.php';
    //require 'includes/signup.inc.php';

    function signupFunc ($name, $email, $pwd){
        try {
            $conn = new PDO("mysql:host=localhost;dbname=lwazCamagru", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $sql = $conn->prepare("INSERT INTO CamUsers (username, email, pwd) VALUES (:username, :email, :pwd, :token)");
            $toke = md5(uniqid(rand(), TRUE));
            $sql->execute(array(':username' => $name, ':email' => $email, ':pwd' => $pwd, ':token' => $toke));
           // Email_verify($email, $name, $toke, $url);
           echo "Successfully signed up!! Let's get posting.";
        }catch(PDOException $e){
            echo "Error: oops!! Something went wrong";
            exit();
        }
    }
?>