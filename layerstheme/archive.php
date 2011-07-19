<?php
// Visual Design Copyright (C) 2010 pixelthemestudio.ca - All Rights Reserved. license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html>
// Get theme settings
include (TEMPLATEPATH . "/includes/settings.php");
get_header(); 
?>

<?php
switch ($pts_archivelayout) {
	case "Archive Right":
		include (TEMPLATEPATH . "/includes/archive/archiveright.php");
		break;
	case "Archive Left":
		include (TEMPLATEPATH . "/includes/archive/archiveleft.php");
		break;
	case "Archive Inset Right":
		include (TEMPLATEPATH . "/includes/archive/archiveinsetright.php");
		break;
	case "Archive Wide":
		include (TEMPLATEPATH . "/includes/archive/archivewide.php");
		break;
}
?>

<?php get_footer(); ?>