<?php
//Connect to database
include("../incs/config.inc.php");
mysql_connect("$host", "$user", "$password");
mysql_select_db("$db");

$id = $_GET['id'];

//Building the query
$query = "SELECT * FROM content WHERE content_id = '$id'";

$result = mysql_query($query);

if(mysql_num_rows($result))
{
	while($obj = mysql_fetch_object($result))
	{
?>

		<form name="update_content" method="post" action="update_content.php">
			<input type="hidden" name="content_id" value="<?php echo $id; ?>" />
			<table>
				<tr>
					<td>
						Select the type of content:
					</td>
					<td>
						<select name="content_type">
							<option name="<?php echo "$obj->content_type"; ?>">
								<?php echo "$obj->content_type"; ?>
							</option>
							<option name="home">
								home
							</option>
				    			<option name="photograpytours">
								photographytours
							</option>
				    			<option name="extremetours">
								extremetours
							</option>
				    			<option name="overlandtours">
								overlandtours
							</option>
							<option name="tickets">
								tickets
							</option>
							<option name="indaba">
								indaba
							</option>
							<option name="faq">
								faq
							</option>
							<option name="about">
								about
							</option>
							<option name="contact">
								contact
							</option>
							<option name="savetheplanet">
								savetheplanet
							</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Enter a name for the content:
					</td>
					<td>
						<input type="text" name="content_name" value="<?php echo "$obj->content_name"; ?>" />
					</td>
				</tr>
				<tr>
					<td>
						Select Language:
					</td>
					<td>
						<select name="content_language">
							<option selected>
								<?php echo "$obj->content_language"; ?>
							</option>
							<option name="Dutch">
								NL
							</option>
							<option name="English">
								EN
							</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Select the owner of the content:
					</td>
					<td>
						<select name="content_owner">
							<option selected>
								<?php echo "$obj->content_owner"; ?>
							</option>
							<option name="lizza">
								Lizza Duijverman
							</option>
							<option name="japie">
								Japie van Deventer
							</option>
							<option name="rory">
								Rory Zweistra
							</option>
						</select>
					</td>
				</tr>
			</table>
			<br />
			<?php
			include("../fckeditor/fckeditor.php");
			$oFCKeditor = new FCKeditor('content_text');
			$oFCKeditor->Value = "$obj->content_text";
			$oFCKeditor->Height = 400;
			$oFCKeditor->Create();
			?>
		</form>
<?php
	}
}
?>


 
