<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Guestbook</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php
require_once("../incs/config.inc.php");
mysql_connect("$host","$user","$password");
mysql_select_db("$db");
$query = "INSERT INTO guestbook (gb_id, gb_name, gb_message, gb_online) VALUES ('null', '$gb_name', '$gb_message', 'null')";
$result = mysql_query($query);

if($result)
{
	header("location: http://www.shapshap.nl");
}
else
{
	print $ln_gb_error;
}	
?>

</body>
</html>