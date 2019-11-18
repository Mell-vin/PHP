<div id="header">
  <?php if(isset($_SESSION['id'])) { ?>
      <div class="button" onclick="location.href='includes/logout.php'">
        <span>
          Logout
        </snap>
      </div>
  <?php } else { ?>
    <div class="button" onclick="location.href='index.php'">
      <span>
        Login
      </snap>
    </div>
  <?php } ?>
  <?php if(isset($_SESSION['id'])) { ?>
  <div class="button" onclick="location.href='MyUpload.php'">
    <span>
      My Upload
    </snap>
  </div>
  <div class="button" onclick="location.href='gallery.php'">
    <span>
      Gallery
    </snap>
  </div>
  <div class="button" onclick="location.href='profile.php'">
    <span>
      Update
    </snap>
  </div>
  <?php } ?>
</div>