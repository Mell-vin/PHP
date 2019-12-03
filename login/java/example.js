var smiley = document.getElementById("smiley");
var sad = document.getElementById("sad");
var cry = document.getElementById("cry");
var laugh = document.getElementById("laugh");
var heart = document.getElementById("heart");
var shocked = document.getElementById("shocked");
var cool = document.getElementById("cool");
var savebutton = document.querySelector("#uploadImage");
var imageUpload = document.querySelector("#FileImage");
(function(){
	var video = document.getElementById('video_cap'),
		canvas = document.getElementById('canvas'),
		canvas2 = document.getElementById('canvas2'),
		photo = document.getElementById('image'),
		photo2 = document.getElementById('image2'),
		vendorUrl = window.URL || window.webkitURL;
		context = canvas.getContext('2d'),
		navigator.getMedia = navigator.getUserMedia || 
							 navigator.webkitgetUserMedia || 
							 navigator.mozGetUserMedia ||
							 navigator.msGetUserMedia;
		navigator.getMedia({
			video: true,
			audio: false
		},function(stream){
			
			video.srcObject=stream;
			video.play();
		},function(error){
		});
		
		document.getElementById('captureImg').addEventListener("click", function(){
			context.drawImage(video,0,0, 900,600);
			photo.setAttribute('src',canvas.toDataURL('image/jpg'));
			
		});
		var Effect = "";
		document.getElementById('captureImg').addEventListener("click", function(){
			context.drawImage(video,0,0, 900,600);
			
			photo.setAttribute('src',canvas.toDataURL('image/jpg'));
		});
		
		
		document.getElementById('drawSmiley').addEventListener("click", function(){
			context.drawImage(smiley, 10, 10, 110, 110);
			Effect ="Smiley";
			photo.setAttribute('src',canvas.toDataURL('image/jpg'));
		});
		
		document.getElementById('drawSad').addEventListener("click", function(){
			context.drawImage(sad, 200, 10, 110, 110);
			Effect ="Sad";
			photo.setAttribute('src',canvas.toDataURL('image/jpg'));
		}); 
		document.getElementById('drawCry').addEventListener("click", function(){
			context.drawImage(cry, 0, 350, 110, 110);
			Effect ="Cry";
			photo.setAttribute('src',canvas.toDataURL('image/jpg'));
		});
		
		document.getElementById('drawLaugh').addEventListener("click", function(){
			context.drawImage(laugh, 200, 350, 110, 110);
			Effect ="Laugh";
			photo.setAttribute('src',canvas.toDataURL('image/jpg'));
		});
		
		document.getElementById('drawHeart').addEventListener("click", function(){
			context.drawImage(heart, 600,10, 110, 110);
			Effect ="Heart";
			photo.setAttribute('src',canvas.toDataURL('image/jpg'));
		});
		
		document.getElementById('drawShocked').addEventListener("click", function(){
			context.drawImage(shocked, 750, 350, 110, 110);
			Effect ="Shocked";
			photo.setAttribute('src',canvas.toDataURL('image/jpg'));
		});
		
		document.getElementById('drawCool').addEventListener("click", function(){
			context.drawImage(cool, 750, 10, 110, 110);
			Effect ="Cool";
			photo.setAttribute('src',canvas.toDataURL('image/jpg'));
		});
		
		
		savebutton.addEventListener('click', function(){
			
			data = canvas.toDataURL('image/png');
			if(data != 0)
			uploadImage(data,Effect);
		}, false);

		imageUpload.addEventListener("change",function(version){
			
			if(version.target.files) {
				let image = version.target.files[0];
				var reader  = new FileReader();
				reader.readAsDataURL(image);
				reader.onloadend = function (e) {
					var image = new Image();
					image.src = e.target.result;
					image.onload = function(version) {
							context.drawImage(image, 0, 0, 800, 500);
							
							photo.setAttribute('src',canvas.toDataURL('image/jpg'));
							}
						}
					}
		});
})();

function uploadImage(data,FX) {
	
	let picData = data.replace("data:image/png;base64,", "");
	let xhr = new XMLHttpRequest();
	let Effects = FX;
	
	xhr.open("POST", "includes/imageupload.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send("image="+encodeURIComponent(picData)+"&effect="+Effects);
    xhr.onreadystatechange = function () {
      if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
		var response = JSON.parse(xhr.responseText);
		if(response['Status'] == "success"){
			var r = confirm("Image successfully uploaded");
			if (r == true) {
				window.location.href = "index.php";
			}
			else {
				alert("An error occured, please try again later");
				window.location.href = "index.php";
			}
		};
      }
    }
  }

