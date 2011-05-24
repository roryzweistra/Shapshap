<html>
<head>
<title></title>
</head>

<body>
Hieronder de recentste toevoegingen aan het gastenboek.
<br>
<br>
<?php
include("../incs/config.inc.php");
mysql_connect("$host","$user","$password");
mysql_select_db("$db");
$query = "SELECT * FROM guestbook WHERE gb_online != '1' ORDER BY id DESC";
$result = mysql_query($query);
if(mysql_num_rows($result)){
	while($row = mysql_fetch_row($result))	{ 
	
	print "$row[0]<table width='600' border='1' bordercolor='#9999FF'><th bgcolor='#9999FF' align='left'>$row[1]</th><tr><td width='400' valign='top'>$row[2]</td></tr>
	<tr><td><form method='post' action='activate_guestbook.php'><input type='hidden' value='$row[0]' name='gb_id'><input type='submit' value='Activeren'></form></td>
	<td><form action='delete_guestbook.php' method='post'><input type='hidden' value='$row[0]' name='gb_id'><input type='submit' value='Verwijderen'></form></td></tr></table><br>";
	}
}
else
{
print "Geen berichten gevonden";
}
?>
</body>
</html>