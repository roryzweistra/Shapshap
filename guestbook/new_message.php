<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Guestbook</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<?php echo $ln_gb_verify; ?>
<br>
<br>
<form action="add_message.php" method="post" name="voegtoe">
<table>
	<tr>
		<td width="200" valign="top" bgcolor="#9999FF">
			<b><?php echo $ln_gb_name; ?></b>
		</td>
		<td width="400" valign="top">
			<input name="gb_name" type="text" size="30" maxlength="30">
		</td>
	</tr>
	<tr>
		<td width="200" valign="top" bgcolor="#9999FF">
			<b><?php echo $ln_gb_message; ?></b>
		</td>
		<td width="400" valign="top">
			<textarea name="gb_message" cols="55" rows="6">
			</textarea>
		</td>
	</tr>
	<tr>
		<td width="200" valign="top" bgcolor="#9999FF">
			<input type="submit" name="submit" value="<?php echo $ln_gb_submit; ?>">
		</td>
		<td width="400" valign="top" bgcolor="#9999FF">
			<input type="reset" value="Reset">
		</td>
	</tr>
</table>
</form>
</body>
</html>