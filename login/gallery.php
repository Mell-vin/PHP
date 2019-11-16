<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="styles/styela.css">
</head>
    <body style="background-color: grey;">
        <?php include 'frag/header.php';?>
        <input id ="browse" onclick="swap2()" type="file">
        <br><br>
        <div id="canvas">
              <video id="video">Video unavailable..</video>
              <button id="shoot">Capture</button>
        </div>
        <canvas id="cam"></canvas>
        <div class="output">
            <img id="photo" alt="Waiting for picture... "> 
        </div>
        <button id="web" onclick="swap()">webcam</button>
        <button id="saveFunc" onclick="saveFunc()">upload</button>
        <script>
              function swap() {
                document.getElementById("canvas").style.zIndex = "-1";
                document.getElementById("cam").style.zIndex = "0";
              }

              function swap2() {
                document.getElementById("canvas").style.zIndex = "0";
                document.getElementById("cam").style.zIndex = "-1";
              }

              document.getElementById('browse').onchange = function(e) {
  var img = new Image();
  img.onload = draw;
  img.onerror = failed;
  img.src = URL.createObjectURL(this.files[0]);
};
function draw() {
  var canvas = document.getElementById('canvas');
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
    </body>
</html>