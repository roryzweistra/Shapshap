<?php // Visual Design Copyright (C) 2010 pixelthemestudio.ca - All Rights Reserved. license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html> ?>

<div id="main">
		<h1 class="page-title"><?php printf( __( '%s', 'pts' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>
			<?php $category_description = category_description(); 
			if ( ! empty( $category_description ) )
			echo '<div class="archive-meta">' . $category_description . '</div>';
			get_template_part( 'loop', 'category' );
?>
</div>