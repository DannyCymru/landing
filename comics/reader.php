<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php 
				include '../PHP/comics.php';
				session_start();

				$comic_name = Comics::validate_comic($_GET['comic']);

				print_r($comic_name);
			?>
		</title>

		<link rel="stylesheet" type="text/css" href="../../CSS/main.css">
		<link rel="stylesheet" type="text/css" href="../../CSS/reader.css">
		<link rel="stylesheet" type="text/css" href="../../CSS/nav.css">

		<script type="text/javascript">

			//Function that changes the image based on the element of the dropdown options 
			function displayImage(elem) {
				var image = document.getElementById("cPage");
				image.src = elem.value;
			}

			//Creates a modal of the image to allow a magnified view of the comic
			function magnify() {
				var modal = document.getElementById("iModal");
				var img = document.getElementById("cPage");
				var modalImg = document.getElementById("modalContent");

				img.onclick =function(){

					modal.style.display = "block";
					modalImg.src = this.src;
				}

				var close = document.getElementById("close");

				close.onclick = function() {
					modal.style.display = "none";
				}
			}

			//Allows for an arrow click to change the comic page
			window.addEventListener("keydown", function e (event) {
				switch (event.key) {

					//Right Arrow					
					case "ArrowRight":

					//changes the drop down boxes index by +1
						document.getElementById("pageOption").selectedIndex +=1;
						var image = document.getElementById("cPage");
						image.src = pageOption.value;

					break;

					//Left Arrow
					case "ArrowLeft":

					//Changes the drop down boxes index by -1
					document.getElementById("pageOption").selectedIndex -=1;

					//multiple declarations of var image was neccessary as it stores the current image only, otherwise the browser console would come back with the error "image is null".
					var image = document.getElementById("cPage");
					image.src= pageOption.value;
					break;
				}
			}

			,true)

		</script>

	</head>
	
	<body>

		<?php include '../PHP/nav.php'; ?>

		<div class="content_container">
			
			<div id="comicDropdown"> 
				<center>
					<select id = "volumeOption" onchange = "location = this.options[this.selectedIndex].value;">

						<option value = "">Volume/Chapter</option>

						<?php Comics::vol_dropdown(); ?>	

					</select>

					<select id= "pageOption" onchange="displayImage(this);" >

						<option value="">Page</option>

						<?php Comics::page_dropdown(); ?>

					</select>
				</center>
			</div>

		<div id="mWrapper" onclick="magnify()">
			<center>

				<?php
					if (isset($_GET['vol']) && !empty($_GET['vol'])) {
						echo "<img src='". $_SESSION['page'] . "' id='cPage'>";
					}
				?>
				<p>You can also use the left and right arrow keys to go back and forth between pages</p>


			<div id="iModal">
				<div id="close">
					&times;
				</div>
				
				<img id="modalContent">
			</div>

			</center>

	 	</div>
	 </div>
	</body>
</html>
