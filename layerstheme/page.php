<?php
// Visual Design Copyright (C) 2010 pixelthemestudio.ca - All Rights Reserved. license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html>
// Get theme settings
include (TEMPLATEPATH . "/includes/settings.php");
get_header(); 
?>

<div id="main">
		<?php get_template_part( 'page-content' ); ?>
</div>

<?php get_footer(); ?>