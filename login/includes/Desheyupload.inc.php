<?php
    session_start();
    require_once('connDB.php');
    $getUser = $_SESSION['userID']; 
    $user = getUserID($getUser);
    $setuser = $user[0]['id_user'];
    
    $postImage = $_POST['image']; 
    $Overlay = $_POST['effect'];
    
    $picture = base64_decode($postImage); 
    $imageName = date("YmdHms"); 
    $image = "";

 
    $fileSet = "../temp_image/".$imageName.".png"; 
    if(file_put_contents($fileSet, $picture)){
        $image1 = "../temp_image/$imageName".".png";  
        $image = $imageName.".png";
    }
    $type = 'png';
    $image2 = "";

    switch($Overlay){
        case "Smiley":
            $image2 = "images/smiley.png";
        break; 
        case "Sad":
            $image2 = "images/sad.png";
        break; 
        case "Cry":
            $image2 = "images/cry.png";
        break; 
        case "Laugh":
            $image2 = "images/laugh.png";
        break; 
        case "Heart":
            $image2 = "images/heart.png";
        break; 
        case "Shocked":
            $image2 = "images/shocked.png";
        break; 
        default:
        //Cool
            $image2 = "images/cool.png";
        break; 
    }
    
    list($width,$height)=getimagesize($image1);
    $image1 = imagecreatefromstring(file_get_contents($image1));
    $image2 = imagecreatefromstring(file_get_contents($image2));

    $save = "../uploads/files/".$imageName.".png";
    imagecopymerge($image1,$image2,0,100,0,0,$width/3, $height/3,0);

    imagepng($image1,$save);
    imageDestroy($image1);
    

    $fileDir = "../uploads/".$image; 
    $fileDirections = "uploads/files/".$image;
    if(file_put_contents($fileDir, $picture))
        
        $data = array(
            ":imagename"=>$imageName."png",
            ":addedBy"=>$setuser,
            ":imageLocation"=>$fileDirections
        );
        $query = "INSERT INTO images (imageName,userID,imageAddr) VALUES(:imagename,:addedBy,:imageLocation)";
        $uploadImage = queryPDO($data,$query);
        if($uploadImage){
            
            unlink("../temp_image/$imageName".".png");

            echo json_encode(array("Status"=>"success","Data"=>$fileDir)); 
            echo json_encode(array("Status"=>"error","Data"=>sfileDir)); 
        }
    }else{
        echo json_encode(array("Status"=>"false","Data"=>$fileDir)); 
?>