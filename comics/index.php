</!DOCTYPE html>
<html>
	<head>
		<title>
			
		</title>
		<link rel="stylesheet" href="../CSS/nav.css">
		<link rel="stylesheet" href="../CSS/main.css">
		<link rel="stylesheet" href="../CSS/mangaReader.css">
	</head>
	<body>
	
	<?php
    	//Nav bar 
    	include '../PHP/nav.php';
  	?>      
  	<center id= "comic_container">
  		<?php
  			include '../PHP/comics_new.php';

  			comic_list();
  		?>
  	</center>

	</body>
</html>