<?PHP
        $cfgProgDir =  '../admin/';
        include($cfgProgDir . "secure.php");
?>
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
    <option name="tours">tours</option>
    <option name="customtours">custom_tours</option>
    <option name="tickets">tickets</option>
    <option name="indaba">indaba</option>
    <option name="faq">faq</option>
    <option name="aboutus">about_us</option>
    <option name="contact">contact</option>
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
<?PHP
include("../fckeditor/fckeditor.php");
$oFCKeditor = new FCKeditor('content_text');
$oFCKeditor->Value = "Place your content here";
$oFCKeditor->Height = 400;
$oFCKeditor->Create();
?>
</form>
</body>
</html>