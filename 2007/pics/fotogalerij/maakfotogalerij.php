<?php
foreach(array_merge($_REQUEST,$_FILES) as $key=>$value)
{
	if(isset(${$key}))
	{
		unset(${$key});
	}
}

$version = "1.00" ;
$photos_per_row = 6;							//Total amount of pictures to be shown on each row
$home = "http://www.shapshap.nl";				//Sets the homedir
$photo_dir = "http://www.shapshap.nl/foto/";	//Dir where the pictures can be found
$language= "nl";								//So far only dutch
$color_outside = "FFFFFF";						//Needs to be set??
$max_size = 120;								//Sets the maximum size for the thumbnails
$sort_pictures = "alpha";						//Set the sorting method, possible are descr, date, alpha
$quality = 50;									//Sets the quality of JPG thumbnails
$your_name = "shapshap";						//Sets the copyright and author tags
$thm_limit = 720;								//Sets the maximum size of the original picture, before additional thumbs will be created 
$thm_size = 520;								//Sets the size of the additional thumbs
$thm_quality = 50;								//Sets the quality of the additional JPG thumbnails


$selectbox = '<option value="http://www.shapshap.nl/">HOME</option>'; //Delelting this anytime soon!!

$create_thumbs = 1;								//Determines if the scripts should create thumbnails. If you have created your own thumbs set 0
$meta_key_words = "photos photo picture image pic shapshap shap afrika africa foto's";
												// these keywords will appear in every page in the meta tag keywords

if (substr($photo_dir,-1) != '/') { 
    $photo_dir = $photo_dir.'/'; 
} 
												
//Language, so far only dutch 
if ($language== "nl") {
$text_1 = "Foto's";
$text_2 = "Hier zie je de foto ";
$text_3 = "Uit de categorie";
$text_4 = "Hallo,%20-%20ik%20heb%20interessante%20foto's%20gevonden";  // for the mailto link
$text_5 = "Hallo,%20-%20ik%20heb%20een%20interessante%20pfoto%20gevonden";
$text_6 = "Stuur je vrienden een email met de link naar deze foto's";
$text_7 = "Stuur je vrienden een email met de link naar deze foto";
$text_8 = "email een vriend";
$text_9 = "bookmark";
$text_10 = "bookmark deze foto's";
$text_11 = "bookmark deze foto";
$text_12 = "Terug naar de thumbnails";
$text_13 = "home";
$text_14 = "links";
$text_15 = "back to the survey";
$text_16 = "afbeelding";
$text_17 = "van";
$text_18 = "Vorige foto";
$text_19 = "Laatste foto";
$text_20 = "Volgende foto";
$text_21 = "Eerste foto";
$text_22 = "Klik hier om de foto te vergroten";
$text_23 = "Deze foto is geweldig";
$text_24 = "Pagina is gecreeerd met behulp van WebYourPhotos";
$text_25 = "nee";
$text_26 = "Voorbeeld";
}


$description = "description.txt" ;
// change this name to the text file of your picture descriptions (optional)
// Name der Textdatei, in welchem die Beschreibungen der Bilder liegen (optional)

// set_time_limit(10800);
// damit kann auf manchen servern die zeit verlängert werden, die das script bekommt - aktivieren sie die obige befehlszeile, wenn das script während der thumbnailerstellung vom server abgewürgt wird (funktioniert nicht auf allen servern)
// if your server kills the script, during the thumbnail creation, you can try to activate the upper line (does not work on all servers)

$versionGD = 0 ;

echo
<<<EOHTML
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
	<HEAD>
		<TITLE>
			Africa's finest!
		</TITLE>
	</HEAD>
	<BODY BGCOLOR="#FFFFFF">
	<P>
	<br>
EOHTML;

if ($versionGD == 0 )
{
	$testGD = get_extension_funcs("gd");
	if (!$testGD)
	{
		echo "
			<b>
				<br>
				the GD library is not installed on your server - sorry that will not work...
				<br>
			</b>
		";
	}
	else
	{
		echo "
			<br>
			the GD library was found on your Server - <br><font color=\"c0c0c0\" size=\"1\">
			<br>if the script stops here, please try to set $versionGD = 1  in this file near line 372
			</font><br><br>
		";
	}

	if(function_exists("imagecreatetruecolor")||function_exists("imagecreatetruecolor()"))
	{
		$imTest1 = @imagecreatetruecolor(12,12);
	}

	if($imTest1)
	{
		echo "
		Der Befehl imagecreatetruecolor funktioniert auf Ihrem Server, und wird verwendet <br>
		";
		
		$versionGD = 2;
		@imagedestroy($imTest1);
	}
	else
	{
		if(function_exists("imagecreate")||function_exists("imagecreate()"))
		{
			$imTest2 = @imagecreate(12,12);
		}
		if($imTest2)
		{
			echo "
			Der Befehl imagecreate funktioniert auf Ihrem Server, und wird verwendet<br>
			";
			
			$versionGD = 1;
			@imagedestroy($imTest2);
		}
		else
		{
			echo "
			<br>the GD library seems not to be installed on your Server - sorry that will not work...<br>
			";
			
			$versionGD = 0;
		}
	}
}

$home1 = $_SERVER['SERVER_NAME'];
if((strlen($home1)>4)&&(!preg_match("/(local|127.0)/",$home1)))
{
	$on=1;
}

if($home=="")
{
	$home = preg_replace("/^www\./i","",$home1);
	$home = "http://www." . $home; 
}

if ( $home == "http://www." ) { echo "<b>Warning: Recognition of your domain name failed - please insert it by hand in the script,</b> (where \$home = \"\" ;)<br>Achtung: <b>Ihr Domainname wurde nicht erkannt - Bitte tragen Sie ihn im Script in die Variable \$home ein</b><br>"; }    if ($on==1) {$in1="";}
$dir = $_SERVER['PHP_SELF'] ;
echo "Server Name: $home<br>";
echo "Pfad: $dir <br>" ; 
$dir = dirname($dir); trim($dir) ;
$kategorie = $dir ;
if ( $photo_dir == "http://www." ){$photo_dir=$home . $dir ;}
$photo_dir = preg_replace ("/\/$/","",$photo_dir);
$photo_dir .= "/" ;
echo "Path / Absoluter Pfad: $photo_dir <br>";

echo "Directory / aktuelles Verzeichnis: $dir <br>\n";
if (strlen($kategorie)<1)  { $verz = getcwd(); echo "getcwd: $verz <br>" ; $kategorie = $verz ; trim($kategorie) ;}
$kategorie = str_replace ("\\","/",$kategorie);
$kategorie = preg_replace ("/\/$/","",$kategorie);
$kategorie1 = preg_replace ("/^.*\//","",$kategorie);
$folder = $kategorie1 ;
if (strlen($kategorie1)<2) 
    {  echo "<br><b> Achtung - Kategoriename/Ordnername wurde nicht erkannt !<br>Warning:  folder name not found !</b>";
    $kategorie1 = $text_1 ;}
$kategorie = preg_replace ("/ /","_",$kategorie1);
if ($kategorie1 != $kategorie) {echo "<br><b>Warning: Your folder name contains space tabs - please change your folder name<br>Achtung Ihr Ordnername enthält Leerzeichen !<br>Bitte bennenen Sie Ihren Ordnernamen um, da Leerzeichen und Umlaute in Urls meist nicht funktionieren<br>" ;}
$hauptseite = $kategorie.".html" ;
$hauptseite = preg_replace ("/ /","",$hauptseite);
$hauptseite_abs = $photo_dir . $hauptseite;
$kategoriename = preg_replace ("/_/"," ",$kategorie) ;
$kategoriek = $kategoriename ;
$kategoriename = ucfirst($kategoriename) ;
$kategoriename = umlaute2($kategoriename)  ; // diese Zeile muss gelöscht werden, wenn der Ordnername nicht in Umlaute verwandelt werden soll (betrifft nur deutsch)
echo "Category / Kategoriename : $kategoriename \n";

