<?php

	/*

	This php script very simply fills the drop down with all the options in the selected directory.

	Basically what the php script does is, for each file in the directory (The variable, $filename is blank, just acts as a sort of container to be filled with the actual file names) then it prints the inputted html with the filename that the php script filled into the container variable.

	basename($filename) acts as a way to strip any prefix or extra data from the $filename's. */	

   function comics_dropdown(){ 

   		foreach(glob($_SERVER['DOCUMENT_ROOT'] . '/landing/comics/*' , GLOB_ONLYDIR) as $filename){

  		$filename = basename($filename);

    	echo "<option value='" . 'https://' . $_SERVER['SERVER_NAME'] . '/comics/' . $filename . "'>".$filename."</option> \n";

    	}

	}

    //Dropdown function for different volumes
	function vol_dropdown(){

		$chapter = basename(dirname(__FILE__));

		$chapterTrim = rtrim(__DIR__, $chapter);

		$webAddress = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

		$chapterAddress = substr($webAddress, 0, -23);

		foreach(glob( $chapterTrim . '/*') as $filename){

    		$filename = basename($filename);

        	echo "<option value='" . $chapterAddress . $filename . "'>".$filename. "</option> \n";

        }

    }

    function comic_list() {

			//This glob gets all the subdirectories in the directory
			foreach(glob($_SERVER['DOCUMENT_ROOT'] . '/landing/comics/*' , GLOB_ONLYDIR) as $filename){

    		//strips prefix from the original $filename variable, which was only a temporary container
    		$filename = basename($filename);

    		//replaces any use of underscores with spaces, this allows for a more neatly organised echo
    		$comic = preg_replace("(_)", " ", $filename);

    		//This makes the beginning of every word uppercase, this allows for a neat list
    		$upperCase = ucwords($comic);

    		echo "<div class= 'manga_listing'>" . "<a href='" . 'https://www.erebus.systems/landing/comics/' . $filename . "/'>" . "<img src='../sources/images/temp.png' >". "<br>" . $upperCase . "</a>"  . "</div>";

    	}

    }


?>
