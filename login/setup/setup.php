#!/C/PHP7/php
<?php
    require 'database.php';

    try {
        $conn = new PDO ("mysql:host=$DB_host", $DB_host, $DB_pwd);
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
        $sql = "CREATE TABLE CamUsers (
            id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            Username VARCHAR(25) NOT NULL,
            email VARCHAR(60) NOT NULL,
            Userid VARCHAR(15) NOT NULL,
            pwd VARCHAR(60) NOT NULL
            );"
            $sql->exec($sql);
            echo "table CamUsers created successfully";
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
            galid int (10) NOT NULL,
            FOREIGN KEY (galid) REFERENCES $Usertable(id)
        );"
        $sql->exec($sql);
        echo "table gallery created successfully";
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
            userid int(10) NOT NULL,
            galid int(10) NOT NULL,
            FOREIGN KEY (userid) REFERENCES $Usertable(id),
            FOREIGN KEY (galid) REFERENCES gallery(id)
        );"
        $sql->exec($sql);
        echo "table comments created successfully";
    }
    catch (PDOException $e){
        echo $sql."<br>". $e->getMessage();
        exit();
    }

    try {
        $conn = new PDO ("mysql:host=$DB_host;dbname=$DB_name", $DB_host, $DB_pwd);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "CREATE TABLE likes (
            id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            userid int(10) NOT NULL,
            galid int(10) NOT NULL,
            liked VARCHAR(1) NOT NULL,
            FOREIGN KEY (userid) REFERENCES $Usertable(id),
            FOREIGN KEY (galid) REFERENCES gallery(id)
        );"
        $sql->exec($sql);
        echo "table likes created successfully";
    }
    catch (PDOException $e){
        echo $sql."<br>". $e->getMessage();
        exit();
    }
?>