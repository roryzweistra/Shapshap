<?php 
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1 

//Folder name where pics are located
$folder = 'pics/logopics';

//kies hier op welke extensies je wilt zoeken 
$extList = array();
$extList['jpg'] = 'image/jpeg';
$extList['jpeg'] = 'image/jpeg';

$img = null; 

if (substr($folder,-1) != '/') { 
    $folder = $folder.'/'; 
} 


if (isset($_GET['img'])) { 
    $imageInfo = pathinfo($_GET['img']); 
    if ( isset( $extList[ strtolower( $imageInfo['extension'] ) ] ) && file_exists( $folder.$imageInfo['basename'] ) ) { 
		$img = $folder.$imageInfo['basename']; 
	} 
} else { 
    $fileList = array(); 
    $handle = opendir($folder); 
    while ( false !== ( $file = readdir($handle) ) ) { 
        $file_info = pathinfo($file); 
        if ( isset( $extList[ strtolower( $file_info['extension'] ) ] ) ) { 
            $fileList[] = $file; 
        } 
    } 
    closedir($handle); 


    if (count($fileList) > 0) { 
        $imageNumber = time() % count($fileList); 
        $img = $folder.$fileList[$imageNumber]; 
    } 
} 
if ($img!=null) { 
    $imageInfo = pathinfo($img); 
    $contentType = 'Content-type: '.$extList[ $imageInfo['extension'] ]; 
    header ($contentType); 
    readfile($img); 
} else { 


//Generate error when no pics can be located. GD must be installed.
    
    if ( function_exists('imagecreate') ) { 
        header ("Content-type: image/png"); 
        $im = @imagecreate (400, 200) 
            or die ("Cannot initialize new GD image stream"); 
        $background_color = imagecolorallocate ($im, 255, 255, 255); 
        $text_color = imagecolorallocate ($im, 0,0,0); 
        $text_colorred = imagecolorallocate ($im, 255,0,0); 
        imagestring ($im, 5, 120, 5, "ERROR ", $text_colorred); 
        imagestring ($im, 5, 5, 25, "No pics can be located", $text_colorred); 
        imagestring ($im, 3, 5, 100, "Possible reasons:", $text_color); 
        imagestring ($im, 2, 5, 125, "1. wrong extension", $text_color); 
        imagestring ($im, 2, 5, 150, "2. no pics in directory: $folder", $text_color); 
        
        imagepng ($im); 
        imagedestroy($im); 
    } 
} 
?> 