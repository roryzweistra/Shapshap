<?php
		
include_once("config.inc");

mysql_connect("$host","$user","$password");
mysql_select_db("$db");

$ln = $_GET['ln'];

if($ln=="nl" OR $ln=="")
{
	$error = "Er is geen tekst in de database gevonden";
}
else
{
	$error = "No text found in the database";
}

$query = "SELECT content_text FROM content WHERE content_type = '$type' AND content_language = '$ln'";

$result = mysql_query($query);

if(mysql_num_rows($result))
{
	while($obj = mysql_fetch_object($result)) 
	{
	
	echo "
		$obj->content_text
	";

	}
}
else
{

echo "
	$error
";

}

?>