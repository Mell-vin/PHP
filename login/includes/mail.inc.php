<?php
    function Email_verify($email, $name, $toke, $url){
      $subject = "[CAMAGRU] - Email verification";
      $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
      $headers .= 'From: <lgumede@student.wethinkcode.co.za.42.fr>' . "\r\n";
      $message = '
      <html>
        <head>
          <title>' . $subject . '</title>
        </head>
        <body>
          Hello ' . htmlspecialchars($name) . ' </br>
          To finalyze your subscribtion please click the link below </br>
          <a href="http://' . $url . '</a>
        </body>
      </html>
      ';
      mail($email, $subject, $message, $headers);
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
            There is your new password : ' . $pwd . '. Please login using this password and immediately update it.214
            57\ </br> 
          </body>     
        </html>
        ';
        try {
        $conn = new PDO("mysql:host=localhost;dbname=lwazCamagru", "root", "000000");
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = $conn->prepare("UPDATE CamUsers SET pwd=:pwd WHERE email=:email");
        $sql->execute(array(':pwd'=> $pwd, ':email'=> $email));
        mail($email,$subject,$message,$headers);
        }catch(PDOException $e){
            echo "couldnt send email";
        }
    }
?>