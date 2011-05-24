<?php
include_once("../incs/config.inc.php");

$id = $_POST['content_id'];
$name = $_POST['content_name'];
$type = $_POST['content_type'];
$owner = $_POST['content_owner'];
$language = $_POST['content_language'];
$text = $_POST['content_text'];


mysql_connect("$host", "$user", "$password");
mysql_select_db("$db");

$query = "UPDATE content SET content_name='$name', content_type='$type', content_owner='$owner', content_language='$language', content_text='$text' WHERE content_id='$id'";

mysql_query($query);

header("location: http://www.shapshap.nl/inkozi/show_content.php");
?>