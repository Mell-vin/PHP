<?php
    session_start();
    include 'mail.inc.php';
    include 'setupFunc.php';

    if (isset($_POST['email']) && isset($_POST['login-submit']) && $_SERVER["REQUEST_METHOD"] == "POST") {
        $email = test(strtolower($_POST['email']));
        if (empty($email)) {
            $mailErr = "email can not be empty";
            header("Location: http://localhost:8080/camagru/login/forgot.php?mailErr={$mailErr}");
            return;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mailErr = "Invalid email format";
            header("Location: http://localhost:8080/camagru/login/forgot.php?mailErr={$mailErr}");
            return;
        } else {
            try {
                $conn = new PDO("mysql:host=localhost;dbname=lwazCamagru", "root", "000000");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = $conn->prepare("SELECT email FROM CamUsers WHERE email=:email");
                $sql->bindParam(':email', $email);
                $sql->execute();
                $ret = $sql->fetchAll();
                $newPwd = uniqid('');

                if (sizeof($ret) > 0) {
                    forgotPwd($email, $newPwd);
                    $_SESSION['mail'] = $email;
                    $_SESSION['success'] = null;
                    $sent = "Please check your email to get your new password then login";
                    header("Location: http://localhost:8080/camagru/login/index.php?sent={$sent}");
                    return;
                } else{
                    $nameErr = "Username not found. try again";
                    header("Location: http://localhost:8080/camagru/login/forgot.php?mailErr={$nameErr}");
                    return;
                }
            } catch(PDOException $e){
                echo "Error: Oops! Couldn't check user account";
                echo $e->getMessage();
            }
            $conn = null;
            }
    }
?>