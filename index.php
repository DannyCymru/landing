<!doctype html>

<head>
  <title>Landed!</title>

  <link rel="stylesheet" href="CSS/main.css">
  <link rel="stylesheet" href="CSS/search.css">

  <!-- Inline CSS to simply incorporate PHP to change the background image-->
  <style type="text/css">
  	html {height:100%;background-image: url(<?php include 'PHP/rando_image.php';?>); background-position: center; background-size: 100% 100%;background-repeat: no-repeat;}
  </style>

</head>

<body>
	<p> This is the beginning </p>

	<div id=search_container>
		<div id=search_form>
			<form id="google_search" action="https://google.com/search" method="get">
				<input id="search_bar" type="text" name="q" placeholder="Search Box">
				<input id="enter_button" type="submit" value="Enter">
			</form>	
		</div>

		<div id = trans_box> </div>
	</div>

</body>
</html>
