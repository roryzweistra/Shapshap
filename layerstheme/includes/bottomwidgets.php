<?php // Visual Design Copyright (C) 2010 pixelthemestudio.ca - All Rights Reserved. license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html> ?>
<div id="bottomwidgets" class="clearfix">
  <div class="w960">
  <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Bottom Widgets')) : ?>
  
  
  
  <div class="three"><h4>Theme Features</h4>
  <div class="textwidget"><p>Welcome to the Layers Theme which was designed for the artist in mind. Whether you are an illustrator, graphic designer, a Photographer, or other, you will find this theme is best suited to showcase your artistic abilities. Use it as a blog or even a portfolio...the clean style and clean edges will help put more focus on your creativity.</p>
  <ul>
  <li>Theme Settings for personalization</li>
  <li>Almost unlimited colour variations</li>
  <li>4 Showcase options</li>
  <li>Custom Google Fonts</li>
  <li>...and more!</li>
  </ul></div>
		</div><div class="three"><h4>Showcase Options</h4><div class="textwidget"><p>Layers comes with 4 Showcase options to give you choices without using plugins.</p>
		<img src="<?php bloginfo('template_directory'); ?>/images/smScreenshot.jpg" class="aligncenter"></div>

		</div><div class="three"><h4><?php _e( 'Recent Posts', 'pts' ); ?></h4>			<div class="textwidget"><p>Check out the recent articles posted here with the Layers Theme and keep up to date with the latest news along with great photographic imagery that shows the great things in nature. </p>
		
<ul>
<?php query_posts('category_id=1&showposts=5');?>
<?php $posts = get_posts('category=#&numberposts=#&offset=0');
	foreach ($posts as $post) : start_wp(); ?>
<li><a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a></li>
<?php endforeach; ?></ul></div>
		</div><div class="clearfix"></div>
		
		
		
  <?php endif; ?>
  <div  class="clearfix"></div></div>
</div>