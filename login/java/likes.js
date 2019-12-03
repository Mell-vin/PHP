
var ImageLike = document.querySelector("#likeImage");
var User = document.querySelector("#userID");
var imageID = document.querySelector("#ImageID");

(function(){

function setLike(user,imageID){
			alert("Liked");
			var xhttp = new XMLHttpRequest();
			xhttp.open("GET", "setLike.php?likeId=" + userID, true);
			xhttp.send();		
		}
})();
