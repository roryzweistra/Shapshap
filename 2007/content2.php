<?php

include_once("incs/config.inc.php");

mysql_connect("$host","$user","$password");
mysql_select_db("$db");

$ln = $_GET['ln'];
$type = $_GET['type'];

if($ln=="nl" OR $ln=="") {
	$error = "Er is geen tekst in de database gevonden";
}
else {
	$error = "No text found in the database";
}

if($type=="") {
	$query = "SELECT content_text FROM content WHERE content_type = 'home' AND content_language = 'nl'";
}
elseif($type=="" AND $ln=="en") {
	$query = "SELECT content_text FROM content WHERE content_type = 'home' AND content_language = 'en'";
}
else {
	
	if($type=="accomodatedtours" OR $type=="campingtours") {
		$query = "SELECT content_text FROM content WHERE content_name = '$type' AND content_language = '$ln'";
	}
	else {
		$query = "SELECT content_text FROM content WHERE content_type = '$type' AND content_language = '$ln'";
	}
}

$result = mysql_query($query);

if(mysql_num_rows($result)) {
	while($obj = mysql_fetch_object($result)) {
		echo "
			$obj->content_text
		";
	}
}
else {
	echo "
		$error
	";
}
?>