<?php
    session_start();

    if (isset($_POST['image']) && isset($_SESSION['id']))
    {
        try {
            $img = $_POST['image'];
            $userid = $_SESSION['id'];
            $conn = new PDO("mysql:host=localhost;dbname=lwazCamagru", "root", "000000");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("INSERT INTO gallery (galid, img) VALUES (:userid, :img)");
            $sql->execute(array(':userid' => $userid, ':img' => $img));
            header("Location: http//localhost/camagru/login/myUpload.php");
        } catch (PODException $e) {
            echo $e->getMessage();
            header("Location: http//localhost/camagru/login/myUpload.php");
            return;
        }
    }
    else {
        header("Location: http//localhost/camagru/login/index.php");
    }
?>
