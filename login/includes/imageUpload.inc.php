<?php
    session_start();

    if (isset($_POST['image']) && isset($_SESSION['id']))
    {
        $img = $_POST['image'];
        $userid = $_SESSION['id'];
        $img = base64_decode($img);
        $imgName = date("YmdHms");
        $image = "";

        $folder = "../temps/".$imgName.".png";
        if (file_puts_contents($folder, $img)){
            $image1 = "../temps/".$imgName.".png";
            $image = $imgName.".png";
        }
        $type = "png";
        $image1 = imagecreatefromstring(file_get_contents($image1));
        $save = "../uploads/files/".$imgName.".png";
        imagepng($image1, $save);
        imageDestroy($image1);

        $fileDir = "../uploads/".$image;
        $fileDirections = "../uploads/files/".$image;
        if (file_put_contents($fileDir, $img))
        try {
            $conn = new PDO("mysql:host=localhost;dbname=lwazCamagru", "root", "000000");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("INSERT INTO gallery (galid, img) VALUES (:userid, :img)");
            $sql->execute(array(':userid' => $userid, ':img' => $imgName."png"));
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