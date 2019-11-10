<?php
    function Email_verify($email, $name, $toke, $url){

    }

    function forgotPwd($email, $pwd) {
        $subject = "Camagru password reset";
        $headers = 'MIME-Version: 1.0'."\r\n";
        $headers = 'Content-type: text/html; charset=UTF-8'."\r\n";
        $headers = 'From: <lgumede@student.wtc.co.za'."\r\n";

        $message = '
        <html>
          <head>
            <title>' . $subject . '</title>
          </head>
          <body>
            Hello user ' . htmlspecialchars($email) . ' </br>
            There is your new password : ' . $pwd . ' </br> 
          </body>     
        </html>
        ';
        try {
        $conn = new PDO("mysql:host=localhost;dbname=lwazCamagru", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql->prepare("UPDATE camUsers SET pwd=:pwd WHERE email=:email");
        $sql->execute(array(':pwd'=> $pwd, ':email'=> $email));
        mail($email,$subject,$message,$headers);
        }catch(PDOException $e){
            echo "couldnt send email";
        }
    }
?>