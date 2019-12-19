<?php
    session_start();
    include '../functions/verify.php';
    if (isset($_POST['base64']) && isset($_SESSION['id']))
    {
        $img = $_POST['base64'];
        $userid = $_SESSION['id'];
        $id = getUserId($userid);
        if ($id == -1 || $id == -2) {
            echo "couldnt find id";
            header("Location: http://localhost/camagru/login/myUpload.php");
            return;
        }
        $img = base64_decode($img);
        $imageName = date("YmdHms");

        $fileDirections = "../uploads/".$img.".png";
        if (file_put_contents($fileDirections, $img)) {
            try {
                $conn = new PDO("mysql:host=localhost;dbname=lwazCamagru", "root", "000000");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = $conn->prepare("INSERT INTO gallery (galid, img, imgLoc) VALUES (:userid, :img, :imgloc)");
                $sql->execute(array(':userid' => $userid, ':img' => $imgName."png", ':imgloc'=> $fileDirections));
                //header("Location: http://localhost/camagru/login/myUpload.php");
            } catch (PODException $e) {
                echo $e->getMessage();
                header("Location: http://localhost/camagru/login/myUpload.php");
                return;
            }
        }
    }
    else {
        //header("Location: http://localhost/camagru/login/index.php");
    }
?>