</!DOCTYPE html>
<html>
	<head>
		<title>
			
		</title>
		<link rel="stylesheet" href="../CSS/nav.css">
		<link rel="stylesheet" href="../CSS/main.css">
		<link rel="stylesheet" href="../CSS/reader.css">
	</head>
	<body>
	
	<?php
    	//Nav bar 
    	include '../PHP/nav.php';
  	?>      
  	<center id= "comic_container">
  		<?php
  			include '../PHP/comics.php';

  			Comics::comic_list();
  		?>
  	</center>

	</body>
</html>