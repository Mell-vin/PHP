<?php
    session_start();
    // include '../functions/verify.php';

    if (isset($_POST['img']) && isset($_SESSION['id'])) {

        $img = $_POST['img'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file =  '/goinfre/lgumede/Desktop/mamp/apache2/htdocs/camagru/login/img/' . 'image' . date('YmdHis') . '.png';
        file_put_contents($file, $data);

        $path = 'image' . date('YmdHis') . '.png';
        $userid = $_SESSION['id'];

        try {
            $conn = new PDO ("mysql:host=localhost;dbname=lwazCamagru","root","000000");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sqlid = $conn->prepare("SELECT id FROM CamUsers WHERE email=:username");
            $sqlid->bindParam(":username", $userid);
            $sqlid->execute();

            $ret = $sqlid->fetch();
            $userid = $ret[0];
            $sqlinsert = $conn->prepare("INSERT INTO gallery (galid, imgName, imgLoc) VALUES (:id, :img, :imgloc)");
            $sqlinsert->bindParam(":id", $userid) ;
            $sqlinsert->bindParam(":img", $path);
            $sqlinsert->bindParam(":imgloc", $file);
            $sqlinsert->execute();
            echo "Photo successfully uploaded";

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    } else {
        echo "Error: No image data";
    }
    
    if (isset($_POST['test']) && isset($_SESSION['id']))
    {
        $img = $_POST['test'];
        $userid = $_SESSION['id'];

        // $id = getUserId($userid);

        


        // if ($id == -1 || $id == -2) {
        //     echo "couldnt find id";
        //     header("Location: http://localhost/camagru/login/myUpload.php");
        //     return;
        // }
        // $img = base64_decode($img);
        // $imageName = date("YmdHms");

        // $fileDirections = "../uploads/".$img.".png";
        // if (file_put_contents($fileDirections, $img)) {
        //     try {
        //         $conn = new PDO("mysql:host=localhost;dbname=lwazCamagru", "root", "000000");
        //         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //         $sql = $conn->prepare("INSERT INTO gallery (galid, img, imgLoc) VALUES (:userid, :img, :imgloc)");
        //         $sql->execute(array(':userid' => $userid, ':img' => $imgName."png", ':imgloc'=> $fileDirections));
        //         //header("Location: http://localhost/camagru/login/myUpload.php");
        //     } catch (PODException $e) {
        //         echo $e->getMessage();
        //         // header("Location: http://localhost/camagru/login/myUpload.php");
        //         return;
        //     }
        // }

    }
    else {
        //header("Location: http://localhost/camagru/login/index.php");
        echo $_SESSION['id'];
    }
?>