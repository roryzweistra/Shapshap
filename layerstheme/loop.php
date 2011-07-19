<?php
/**
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 * Modified by Pixel Theme Studio
 * @package WordPress
 */
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'pts' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'pts' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php // Start the Loop. ?>
<?php while ( have_posts() ) : the_post(); ?>


		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'pts' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
            

			<div class="entry-meta">
				<?php pts_posted_on(); ?>
                <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'pts' ), __( '1 Comment', 'pts' ), __( '% Comments', 'pts' ) ); ?></span>
			</div><!-- .entry-meta -->

	<?php if ( is_search() ) : // Only display excerpts for search. ?>
			<div class="entry-summary">
            
				<?php the_excerpt( __( 'Continue Reading', 'pts' ) ); ?>
			</div><!-- .entry-summary -->
	<?php else : ?>
    
			<div class="entry-content">
            <?php the_post_thumbnail(); ?>
            
				<?php the_content( __( 'Continue Reading', 'pts' ) ); ?>
             
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'pts' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
	<?php endif; ?>


		</div><!-- #post-## -->
<div class="clearfix"></div>
		<?php comments_template( '', true ); ?>

<?php endwhile; // End the loop. Whew. ?>

<!-- Post navigation -->
<?php pts_pagination(); ?>