$zeit = time(); $datum = getdate($zeit); $zeit = $datum[year] . "-" . $datum[mon] . "-" . $datum[mday] ;  $te=3;

// looking for the pics:
$allpics = array();
$auf = opendir ("./"); // alternativ:  $verz = getcwd();  $auf = opendir ($verz);
while ($file = readdir ($auf)) {
 if (!((preg_match ("/^th_/",$file))||(preg_match ("/ecke_wyp/",$file)))) {
   if (preg_match ("/^thm_/",$file)) {
    $bild_om = preg_replace ("/^thm_/","",$file) ;
    if (!(file_exists($bild_om))) {
        if (preg_match("/\.jpg$/i",$file))  { array_push ($allpics,$file) ; }
        if (preg_match("/\.jpeg$/i",$file)) { array_push ($allpics,$file) ; }
        if (preg_match("/\.png$/i",$file))  { array_push ($allpics,$file) ; }
		if ($GIF_pics==1) { if (preg_match("/\.gif$/i",$file))  { array_push ($allpics,$file) ; } } }
 } else
  if (preg_match("/\.jpg$/i",$file))  { array_push ($allpics,$file) ; }
  if (preg_match("/\.jpeg$/i",$file)) { array_push ($allpics,$file) ; }
  if (preg_match("/\.png$/i",$file))  { array_push ($allpics,$file) ; }
  if ($GIF_pics==1) { if (preg_match("/\.gif$/i",$file))  { array_push ($allpics,$file) ; } } }
 }
closedir($auf);


// die Thumbnails:
if (( $versionGD == 0 )|| ($create_thumbs == 0 )) {  echo "<br>Es wird nach Thumbnails und mittelgroßen Bildern gesucht, welche Sie selbst erstellt haben. Diese müssen das Präfix th_ bzw thm_ haben<br>The script searches for thumbnails (th_ ) and middle great thumbnails (thm_ ), you have created yourself.<br>";

foreach ($allpics as $bild) {
  $kb[$bild] =  round(filesize($bild)/1000) ;
  $info  = getimagesize($bild);
  $wi[$bild] = $info[0];
  $hi[$bild] = $info[1];
  $tags[$bild] = $info[3];

  $th = "th_" . $bild ;
  if (file_exists($th)) { echo "Thumbnail found/ Vorschaubild gefunden: $th <br>" ;
  $infotn  = getimagesize($th);
  $tagstn[$bild] = $infotn[3];
  $th_wi[$bild] = $infotn[0] ;
  $th_hi[$bild] = $infotn[1] ;}
  else {echo "Thumbnail <b>not</b> found/ Vorschaubild <b>nicht</b> gefunden: $th <br>" ; } // $no_th[$bild] = 1;

  $thm = "thm_" . $bild ;
  if (file_exists($thm)) { echo "additional Thumbnail found/ mittelgrosses Vorschaubild gefunden: $thm <br>" ;
  $infotm  = getimagesize($thm); 
  $tagstm[$bild] = $infotm[3];  
  $wi[$bild] = $infotm[0]; 
  $hi[$bild] = $infotm[1]; 
  $thm_exists[$bild] = 1 ;} 
}  }
 else { // ab hier kreiert das script die Thumbnails:
echo "<br>creating the thumbnails <br> if the script stops here please just run it again (refresh), and the missing thumbnails will be created<br>Erstelle Thumbnails - <FONT SIZE=\"1\" COLOR=\"666666\">falls das Script an dieser Stelle abbricht, so rufen Sie das Script bitte einfach erneut auf (aktualisieren), damit die restlichen Thumbnails erstellt werden.</font><br>";
foreach ($allpics as $bild) {
  $kb[$bild] =  round(filesize($bild)/1000) ;
  $info  = getimagesize($bild);
  $th = "th_" . $bild ;
  $infotn[0] = 0 ;
if (file_exists($th)) {$infotn  = getimagesize($th);}
  $w = $info[0];
  $h = $info[1];
  $wi[$bild] = $w;
  $hi[$bild] = $h;
  $tags[$bild] = $info[3];
  $newwidth = $max_size ;
  $newheight = round($h/$w*$max_size);
  if ($h>$w) {$newheight = $max_size ; $newwidth = round($w/$h*$max_size);}
if ($newwidth!=$infotn[0]) {
 if ($info[2] == 2) {
  $src = imagecreatefromjpeg($bild);
  if ($src) {
  if ( $versionGD == 1 ) { $im = imagecreate($newwidth,$newheight);  imagecopyresized($im,$src,0,0,0,0,$newwidth,$newheight,$w,$h); }
   else {  $im = imagecreatetruecolor($newwidth,$newheight);  imagecopyresampled($im,$src,0,0,0,0,$newwidth,$newheight,$w,$h);} }
  else {$im = imagecreate(84,42);   // wenn bild nicht erstellt werden konnte
   $farbe_body=imagecolorallocate($im,243,243,243);
   imagefill($im,0,0,$farbe_body);
   $farbe_b = imagecolorallocate($im,10,36,106);
   imagestring ($im, 5,18, 4, $text_25, $farbe_b);
   imagestring ($im, 6,6, 20, $text_26, $farbe_b);}
  imagejpeg($im,$th,$quality);
  imagedestroy($im);
  $infotn  = getimagesize($th);
  chmod ($th, 0775); }
 else if ($info[2] == 3) {
  $src = imagecreatefrompng($bild);
  if ($src) {
  if ( $versionGD == 1 ) { $im = imagecreate($newwidth,$newheight);  imagecopyresized($im,$src,0,0,0,0,$newwidth,$newheight,$w,$h); }
   else {  $im = imagecreatetruecolor($newwidth,$newheight);  imagecopyresampled($im,$src,0,0,0,0,$newwidth,$newheight,$w,$h);} }
  else {$im = imagecreate(84,42);
   $farbe_body=imagecolorallocate($im,243,243,243);
   imagefill($im,0,0,$farbe_body);
   $farbe_b = imagecolorallocate($im,10,36,106);
   imagestring ($im, 5,18, 4, $text_25, $farbe_b);
   imagestring ($im, 6,6, 20, $text_26, $farbe_b);}
  imagepng($im,$th);
  imagedestroy($im);
  $infotn  = getimagesize($th);
  chmod ($th, 0775); }
  if ($src) {echo "$th  <br>" ;} else {echo"<b>The photo $bild seams to be too big for the server.</b><br>";} }
// die mittelgroßen Bilder (thm_)erzeugen:
  if (($w > $thm_limit)||($h > $thm_limit)) {
  $thm = "thm_" . $bild ;
  $infotm[0] = 0 ;
if (file_exists($thm)) {$infotm  = getimagesize($thm);}
  $newwidth = $thm_size ;
  $newheight = round($h/$w*$thm_size);
  if ($h>$w) {$newheight = $thm_size ; $newwidth = round($w/$h*$thm_size);}
if ($newwidth!=$infotm[0]) {
 if ($info[2] == 2) {
  $src = imagecreatefromjpeg($bild);
   if ($src) {
  if ( $versionGD == 1 ) { $im = imagecreate($newwidth,$newheight);  imagecopyresized($im,$src,0,0,0,0,$newwidth,$newheight,$w,$h); }
   else {  $im = imagecreatetruecolor($newwidth,$newheight);  imagecopyresampled($im,$src,0,0,0,0,$newwidth,$newheight,$w,$h);}
  imagejpeg($im,$thm,$thm_quality);
  imagedestroy($im);
  chmod ($thm, 0775);
  $infotm  = getimagesize($thm); }
  else {echo"<b>The photo $bild seams to be too big for the server</b><br>";}}
 else if ($info[2] == 3) {
  $src = imagecreatefrompng($bild);
  if ($src) {
  if ( $versionGD == 1 ) { $im = imagecreate($newwidth,$newheight);  imagecopyresized($im,$src,0,0,0,0,$newwidth,$newheight,$w,$h); }
   else {  $im = imagecreatetruecolor($newwidth,$newheight);  imagecopyresampled($im,$src,0,0,0,0,$newwidth,$newheight,$w,$h);}
  imagepng($im,$thm);
  imagedestroy($im);
  chmod ($thm, 0775);
  $infotm  = getimagesize($thm);}
  else {echo"<b>The photo $bild seams to be too big for the server</b><br>";}}
  }
  if (file_exists($thm)) {echo "additional Thumbnaild: $thm <br>" ; $tagstm[$bild] = $infotm[3];  $wi[$bild] = $infotm[0]; $hi[$bild] = $infotm[1]; $thm_exists[$bild] = 1 ;}
  }
 $tagstn[$bild] = $infotn[3];
 $th_wi[$bild] = $infotn[0] ;
 $th_hi[$bild] = $infotn[1] ;
}
echo "Thumbnails herstelt" ; } // ende thumbnails


