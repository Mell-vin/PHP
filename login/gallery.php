<?php
    session_start();
    include 'functions/recent.inc.php';
    include 'frag/header.php';
    include 'includes/setupFunc.php';

    $pictures = get_all_Pictures();
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
    <div class="sideGallery">

<div class="title">Pictures</div>

<div id="miniatures">
    <?php
        $gallery = "";
        $comment = "";
        if ($pictures != null) {
            for ($i = sizeof($pictures) - 1; $i >= 0; $i--) {
                $class = "icon";
                if ($pictures[$i]['galid']) {
                    $class .= " removableG";
                }
                $gallery .= "<img class=\"" . $class . "\" src=\"./montage/" . $pictures[$i]['imgLoc'] . "\" data-userid=\"" . $pictures[$i]['galid'] . "\"></img>";
            }
            echo $gallery;
            echo "<br><br>";
        }
    ?>
</div>
</div>
        <?php
            include 'frag/footer.php';
        ?>
    </body>
</html>