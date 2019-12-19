<?php
session_start();
//include 'includes/recent.inc.php';
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
        <div class="output">
            <img id="photo" alt="image should appear here" name="picture">
        </div>
        <div class="select">
      			<img class="thumbnail" src="img/gun.png">
      			<input id="cadre.png" type="radio" name="img1" value="1" onclick="onCheckBoxChecked(this)">
      			<img class="thumbnail" src="img/cig.png">
      			<input id="cigarette.png" type="radio" name="img2" value="2" onclick="onCheckBoxChecked(this)">
      			<img class="thumbnail" src="img/hat.png">
                <input id="hat.png" type="radio" name="img3" value="3" onclick="onCheckBoxChecked(this)">
                
                <img id="test" class="thumbnail" src="img/hat.png">
        </div>
            <img id="hat" style="display:none;" src="img/hat.png">
            <img id="cigarette" style="display:none;" src="img/cig.png">
            <img id="gun" style="display:none;" src="img/gun.png">

        
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
        </script>
        <script type="text/javascript" src="java/cam2.js"></script>


        <!-- <script type="text/javascript" src="java/import.js"></script> -->
        
    </body>
</html>