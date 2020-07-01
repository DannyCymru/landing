<?php

	/*

	basename($filename) acts as a way to strip any prefix or extra data from the $filename's. 	

   function comics_dropdown(){ 

   		foreach(glob($_SERVER['DOCUMENT_ROOT'] . '/comics/*' , GLOB_ONLYDIR) as $filename){

  		$filename = basename($filename);

    	echo "<option value=' https://" . $_SERVER['SERVER_NAME'] . '/comics/' . $filename . "'>".$filename."</option> \n";

    	}

	}

    //Dropdown function for different volumes
	function vol_dropdown(){
            
            //Grabs the current directory where the php function was called from
            $cwd = getcwd();
            
            //Gets the current volume directory
            $this_dir = basename($cwd);

            //Removes the current volume from the CWD string so that we can get list all volumes of this series
            $rm_cv = str_replace($this_dir, "", $cwd);            

            foreach (glob($rm_cv . "*", GLOB_ONLYDIR) as $filename) {
                //Removes the unix path variables
                $sans_prefix = substr($filename, 9);

                echo "<option value= https://www." . $sans_prefix . ">" . "</option> \n";
            }
    }

    function page_dropdown() {

        //Grabs the current directory where the php function was called from
        $cwd = getcwd();

        //For loop to go through every found file at the current working directory. 
        foreach (glob($cwd . "/*{.webp, jpg, png}", GLOB_BRACE) as $filename) {
            //Removes the unix path variables
            $sans_prefix = substr($filename, 9);

            echo "<option value= https://www." . $sans_prefix . ">" . "</option> \n";
        }

    }

   
*/
  class Comics {



  	function __construct() {

  	}

    function comic_list(){
        //This glob gets all the subdirectories in the directory
        foreach(glob($_SERVER['DOCUMENT_ROOT'] . '/comics/*' , GLOB_ONLYDIR) as $filename){

            //strips prefix from the original $filename variable
            $filename = basename($filename);

            //replaces any use of underscores with spaces
            $comic = preg_replace("(_)", " ", $filename);

            $upperCase = ucwords($comic);

            echo "<div class='comic'>" . "<a href='" . '/comics/' . $filename . "/'>";
            echo Comics::iC();
            echo "<br>" . $upperCase . "</a>"  . "</div>\r\n";
        }
    }

    function first_image(){

    }

    //Basic image creation function with GD
    function iC(){

    	ob_start();

        //Loads WebP image from directory
        $dir_im = imagecreatefromwebp("All_Rounder_Meguru/All-RounderMeguruv01/All-Rounder_Meguru_V01_000a.webp");

        //Gets the size of the image
        $image_size = getimagesize("All_Rounder_Meguru/All-RounderMeguruv01/All-Rounder_Meguru_V01_000a.webp");

        //Crops the image
        $cropped = imagecrop($dir_im, ['x' => 1000,
                                      'y' =>0, 
                                      'width' => (536*3), 
                                      'height' => (829*2)]);
        
        //Scales the imgage to an appropriate size to use as a thumbnail
        $scaled = imagescale($cropped, 250);
        
        //Creates a jpeg image from provided resource
        imagejpeg($scaled);

        //Gets the raw code for the image, cleans it for viewing
        $raw_image = ob_get_clean();

        //Echo's the image file using base64 encoding of the raw image data
        echo "<img src='data:image/jpeg;base64," . base64_encode($raw_image) . "'/>";
      }
}

?>
