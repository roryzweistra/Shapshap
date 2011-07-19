<?php

$id = $_GET['id'];

$query = "DELETE FROM guestbook WHERE gb_id='$id'";
mysql_query($query);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Guestbook</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>


Het bericht is verwijderd.<br>

<br>
<br>
Klik <a href="index.php" target="_self">hier</a> om terug te gaan.
<br>
<br>
</body>
</html>