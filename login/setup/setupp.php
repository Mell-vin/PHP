#!/usr/bin/php
<?php

    include 'database.php';
    try {
        $conn = new PDO ("mysql:host=$DB_host",$DB_host,$DB_pwd);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="CREATE DATABASE 'LwazCamagru' ";
        $conn->exec($sql);
        echo "database created successfully";
    }catch(PDOException $e){
        echo$sql."<br>".$e->getMessage();
        exit();
    }
    try{
        $conn=new PDO("mysql:host=$DB_host;dbname=$DB_name",$DB_host,$DB_pwd);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="CREATE TABLE 'CamUsers'(
            id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            Username VARCHAR(25) NOT NULL,
            email VARCHAR(60) NOT NULL,
            Userid VARCHAR(15) NOT NULL,
            pwd VARCHAR(60) NOT NULL
        );"
        $conn->exec($sql);
        echo"table created successfully";
    }catch(PDOException $e){
        echo$sql."<br>".$e->getMessage();
    }
    try{
        $conn=new PDO("mysql:host=$DB_host;dbmane=$DB_name",$DB_host,$DB_pwd);
        $conn->SetAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="CREATE TABLE gallery(
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            img IMAGE NOT NULL,
            galid INT(10) NOT NULL,
            FOREIGN KEY (galid) REFERENCES $Usertable(id)
        );"
        $conn->exec($sql);
        echo "table created successfully";
    }catch(PDOException $e){
        echo $sql."<br>".$e->getMessage();
    }
    try{
        $conn=new PDO("mysql:host=$DB_host;dbname=$DB_name",$DB_host,$DB_pwd);
        $conn-SetAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="CREATE TABLE comments(
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            userid INT(10) NOT NULL,
            galid INT(10) NOT NULL,
            FOREIGN KEY (userid) REFERENCES $Usertable(id),
            FOREIGN KEY (galid) REFERENCES gallery(id)
        );"
        $conn->exec($sql);
        echo "table created successfully";
    }catch(PDOException $e){
        echo $sql."<br>".$e->getMessage();
    }
    try{
        $conn=new PDO("mysql:host=$DB_host;dbname=$DB_name",$DB_host,$DB_pwd);
        $conn->SetAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="CREATE TABLE likes(
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            userid INT(10) NOT NULL,
            galid INT(10) NOT NULL,
            liked VARCHAR(1) NOT NULL,
            FOREIGN KEY (userid) REFERENCES $Usertable(id),
            FOREIGN KEY (galid) REFERENCES gallery(id)
        );"
        $conn->exec($sql);
        echo "table created successfully";
    }catch(PDOException $e){
        echo $sql."<br>".$e->getMessage();
    }
    ?>