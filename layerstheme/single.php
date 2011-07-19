<?php
// Visual Design Copyright (C) 2010 pixelthemestudio.ca - All Rights Reserved. license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html>
// Get theme settings
include (TEMPLATEPATH . "/includes/settings.php");
get_header(); 
?>

<?php
switch ($pts_singlelayout) {
	case "Single Right":
		include (TEMPLATEPATH . "/includes/single/singleright.php");
		break;
	case "Single Left":
		include (TEMPLATEPATH . "/includes/single/singleleft.php");
		break;
	case "Single Inset Right":
		include (TEMPLATEPATH . "/includes/single/singleinsetright.php");
		break;
	case "Single Wide":
		include (TEMPLATEPATH . "/includes/single/singlewide.php");
		break;
}
?>

<?php get_footer(); ?>