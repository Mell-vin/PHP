<?php
session_start();
?>
<!DOCTYPE HTML>
<html>
<header>
    <link rel="stylesheet" href="styles/styela.css">
</header>
<?php if (isset($_SESSION['id'])) { ?>
        You are logged in as: <?php print_r(htmlspecialchars($_SESSION['id']))?>
    <body style="background-color: grey;">
        <?php include 'frag/header.php';?>
        <input id ="browse" onclick="swap()" type="file">
        <br><br>
        <div id="canvas">
              <video id="video">Video unavailable..</video>
              <button id="shoot">Capture</button>
        </div>
        <canvas id="cam"></canvas>
        <canvas id="upload"></canvas>
        <canvas id="stickers"></canvas>
        <canvas id="canvass" style="display:none;" width="800" height="600"></canvas>
        <canvas id="stickers"></canvas>
        <div class="output">
            <img id="photo" alt="Waiting for picture... "> 
        </div>
        <div class="select">
      			<img class="thumbnail" src="img/gun.png"></img>
      			<input id="cadre.png" type="radio" name="img" value="./img/cadre.png" onclick="onCheckBoxChecked(this)">
      			<img class="thumbnail" src="img/cig.png"></img>
      			<input id="cigarette.png" type="radio" name="img" value="./img/cigarette.png" onclick="onCheckBoxChecked(this)">
      			<img class="thumbnail" src="img/hat.png"></img>
      			<input id="hat.png" type="radio" name="img" value="./img/hat.png" onclick="onCheckBoxChecked(this)">
        </div>
            <img id="hat" style="display:none;" src="img/hat.png"></img>
            <img id="cigarette" style="display:none;" src="img/cig.png"></img>
            <img id="gun" style="display:none;" src="img/gun.png"></img>
        <button id="web" onclick="swap2()">webcam</button>
        <button id="saveFunc" onclick="includes/upload.inc.php">upload</button>
        <script>
              function swap() {
                document.getElementById("cam").style.zIndex = "1";
                document.getElementById("photo").style.zIndex = "0";
                var c = document.getElementById("cam");
                var ctx = c.getContext("2d");
                ctx.clearRect(0, 0, 800, 800);
              }

              function swap2() {
                document.getElementById("photo").style.zIndex = "1";
                document.getElementById("cam").style.zIndex = "0";
              }
              document.getElementById('browse').onchange = function(e) {
              var img = new Image();
              img.onload = draw;
              img.onerror = failed;
              img.src = URL.createObjectURL(this.files[0]);
              };
              function draw() {
              var canvas = document.getElementById('cam');
              var photo = document.getElementById('photo');
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
        <script type="text/javascript" src="java/import.js"></script>
        <?php } else { ?>
          <strong>You need to connect to use the gallery</strong>
          <h1>Gallery</h1><a href="index.php">Home</a>
        <?php } ?>
    </body>
</html>