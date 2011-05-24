<?php
//Connect to database
include("../incs/config.inc.php");
mysql_connect("$host", "$user", "$password");
mysql_select_db("$db");

//Building the query
$query = "SELECT
			content_id, content_name, content_language 
		FROM
			content
		ORDER BY
			content_language, content_name
		";

$result = mysql_query($query);

?>
<style type="text/css">
.show_content_table {
	margin: 0px auto;
	width: 600px;
	text-align: center;
	border: 3px solid #CCC;
}

th, td, tr {
	border: 1px solid #CCC;
}
</style>

<html>
<head>
	<title>
		Overzicht aanwezige content
	</title>
</head>

<body>

<table class='show_content_table'>
	<th>
		NAAM INHOUD:
	</th>
	<th>
		TAAL:
	</th>
	<th>
		WIJZIGEN:
	</th>
	<th>
		VERWIJDEREN:
	</th>
	<?php

	if(mysql_num_rows($result))
	{
		while($obj = mysql_fetch_object($result))
		{
			if($obj->content_language=="NL")
			{
				$country_flag = "nederlands.jpg";
			}
			elseif($obj->content_language=="EN")
			{
				$country_flag = "engels.jpg";
			}
			
			echo "
				<tr>
					<td align=\"center\">
						$obj->content_name
					</td>
					<td align=\"center\">
						<img src='/pics/$country_flag' alt='$obj->content_language' />
					</td>
					<td>
						<a href='edit_content.php?id=$obj->content_id'>
							<img src='/pics/edit.png' alt='Wijzigen' />
						</a>
					</td>
					<td>
						<a href='delete_content.php?id=$obj->content_id'>
							<img src='/pics/delete.png' alt='Verwijderen' />
						</a>
					</td>
				</tr>
			";
		}
	}
?>
</table>

</body>
</html>