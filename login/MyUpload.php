<?php
    session_start();
    include 'includes/setupFunc.php';
    $UserId = get_UserID($_SESSION['id']);
    $pictures = get_user_Pictures($UserId);
?>
<!DOCTYPE HTML>
<html>
<header>
    <link rel="stylesheet" href="styles/styela.css">
</header>
    <body style="background-color: grey;">
        <?php include 'frag/header.php';?>
        <form action="includes/LocalUpload.inc.php" method="post" enctype="multipart/form-data">
            <input id ="browse" name ="file" type="file" accept="image/*">
            <button id="browse2" type="submit" name="submit">UPLOAD</button>
        </form>
        <br><br>
        <div id="canvas">
              <video id="video">Video unavailable..</video>
              <button id="shoot">Capture</button>
        </div>
        <canvas id="upload"></canvas>
        <canvas id="stickers"></canvas>
        <div class="output">
            <img id="photo" alt="image should appear here" name="picture">
        </div>
        <div class="select">
      			<img class="thumbnail" src="img/gun.png">
      			<input id="cadre.png" type="radio" name="img1" value="1" onclick="DrawCadre()">
      			<img class="thumbnail" src="img/cig.png">
      			<input id="cigarette.png" type="radio" name="img2" value="2" onclick="DrawCig()">
      			<img class="thumbnail" src="img/hat.png">
                <input id="hat.png" type="radio" name="img3" value="3" onclick="DrawHat()">
        </div>
            <button id="upload1">Uploadbutton</button>
        <script>
              document.getElementById('browse').onchange = function(e) {
              var img = new Image();
              img.onload = draw;
              img.onerror = failed;
              img.src = URL.createObjectURL(this.files[0]);
              };
              function draw() {
              var canvas = document.getElementById('upload');
              canvas.width = this.width;
              canvas.height = this.height;
              var ctx = canvas.getContext('2d');
              ctx.drawImage(this, 0,0);
              }
              function failed() {
              console.error("The provided file couldn't be loaded as an Image media");
              }
              var stickerCanvas = document.getElementById("stickers");
              var ctx = stickerCanvas.getContext("2d");
              function DrawCadre() {
                  var sticker = document.getElementsByTagName("img");
                  var cadre = sticker[1];
                  ctx.drawImage(cadre, 5, 5, 40, 40);
              }
              function DrawCig() {
                  var sticker = document.getElementsByTagName("img");
                  var Cig = sticker[2];
                  ctx.drawImage(Cig, 100, 90, 40, 40);
              }
              function DrawHat() {
                  var sticker = document.getElementsByTagName("img");
                  var Hat = sticker[3];
                  ctx.drawImage(Hat, 100, 0, 40, 40);
              }
        </script>
        <div class="side">

<div class="title">Pictures</div>

<div id="miniatures">
    <?php
        $gallery = "";
        if ($pictures != null) {
            for ($i = sizeof($pictures) - 1; $i >= 0; $i--) {
                $class = "icon";
                if ($pictures[$i]['galid'] === $UserId) {
                    $class .= " removable";
                }
                $gallery .= "<img class=\"" . $class . "\" src=\"./montage/" . $pictures[$i]['imgLoc'] . "\" data-userid=\"" . $pictures[$i]['galid'] . "\"></img>";
            }
            echo $gallery;
        }
    ?>
</div>
</div>
        <script type="text/javascript" src="java/cam2.js"></script>


        <!-- <script type="text/javascript" src="java/import.js"></script> -->
        
    </body>
</html>