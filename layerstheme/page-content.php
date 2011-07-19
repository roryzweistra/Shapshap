<?php // Visual Design Copyright (C) 2010 pixelthemestudio.ca - All Rights Reserved. license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html> ?>


<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'pts' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'pts' ), '<span class="edit-link">', '</span>' ); ?>
						
					<div class="clearfix">
	<a href="javascript:javascript:history.go(-1)" class="back">Return to Previous Page</a>
</div><br />

</div><!-- .entry-content -->
				</div><!-- #post-## -->

	<?php comments_template( '', true ); ?>

<?php endwhile; ?>	
	
	