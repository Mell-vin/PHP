<?php
    //require 'database.php';

    try{
        $conn=new PDO("mysql:host=localhost", "root","");
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "DROP DATABASE lwazCamagru";
        $conn->exec($sql);
        echo "Database dropping like a ton of bricks";
    }catch(PDOException $e){
        echo "Error! Database is still floating around";
    }
    $conn = null;
?>