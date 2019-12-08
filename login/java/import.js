document.getElementById("saveFunc").addEventListener("click", function() {
    var img = document.getElementsByTagName("img");
    var imgSrc = img[0].src;
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "includes/imageUpload.inc.php", true);
    xhr.responseType = 'json';
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("image=" +encodeURIComponent(imgSrc));
    xhr.onreadystatechange = function () {
        if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if(response['Status'] == "success"){
              var r = confirm("Image successfully uploaded");
              if (r == true) {
                  window.location.href = "index.php";
              }
              else {
                  alert("An error occured, please try again...");
                  window.location.href = "index.php";
              }
          };
        }
      }
});