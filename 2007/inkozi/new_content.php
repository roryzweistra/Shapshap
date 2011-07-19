<html>
<head>
<title>Add Content</title>
</head>

<body>
<form name="add_content" method="post" action="add_content.php">
	<table>
		<tr>
			<td>
				Select the type of content:
			</td>
			<td>
				<select name="content_type">
				    <option name="home">home</option>
				    <option name="photografytours">photographytours</option>
				    <option name="extremetours">extremetours</option>
				    <option name="overlandtours">overlandtours</option>
					<option name="accomodatedtours">accomodatedtours</option>
				    <option name="campingtours">campingtours</option>
				    <option name="tickets">tickets</option>
				    <option name="indaba">indaba</option>
				    <option name="faq">faq</option>
				    <option name="about">about</option>
				    <option name="contact">contact</option>
					<option name="savetheplanet">savetheplanet</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				Enter a name for the content:
			</td>
			<td>
				<input type="text" name="content_name" />
			</td>
		</tr>
		<tr>
			<td>
				Select Language:
			</td>
			<td>
				<select name="content_language">
					<option name="Dutch">NL</option>
					<option name="English">EN</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				Select the owner of the content:
			</td>
			<td>
				<select name="content_owner">
				    <option name="rory">Rory Zweistra</option>
				    <option name="japie">Japie van Deventer</option>
				    <option name="lizza">Lizza Duijverman</option>
				</select>
			</td>
		</tr>
	</table>
	<br />
	<?php
	include("../fckeditor/fckeditor.php");
	$oFCKeditor = new FCKeditor('content_text');
	$oFCKeditor->Value = "Place your content here";
	$oFCKeditor->Height = 400;
	$oFCKeditor->Create();
	?>
</form>
</body>
</html>