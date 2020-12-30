<?php
	class Comics {

  		function __construct() {

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
                	$sans_prefix = substr($filename, 29);

                	echo "<option value= " . $sans_prefix . ">"  . "</option> \n";
            	}
    	}

    	function page_dropdown() {

  	     	//Grabs the current directory where the php function was called from
    	    $cwd = getcwd();

         	$filename = glob($cwd . "/*{.webp, jpg, jpeg, png}", GLOB_BRACE);

            	for ($i=0; $i < sizeof($filename); $i++) {

                	//Removes the unix path variables
                	$sans_prefix = substr($filename[$i], 29);

                	echo "<option value= " . $sans_prefix . ">" . "Page:" . $i . "</option>\n";
            	}

    	}

    	function comic_list(){

    		$cwd = getcwd();

    		$glob_it = glob($cwd . '/*' , GLOB_ONLYDIR);

    		$exclude = [$cwd . '/Monster', $cwd . '/comic_image'];

    		$remove = array_diff($glob_it, $exclude);

        	//This glob gets all the subdirectories in the directory
        	foreach($remove as $filename){

            //strips prefix from the original $filename variable
            $filename = basename($filename);

            //replaces any use of underscores with spaces
            $comic = preg_replace("(_)", " ", $filename);

            $upperCase = ucwords($comic);

            echo "<div class='comic'>" . "<a href='" . '/comics/' . $filename . "/'>";
            echo Comics::im_cr(Comics::first_im($filename));
            echo "<br>" . $upperCase . "</a>"  . "</div>\r\n";
        	}
    	}

    	function first_im($filename){

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

 				//Recursively scans the very first volume for each comic and removes unnecessary results
 				$scanned_dir = array_diff(scandir($first_dir[0]), array('..', '.', 'index.php'));

 				//Returns the full path to the first image found (array elements 0 and 1 of scanned_dir are the '..' files)
 				$full_path = $all_dirs[0] . '/' . $scanned_dir[2];
 				return $full_path;
    		}
    	}

    	//Basic image creation function with GD
    	function im_cr($image){
    		$file_info = pathinfo($image);
    		$dir_im;
    		ob_start();

            //Checks file extension to decide which imagecreate function is required
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
        
        	//Creates a jpeg image from provided resource
        	imagejpeg(Comics::im_man($image, $dir_im));

        	//Gets the raw code for the image, cleans it for viewing
        	$raw_image = ob_get_clean();

        	//Echo's the image file using base64 encoding of the raw image data
        	echo "<img src='data:image/jpeg;base64," . base64_encode($raw_image) . "'/>";
        }

        //Function to handle iamge manipulation
        function im_man($image, $dir_im){
            //Gets the size of the image
            $image_size = getimagesize($image);

            //Checks which cropping template to use
            if ($image_size[0] >= 2050) {
                $cropped = imagecrop($dir_im, ['x' => ($image_size[1]/2),
                                                'y' =>0, 
                                                'width' =>  ($image_size[0] / 3), 
                                                'height' => ($image_size[1] /1.5)]);

                //Scales the imgage to an appropriate size to use as a thumbnail
                $scaled = imagescale($cropped, 300);
            }
            else{
                $cropped = imagecrop($dir_im, ['x' => ($image_size[1]/17),
                                                'y' =>0, 
                                                'width' =>  (($image_size[0] / 3)*2.5), 
                                                'height' => ($image_size[1] /2)]);

                //Scales the imgage to an appropriate size to use as a thumbnail
                $scaled = imagescale($cropped, 280);
            }


        return Comics::im_save($scaled);
        }

       function im_save($image){
        	 imagewebp($image, '/var/wwww/erebus.cymru/landing/comics/comic_image/' + $image);
        }
    }
?>
