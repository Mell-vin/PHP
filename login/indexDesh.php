<?php
	require_once('includes/login.php');
	include('includes/selectuploads.php');
	
	if(isset($_SESSION['userID']) !=""){

	$LoggedIn = getUserID($_SESSION['userID']);
	//print_r($LoggedIn);
	$user = $LoggedIn[0]['id_user'];
	//echo $user;
		require_once('header-in.php');
		echo '
			<style>
				.cam{
					display:block !important;
				}
				.features button{
					display:inline-block !important;
				}
			</style>
		';
	}else{
		$user="";
		echo '
			<style>
			.features button {
				display:none;
			}
			</style>
		';
		require_once('header.php');
	}
?>
<html>
    <head>
    	<title>Camagru</title>
		<link rel="stylesheet" href="includes/styles/styles.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<style>
			.pagination li {
				display:inline-block;
				padding:10px;
				color:#2f2f2f;
			}
			.pagination li a{
				background:#ccc;
				text-decoration:none;
				color:#000;
				padding:5px 10px;
				border-radius:5px;
			}
			.active a{
				background:#0898d3 !important;
				color:#fff !important;
			}
		</style>
    </head>
    <body>
    	<input type="text" id="userID" hidden>
        <div class="content">
		<?php 

			$pageCount = 5;
			if(isset($_GET['page']) && !empty($_GET['page'])){
				$currentPage = $_GET['page'];
			}else{
				$currentPage = 1;
			}
			$LimitCheck = ($currentPage * $pageCount) - $pageCount;
			$limit = 'LIMIT '.$LimitCheck.', '.$pageCount.'';
			$totalCountPhotos = getImagesCount();
			$lastPage = ceil($totalCountPhotos/$pageCount);
			$firstPage = 1;
			$nextPage = $currentPage + 1;
			$previousPage = $currentPage - 1;
			
			$images = getAllImages($limit);
			// print_r($images);
			// Array ( 
			// 	[0] => Array ( [image_id] => 7 [0] => 7 [imageName] => 20191120111114jpg [1] => 20191120111114jpg [imageAddr] => uploads/20191120111114.jpg [2] => uploads/20191120111114.jpg [timset] => 2019-11-20 21:51:14 [3] => 2019-11-20 21:51:14 [userID] => 1 [4] => 1 [status] => 1 [5] => 1 ) 
			// 	[1] => Array ( [image_id] => 4 [0] => 4 [imageName] => 20191117031109jpg [1] => 20191117031109jpg [imageAddr] => uploads/20191117031109.jpg [2] => uploads/20191117031109.jpg [timset] => 2019-11-17 13:10:09 [3] => 2019-11-17 13:10:09 [userID] => 8 [4] => 8 [status] => 1 [5] => 1 ) 
			// 	[2] => Array ( [image_id] => 1 [0] => 1 [imageName] => 20191105091132jpg [1] => 20191105091132jpg [imageAddr] => uploads/20191105091132.jpg [2] => uploads/20191105091132.jpg [timset] => 2019-11-05 16:10:32 [3] => 2019-11-05 16:10:32 [userID] => 1 [4] => 1 [status] => 1 [5] => 1 ) )
			if(sizeof($images)<= 0){
				echo "<center><p>No images uploaded yet!</p></center>";
			}
			else{
			foreach($images as $image){
				$username = getUserName($image["userID"]);
				echo '	<div class="content-body">
						<div class="content-set">
							<div class="ProfilePost">
								<span>
								<div class="ImgThumb">
							<div class="image-view">
								<img src="'.$image["imageAddr"].'" width="900px">
								<input type="text" id="ImageID" value="'.$image["image_id"].'" hidden>
							</div>
							<div class="features">
							<p><span class="likes"><span id="Likescount_'.$image["image_id"].'">'.CountImageLikes($image["image_id"]).'</span> Likes</span> | <span><span id="countComment">'.CountComments($image["image_id"]).'</span> Comments</span><br>
								<button id="likeImage_'.$image["image_id"].'" onclick="setLike('.$user.','.$image["image_id"].')" style="text-decoration:none">Like </button> <button>|</button> <button onclick="openfield(\'commet_'.$image["image_id"].'\')"  style="text-decoration:none"> Comment</button><br>
							</p>
							</div>
							<p class="lastComments">';
								$omm = getComment(3,$image["image_id"]);
								if(sizeof($omm) > 0){
									foreach($omm as $indexart){
										echo "<span>".$indexart['comment_Msg']."</span><br><br>";
									}
								}else{
								
								}
							echo '
							</p>
							<div class="context" id="commet_'.$image["image_id"].'">
								 <input type="text" class="formBtn" name="comment" id="commentMessage" placeholder="Comment here"><button class="sendbtn" onclick="SendComment(\'commentMessage\','.$username[0]['id_user'].','.$image["image_id"].','.$image["userID"].')">Send</button>
							</div>
						</div></div>
						<br>';
						
				};
		echo '<center><nav aria-label="Page navigation">
		<ul class="pagination">';
		if($currentPage != $firstPage) { 
		echo '<li class="page-item">
		<a class="page-link active" href="?page='.$firstPage.'" tabindex="-1" aria-label="Previous">
		<span aria-hidden="true">First</span>
		</a>
		</li>';
		}
		if($currentPage >= 2) { 
			echo '<li class="page-item"><a class="page-link" href="?page='.$previousPage.'">'.$previousPage.'</a></li>';
		}
		echo '<li class="page-item active"><a class="page-link" href="?page='.$currentPage.'">'.$currentPage.'</a></li>';
		if($currentPage != $lastPage) { 
			echo '<li class="page-item"><a class="page-link" href="?page='.$nextPage.'">'.$nextPage.'</a></li>
			<li class="page-item">
			<a class="page-link" href="?page='.$lastPage.'" aria-label="Next">
		<span aria-hidden="true">Last</span>
		</a>
		</li>';
		}
		echo '</ul>
		</nav></center>';


	}
		   require_once('footer.php');?>
	<div class="cam">
     <a href="capture-image.php">
     	<div class="camera">
	    	<img src="images/Camera.png">
	    </div>
	</a>
	</div>
    </body> 
</html>