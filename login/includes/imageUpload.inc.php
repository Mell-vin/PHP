<?php
    session_start();
    // include '../functions/verify.php';

    if (isset($_POST['img']) && isset($_SESSION['id']) && isset($_POST['sticker'])) {

        $img = $_POST['img'];
        $sticker = $_POST['sticker'];
        $userid = $_SESSION['id'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $sticker = str_replace('data:image/png;base64,', '', $sticker);
        $img = str_replace(' ', '+', $img);
        $sticker = str_replace(' ', '+', $sticker);
        $data = base64_decode($img);
        $effect = base64_decode($sticker);
        $temp = '../tmp/' . 'image' . date('YmdHis') . '.png';
        $file =  '../img/' . 'image' . date('YmdHis') . '.png';
        file_put_contents($file, $data); //move to last in a bit
        file_put_contents($temp, $effect);
        list($width,$height) = getimagesize($file);
        $path = 'image' . date('YmdHis') . '.png';
        $Fdata = imagecreatefromstring(file_get_contents($file));
        $Feffect = imagecreatefromstring(file_get_contents($temp));
        imagecopymerge($Fdata,$Feffect,0,0,0,0,$width, $height,45);
        $save = '../uploads/' . 'image' . date('YmdHis') . '.png';
        imagepng($Fdata, $save);
        imageDestroy($Fdata);

        try {
            $conn = new PDO ("mysql:host=localhost;dbname=lwazCamagru","root","000000");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlid = $conn->prepare("SELECT id FROM CamUsers WHERE email=:username");
            $sqlid->bindParam(":username", $userid);
            $sqlid->execute();

            $ret = $sqlid->fetch();
            $userid = $ret[0];
            $sqlinsert = $conn->prepare("INSERT INTO gallery (galid, imgName, imgLoc) VALUES (:id, :img, :imgloc)");
            $sqlinsert->bindParam(":id", $userid);
            $sqlinsert->bindParam(":img", $path);
            $sqlinsert->bindParam(":imgloc", $save);
            $sqlinsert->execute();
            echo "Photo successfully uploaded";

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    } else {
        echo "Error: No image data";
    }