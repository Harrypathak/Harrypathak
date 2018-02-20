<?php
	error_reporting( ~E_DEPRECATED & ~E_NOTICE );
mysql_connect('sql209.ihostfull.com','uoolo_21194287', 'Iamagirl');
mysql_select_db ('uoolo_21194287_Harry');
  
  $folderi = __DIR__."/images/kathmandu/" ;
  
  if (isset($_POST['submit']))
   {
  
   $upload_image =$_FILES["image" ]["name"];
  $tmp_image =$_FILES["image" ]["tmp_name"];
  $namei =$_FILES['image']['name'];
  
  

  
  	// clean user inputs to prevent sql injections
		$image = trim($_POST['image']);
		$image = strip_tags($image);
		$image = htmlspecialchars($image);
		
	
  	// clean user inputs to prevent sql injections
		$text = trim($_POST['text']);
		$text = strip_tags($text);
		$text = htmlspecialchars($text);
		
		
		
   
  
 $path = $folderi.$image;
 
if (move_uploaded_file($_FILES['image']['tmp_name'], $folderi.$namei)) {
     	echo " saved successfully";
     
     }
     else {
   die("<br>move into the folder failed : " . mysql_error());
   
    }
    
      $filei= $namei;

     $sql= "INSERT INTO kathmandu(imageId,image,imageM, imageAlt, imageDate) VALUES ('','$namei','$filei','$text','".date('Y-m-d ')."')";
     $res = mysql_query($sql);
     }
if (!$res)
     {
die ("SORRY UPLOAD FAILED".mysql_error());

     } 
     echo "<font size = '5'><font color=\"#0CF44A\">SAVED TO DATABASE" ;
   
   
   mysql_close();
   
   
   $pathToImages = __.DIR__."/images/kathmandu";
$pathToThumbs= __.DIR__."/images/thumbs";
$thumbWidth= "600px";

function createThumbs( $pathToImages, $pathToThumbs, $thumbWidth ) 
{
  // open the directory
  $dir = opendir( $pathToImages );

  // loop through it, looking for any/all JPG files:
  while (false !== ($fname = readdir( $dir ))) {
    // parse path for the extension
    $info = pathinfo($pathToImages . $fname);
    // continue only if this is a JPEG image
    if ( strtolower($info['extension']) == 'jpg') 
    {
      echo "Creating thumbnail for {$fname} <br />";

      // load image and get image size
      $img = imagecreatefromjpeg( "{$pathToImages}{$fname}" );
      $width = imagesx( $img );
      $height = imagesy( $img );

      // calculate thumbnail size
      $new_width = $thumbWidth;
      $new_height = floor( $height * ( $thumbWidth / $width ) );

      // create a new temporary image
      $tmp_img = imagecreatetruecolor( $new_width, $new_height );

      // copy and resize old image into new image 
      imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height );

      // save thumbnail into a file
      imagejpeg( $tmp_img, "{$pathToThumbs}{$fname}" );
    }
  }
  // close the directory
  closedir( $dir );
}
// call createThumb function and pass to it as parameters the path 
// to the directory that contains images, the path to the directory
// in which thumbnails will be placed and the thumbnail's width. 
// We are assuming that the path will be a relative path working 
// both in the filesystem, and through the web for links
createThumbs("images/kathmandu/","images/thumbs/",400);

   
   
   ?>