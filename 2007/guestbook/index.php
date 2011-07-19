<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Guestbook</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>

<?php echo $ln_gb_welcome; ?>
<br>
<?php echo $ln_gb_newmessage; ?>
<br>
<br>
<?php
include("../incs/config.inc.php");
include("navigation.php");
mysql_connect("$host","$user","$password");
mysql_select_db("$db");
$query = "SELECT * FROM guestbook WHERE gb_online != 0 ORDER BY id DESC";
$result = mysql_query($query);
if(mysql_num_rows($result)){
	while($row = mysql_fetch_row($result))	{ 
	
	echo "
		<table>
		<th>
			$row[1]
		</th>
			<tr>
				<td>
					$row[2]
				</td>
			</tr>
		</table>
		<br />";
	}
}
else
{
print $ln_gb_nomessages;
}
?>
</body>
</html>