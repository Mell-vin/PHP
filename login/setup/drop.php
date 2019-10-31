<?php
    require 'database.php';

    try{
        $conn = new PDO("mysql:host=$DB_host",$DB_username,$DB_pwd);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="DROP DATABASE $DB_name";
        $conn->exec($sql);
        echo "DB dropping like a skydiver without a chute";
    }catch (PDOException $e){
        echo "Error: Database still floating around";
        exit();
    }
?>