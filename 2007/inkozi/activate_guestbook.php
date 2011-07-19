<?php
$id = $_GET['gb_id'];
$query = "UPDATE guestbook SET gb_online = '1' WHERE id='$id'";
mysql_query($query);

header("location: http://www.shapshap.nl");
?>
