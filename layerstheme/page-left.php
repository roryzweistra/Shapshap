<?php
/* Template Name: Page - Left Column */
// Visual Design Copyright (C) 2010 pixelthemestudio.ca - All Rights Reserved. license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html>
// Get theme settings
include (TEMPLATEPATH . "/includes/settings.php");
get_header(); 
?>

<div id="left">        
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Page Left Column')) : ?>        
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum a justo quam, eu mattis velit. Cras ac dolor ac mi placerat vulputate. Proin bibendum tristique sagittis. Aliquam diam leo, tempus sed aliquet vel, tincidunt vel ligula. Phasellus magna enim, feugiat non condimentum quis, interdum vitae nisi. Vivamus eros nisl, dignissim vel scelerisque nec, laoreet eu mauris.		
		<?php endif; ?>
</div> 
<div id="main-l">
     <?php get_template_part( 'page-content' ); ?>
    </div>
    
<?php get_footer(); ?>