// multi-Galerien (ist noch nicht perfekt - aber besser als gar nichts...):
$links_to_all_gallerys = "../links_to_all_gallerys.txt" ;
$all_gallery = '<option value="../'.$folder.'/">'.$kategoriename."</option>\n" ;
if(file_exists($links_to_all_gallerys)) {
$data = file($links_to_all_gallerys);
$okat = ">".$kategoriename."<" ; $ist_drin = 0 ; $gal = 0 ;
$all_gallery = '<option value="../'.$folder.'/">'.$kategoriename."</option>\n" ;
foreach ($data as $zeile) {
    if ( stristr($zeile,$okat)){ $ist_drin = 1 ;}
    else { if ( stristr($zeile,"option")) {$all_gallery .= $zeile ; $gal = 1 ; }  }  }  }
else {echo "<br>Er werden geen verder gallerijen gevonden<br>";}

// Beschreibungen und Reihenfolge der Bilder:
if(file_exists($description)) { 
$data = file($description);
$nr = 0 ;
foreach ($data as $zeile) {
  $zeile = trim ($zeile) ;
  if (strlen($zeile)>4){
  $data2 = explode(" ",$zeile,2);
  $bild = $data2[0] ;
  if (in_array($bild,$allpics)) {
    $bb[$bild] = trim($data2[1]) ;
    $nr++;
    $bnr[$bild]=$nr;
    $biname[$nr] = $bild ; }
  else {echo "<br><b>$bild</b> Kan niet gevonden worden";}
}}}
  else {echo "<br>Descriptie file $description niet gevonden !!!";}
  
if ($lizens == "free") {$regi = "" ;                                                                                                                                                                                    $te=2;}

$newd = "" ;
foreach ($allpics as $bild) {
 if(!isset($bnr[$bild])) {
  $nr++;
  $bnr[$bild]=$nr;
  $biname[$nr] = $bild ;
  $bb[$bild]="";
  $newd .= $bild . "\n";
  }
  $bnn[$bild] = preg_replace ("/\..*/","",$bild) ;
  $bnn[$bild] = preg_replace ("/^thm_/","",$bnn[$bild]) ;
  $bn[$bild] = preg_replace ("/_/"," ",$bnn[$bild]) ;
  $bn[$bild] = ucfirst($bn[$bild]) ;
  $bnoz[$bild] = preg_replace ("/\d*$/","",$bn[$bild]) ;
  $bnoz2[$bild] = preg_replace ("/\d/","",$bnoz[$bild]) ;
  $suchwort[$bild] = preg_replace ("/\b[\w]{1,3}\b/","",$bnoz2[$bild]) ;
  if (strlen($suchwort[$bild])<4){ $suchwort[$bild] = $kategoriek ;}
  $suchwort[$bild] = preg_replace ("/\d/","",$suchwort[$bild]) ;
  $suchwort[$bild] = preg_replace ("/-/"," ",$suchwort[$bild]) ;
  $suchwort[$bild] = preg_replace ("/ +/","+",$suchwort[$bild]) ;
  $suchwort[$bild] = preg_replace ("/\++$/","",$suchwort[$bild]) ;
  $suchwort[$bild] = preg_replace ("/^\++/","",$suchwort[$bild]) ;
  if (strlen($suchwort[$bild])<2){ $suchwort[$bild] = preg_replace ("/ /","",$text_1) ;}
  if ($bnoz_h == $bnoz2[$bild]) { $bnoz[$bild] = $bn[$bild] ; $bnoz[$bild_h] = $bn[$bild_h] ;}
  $bnoz_h = $bnoz2[$bild] ;
  $bild_h = $bild ;
}
if (strlen($newd)>8){ $fp = fopen($description,"ab"); if ($fp) { fputs($fp,$newd);  fclose($fp);  chmod ($description, 0775);} }

if ($sort_pictures == "alpha") {
  natcasesort($allpics) ;
  $nr = 0 ;
  foreach ($allpics as $bild) { $nr++; $bnr[$bild] = $nr; $biname[$nr] = $bild ;}
}
if ($sort_pictures == "date") {
  foreach ($allpics as $bild) {
    $datch[$bild]= filemtime($bild); }
  arsort($datch,SORT_NUMERIC);  // rückwärts sortieren(backwards):  asort($datch,SORT_NUMERIC);
  $nr = 0 ;
  while(list($bild, $val) = each($datch))
  { $nr++; $bnr[$bild] = $nr; $biname[$nr] = $bild ;
  echo "<br>$bild - $datch[$bild]"; echo " Date: " .gmdate("d M Y H:i:s", $datch[$bild]);}
}
for($i = 1;$i <= $nr; $i++) {
  $bild = $biname[$i];
  $keywords[$bild] = (" " . $bn[$bild] . " " . $bb[$bild] . " ") ;
  $keywords[$bild] = preg_replace ("/<.*>/U"," ",$keywords[$bild]) ;
  $keywords[$bild] = preg_replace ("/[^a-zA-ZäöüÄÖÜß]/"," ",$keywords[$bild]) ;
  $keywords[$bild] = preg_replace ("/ [a-zA-ZäöüÄÖÜß]{1,3} /"," ",$keywords[$bild]) ;
  $keywords[$bild] = preg_replace ("/ [a-zA-ZäöüÄÖÜß]{1,3} /"," ",$keywords[$bild]) ;
  $keywords[$bild] = preg_replace ("/ +/"," ",$keywords[$bild]) ;
  if (strlen($keywords[$bild]) > 12) {$keywords[$bild] = preg_replace ("/ [a-zA-ZäöüÄÖÜß]{1,4} /"," ",$keywords[$bild]) ;$keywords[$bild] = preg_replace ("/ [a-zA-ZäöüÄÖÜß]{1,4} /"," ",$keywords[$bild]) ;}
  if (strlen($keywords[$bild]) > 32) {$keywords[$bild] = preg_replace ("/ [a-zA-ZäöüÄÖÜß]{1,5} /"," ",$keywords[$bild]) ;}
  if (strlen($keywords[$bild]) > 111) {$keywords[$bild] = substr($keywords[$bild],0,100) ; $keywords[$bild] = preg_replace ("/ \w+$/","",$keywords[$bild]) ; }
  $keywords[$bild] = $keywords[$bild] . " " . $kategoriek . " " . $meta_key_words;
  $keywords[$bild] = preg_replace ("/,/"," ",$keywords[$bild]) ;
  $keywords[$bild] = preg_replace ("/ +/"," ",$keywords[$bild]) ;
  $keywords[$bild] = trim($keywords[$bild]) ;
  $dop = explode(" ",$keywords[$bild]) ;
  $dopp = array_unique($dop) ;
  $keywords[$bild] = implode(", ",$dopp) ;
  $keywords[$bild] = preg_replace ("/ +/"," ",$keywords[$bild]) ;
  $keywords[$bild] = preg_replace ("/[, ]{2,}/",", ",$keywords[$bild]) ;
  $keywords[$bild] = umlaute($keywords[$bild]) ;
  $bb[$bild] = umlaute($bb[$bild]);
  $btitle[$bild] = $bb[$bild];
  $btitle[$bild] = preg_replace ("/<.*>/U"," ",$btitle[$bild]) ;
  if (strlen($bb[$bild]) > 200)  {
    $btitle[$bild] = substr($btitle[$bild],0,189) ;
    $btitle[$bild] = preg_replace ("/ \w+$/","",$btitle[$bild]) ;
    $btitle[$bild] = $btitle[$bild] . "... " ; }
  if (strlen($bb[$bild]) < 2)  { $btitle[$bild] =  "(" . $kategoriename . ")"; $metadesc[$bild] = $text_2 . $bn[$bild] . " " . $text_3 . " " . $kategoriename  ;}
  else { $metadesc[$bild] = $bn[$bild] . ": " . $btitle[$bild] ; }

  $btitle[$bild] =  $bn[$bild] . ": \n" . $btitle[$bild] ;
}
echo "<br><table border=1  bgcolor=FFCCFF CELLPADDING=1><TR ALIGN=CENTER VALIGN=MIDDLE><td><b>Picture / Bild</b></td><td><b>Description / Beschreibung</b></td><td><b>Keywords</b></td><td><b>title</b></td></tr>" ;
for($i = 1;$i <= $nr; $i++) {
  $bild = $biname[$i]; 
  echo "<tr VALIGN=TOP><td>Nr. $i: $bild<br>&nbsp;&nbsp; $kb[$bild] kB</td><td>$bb[$bild]&nbsp;</td><td>$keywords[$bild] </td><td>$btitle[$bild]</td></tr>";}
