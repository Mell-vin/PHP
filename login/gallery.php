<?php
    session_start();
    $pages = "";//get_all_pages();
?>
<!DOCTYPE html>
<HTML>
    <header>
        <link rel="stylesheet" href="styles/styela.css">
        <meta charset="utf-8">
        <title>Camagru: Gallery</title>
    </header>
    <?php if (isset($_SESSION['id'])) { ?>
        You are logged in as: <?php print_r(htmlspecialchars($_SESSION['id']))?>
    <body style="background-color: grey;">
        <?php include 'frag/header.php';?>
        <div class="main">
            <img class="small" src="img/gun.png"></img>
            <input id="cadre.png" type="radio" name="img" value="./img/cadre.png" onclick="onCheckBoxChecked(this)">
            <img class="small" src="img/cig.png"></img>
            <input id="cigarette.png" type="radio" name="img" value="./img/cig.png" onclick="onCheckBoxChecked(this)">
            <img class="small" src="img/hat.png"></img>
            <input id="hat.png" type="radio" name="png" value="./img/hat.png" onclick="onCheckBoxChecked(this)">
        </div>
        <video width="100%" autoplay="true" id="webcam"></video>
        <div id="camera-not-available">CAMERA NOT AVAILABLE</div>
          <img id="hat" style="display:none;" src="img/hat.png"></img>
          <img id="cigarette" style="display:none;" src="img/cigarette.png"></img>
          <img id="gun" style="display:none;" src="img/cadre.png"></img>
    		  <div class="capture" id="pickImage">
            <img class="camera" src="img/camera.png"></img>
          </div>
          <canvas id="canvas" style="display:none;" width="640" height="480"></canvas>
          <div class="captureFile" id="pickFile">
            <img class="camera" src="img/camera.png"></img>
          </div>
          <input type="file" id="take-picture" style="display:none;" accept="image/*">
        </div>
        <div class="side">
			<div class="title">Montages</div>
      <div id="miniatures">
        <?php
          $gallery = "";
          if ($pages != null) {
            for ($i = 0; $pages[$i] ; $i++) {
              $class = "icon";
              if ($pages[$i]['userid'] === $_SESSION['id']) {
                $class .= " removable";
              }
              $gallery .= "<img class=\"" . $class . "\" src=\"./montage/" . $pages[$i]['img'] . "\" data-userid=\"" . $pages[$i]['userid'] . "\"></img>";
            }
            echo $gallery;
          }
        ?>
      </div>
		</div>
        <?php } else { ?>
          You need to connect to use the gallery
        <?php } ?>
      </div>
    </body>
    <?php if(isset($_SESSION['id'])) { ?>
      <script type="text/javascript" src="java/cam.js"></script>
      <script type="text/javascript" src="java/drop.js"></script>
      <script type="text/javascript" src="java/import.js"></script>
      <?php } ?>
      <?php include 'frag/footer.php'; ?>
</HTML>