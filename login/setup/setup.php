<?php
    require 'database.php';

    try {
        $conn = new PDO ("mysql:host=$DB_host", $DB_host, $DB_pwd);
        //setting the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE $DB_name";
        $sql->exec($sql);
        echo "database created successfully";
    }
    catch (PDOException $e){
        echo $sql."<br>". $e->getMessage();
        exit();
    }
    //now to create my db table

    try {
        $conn = new PDO ("mysql:host=$DB_host;dbname=$DB_name", $DB_host, $DB_pwd);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //lets create our table yea
        $sql ="CREATE TABLE $Usertable (
            id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            Username VARCHAR(25) NOT NULL,
            email VARCHAR(60) NOT NULL,
            Userid VARCHAR(15) NOT NULL,
            password VARCHAR(64) NOT NULL
            );"
    }
    catch (PDOException $e){
        echo $sql."<br>". $e->getMessage();
        exit();
    }
    // gallery table is to be born

    try {
        $conn = new PDO ("mysql:host=$DB_host;dbname=$DB_name", $DB_host, $DB_pwd);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE gallery (
            id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            img IMAGE NOT NULL,
            galid int (10) NOT NULL'
            FOREIGN KEY (galid) REFERENCES $Usertable(id)
        );"
    }
    catch (PDOException $e){
        echo $sql."<br>". $e->getMessage();
        exit();
    }
    // now to create the comments sections for the images posted

    try {
        $conn = new PDO ("mysql:host=$DB_host;dbname=$DB_name", $DB_host, $DB_pwd);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE comments (
            id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
        );"
    }
?>