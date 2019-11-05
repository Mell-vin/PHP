<?php
<<<<<<< HEAD
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
=======
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
>>>>>>> c1cfc1d34431c7975ac1f0195f96ec7b1ad5721b
?>