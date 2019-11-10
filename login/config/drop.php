<?php
    //require 'database.php';

    try{
        $conn = new PDO("mysql:host=localhost","root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="DROP DATABASE lwazCamagru";
        $conn->exec($sql);
        echo "DB dropping like a skydiver without a chute";
    }catch (PDOException $e){
        echo "Error: Database still floating around";
        exit();
    }
?>