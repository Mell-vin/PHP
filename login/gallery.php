<?php
    session_start();
    include 'functions/recent.inc.php';
    include 'frag/header.php';

    $uploads = get_all();
?>
<!DOCTYPE HTML>
<html>
    <header>
        <link rel="stylesheet" href="styles/styela.css">
        <meta charset="utf-8">
        <title> -->Gallery<-- </title>
        <h1 style="color: purple">Your Gallery</h1>
        
    </header>
    <body style="background-color: grey">
        <div id="miniPic">
        <?php
            $gallery = "";
            if ($uploads != null) {
                for ($i = 0; $montages[$i] ; $i++) {
                    $class = "icon";
                    if ($uploads[$i]['userid'] === $_SESSION['id']) {
                        $class .= " removable";
                    }
                    $gallery .= "<img class=\"" . $class . "\" src=\"./montage/" . $uploads[$i]['img'] . "\" data-userid=\"" . $uploads[$i]['userid'] . "\"></img>";
                }
                echo $gallery;
            }
        ?>
        </div>
        <?php
            include 'frag/footer.php';
        ?>
    </body>
</html>