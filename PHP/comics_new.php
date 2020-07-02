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

    	$cwd = getcwd();

        //This glob gets all the subdirectories in the directory
        foreach(glob($cwd . '/*' , GLOB_ONLYDIR) as $filename){

            //strips prefix from the original $filename variable
            $filename = basename($filename);

            //replaces any use of underscores with spaces
            $comic = preg_replace("(_)", " ", $filename);

            $upperCase = ucwords($comic);

            echo "<div class='comic'>" . "<a href='" . '/comics/' . $filename . "/'>";
            echo Comics::iC( Comics::first_image($filename));
            echo "<br>" . $upperCase . "</a>"  . "</div>\r\n";
        }
    }

    function first_image($filename){

    	$filename=array("$filename");
    	$cwd = getcwd();

    	//For every filename in the array
    	for ($i=0; $i < sizeOf($filename); $i++) {
    	    
    	    $dir = $cwd . '/' . $filename[$i] . "/";
 			
 			$all_dirs = glob($dir . '*');
 			
 			//Foreach function to fill the array with all directories for the comic
 			//This is so we can grab only the very first volume for each comic
 			foreach ($all_dirs as $file) {
 				$first_dir[] = $file;
 			}

 			//Recursively scans the very first volume for each comic
 			$scanned_dir = array_diff(scandir($first_dir[0]), array('..', '.', 'index.php'));

 			//Returns the full path to the first image found (array elements 0 and 1 of scanned_dir are the '..' files)
 			$full_path = $all_dirs[0] . '/' . $scanned_dir[2];
 			return $full_path;
    	}


    }

    //Basic image creation function with GD
    function iC($image){
    	$file_info = pathinfo($image);
    	$dir_im;
    	ob_start();


    	switch ($file_info['extension']) {
    		case 'webp':
    			$dir_im = imagecreatefromwebp($image);
    			break;
    		case 'jpg':
    			$dir_im = imagecreatefromjpeg($image);
    			break;
    		case 'jpeg':
    			$dir_im = imagecreatefromjpeg($image);
    			break;
    		case 'png':
    			$dir_im = imagecreatefrompng($image);
    			break;
    		default:
    			echo "error";
    			break;
    	}

        //Gets the size of the image
        $image_size = getimagesize($image);

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
