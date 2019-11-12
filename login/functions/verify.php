<?php
    function verifyFunc($token){

            try{
                $conn = new PDO("mysql:host=localhost;dbname=lwazCamagru","root","000000");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = $conn->prepare("SELECT id FROM CamUsers WHERE token=:token");
                
                $sql->bindParam(":token", $token);
                $sql->execute();
    
                $ret = $sql->fetch();
    
                if($ret == 0)
                {
                    $sql->closeCursor();
                    return (-1);
                }

                $sql= $conn->prepare("UPDATE CamUsers SET verified='Y' WHERE id=:id");
                $sql->execute(array('id' => $ret['id']));
                $sql->closeCursor();
                return (0);
                }catch (PDOException $e){
                    echo $e->getMessage();
                    return (-2);
                }
    }
?>