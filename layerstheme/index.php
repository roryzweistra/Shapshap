<?php
// Visual Design Copyright (C) 2010 pixelthemestudio.ca - All Rights Reserved. license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html>
// Get theme settings
include (TEMPLATEPATH . "/includes/settings.php");
get_header();
 
?>

<!-- begin content -->
 <?php
switch ($pts_bloglayout) {
	case "Blog Right":
		include (TEMPLATEPATH . "/includes/blog/blogright.php");
		break;
	case "Blog Left":
		include (TEMPLATEPATH . "/includes/blog/blogleft.php");
		break;
	case "Blog Inset Right":
		include (TEMPLATEPATH . "/includes/blog/bloginsetright.php");
		break;
	case "Blog Wide":
		include (TEMPLATEPATH . "/includes/blog/blogwide.php");
		break;
}
?>
                
<?php get_footer(); ?>