<?php
    function login($mailid, $pwd) {
        include_once "setup.database.php";

        try {
            $conn = new PDO ("mysgl:host=localhost;dbname=lwazCamagru","root","000000");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("SELECT id, Username FROM CamUsers WHERE email=:email AND pwd=:pwd AND verified='Y'");
            $mailid = strtolower($mailid);
            $hash = password_hash($pwd, PASSWORD_DEFAULT);
            $sql->execute(array(':email' => $mailid, ':pwd' => $hash));

            $value = $sql->fetch();
            if ($value == null){
                $sql->closeCursor();
                return (-1);
            }
            $sql->colseCursor();
            
            return ($value);
        } catch (PDOException $e){
            $val['err'] = $e->getMessage();
            return ($val);
        }
    }
?>