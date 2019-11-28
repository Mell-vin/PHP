var upload = document.getElementById("saveFunc");
var img = document.getElementById("photo");
var canvas = document.getElementById("upload");
//var cadre = document.getElementsById("cadre.png").checked;
//var cig = document.getElementsById("cigarette.png").checked;
//var hat = document.getElementsById("hat.png").checked;


upload.addEventListener("click", function () {
    const dataURI = canvas.toDataURL();
    var xhttp = XMLhttpRequest();
    xhttp.onreadystatechange = fuction () {
        if (this.readystate == 4 && this.status == 200) 
        {
            let url = new URL('http://localhost//camagru/login/includes/recent.inc.php');
            searchParams.set('image', dataURI);
            xhttp.open('POST', url);
        }
    }
});