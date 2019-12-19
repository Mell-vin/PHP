document.getElementById("saveFunc").addEventListener("click", function() {
    var img = document.getElementsByTagName("img");
    var imgSrc = img[0].src;
    imgSrc = imgSrc.replace("data:image/png;base64,", "");


    $.ajax({
        url:"../includes.imageUpload.inc.php",
        // send the base64 post parameter
        data:{
          base64: imgSrc
        },
        // important POST method !
        type:"post",
        complete:function(){
          console.log("Ready");
        }
    });
});