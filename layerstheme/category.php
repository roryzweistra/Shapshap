<?php
// Visual Design Copyright (C) 2010 pixelthemestudio.ca - All Rights Reserved. license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html>
// Get theme settings
include (TEMPLATEPATH . "/includes/settings.php");
get_header(); 
?>

<?php
switch ($pts_categorylayout) {
	case "Category Right":
		include (TEMPLATEPATH . "/includes/category/categoryright.php");
		break;
	case "Category Left":
		include (TEMPLATEPATH . "/includes/category/categoryleft.php");
		break;
	case "Category Inset Right":
		include (TEMPLATEPATH . "/includes/category/categoryinsetright.php");
		break;
	case "Category Wide":
		include (TEMPLATEPATH . "/includes/category/categorywide.php");
		break;
}
?>

<?php get_footer(); ?>