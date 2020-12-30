<!DOCTYPE html>

<html>

	<head>

		<title>

			<?php 

				include '../PHP/comics.php';

			?>

		</title>

		<link rel="stylesheet" type="text/css" href="../../../CSS/main.css">
		<link rel="stylesheet" type="text/css" href="../../../CSS/mangaReader.css">
		<link rel="stylesheet" type="text/css" href="../../../CSS/nav.css">

		<script type="text/javascript">
			/*
			javascript function to change the image of the comic through the drop down options
			Basically the image change is based off the element value of the select option that,
			is generated for every page in the chapters directory.
			*/

			function displayImage(elem) {

				var image = document.getElementById("cPage");
				image.src = elem.value;
			}

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

		<select id = "volumeOption" onchange= "location = this.options[this.selectedIndex].value;">

			<option value = "" selected="">Volume/Chapter</option>

			<?php Comics::vol_dropdown(); ?>	

		</select>



		<select id= "pageOption" onchange="displayImage(this);" >

			<option value="" selected="">Pages</option>

			<?php Comics::page_dropdown(); ?>

		</select>



		</center>



		</div>



		<div id="mWrapper">

			<center>

				<img id= "cPage" src='https://www.erebus.cymru/comics/All_Rounder_Meguru/All-RounderMeguruv01/All-Rounder_Meguru_V01_000a.webp' onclick="magnify()" >

				<p>You can also use the left and right arrow keys to go back and forth between pages</p>

			</center>

			<div id="iModal">
				<div id="close">&times;</div>

				

				<img id="modalContent">

			</div>
	 	</div>

	 </div>
	
	</body>

</html>
