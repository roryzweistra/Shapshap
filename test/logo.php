<?php 
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1 

//vul hier in welke folder je wilt gebruiken. als 
//je deze script in dezelfde folder zet als je 
//plaatjes hoef je hier niks aan te passen 

    $folder = '../pics/logopics'; 

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
    if ( 
        isset( $extList[ strtolower( $imageInfo['extension'] ) ] ) && 
        file_exists( $folder.$imageInfo['basename'] ) 
) { 
    $img = $folder.$imageInfo['basename']; 
} 
} else { 
    $fileList = array(); 
    $handle = opendir($folder); 
    while ( false !== ( $file = readdir($handle) ) ) { 
        $file_info = pathinfo($file); 
        if ( 
            isset( $extList[ strtolower( $file_info['extension'] ) ] ) 
) { 
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


//hieronder wordt de GD module gebruikt om een plaatje 
//te maken met een error als deze script geen plaatjes 
//kan vinden. Hiervoor moet de GD module geinstalleerd 
//zijn. 
    
    if ( function_exists('imagecreate') ) { 
        header ("Content-type: image/png"); 
        $im = @imagecreate (400, 200) 
            or die ("Cannot initialize new GD image stream"); 
        $background_color = imagecolorallocate ($im, 255, 255, 255); 
        $text_color = imagecolorallocate ($im, 0,0,0); 
        $text_colorred = imagecolorallocate ($im, 255,0,0); 
        imagestring ($im, 5, 120, 5, "ERROR ", $text_colorred); 
        imagestring ($im, 5, 5, 25, "deze script geen plaatjes kan vinden", $text_colorred); 
        imagestring ($im, 3, 5, 100, "De oorzaak kan zijn:", $text_color); 
        imagestring ($im, 2, 5, 125, "1. de script kan geen plaatjes vinden met de jouw gekozen extensies", $text_color); 
        imagestring ($im, 2, 5, 150, "2. Er bevinden geen plaatjes in de directory: $folder", $text_color); 
        
        imagepng ($im); 
        imagedestroy($im); 
    } 
} 
?> 