echo "</table><br>";

$color_inside1 = $color_inside ;
if ($color_inside1 == ""){ $color_inside = create_random_color() ; } // here only for the thumbnailpage

// die eck grafiken werden in diesem design nicht gebraucht:
// if ( $versionGD > 0 ){create_corners($color_outside,$color_inside); } else { if (!(file_exists("ecke_wyp4.png"))){ echo "<br>Sie müssen die Eckgrafiken: ecke_wyp1.png, ecke_wyp2.png, ecke_wyp3.png, ecke_wyp4.png,  selbst hochladen<br> You will have to upload the corner-pics yourself<br>you will find them in the <a href=http://www.superphotos.info/webYourPhotos.zip>webYourPhotos zip file</a><br>";} }

// Fotokasten.de Einbindung (only german version)
if (($Foto_Postkarte != 0) && ($language== "de")) { 
echo " <br><font color=FF0000>Achtung:</font> Bitte prüfen sie unbedingt, ob der absolute Pfad zu den Bildern korrekt erkannt wurde,<br>damit der Service von <a href=http://partners.webmasterplan.com/click.asp?ref=89063&site=2558&type=text&tnb=4>Fotokasten</a> funktioniert:<br><b><a href=\"$photo_dir\" title>$photo_dir</a></b><br>Falls der Pfad nicht korrekt erkannt wurde, tragen Sie bitte manuell die Url im Script in die Variable \$photo_dir (etwa Zeile 170) ein<br><br>" ;
if (($Foto_Postkarte == 1)||($Foto_Postkarte == 3)) { 
$fotokasten_link_text1 = "Dieses Bild als Postkarte versenden" ; 
$fotokasten_link_title1 = "Senden Sie dieses Bild als echte Postkarte an Freunde" ; }
if (($Foto_Postkarte == 2)||($Foto_Postkarte == 3)) { 
$fotokasten_link_text2 = "Dieses Bild bei Fotokasten bestellen" ;
$fotokasten_link_title2 = "Dieses Bild auf hochwertigem Fotopapier bei Fotokasten.de bestellen" ; }

foreach ($allpics as $bild) { if (eregi ("jp(e){0,1}g$",$bild)){
$th = "th_" . $bild ; $wi_b= $wi[$bild] ;  $hi_b= $hi[$bild] ;
if (($th_wi[$bild] < 300)&&($th_wi[$bild] > 10)&&($th_hi[$bild] < 300)&&($th_hi[$bild] > 10)&&( $kb[$bild] > $mindest_kB_groesse )) { 
if ($thm_exists[$bild] == 1 ) { 
if (($wi_b< 300)&&($hi_b< 300)) { // wenn thm kleiner als 300 pixel dann kann das mittelgroße Bild als Vorschau verwendet werden
$th = "thm_" . $bild ;
$kb_thm =  round(filesize($th)/1000) ;
if ($kb_thm > 60) { $th = "th_" . $bild ; } } // wenn thm größer als 60 kB, dann doch das kleine Thumbnail
$info  = getimagesize($bild);   $wi_b= $info[0];   $hi_b= $info[1];  } // wegen thm sonderbehandlung notwendig
$bildlink = $photo_dir . $bild ;
$th_bildlink = $photo_dir . $th ;

if (($Foto_Postkarte == 1)||($Foto_Postkarte == 3)) { 
if ( ($wi_b* $hi_b) > 600000 ) {  // prüft, ob mindestens 0.6 Megapixel vorhanden sind, wegen Postkarten-Bildqualität
$fotokasten_url1 = "http://" . $Fotokasten_partnerID . ".partner.fotokasten.de/affiliateapi/standard.php?opedo=" . $bildlink . "&thumbnail=" . $th_bildlink . "&width=" . $wi_b. "&height=" . $hi_b;
$fotokasten_JS1[$bild] = <<<EOTJS
function opedo() {
    basket = "$fotokasten_url1" ;
	fotobasket=window.open(basket, 'blank', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=no,width=528,height=700');
	fotobasket.focus(); }
EOTJS;
$fotokasten_link1[$bild] = "<br><a href=\"javascript:opedo()\" title=\"" . $fotokasten_link_title1 . "\">" . $fotokasten_link_text1 . "</a><br>" ;
$fotokasten_optionsfeld1[$bild] = "<option value=\"opedo\">Bild als Postkarte versenden</option>" ; } }
if (($Foto_Postkarte == 2)||($Foto_Postkarte == 3)) {
$fotokasten_url2 = "http://" . $Fotokasten_partnerID . ".partner.fotokasten.de/affiliateapi/standard.php?add=" . $bildlink . "&thumbnail=" . $th_bildlink . "&width=" . $wi_b. "&height=" . $hi_b;
$fotokasten_JS2[$bild] = <<<EOTJS
function fototransfer() {
    basket = "$fotokasten_url2" ;
	fotobasket=window.open(basket, 'fotobasket', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=190,height=250');
	fotobasket.focus(); }
EOTJS;
$fotokasten_link2[$bild] = "<br><a href=\"javascript:fototransfer() \" title=\"" . $fotokasten_link_title2 . "\">" . $fotokasten_link_text2 . "</a>" ;
$fotokasten_optionsfeld2[$bild] = "<option value=\"fototransfer\">Bild bei Fotokasten bestellen</option>" ; }
} } } }

// the pages:
// the index-page (just a forwarding page to the thumbnails):
$ind = <<<EOT
<HTML><HEAD><title>$kategoriename $text_1</title><meta NAME="robots" CONTENT="follow"><meta NAME="generator" CONTENT="webYourPhotos $version">
<meta NAME="description" CONTENT="$kategoriename - $nr $text_1"><meta NAME="keywords" CONTENT="$kategoriename $meta_key_words">
<meta HTTP-EQUIV="refresh" CONTENT="0; URL=$hauptseite"></HEAD>
<BODY BGCOLOR="#$color_outside">
<P>&nbsp;</P><P>&nbsp;</P><P>&nbsp;</P><P>&nbsp;</P><P>&nbsp;</P><P ALIGN="CENTER"><A HREF="$hauptseite">$text_1</A></P>
</BODY></HTML>
EOT;
$in = fopen("index.htm","wb"); fputs($in,$ind); fclose($in); echo "index.htm is created / erstellt<br>"; chmod ("index.htm", 0775);

if (ereg("yourname",$selectbox)) {$selectbox="";}
$selectbox = $selectbox . $all_gallery . "<option value=\"$home\">Home</option>" ;
$wyp = '<option value="nothing"> - - - - - - - - - - - - </option><option value="xhttp://www.webyourphotos.info/">webYourPhotos</option>' ;  if ($te!=2) {$wyp = "";}
$thumbnails = "";

// start of html-code for the tumbnail page. / hier beginnt der html code der Seite mit den Vorschau-bildchen.
$thumbnails = '<table width="96%" border="0" cellspacing="0" cellpadding="3" align="center">' ; $ba = 0 ;
for($i = 1;$i <= $nr; $i++) { $ba++ ; if($ba == 1){$thumbnails .= "<tr>\n" ; }
  $bild = $biname[$i];
$thumbnails .= <<<EOT
<td align="center" valign="middle"><a href="$bnn[$bild].htm" CLASS="netscape"><IMG SRC="th_$bild" $tagstn[$bild] border="0" title="$btitle[$bild]" VSPACE="3" HSPACE="3"></a><br><a href="$bnn[$bild].htm" CLASS="unterThumbnails">$main_pic_text</a></td> \n
EOT;
if($ba == $photos_per_row){$thumbnails .= "</tr>\n" ; $ba = 0; }
}
if ($ba > 0) {$thumbnails .= str_repeat('<td>&nbsp;</td>',$photos_per_row-$ba);$thumbnails .= "</tr>\n" ;}
$thumbnails .= "</table>\n" ;
$thumbnail_page = <<<EOT
<HTML>
<HEAD>
<title>$kategoriename $text_1</title>
<meta NAME="description" CONTENT="$kategoriename - $nr $text_1">
<meta NAME="keywords" CONTENT="$kategoriename $meta_key_words">
<meta NAME="copyright" CONTENT="$your_name">
<meta NAME="Author" CONTENT="$your_name">
<meta NAME="generator" CONTENT="webYourPhotos $version $lizens">
<meta name="date" content="$zeit">
<meta NAME="robots" CONTENT="index, follow">
$css_styles
<script language="JavaScript" type="text/JavaScript">
<!--
// url with x: opens in new window
// url with y: opens in same frame

function jumping(url)
{
 if(url == "nothing") {
   document.forms[0].reset();
   document.forms[0].elements[0].blur();
   return; }
var url1 = url.replace("xhttp","http");
var url2 = url.replace("yhttp","http");

  if (url1 != url) { window.open(url1,"_blank"); }
    else { if (url2 != url) { location.href = url2 ; }
       else  { top.location.href = url ; } }
}
//-->
</script>
</HEAD>
<BODY>
<TABLE WIDTH="100%" HEIGHT="98%" BORDER="0" CELLSPACING="0" CELLPADDING="0"><TR VALIGN="MIDDLE" ALIGN="CENTER"><TD>
<TABLE CLASS="infoTabelle" WIDTH="100%" CELLSPACING="0" CELLPADDING="6"><TR>
<TD>&nbsp;</TD>
<TD><FONT SIZE="+1"><b>$kategoriename</b></FONT> &nbsp;&nbsp; $nr&nbsp;$text_1</TD>
<TD>&nbsp;</TD></TR></TABLE>

$thumbnails

<form name="form1">
<TABLE CLASS="infoTabelle" WIDTH="100%" BORDER="0" CELLSPACING="0" CELLPADDING="6"><TR>
<TD ALIGN="CENTER"><b>$kategoriename</b> &nbsp;$nr $text_1</TD>
</TR>
</TABLE>
<TABLE CLASS="infounten" WIDTH="100%" CELLSPACING="0" CELLPADDING="0"><TR VALIGN="MIDDLE" ALIGN="CENTER">
<TD>
<DIV ALIGN="CENTER">
<select name="menu1" onChange="jumping(this.form.menu1.options[this.form.menu1.options.selectedIndex].value)"  valign="middle">
<option value="nothing" selected STYLE="background-color : 0099cc">Links:</option>
$selectbox
</select> &nbsp;  &nbsp;  &nbsp; 
<script type="text/javascript">
<!--
function bookmark_this_page() { window.external.AddFavorite(location.href, document.title); }
if (document.all) {
var email_link = "<a href=\"mailto:?subject=$text_4&amp;body=" + window.location.href + "\" title=\"$text_6\">$text_8</a> &nbsp; ";
document.write("<a href=\"javascript:bookmark_this_page()\" title=\"$text_10\">$text_9</a> &nbsp; ");
document.write(email_link); }
// -->
</SCRIPT>
<A HREF="$home" TARGET="_top" title="$home">$text_13</A></DIV></TD>
</TR></TABLE>
</form>
</TD></TR></TABLE>
</BODY>
</HTML>
EOT;

$thp = fopen($hauptseite,"wb");
if ($thp) { fputs($thp,$thumbnail_page); fclose($thp); echo "Link HTML-Code:<br><font size=1>(falls URL korrekt erkannt wurde / only if your url was recognized correctly) </font><br><TEXTAREA NAME=\"textfield\" COLS=\"77\" ROWS=\"3\"> &lt;A HREF=&quot;$hauptseite_abs&quot;&gt;$kategoriename &lt;/A&gt; </TEXTAREA><br>Your Thumbnails / Ihre Thumbnailseite: \n <b><a href=$hauptseite target=_blank>$hauptseite</a></b><br>Single picture pages / Einzelbildseiten:<br>\n"; chmod ($hauptseite, 0775);}
 else { echo " $i: Achtung - <a href=$hauptseite target=_blank>$hauptseite</a> wurde nicht erstellt, bzw ver&auml;ndert. <FONT SIZE=\"1\" COLOR=\"666666\"> Achtung, Dies kann ein Hinweis darauf sein, dass auf Ihrem Server die Schreib-Rechte nicht wie in der normalen Standardkonfiguration vergeben sind.                                                             (ein paar wenige Provider sind aus Sicherheitsgr&uuml;nden sehr geizig beim Vergeben von Schreibrechten) Wenn Sie eine &Auml;nderung m&ouml;chten k&ouml;nnen Sie sich behelfen indem Sie die betreffende Datei l&ouml;schen, damit diese vom Script neu erstellt werden kann. Sollte auch eine L&ouml;schung von Hand nicht möglich sein, wenden Sie sich bitte an Ihren Webspace-Provider damit dieser Ihnen die erforderlichen Rechte zuweist.</font><br>Warning: Your thumbnailpage could not be created. Maybe your server does not allow to save or change htm pages. In this case the script will not work.<br>\n";}

$BH = 66 ; // Bildhöhe für das kleine Vorschaubildchen auf der Einzelbildseite. Stellen Sie hier Ihre Wunsch BH-Größe ein.

for($i = 1;$i <= $nr ;$i++) {
  $bild = $biname[$i];
  $bilderseite = $bnn[$bild] . ".htm" ;
  $nex = $i+1;
  $pre = $i-1;
  if ($i == $nr) { $nex = 1 ; }
  if ($i == 1) { $pre = $nr ; }

if ($color_inside1 == ""){ $color_inside = create_random_color() ; }  

  if ( $language == "de" ) { $selectbox_all = $selectbox . '<option value="nothing"> - - - - - - - -</option><option value="xhttp://www.bilder-fotos-poster.de/poster-suche.php?suchwort='.$suchwort[$bild].'">Postersuche nach '.$suchwort[$bild].'</option><option value="xhttp://www.buechersuchseite.de/index.php?Suche_nach='.$suchwort[$bild].'&index=blended">B&uuml;chersuche nach '.$suchwort[$bild].'</option><option value="xhttp://partners.webmasterplan.com/click.asp?site=1382&ref=89063&type=text&tnb=0&diurl=http://adfarm.mediaplex.com/ad/ck/707-3922-3266-0?RedirectEnter&partner=25910&loc=http://search.ebay.de/search/search.dll%3f%26query='.$suchwort[$bild].'">Suche bei Ebay nach '.$suchwort[$bild].'</option>'; $wyp = '<option value="xhttp://www.superphotos.info/">webYourPhotos</option>' ;}
       else  { $selectbox_all = $selectbox . '<option value="nothing"> - - - - - - - -</option><option value="xhttp://www.postershop.com/suchergebnis.html?Partnerid=4204&TSCHLAGWORT='.$suchwort[$bild].'&operation=Schnellsuche">Postersearch for '.$suchwort[$bild].'</option><option value="xhttp://www.amazon.com/exec/obidos/external-search?mode=books&keyword='.$suchwort[$bild].'&tag=newbooks-20">search Amazon for '.$suchwort[$bild].'</option><option value="xhttp://affiliates.allposters.com/link/redirect.asp?aid=800197&search='.$suchwort[$bild].'">Poster search for '.$suchwort[$bild].'</option>'; $wyp = '<option value="xhttp://www.webyourphotos.info/">webYourPhotos</option>' ;}
  if ( $language == "fr" ) { $selectbox_all = $selectbox . '<option value="nothing"> - - - - - - - -</option><option value="xhttp://www.postershop-france.com/suchergebnis.html?Partnerid=4204&TSCHLAGWORT='.$suchwort[$bild].'&operation=Schnellsuche">Poster Recherche à '.$suchwort[$bild].'</option><option value="xhttp://www.amazon.fr/exec/obidos/external-search?tag=photoinfo-21&keyword='.$suchwort[$bild].'&mode=blended">Amazon: recherche sur '.$suchwort[$bild].'</option>'; $wyp = '<option value="xhttp://www.webyourphotos.info/francais.htm">webYourPhotos</option>' ;}
  if ($te!=2) {$wyp = "";}
  $selectbox_all = $fotokasten_optionsfeld1[$bild] . $fotokasten_optionsfeld2[$bild] . $selectbox_all . $wyp ;
  $next_orginal = $biname[$nex];
  if ($thm_exists[$next_orginal] == 1) { $next_orginal = "thm_" . $next_orginal;}
 $w = round($th_wi[$biname[$pre]]/$th_hi[$biname[$pre]]*$BH); $w_td1= $w + 6 ;

 $prevbild = "<a href=\"" . $bnn[$biname[$pre]] . ".htm\"><img align=\"right\" SRC=\"th_" . $biname[$pre] . "\" width=\"$w\" height=\"".$BH."\" BORDER=\"0\" title=\"" . $btitle[$biname[$pre]] . "\"></a>" ;
 if ($i > 1) {
  $prev = $text_18 . ":<br><a href=\"" . $bnn[$biname[$i-1]] . ".htm\" title=\"" . $btitle[$biname[$i-1]] . "\" CLASS=\"hohelinie\">" . $bnoz[$biname[$i-1]] . "</a>" ;
  $prev1 = "<a href=\"" . $bnn[$biname[$i-1]] . ".htm\" title=\"" . $text_18 . ": \n" . $btitle[$biname[$i-1]] . "\">&lt;==</a>" ;}
 else {
  $prev = $text_19 . ":<br><a href=\"" . $bnn[$biname[$nr]] . ".htm\" title=\"" . $btitle[$biname[$nr]] . "\" CLASS=\"hohelinie\">" . $bnoz[$biname[$nr]] . "</a>";
  $prev1 = " ";}

 $w = round($th_wi[$biname[$nex]]/$th_hi[$biname[$nex]]*$BH); $w_td= $w + 6 ;
 $nextbild = "<a href=\"" . $bnn[$biname[$nex]] . ".htm\"><img align=\"right\" SRC=\"th_" . $biname[$nex] . "\" width=\"$w\" height=\"".$BH."\" BORDER=\"0\" title=\"" . $btitle[$biname[$nex]] . "\"></a>" ;
 if ($i < $nr) {
  $next = $text_20 . ":<br><a href=\"" . $bnn[$biname[$i+1]] . ".htm\" title=\"" . $btitle[$biname[$i+1]] . "\" CLASS=\"hohelinie\">" . $bnoz[$biname[$i+1]] . "</a>" ;
  $next1 = "<a href=\"" . $bnn[$biname[$i+1]] . ".htm\" title=\"" . $text_20 . ": \n" . $btitle[$biname[$i+1]] . "\">==&gt;</a>" ;}
 else {
  $next = $text_21 . ":<br><a href=\"" . $bnn[$biname[1]] . ".htm\" title=\"" . $btitle[$biname[1]] . "\" CLASS=\"hohelinie\">" . $bnoz[$biname[1]] . "</a>";
  $next1 = " ";}
  
  
if ($thm_exists[$bild] == 1) { $main_pic = '<a href="javascript:Bild_ganz_gross_in_neuem_Fenster()" CLASS="netscape"><img SRC="thm_' . $bild . '" ' . $tagstm[$bild] . ' TITLE="' . $btitle[$bild] . '" BORDER="0" VSPACE="9"></a>' ;
  $main_pic_text = '<center><br><a href="javascript:Bild_ganz_gross_in_neuem_Fenster()" title="' . $text_22 . '">' . $text_23 . '</a><br>' . $fotokasten_link1[$bild] . $fotokasten_link2[$bild] . '</center>' ;}
else { $main_pic = '<img SRC="' . $bild . '" ' . $tags[$bild] . ' TITLE="' . $btitle[$bild] . '" BORDER="0" VSPACE="9">' ; $main_pic_text = '<center>'. $fotokasten_link1[$bild] . $fotokasten_link2[$bild] . '</center>';}

if (($hi[$bild]+10)<$wi[$bild]) {$width = $wi[$bild] + 24 ;}
 else {$width = $wi[$bild] + 48 ; }
// start of html-code for the singe picture pages / hier beginnt der html code der Einzelbildseiten.

$single_picture_page = <<<EOT
<HTML>
<HEAD>
<title>Bild: $bn[$bild] - $text_3 $kategoriename</title>
<meta NAME="description" CONTENT="$metadesc[$bild].">
<meta NAME="keywords" CONTENT="$keywords[$bild]">
<meta NAME="Author" CONTENT="$your_name">
<meta NAME="copyright" CONTENT="$your_name">
<meta NAME="generator" CONTENT="webYourPhotos $version $lizens $lang">
<meta NAME="robots" CONTENT="index, follow">
<meta name="date" content="$zeit">
$css_styles
<script language="JavaScript" type="text/JavaScript">
<!--
// url with x: opens in new window
// url with y: opens in same frame

function jumping(url) {
 if(url == "nothing") { document.forms[0].reset(); document.forms[0].elements[0].blur(); return; }
 if(url == "fototransfer") { fototransfer(); return; }
 if(url == "opedo") { opedo(); return; }
 var xyz = url.slice(0,1);
 if (xyz == "x") {var url1 = url.replace("xhttp","http"); window.open(url1,"_blank");  return; }
 if (xyz == "y") {var url2 = url.replace("yhttp","http"); location.href = url2 ;  return; }
top.location.href = url ; 
}

function Bild_ganz_gross_in_neuem_Fenster() { window.open("$bild", "_blank", "status=no,toolbar=no,menubar=no,resizable=yes,scrollbars=yes"); }
$fotokasten_JS1[$bild]
$fotokasten_JS2[$bild]
//-->
</script>
</HEAD>
<BODY>
<form name="form1">
<TABLE WIDTH="100%" HEIGHT="98%" BORDER="0" CELLSPACING="0" CELLPADDING="0"><TR VALIGN="MIDDLE" ALIGN="CENTER"><TD>
<TABLE CLASS="infoTabelle" WIDTH="100%" CELLSPACING="0" CELLPADDING="6"><TR>
<TD WIDTH="32%" ALIGN="CENTER"><a HREF="$hauptseite" TITLE="$text_15">$kategoriename</a>  &nbsp; $text_16&nbsp;$i&nbsp;$text_17&nbsp;$nr</TD>
<TD WIDTH="36%" ALIGN="CENTER"><FONT SIZE="+1"><b>$bnoz[$bild]</b></font></TD>
<TD WIDTH="32%" ALIGN="CENTER">$prev1&nbsp; $next1</TD>
</TR></TABLE>
<DIV ALIGN="CENTER"> $main_pic </DIV>
<TABLE CLASS="infoTabelle" WIDTH="100%" CELLSPACING="0" CELLPADDING="6"><TR>
<TD VALIGN="BOTTOM" WIDTH="$w_td1">$prevbild</TD>
<TD VALIGN="BOTTOM" ALIGN="LEFT" WIDTH="17%">$prev</TD>
<TD VALIGN="MIDDLE" ALIGN="CENTER">
<TABLE CLASS="innereTabelle" CELLSPACING="4"><TR>
<TD WIDTH="21">&nbsp;</TD>
<TD><B>$bnoz[$bild]</B><BR> $bb[$bild] $main_pic_text</TD>
<TD WIDTH="21">&nbsp;</TD>
</TR></TABLE>
</TD>
<TD VALIGN="BOTTOM" ALIGN="RIGHT" WIDTH="17%">$next</TD>
<TD VALIGN="BOTTOM" WIDTH="$w_td">$nextbild</TD>
</TR></TABLE>
<TABLE CLASS="infounten" WIDTH="100%" CELLSPACING="0" CELLPADDING="0"><TR>
<TD WIDTH="30%" align="center" valign="middle">
</TD>
<TD ALIGN="CENTER">
<script type="text/javascript">
<!--
function bookmark_this_page() { window.external.AddFavorite(location.href, document.title); }
if (document.all) {
var email_link = "<a href=\"mailto:?subject=$text_5&amp;body=" + window.location.href + "\" title=\"$text_7\">$text_8</a> &nbsp; ";
document.write("<a href=\"javascript:bookmark_this_page()\" title=\"$text_11\">$text_9</a> &nbsp; ");
document.write(email_link); }
// -->
</SCRIPT>
<a HREF="$home" TARGET="_top" TITLE="$home">$text_13</a></TD>
<TD WIDTH="30%" ALIGN="RIGHT">$text_12: <A HREF="$hauptseite" TITLE="$text_12">$kategoriename</A>&nbsp;&nbsp;&nbsp;</TD>
</TR></TABLE>
</TD></TR></TABLE>
<img SRC="$next_orginal" width="1" height="1" BORDER="0">

</form>
</BODY>
</HTML>
EOT;

  $sp = fopen($bilderseite,"wb");
  if ($sp) { fputs($sp,$single_picture_page); fclose($sp); echo " $i Neu erstellt: <a href=$bilderseite target=_blank>$bilderseite</a><br>\n"; chmod ($bilderseite, 0775);}
  else { echo " $i: Achtung - <a href=$bilderseite target=_blank>$bilderseite</a> wurde nicht erstellt, bzw ver&auml;ndert. <FONT SIZE=\"1\" COLOR=\"666666\"> Achtung, Dies kann ein Hinweis darauf sein, dass auf Ihrem Server die Schreib-Rechte nicht wie in der normalen Standardkonfiguration vergeben sind. (ein paar wenige Provider sind aus Sicherheitsgr&uuml;nden sehr geizig beim Vergeben von Schreibrechten) Wenn Sie eine &Auml;nderung m&ouml;chten k&ouml;nnen Sie sich behelfen indem Sie die betreffende Datei l&ouml;schen, damit diese vom Script neu erstellt werden kann. Sollte auch eine L&ouml;schung von Hand nicht möglich sein, wenden Sie sich bitte an Ihren Webspace-Provider damit dieser Ihnen die erforderlichen Rechte zuweist.</font><br>Warning: $bilderseite could not be created. Maybe your server does not allow to save or change htm pages. In this case the script will not work.<br>\n";} 
}

if ($ist_drin == 0){ $fp = @fopen($links_to_all_gallerys,"wb"); if ($fp) { fputs($fp,$all_gallery);  fclose($fp);  chmod ($links_to_all_gallerys, 0777); echo "<br>Ihre Links zu den einzelnen Galerien / your gallery links: <a HREF=\"../links_to_all_gallerys.txt\" TARGET=_blank>links_to_all_gallerys.txt</a> (for the dropdown menue)<br>" ; } }
foreach ($allpics as $bild) { check_pic_name($bild); }
$regi = "fertig / end";
echo "Your description file: <a HREF=$description TARGET=_blank>$description</a><br>" ;
echo '<TABLE WIDTH="100%" BORDER="1" CELLSPACING="0" CELLPADDING="9" bgcolor="#E9E9E9">
  <TR valign="top"> 
    <TD><FONT SIZE="2" face="Tahoma"><img src="http://www.superphotos.info/bilder/webYourPhotos.gif" width="290" height="40"><br>
      <font face="Verdana, Arial, Helvetica, sans-serif">webYourPhotos-Links:</font></FONT> 
      <ul>
        <li> 
          <div align="left"><FONT SIZE="2" face="Verdana, Arial, Helvetica, sans-serif"> 
            <a href="http://www.superphotos.info/webYourPhotos.htm">webYourPhotos</a>
            </FONT></div>
        </li>
        <li> 
          <div align="left"><FONT SIZE="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="http://www.superphotos.info/tipps.htm"> 
            weitere Tipps und Infos</a> </FONT></div>
        </li>
        <li> 
          <div align="left"><FONT SIZE="2" face="Verdana, Arial, Helvetica, sans-serif"><b>
            <a href="http://superphotos.info/forum/viewforum.php?f=2">Support 
            Forum</a></b><br>
			<script language="javascript" type="text/javascript" src="http://www.superphotos.info/forum.txt"></script>
			</FONT></div>
        </li>
        <li> 
          <div align="left"><FONT SIZE="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="http://www.superphotos.info/photo_topliste/">PHOTO 
            TOP99 Topliste</a> </FONT></div>
        </li>
      </ul>
    </TD>
    <TD><FONT SIZE="2" face="Tahoma"> <br>
      <font face="Verdana, Arial, Helvetica, sans-serif">Werbe-Links:</font></FONT> 
      <ul>
        <li> 
          <div align="left"><FONT SIZE="2" face="Verdana, Arial, Helvetica, sans-serif"> 
            <A HREF="http://partners.webmasterplan.com/click.asp?ref=89063&site=2792&type=text&tnb=1" TARGET="_blank">Digitalland 
            - Alles für Ihre Digitalkamera</a> </FONT></div>
        </li>
        <li> 
          <div align="left"> 
            <div align="left"><font size="2" face="Verdana, Arial, Helvetica, sans-serif"><a href="http://www.dialerheaven.de/lay001/?pid=drn-10020" target="_top"> 
              Günstige Website-Templates per Dialer downloaden</a></font></div>
          </div>
        </li>
        <li> 
          <div align="left"><FONT SIZE="2" face="Verdana, Arial, Helvetica, sans-serif"><a href=http://partners.webmasterplan.com/click.asp?ref=89063&site=2558&type=text&tnb=4>Ihre 
            Bilder als Foto-Postkarte versenden - Fotokasten Partnerprogramm</a> 
            <font size="1">(Partner k&ouml;nnen einfach im config-file von webYourPhotos 
            einen direkten Link aktivieren, &uuml;ber den dann User die Foto-Postkarte 
            oder anderes bestellen k&ouml;nnen)</font></FONT></div>
        </li>
        <li> 
          <div align="left"><FONT SIZE="2" face="Verdana, Arial, Helvetica, sans-serif"> 
            Affiliate -Partnerprogramme finden Sie zb bei <a href="http://ui.zanox-affiliate.de/bin/z_ct_trc.dll?36075C976852081" target="_blank">zanox</a>, 
            <a href="http://www.affili.net/" target="_blank">affili.net</a>, <a href="http://james.adbutler.de/click.php?pid=91&tid=25174&bid=123" target="_blank" title="Geld verdienen mit der eigenen Homepage!">Adbuttler</a> 
            und <a href="http://clix.superclix.de/cgi-bin/tclix.cgi?id=leichteinfo&pp=1&linknr=1&page=http://clix.superclix.de/cgi-bin/ppsignup.cgi?pp=973" target="_blank">Superclix</a>. 
            </FONT></div>
        </li>
        <li> 
          <div align="left"><FONT SIZE="2" face="Verdana, Arial, Helvetica, sans-serif"> 
            vielleicht ist auch das Flirt Partnerprogramm von <a href="http://www.lovealizer.de/partner/?ref=1716">Lovealizer.de</a> 
            für Ihre Webseite interessant.<font size="1"> ( &Ouml;sterreich: <a href="http://www.lovealizer.at/partner/?ref=65">Lovealizer.at)</a></font></FONT></div>
        </li>
        <li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">oder das 
          Partnerprogramm von <a href="http://www.Partner-Versicherung.de/?pr=16209">TarifCheck24</a></font><br>
        </li>
		<li><font size="2" face="Verdana, Arial, Helvetica, sans-serif">oder das 
          Partnerprogramm von <a href="http://www.bankingportal24.de/?ref=22" target="_blank"> Bankingportal24 (Geld und Kontovergleiche - startet in Kürze..) <img src="http://www.bankingportal24.de/banner/bp88x31_4.gif" border="0" alt="banking.portal24"></a></font><br>
        </li>
      </ul>
    </TD></TR></TABLE>
</BODY></HTML>' ;


// ------------------------------------------------------------------------------------------------------
// die Funktionen:



function create_random_color() { 
  $var = array("6", "7", "8", "9", "A", "B", "C", "D", "E", "F"); // to avoid dark colors "0", "1", "2", "3", "4", "5", are not used
  $rand_var = array_rand($var, 6);
  $color_inside = $var[$rand_var[0]] . $var[$rand_var[1]] . $var[$rand_var[2]] . $var[$rand_var[3]] . $var[$rand_var[4]] . $var[$rand_var[5]] ;
  return $color_inside ; }

function create_corners($color_outside,$color_inside) {
    $color_outside = str_replace ("#","",$color_outside);
	if(strlen($color_outside)!=6) {echo "<br>Ihre Aussenfarbe $color_outside ist nicht korrekt eingetragen<br>";}
	$co1 = hexdec(substr($color_outside,0,2));
	$co2 = hexdec(substr($color_outside,2,2));
	$co3 = hexdec(substr($color_outside,4,2));
	$co4 = 224 ; 	$co5 = 224 ;	$co6 = 224 ;
	if ($color_inside!=""){  $color_inside = str_replace ("#","",$color_inside);
	if(strlen($color_inside)!=6) {echo "<br>Ihre Innenfarbe $color_inside ist nicht korrekt eingetragen<br>";}
	$co4 = hexdec(substr($color_inside,0,2));
	$co5 = hexdec(substr($color_inside,2,2));
	$co6 = hexdec(substr($color_inside,4,2)); }
	
	$im = imagecreate(12,12);
	$farbe_a=imagecolorallocate($im,$co1,$co2,$co3);
	$farbe_b=imagecolorallocate($im,$co4,$co5,$co6);
	imagecolortransparent($im,$farbe_b);  // die erstellten ecken sind innen transparent - es scheint also immer die Tabellenfarbe durch. Bei Verwendung einer Hintergrundgrafik hier bitte imagecolortransparent($im,$farbe_a); verwenden - bei allen 4 ecken.
	imagefill($im,0,0,$farbe_a);
	$mess_p = array(11,11,1,11,1,9,2,8,2,6,6,2,8,2,9,1,11,1);
	imagefilledpolygon($im, $mess_p, 9 , $farbe_b);
	imagepng($im,"ecke_wyp1.png");
	imagedestroy($im);
	chmod ("ecke_wyp1.png", 0775);
	
	$im = imagecreate(12,12);
	$farbe_a=imagecolorallocate($im,$co1,$co2,$co3);
	$farbe_b=imagecolorallocate($im,$co4,$co5,$co6);
	imagecolortransparent($im,$farbe_b);
	imagefill($im,0,0,$farbe_a);
	$mess_p = array(0,1,2,1,3,2,5,2,9,6,9,8,10,9,10,11,0,11);
	imagefilledpolygon($im, $mess_p, 9 , $farbe_b);
	imagepng($im,"ecke_wyp2.png");
	imagedestroy($im);
	chmod ("ecke_wyp2.png", 0775);
	
	$im = imagecreate(12,12);
	$farbe_a=imagecolorallocate($im,$co1,$co2,$co3);
	$farbe_b=imagecolorallocate($im,$co4,$co5,$co6);
	imagecolortransparent($im,$farbe_b);
	imagefill($im,0,0,$farbe_a);
	$mess_p = array(0,0,10,0,10,2,9,3,9,5,5,9,3,9,2,10,0,10);
	imagefilledpolygon($im, $mess_p, 9 , $farbe_b);
	imagepng($im,"ecke_wyp3.png");
	imagedestroy($im);
	chmod ("ecke_wyp3.png", 0775);
	
	$im = imagecreate(12,12);
	$farbe_a=imagecolorallocate($im,$co1,$co2,$co3);
	$farbe_b=imagecolorallocate($im,$co4,$co5,$co6);
	imagecolortransparent($im,$farbe_b);
	imagefill($im,0,0,$farbe_a);
	$mess_p = array(11,0,11,10,9,10,8,9,6,9,2,5,2,3,1,2,1,0);
	imagefilledpolygon($im, $mess_p, 9 , $farbe_b);
	imagepng($im,"ecke_wyp4.png");
	imagedestroy($im); 
	chmod ("ecke_wyp4.png", 0775);}

function umlaute($text)
{ if ($language== "de") {
  $text = str_replace ("Ä","&Auml;",$text)  ;
  $text = str_replace ("Ü","&Uuml;",$text)  ;
  $text = str_replace ("Ö","&Ouml;",$text)  ;
  $text = str_replace ("ä","&auml;",$text)  ;
  $text = str_replace ("ö","&ouml;",$text)  ;
  $text = str_replace ("ü","&uuml;",$text)  ;
  $text = str_replace ("ß","&szlig;",$text) ; }
 if (!(preg_match ("/(<br>)|(<p)|(<i)|(<b)|(<font)|(<a)/i", $text )))
  { $text = str_replace ("<","&lt;",$text) ;
    $text = str_replace (">","&gt;",$text) ;
    $text = str_replace ("\"","&quot;",$text) ;}
  return $text ; }

function umlaute2($text)
{ if ($language== "de") {
  $text = str_replace ("Ae","&Auml;",$text) ;
  $text = str_replace ("Ue","&Uuml;",$text) ;
  $text = str_replace ("Oe","&Ouml;",$text) ;
  $text = str_replace ("ae","&auml;",$text) ;
  $text = str_replace ("oe","&ouml;",$text) ;
  $text = str_replace ("ue","&uuml;",$text) ; }
  return $text ; }
  
function check_pic_name($bild)
{ $bild_better_name = $bild ;
  $old = array("ä","ü","ö","Ä","Ü","Ö","ß",'"',"'","/","?","!","é"," ","%","&","$","§","€","(",")","[","]","{","}","#",";",":","<",">","|","è","ê",",");
  $new = array("ae","ue","oe","Ae","Ue","Oe","ss","_","_","_","_","_","e","_","_","_","Dollar","_","Euro","_","_","_","_","_","_","_","_","_","_","_","_","e","e","_");
  for($x=0;$x<34;$x++){ $bild_better_name = str_replace($old[$x],$new[$x],$bild_better_name); }
if ( $bild_better_name != $bild ) { echo "<b>Achtung: <font color=FF0000>$bild</font> ist not a valid file name</b> Please rename it to $bild_better_name <br>" ; 
// if(rename($bild,$bild_better_name)) { echo "$bild wurde umbenannt in $bild_better_name<br>"; } // aktivieren sie diese zeile, um das script die Bilder umbenennen zu lassen (Script 2x aufrufen)
} }

?>