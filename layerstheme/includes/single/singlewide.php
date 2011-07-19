<?php // Visual Design Copyright (C) 2010 pixelthemestudio.ca - All Rights Reserved. license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html> ?>


<div id="main">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h2 class="entry-title"><?php the_title(); ?></h2>

					<div class="entry-meta">
						<?php pts_posted_on(); ?><?php edit_post_link( __( 'Edit', 'pts' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-meta -->

					<div class="entry-content clearfix">
                    <?php the_post_thumbnail( 'single-post-thumbnail' ); ?>
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'pts' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->

<div class="clearfix">
	<a href="javascript:javascript:history.go(-1)" class="back">Return to Previous Page</a>
</div>
<div class="entry-utility">
				<?php if ( count( get_the_category() ) ) : ?>
					<span class="cat-links">
						<?php printf( __( '<span class="%1$s">Posted in: </span> %2$s', 'pts' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
					</span>
					
				<?php endif; ?>
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<span class="tag-links"> &#8226;
						<?php printf( __( '<span class="%1$s">Tagged: </span> %2$s', 'pts' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					</span>
				<?php endif; ?>
				
				
</div><!-- .entry-utility --> 
                    

                    
				</div><!-- #post-## -->

				

			
<?php comments_template( '', true ); ?>
<?php endwhile; // end of the loop. ?>
</div>