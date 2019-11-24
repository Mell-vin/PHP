<?php
    session_start();
    
    function get_all() {
        try {
            $conn = new PDO ("mysql:host=localhost;dbname=lwazCamagru", "root", "000000");
            $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = $conn->prepare("SELECT galid, img FROM gallery");
            $sql->execute();

            $i = 0;
            $tabs = null;
            while ($val = $sql->fetch()) {
                $tabs[$i] = $val;
                $i++;
            }
            $sql->closeCursor();
            return ($tabs);
        } catch (PDOException $e) {
            return ($e->getMessage());
        }
    } //the js for the mini montag shit. incase your browser closes
?> 