<?php
    function login($mailid, $pwd) {
        include_once "setup.database.php";

        try {
            $conn = new PDO ("mysgl:host=localhost;dbname=lwazCamagru","root","000000");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("SELECT email, pwd FROM CamUsers WHERE email=:email AND pwd=:pwd AND verified='N'");
            $mailid = strtolower($mailid);
            $hash = password_hash($pwd, PASSWORD_DEFAULT);
            $sql->execute(array(':email' => $mailid, ':pwd' => $hash));

            $count = $sql->rowCount();
            if ($count > 0) {
                $_SESSION['id'] = $mailid;
                $success = 1;
                //header("Location: http://localhost:8080/camagru/login/index.php");
            }else {
                $success = 0;
            }
        } catch (PDOException $e){
            $val['err'] = $e->getMessage();
        }
        return ($success);
    }
?>