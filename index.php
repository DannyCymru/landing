<!doctype html st>

<head>
  <title>Landed!</title>

  <link rel="stylesheet" href="CSS/home.css">
  <link rel="stylesheet" href="CSS/nav.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Inline CSS to simply incorporate PHP to change the background image-->
  <style type="text/css">
  	html {height:100%;background-image: url(<?php include 'PHP/wallpaper.php'; rando_image();?>); background-position: center; background-size: 100% 100%;background-repeat: no-repeat;}
  	nav {background-color:unset;}
  </style>
  <script type="text/javascript">
    function brgr(){
    	var x = document.getElementById("brgr_links");
    	if (x.style.display === "block"){
    		x.style.display = "none";
    	} else {
    		x.style.display = "block";
    	}
    }

    function rm_paper(){
      var wallpaper = $("html").css("background-image");
      $.ajax({ url: 'PHP/wallpaper.php',
               type: 'POST',
               data: {"id": 'rm', "paper": wallpaper},
               success: function(data){  
                  console.log(data);
               }
      })
    }

  </script>

</head>

<body>
	<?php
    //Nav bar 
    include 'PHP/nav.php';
  ?>      

  <!--Burger menu links -->
  <div id="brgr_container">
    <a href="javascript:void(0);" class="icon" onclick="brgr()">
        <i class="fa fa-bars"></i>
    </a>

    <div id = "brgr_links">
	   	<a href="#">Next image</a>
      <br>
		  <a href="#" onclick="rm_paper()">Remove image</a>
    </div>
  </div>


	<div id=search_container>
		<div id=search_form>
			<form id="google_search" action="https://google.com/search" method="get">
				<input id="search_bar" type="text" name="q" placeholder="www.reddit.com">
				<input id="enter_button" type="submit" value="SEARCH">
			</form>	
		</div>

		<!--Transparent box I created for a search bar. Commenting it out till I am sure I don't want to use it in
		some way 
			<div id = trans_box> </div> -->
	</div>
</body>
</html>
