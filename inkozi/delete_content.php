<?php
//Connect to database
include("../incs/config.inc.php");
mysql_connect("$host", "$user", "$password");
mysql_select_db("$db");

$id = $_GET['id'];

//Building the query
$query = "DELETE FROM content WHERE content_id = '$id' LIMIT 1";

mysql_query($query);

header("location: http://www.shapshap.nl/inkozi/show_content.php");
?>


 
