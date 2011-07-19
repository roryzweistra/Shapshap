<?php
include("../incs/database_backup_function.inc.php");

$content = datadump ("content");

$backup_content = $content;

$file_name = 'backup_' . date("d-m-Y-H-i-s") . '.sql';
//Header("Content-type: application/octet-stream");
//Header("Content-Disposition: attachment; filename=$file_name");
echo $backup_content;
exit;
?>