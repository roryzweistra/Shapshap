<?php

require_once("config.inc.php");
mysql_connect("$host", "$user", "$password");
mysql_select_db("$db");

function datadump ($table) {

    $result .= "# Dump of $table \n";
    $result .= "# Dump DATE : " . date("d-M-Y") ."\n\n";

    $query = mysql_query("select * from $table");
    $num_fields = @mysql_num_fields($query);
    $numrow = mysql_num_rows($query);

    for ($i =0; $i<$numrow; $i++) {
  $result .= "INSERT INTO ".$table." VALUES(";
    for($j=0; $j<$num_fields; $j++) {
    $row[$j] = addslashes($row[$j]);
    $row[$j] = ereg_replace("\n","\\n",$row[$j]);
    if (isset($row[$j])) $result .= "\"$row[$j]\"" ; else $result .= "\"\"";
    if ($j<($num_fields-1)) $result .= ",";
   }   
      $result .= ");\n";
     }
     return $result . "\n\n\n";
  }
?>