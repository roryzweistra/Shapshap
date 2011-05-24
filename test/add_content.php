<?PHP
		$cfgProgDir =  '../admin/';
		include($cfgProgDir . "secure.php");

require_once("config.inc");

echo "
<link rel=\"stylesheet\" type=\"text/css\" href=\"style/style.css\" />

<link rel=\"stylesheet\" type=\"text/css\" href=\"style/orange.css\" />
";

mysql_connect("$host", "$user", "$password");
mysql_select_db("$db");

$dutchmonth_array = array(
      "januari", "februari", "maart", "april",
      "mei", "juni", "juli", "augustus", "september",
      "oktober", "november", "december");
  
$date = date("j ") . $dutchmonth_array[date("n") - 1] . date(" Y");
$time = date("H:i:s");

$date = $date . ", " . $time;

echo "$date";

//POST variabelen ophalen
$content_type = $_POST['content_type'];
$content_name = $_POST['content_name'];
$content_language = $_POST['content_language'];
$content_owner = $_POST['content_owner'];
$content_text = $_POST['content_text'];

$query = "INSERT INTO content (content_id, content_type, content_name, content_language, content_owner, content_date, content_text) VALUES ('NULL', '$content_type', '$content_name', '$content_language', '$content_owner', '$date', '$content_text')";

mysql_query("$query");

//SHOW NEW CONTENT

$new_id = mysql_insert_id();

$query = "SELECT content_text FROM content WHERE content_id = '$new_id'";

$result = mysql_query($query);

if(mysql_num_rows($result))
{
	while($obj = mysql_fetch_object($result)) 
	{
	
	echo "<div id='content'>
			<div id='column2'>
				$obj->content_text
			</div>
		</div>
	";

	}
}
?>

