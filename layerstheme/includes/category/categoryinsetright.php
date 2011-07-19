<?php // Visual Design Copyright (C) 2010 pixelthemestudio.ca - All Rights Reserved. license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html> ?>
<div id="main-ir">
		<h1 class="page-title"><?php printf( __( '%s', 'pts' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
			<?php $category_description = category_description(); 
			if ( ! empty( $category_description ) )
			echo '<div class="archive-meta">' . $category_description . '</div>';
			get_template_part( 'loop', 'category' );
?>
</div>	
<div id="inset">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog Inset Column')) : ?>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum a justo quam, eu mattis velit. Cras ac dolor ac mi placerat vulputate. Proin bibendum tristique sagittis. Aliquam diam leo, tempus sed aliquet vel, tincidunt vel ligula. Phasellus magna enim, feugiat non condimentum quis, interdum vitae nisi. Vivamus eros nisl, dignissim vel scelerisque nec, laoreet eu mauris.
        <?php endif; ?>
</div>

<div id="right">
        <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog Right Column')) : ?>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum a justo quam, eu mattis velit. Cras ac dolor ac mi placerat vulputate. Proin bibendum tristique sagittis. Aliquam diam leo, tempus sed aliquet vel, tincidunt vel ligula. Phasellus magna enim, feugiat non condimentum quis, interdum vitae nisi. Vivamus eros nisl, dignissim vel scelerisque nec, laoreet eu mauris.
        <?php endif; ?>
</div>