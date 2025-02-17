<?php
    //require_once ('database.php');
    try{
        $conn = new PDO ("mysql:host=localhost", "root", "000000");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE IF NOT EXISTS lwazCamagru";
        $conn->exec($sql);
        echo "database created successfully";
    }
    catch(PDOException $e){
        echo "kubi mtase. didnt create db";
        exit();
    }
    //now to create my db table
    try {
        $conn = new PDO ("mysql:host=localhost;dbname=lwazCamagru", "root", "000000");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE IF NOT EXISTS CamUsers (
            id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            Username VARCHAR(25) NOT NULL,
            email VARCHAR(60) NOT NULL,
            token VARCHAR(50) NOT NULL,
            verified VARCHAR(1) NOT NULL DEFAULT 'N', 
            pwd VARCHAR(60) NOT NULL
            )";
            $conn->exec($sql);
            echo "table CamUsers created successfully\n";
    }
    catch (PDOException $e){
        echo "kubi mtase. didnt create table";
        exit();
    }
    // gallery table is to be born

    try {
        $conn = new PDO ("mysql:host=localhost;dbname=lwazCamagru", "root", "000000");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE IF NOT EXISTS gallery (
            id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            imgName VARCHAR(100) NOT NULL,
            galid int (10) NOT NULL,
            imgLoc VARCHAR(100) NOT NULL,
            FOREIGN KEY (galid) REFERENCES CamUsers(id)
        )";
        $conn->exec($sql);
        echo "table gallery created successfully\n";
    }
    catch (PDOException $e){
        echo "kubi mtase. didnt create table";
        exit();
    }
    // now to create the comments sections for the images posted
    try {
        $conn = new PDO ("mysql:host=localhost;dbname=lwazCamagru", "root", "000000");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE IF NOT EXISTS comments (
            id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            userid int(10) NOT NULL,
            galid int(10) NOT NULL,
            FOREIGN KEY (userid) REFERENCES CamUsers(id),
            FOREIGN KEY (galid) REFERENCES gallery(id)
        )";
        $conn->exec($sql);
        echo "table comments created successfully\n";
    }
    catch (PDOException $e){
        echo "kubi mtase. didnt create table";
        exit();
    }

    try {
        $conn = new PDO ("mysql:host=localhost;dbname=lwazCamagru", "root", "000000");        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE IF NOT EXISTS likes (
            id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            userid int(10) NOT NULL,
            galid int(10) NOT NULL,
            liked VARCHAR(1) NOT NULL,
            FOREIGN KEY (userid) REFERENCES CamUsers(id),
            FOREIGN KEY (galid) REFERENCES gallery(id)
        )";
        $conn->exec($sql);
        echo "table likes created successfully\n";
    }
    catch (PDOException $e){
        echo "kubi mtase. didnt create table";
        exit();
    }
?>
