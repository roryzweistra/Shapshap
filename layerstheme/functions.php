<?php // Visual Design Copyright (C) 2010 pixelthemestudio.ca - All Rights Reserved. license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html>

$functions_path = TEMPLATEPATH . '/functions/';
$includes_path = TEMPLATEPATH . '/includes/';
require_once ($functions_path . 'contact.php');
require_once ($functions_path . 'shortcodes.php');
require_once ($functions_path . 'widgets.php');
require_once ($functions_path . 'breadcrumbs.php');
require_once ($functions_path . 'pagenav.php');


// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
// This theme allows users to set a custom background
	//add_custom_background();
// This theme supports post thumbnails	
if (function_exists('add_theme_support')) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 250, 140, false ); // default thumbnail size
	//add_image_size('index-thumbnail', 100, 100); // for front page thumbnails
	add_image_size('single-post-thumbnail', 300, 170); // a different thumbnail size on single post pages
}
// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );
	
// Add menu Support and removing the menu container.
	register_nav_menu('Main Menu', 'Your primary site menu');
	register_nav_menu('Footer Menu', 'Your footer menu');
	
function my_wp_nav_menu_args( $args = '' )
{
	$args['container'] = false;
	return $args;
} 
// for removal of submit text
add_action('init', init_method);
 
function init_method() {
	wp_enqueue_script('jquery');	
}    

// Custom Menu with Item Descriptions
class description_walker extends Walker_Nav_Menu
{
      function start_el(&$output, $item, $depth, $args)
      {
           global $wp_query;
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $prepend = '<strong>';
           $append = '</strong>';
           $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

           if($depth != 0)
           {
                     $description = $append = $prepend = "";
           }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            }
}

// function

//add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );
/* Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link. */
function pts_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'pts_page_menu_args' );

/* Sets the excerpt length */
function pts_excerpt_length( $length ) {
	return 60;
}
add_filter( 'excerpt_length', 'pts_excerpt_length' );


// Stops WordPress from going to middle of full post view - very irrating. Thanks to http://digwp.com
function remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');

// Changing excerpt ending to a more-link
   function new_excerpt_more($more) {
   global $post;
   return '<a class="more-link" href="'. get_permalink($post->ID) . '">' . 'Continue Reading' . '</a>';
   }
   add_filter('excerpt_more', 'new_excerpt_more');

/* Remove the irritating comment tags on the comment form */
function mytheme_init() {
	add_filter('comment_form_defaults','mytheme_comments_form_defaults');
}
add_action('after_setup_theme','mytheme_init');

function mytheme_comments_form_defaults($default) {
	unset($default['comment_notes_after']);
	return $default;
}   
/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Twenty Ten 1.0
 */
function pts_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'pts_remove_recent_comments_style' );

if ( ! function_exists( 'pts_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Twenty Ten 1.0
 */
function pts_posted_on() {
	printf( __( '<span class="%1$s">Date: </span> %2$s <span class="meta-sep">&nbsp;Author: </span> %3$s', 'pts' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'pts' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'pts_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own pts_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Ten 1.0
 */
function pts_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<div <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div class="commentgroup">
			<div id="comment-<?php comment_ID(); ?>">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    <td class="cmeta" colspan="2" valign="middle"><?php echo get_avatar( $comment, 50 ); ?><?php printf( __( '%s', 'pts' ), sprintf( '<span class="cname">%s</span>', get_comment_author_link() ) ); ?><br />
	<span class="cdate">Commented:&nbsp;<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'pts' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'pts' ), ' ' );
					?>
					</span>
		</td>
  </tr>
  <tr>
  <?php if ( $comment->comment_approved == '0' ) : ?>
    <td colspan="2" class="cmoderation">
		<?php _e( 'Your comment is awaiting moderation.', 'pts' ); ?></td>
<?php endif; ?>
    </tr>
  <tr>
    <td colspan="2" class="comment-body"><?php comment_text(); ?></td>
  </tr>
  <tr>
    <td colspan="2" class="reply"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></td>
  </tr>
</table>
					
				</div>
			</div><!-- #comment-##  -->
		</div>
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'pts' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'pts'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

















if ( ! function_exists( 'pts_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function pts_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. <br />Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'pts' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'pts' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'pts' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;
?>
<?php
// for scripts needed on the front-end

define('pts_js', get_template_directory_uri() . '/js' );
function pts_js_scripts() {
	if(!is_admin()){
		//wp_deregister_script( 'jquery' );
		//wp_register_script( 'jquery', pts_js . '/jquery-1.3.2.min.js', false, '' );
	}
}     
add_action('init', 'pts_js_scripts');
?>
<?php
// begin control panel naming

$themename = "Layers Theme";
$shortname = "pts";

$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}
array_unshift($wp_cats, "Choose a category");



/* control panel settings here */

$options = array (
	
array( "name" => "Website &amp; Blog Settings",
	"type" => "section"),
array(  "type" => "open"),

	array(  "name" => "Custom Logo",
		"desc" => "Path to your logo image (Best to keep it within 250px x 100px or less).",
		"id" => $shortname."_logo",
		"std" => "",
		"type" => "text"),
		
	array(  "name" => "Blog Layout",
		"desc" => "Choose your blog page layout with a Right Column, Left Column, or with an Inset and Right Column.",
		"id" => $shortname."_bloglayout",
		"type" => "select",
		"std" => "Blog Right",
		"options" => array("Blog Right", "Blog Left", "Blog Inset Right", "Blog Wide")),
	
	array(  "name" => "Single Page Layout",
		"desc" => "Choose your Single Post layout. Although you do not have to match it with the blog layout, if you use full width images, it is recommended to match this layout with the blog.",
		"id" => $shortname."_singlelayout",
		"type" => "select",
		"std" => "Single Right",
		"options" => array("Single Right", "Single Left", "Single Inset Right", "Single Wide")),
		
	array(  "name" => "Category Layout",
		"desc" => "Choose your Category page layout. Although you do not have to match it with the blog layout, if you use full width images, it is recommended to match this layout with the blog.",
		"id" => $shortname."_categorylayout",
		"type" => "select",
		"std" => "Category Right",
		"options" => array("Category Right", "Category Left", "Category Inset Right", "Category Wide")),
		
	array(  "name" => "Archive Layout",
		"desc" => "Choose your Archive page layout. Although you do not have to match it with the blog layout, if you use full width images, it is recommended to match this layout with the blog.",
		"id" => $shortname."_archivelayout",
		"type" => "select",
		"std" => "Archive Right",
		"options" => array("Archive Right", "Archive Left", "Archive Inset Right", "Archive Wide")),
		
array( "type" => "close"),	
array(  "name" => "Style &amp; Colour Settings",
	"type" => "section"),
array(  "type" => "open"),

	array(  "name" => "Page Background",
		"desc" => "Change your background style with pre-styled gradients or select None if you want just a colour background only (choose your background colour below).",
		"id" => $shortname."_pagebg",
		"type" => "select",
		"std" => "Default",
		"options" => array("Default", "Rust", "Olive", "Amber", "Brown", "Wine", "Taupe", "Grey", "Grape", "Marine","Custom", "None")),
				
	array(  "name" => "Background Colour",
		"desc" => "Choose your own background colour after you select the gradient option above as None. Default colour is 293A47",
		"id" => $shortname."_bgcolour",
		"type" => "text_colour",
		"std" => "293A47"),
		
	array(  "name" => "Header Background",
		"desc" => "Change your Header (behind the site title and Showcase) style with pre-styled gradients or select None if you want just a colour background only (choose your background below).",
		"id" => $shortname."_headerbg",
		"type" => "select",
		"std" => "Default",
		"options" => array("Default", "Rust", "Olive", "Amber", "Brown", "Wine", "Taupe", "Grey", "Grape", "Marine","Custom", "Colour")),
		
	array(  "name" => "Header Colour",
		"desc" => "Choose your own Header background colour after you select the header gradient option above as None. Default colour is 293A47",
		"id" => $shortname."_headercolour",
		"type" => "text_colour",
		"std" => "293A47"),
		
	array(  "name" => "Site Title",
		"desc" => "Choose the colour of your blog title. Default is white FFFFFF",
		"id" => $shortname."_blogtitle",
		"type" => "text_colour",
		"std" => "FFFFFF"),
		
	array(  "name" => "Site Caption",
		"desc" => "Choose the colour of your blog description caption. Default is grey 7E7E7E",
		"id" => $shortname."_blogcaption",
		"type" => "text_colour",
		"std" => "7E7E7E"),
	
	array(  "name" => "Showcase Background Colour",
		"desc" => "Choose the background colour for your showcase. Default colour is grey 444444",
		"id" => $shortname."_sccolour",
		"type" => "text_colour",
		"std" => "444444"),
	
	array(  "name" => "Outer Background Colour",
		"desc" => "This is the outer container for your page content. Default colour is grey 838383",
		"id" => $shortname."_outer",
		"type" => "text_colour",
		"std" => "838383"),
		
	array(  "name" => "Main Menu Colour",
		"desc" => "The main menu link colour. Default colour is dark 333333",
		"id" => $shortname."_menulink",
		"type" => "text_colour",
		"std" => "333333"),
	
	array(  "name" => "Main Menu Hover",
		"desc" => "The main menu colour when you mouseover and active state. Default is 3C5C75",
		"id" => $shortname."_menuhlink",
		"type" => "text_colour",
		"std" => "3C5C75"),
		
	array(  "name" => "Page Links Colour",
		"desc" => "Choose the colour of your in-page text links. Default is 446278",
		"id" => $shortname."_linkcolour",
		"type" => "text_colour",
		"std" => "446278"),
	
	array(  "name" => "Page Link Hover",
		"desc" => "Choose the colour of your in-page text link hover colour on mouseovers. Default is 333333",
		"id" => $shortname."_linkhcolour",
		"type" => "text_colour",
		"std" => "333333"),
		
	array(  "name" => "Bottom Text Links",
		"desc" => "Choose the colour of your text links in the bottom widgets group area but also is the mouseover colour for any list type links. Default is A6B278",
		"id" => $shortname."_blinks",
		"type" => "text_colour",
		"std" => "A6B278"),
		
	array(  "name" => "Bottom Text Hover",
		"desc" => "Choose the colour of your text links in the bottom widgets group area when you mouseover. Default is white fff",
		"id" => $shortname."_bhlinks",
		"type" => "text_colour",
		"std" => "fff"),
		
	array(  "name" => "Bottom List Colour",
		"desc" => "Choose the colour of your lists in the bottom widgets. Default is white CCC",
		"id" => $shortname."_blistlinks",
		"type" => "text_colour",
		"std" => "CCC"),
		
array( "type" => "close"),	
array(  "name" => "Showcase Settings",
	"type" => "section"),
array(  "type" => "open"),
		
	array(  "name" => "Home Page Showcase",
		"desc" => "Choose any of the choices listed in the dropdown for your front page Showcase. The Showcase Widget can be used on other pages.",
		"id" => $shortname."_showcase",
		"type" => "select",
		"std" => "Showcase - Widget",
		"options" => array("Showcase - Widget", "Showcase - Accordion", "Showcase - Slideshow", "Showcase - My Own", "No Showcase")),
	
	array(  "name" => "Accordion Height",
		"desc" => "Set the height of your Showcase Accordion group. Maximum height is 420 pixels.",
		"id" => $shortname."_accheight",
		"type" => "text",
		"std" => "420"),
		
	array(  "name" => "Accordion Width",
		"desc" => "Set the width of your Showcase Accordion group images in their normal state (before mouseover). Default 4 image panel is 240 pixels and is done by dividing 960 pixels (full width) by the number of images.",
		"id" => $shortname."_accwidth",
		"type" => "text",
		"std" => "240"),
		
	array(  "name" => "Slideshow Height",
		"desc" => "Set the height of your Showcase slideshow. Maximum dimensions are 960px x 420px for the Showcase area. I recommend you keep the 960px width.",
		"id" => $shortname."_ssheight",
		"type" => "text",
		"std" => "300"),
		
	array(  "name" => "Your Media Plugin Code",
		"desc" => "Enter your own slideshow or other media plugin code for your own custom Showcase on the Front Page. Maximum dimensions are 960px x 420px for the Showcase area.",
		"id" => $shortname."_sccustom",
		"std" => "",
		"type" => "textarea"),
		
array( "type" => "close"),	
array(  "name" => "Showcase - Accordion Images",
	"type" => "section"),
array(  "type" => "open"),

	array(  "name" => "Enable Image 1",
		"desc" => "This disables or enables the first image.",
		"id" => $shortname."_pic1",
		"type" => "select",
		"std" => "Enable",
		"options" => array("Enable", "Disable")),

	array(  "name" => "Image 1 Path",
		"desc" => "The path where your image is located. Use either the Media Library or upload your images to a different location.",
		"id" => $shortname."_pic1path",
		"type" => "text",
		"std" => ""),
		
	array(  "name" => "Image 1 Link",
		"desc" => "You can link this image to anything like a page, another website, or file with a full url.",
		"id" => $shortname."_pic1link",
		"type" => "text",
		"std" => ""),
	
	array(  "name" => "Image 1 Link Title",
		"desc" => "For search engines and users, I recommend adding a title description if you use links.",
		"id" => $shortname."_pic1title",
		"type" => "text",
		"std" => "My image link description"),
		
		
	array(  "name" => "Enable Image 2",
		"desc" => "This disables or enables the first image.",
		"id" => $shortname."_pic2",
		"type" => "select",
		"std" => "Enable",
		"options" => array("Enable", "Disable")),

	array(  "name" => "Image 2 Path",
		"desc" => "The path where your image is located. Use either the Media Library or upload your images to a different location.",
		"id" => $shortname."_pic2path",
		"type" => "text",
		"std" => ""),
		
	array(  "name" => "Image 2 Link",
		"desc" => "You can link this image to anything like a page, another website, or file with a full url.",
		"id" => $shortname."_pic2link",
		"type" => "text",
		"std" => ""),
	
	array(  "name" => "Image 2 Link Title",
		"desc" => "For search engines and users, I recommend adding a title description if you use links.",
		"id" => $shortname."_pic2title",
		"type" => "text",
		"std" => "My image link description"),		
		
	array(  "name" => "Enable Image 3",
		"desc" => "This disables or enables the first image.",
		"id" => $shortname."_pic3",
		"type" => "select",
		"std" => "Enable",
		"options" => array("Enable", "Disable")),

	array(  "name" => "Image 3 Path",
		"desc" => "The path where your image is located. Use either the Media Library or upload your images to a different location.",
		"id" => $shortname."_pic3path",
		"type" => "text",
		"std" => ""),
		
	array(  "name" => "Image 3 Link",
		"desc" => "You can link this image to anything like a page, another website, or file with a full url.",
		"id" => $shortname."_pic3link",
		"type" => "text",
		"std" => ""),
	
	array(  "name" => "Image 3 Link Title",
		"desc" => "For search engines and users, I recommend adding a title description if you use links.",
		"id" => $shortname."_pic3title",
		"type" => "text",
		"std" => "My image link description"),	
			
	array(  "name" => "Enable Image 4",
		"desc" => "This disables or enables the first image.",
		"id" => $shortname."_pic4",
		"type" => "select",
		"std" => "Enable",
		"options" => array("Enable", "Disable")),

	array(  "name" => "Image 4 Path",
		"desc" => "The path where your image is located. Use either the Media Library or upload your images to a different location.",
		"id" => $shortname."_pic4path",
		"type" => "text",
		"std" => ""),
		
	array(  "name" => "Image 4 Link",
		"desc" => "You can link this image to anything like a page, another website, or file with a full url.",
		"id" => $shortname."_pic4link",
		"type" => "text",
		"std" => ""),
	
	array(  "name" => "Image 4 Link Title",
		"desc" => "For search engines and users, I recommend adding a title description if you use links.",
		"id" => $shortname."_pic4title",
		"type" => "text",
		"std" => "My image link description"),	
		
	array(  "name" => "Enable Image 5",
		"desc" => "This disables or enables the first image.",
		"id" => $shortname."_pic5",
		"type" => "select",
		"std" => "Disable",
		"options" => array("Disable", "Enable")),

	array(  "name" => "Image 5 Path",
		"desc" => "The path where your image is located. Use either the Media Library or upload your images to a different location.",
		"id" => $shortname."_pic5path",
		"type" => "text",
		"std" => ""),
		
	array(  "name" => "Image 5 Link",
		"desc" => "You can link this image to anything like a page, another website, or file with a full url.",
		"id" => $shortname."_pic5link",
		"type" => "text",
		"std" => ""),
	
	array(  "name" => "Image 5 Link Title",
		"desc" => "For search engines and users, I recommend adding a title description if you use links.",
		"id" => $shortname."_pic5title",
		"type" => "text",
		"std" => "My image link description"),	
		
array( "type" => "close"),	
array(  "name" => "Showcase - Slideshow Images",
	"type" => "section"),
array(  "type" => "open"),

	array(  "name" => "Enable Slide 1",
		"desc" => "This disables or enables the first image.",
		"id" => $shortname."_s1",
		"type" => "select",
		"std" => "Enable",
		"options" => array("Enable", "Disable")),
	
	array(  "name" => "Enable Slide 1 Info",
		"desc" => "This disables or enables the slide description and Read More link. You can disable this to just show the slide image only.",
		"id" => $shortname."_s1info",
		"type" => "select",
		"std" => "Enable",
		"options" => array("Enable", "Disable")),

	array(  "name" => "Slide 1 Path",
		"desc" => "The path where your image is located. Use either the Media Library or upload your images to a different location.",
		"id" => $shortname."_s1path",
		"type" => "text",
		"std" => ""),
	
	array(  "name" => "Slide 1 ALT",
		"desc" => "Add your slide image ALT description here.",
		"id" => $shortname."_s1alt",
		"type" => "text",
		"std" => ""),
		
	array(  "name" => "Slide 1 description",
		"desc" => "Add your slide description content here for your slide being displayed.",
		"id" => $shortname."_s1desc",
		"type" => "textarea",
		"std" => ""),
	
	array(  "name" => "Slide 1 Link Text",
		"desc" => "Choose what you want your (Read More) text to be for this slide.",
		"id" => $shortname."_s1more",
		"type" => "select",
		"std" => "Read More",
		"options" => array("Read More", "Continue Reading", "See More", "View Image", "Visit Website", "Download")),		

	array(  "name" => "Slide 1 Link",
		"desc" => "Add a link to what you want this slide to have. It can be to a page, post, image, file, website, or other.",
		"id" => $shortname."_s1link",
		"type" => "text",
		"std" => ""),
		
	array(  "name" => "Slide 1 Link Title",
		"desc" => "Add a descriptive title for your link, which helps with search engine ranking.",
		"id" => $shortname."_s1linktitle",
		"type" => "text",
		"std" => ""),

	array(  "name" => "Enable Slide 2",
		"desc" => "This disables or enables the first image.",
		"id" => $shortname."_s2",
		"type" => "select",
		"std" => "Enable",
		"options" => array("Enable", "Disable")),
		
	array(  "name" => "Enable Slide 2 Info",
		"desc" => "This disables or enables the slide description and Read More link. You can disable this to just show the slide image only.",
		"id" => $shortname."_s2info",
		"type" => "select",
		"std" => "Enable",
		"options" => array("Enable", "Disable")),

	array(  "name" => "Slide 2 Path",
		"desc" => "The path where your image is located. Use either the Media Library or upload your images to a different location.",
		"id" => $shortname."_s2path",
		"type" => "text",
		"std" => ""),
		
	array(  "name" => "Slide 2 ALT",
		"desc" => "Add your slide image ALT description here.",
		"id" => $shortname."_s2alt",
		"type" => "text",
		"std" => ""),
		
	array(  "name" => "Slide 2 Description",
		"desc" => "Add your slide description content here for your slide being displayed.",
		"id" => $shortname."_s2desc",
		"type" => "textarea",
		"std" => ""),	
		
	array(  "name" => "Slide 2 Link Text",
		"desc" => "Choose what you want your (Read More) text to be for this slide.",
		"id" => $shortname."_s2more",
		"type" => "select",
		"std" => "Read More",
		"options" => array("Read More", "Continue Reading", "See More", "View Image", "Visit Website", "Download")),	

	array(  "name" => "Slide 2 Link",
		"desc" => "Add a link to what you want this slide to have. It can be to a page, post, image, file, website, or other.",
		"id" => $shortname."_s2link",
		"type" => "text",
		"std" => ""),
	
	array(  "name" => "Slide 2 Link Title",
		"desc" => "Add a descriptive title for your link, which helps with search engine ranking.",
		"id" => $shortname."_s2linktitle",
		"type" => "text",
		"std" => ""),	

	array(  "name" => "Enable Slide 3",
		"desc" => "This disables or enables the first image.",
		"id" => $shortname."_s3",
		"type" => "select",
		"std" => "Enable",
		"options" => array("Enable", "Disable")),
		
	array(  "name" => "Enable Slide 3 Info",
		"desc" => "This disables or enables the slide description and Read More link. You can disable this to just show the slide image only.",
		"id" => $shortname."_s3info",
		"type" => "select",
		"std" => "Enable",
		"options" => array("Enable", "Disable")),

	array(  "name" => "Slide 3 Path",
		"desc" => "The path where your image is located. Use either the Media Library or upload your images to a different location.",
		"id" => $shortname."_s3path",
		"type" => "text",
		"std" => ""),
	
	array(  "name" => "Slide 3 ALT",
		"desc" => "Add your slide image ALT description here.",
		"id" => $shortname."_s3alt",
		"type" => "text",
		"std" => ""),
		
	array(  "name" => "Slide 3 Description",
		"desc" => "Add your slide description content here for your slide being displayed.",
		"id" => $shortname."_s3desc",
		"type" => "textarea",
		"std" => ""),
		
	array(  "name" => "Slide 3 Link Text",
		"desc" => "Choose what you want your (Read More) text to be for this slide.",
		"id" => $shortname."_s3more",
		"type" => "select",
		"std" => "Read More",
		"options" => array("Read More", "Continue Reading", "See More", "View Image", "Visit Website", "Download")),		

	array(  "name" => "Slide 3 Link",
		"desc" => "Add a link to what you want this slide to have. It can be to a page, post, image, file, website, or other.",
		"id" => $shortname."_s3link",
		"type" => "text",
		"std" => ""),
		
	array(  "name" => "Slide 3 Link Title",
		"desc" => "Add a descriptive title for your link, which helps with search engine ranking.",
		"id" => $shortname."_s3linktitle",
		"type" => "text",
		"std" => ""),	

	array(  "name" => "Enable Slide 4",
		"desc" => "This disables or enables the first image.",
		"id" => $shortname."_s4",
		"type" => "select",
		"std" => "Enable",
		"options" => array("Enable", "Disable")),
	
	array(  "name" => "Enable Slide 4 Info",
		"desc" => "This disables or enables the slide description and Read More link. You can disable this to just show the slide image only.",
		"id" => $shortname."_s4info",
		"type" => "select",
		"std" => "Enable",
		"options" => array("Enable", "Disable")),

	array(  "name" => "Slide 4 Path",
		"desc" => "The path where your image is located. Use either the Media Library or upload your images to a different location.",
		"id" => $shortname."_s4path",
		"type" => "text",
		"std" => ""),
		
	array(  "name" => "Slide 4 ALT",
		"desc" => "Add your slide image ALT description here.",
		"id" => $shortname."_s4alt",
		"type" => "text",
		"std" => ""),
		
	array(  "name" => "Slide 4 Description",
		"desc" => "Add your slide description content here for your slide being displayed.",
		"id" => $shortname."_s4desc",
		"type" => "textarea",
		"std" => ""),
		
	array(  "name" => "Slide 4 Link Text",
		"desc" => "Choose what you want your (Read More) text to be for this slide.",
		"id" => $shortname."_s4more",
		"type" => "select",
		"std" => "Read More",
		"options" => array("Read More", "Continue Reading", "See More", "View Image", "Visit Website", "Download")),		

	array(  "name" => "Slide 4 Link",
		"desc" => "Add a link to what you want this slide to have. It can be to a page, post, image, file, website, or other.",
		"id" => $shortname."_s4link",
		"type" => "text",
		"std" => ""),
		
	array(  "name" => "Slide 4 Link Title",
		"desc" => "Add a descriptive title for your link, which helps with search engine ranking.",
		"id" => $shortname."_s4linktitle",
		"type" => "text",
		"std" => ""),	

	array(  "name" => "Enable Slide 5",
		"desc" => "This disables or enables the first image.",
		"id" => $shortname."_s5",
		"type" => "select",
		"std" => "Disable",
		"options" => array("Disable", "Enable")),
	
	array(  "name" => "Enable Slide 5 Info",
		"desc" => "This disables or enables the slide description and Read More link. You can disable this to just show the slide image only.",
		"id" => $shortname."_s5info",
		"type" => "select",
		"std" => "Enable",
		"options" => array("Enable", "Disable")),

	array(  "name" => "Slide 5 Path",
		"desc" => "The path where your image is located. Use either the Media Library or upload your images to a different location.",
		"id" => $shortname."_s5path",
		"type" => "text",
		"std" => ""),
	
	array(  "name" => "Slide 5 ALT",
		"desc" => "Add your slide image ALT description here.",
		"id" => $shortname."_s5alt",
		"type" => "text",
		"std" => ""),
		
	array(  "name" => "Slide 5 Description",
		"desc" => "Add your slide description content here for your slide being displayed.",
		"id" => $shortname."_s5desc",
		"type" => "textarea",
		"std" => ""),
		
	array(  "name" => "Slide 5 Link Text",
		"desc" => "Choose what you want your (Read More) text to be for this slide.",
		"id" => $shortname."_s5more",
		"type" => "select",
		"std" => "Read More",
		"options" => array("Read More", "Continue Reading", "See More", "View Image", "Visit Website", "Download")),		

	array(  "name" => "Slide 5 Link",
		"desc" => "Add a link to what you want this slide to have. It can be to a page, post, image, file, website, or other.",
		"id" => $shortname."_s5link",
		"type" => "text",
		"std" => ""),
		
	array(  "name" => "Slide 5 Link Title",
		"desc" => "Add a descriptive title for your link, which helps with search engine ranking.",
		"id" => $shortname."_s5linktitle",
		"type" => "text",
		"std" => ""),				
		


array( "type" => "close"),	
array(  "name" => "Miscellaneous Settings",
	"type" => "section"),
array(  "type" => "open"),
		
		
	array(  "name" => "Copyright Information",
		"desc" => "Enter your own copyright credit line.",
		"id" => $shortname."_copyright",
		"std" => "Copyright &copy; 2010 Pixel Theme Studio. All rights reserved",
		"type" => "textarea"),
		
	array(  "name" => "Google Analytics Code",
		"desc" => "Enter your own Google Analytics code.",
		"id" => $shortname."_google",
		"std" => "",
		"type" => "textarea"),


array( "type" => "close")
 
);


function ptstheme_add_admin() {
 
global $themename, $shortname, $options;
 
if ( $_GET['page'] == basename(__FILE__) ) {
 
	if ( 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
		update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
 
	header("Location: admin.php?page=functions.php&saved=true");
die;
 
} 
else if( 'reset' == $_REQUEST['action'] ) {
 
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
	header("Location: admin.php?page=functions.php&reset=true");
die;
 
}
}

    if(function_exists(add_object_page))
    {
		$file_dir=get_bloginfo('template_directory');
		add_object_page($themename, $themename, 'administrator', basename(__FILE__), 'ptstheme_admin',$file_dir."/functions/images/icon.png");
	} else {
		$file_dir=get_bloginfo('template_directory');
		add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'ptstheme_admin',$file_dir."/functions/images/icon.png");
	}
	add_submenu_page(basename(__FILE__), $themename, 'Theme Options', 'administrator', basename(__FILE__),'ptstheme_admin');
		
}

function ptstheme_add_init() {

$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/functions/css/style.css", false, "1.0", "all");
wp_enqueue_script("functions", $file_dir."/functions/js/jscolor/jscolor.js", false, "1.3.1");
wp_enqueue_script("m_script", $file_dir."/functions/js/script.js", false, "1.0");

}

function ptstheme_admin() {
 
global $themename, $shortname, $options;
$i=0;
 
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade" style="background:#87A85E; border-color:#4C693C; color:#fff; margin-left:5px;"><p><strong>'.$themename.' settings sucessfully saved.</strong><br><br><img src=""></p></div> ';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade" style="background:#5992B5; border-color:#4A6A80; color:#fff; margin-left:5px;"><p><strong>'.$themename.' settings successfully reset.</strong></p></div>';
if ( $_REQUEST['error'] ) echo '<div id="message" class="updated fade" style="border-color:#733B2F; background:#B56D6B; color:#fff; margin-left:5px;"><p><strong>An error has occurred in the '.$themename.' theme.</strong></p></div>';
 
?>

<?php $file_dir=get_bloginfo('template_directory'); ?>
<div class="wrap m_wrap">
<div id="logo"><img src='<?php echo $file_dir."/functions/images/logo.png"; ?>' alt="logo" /><h1> <?php echo $themename; ?> Settings </h1></div>

<div class="m_help">
<p>
<strong>Theme Support: </strong>If you are experiencing difficulties with the <?php echo $themename; ?> template, you can setup a membership with www.pixelthemestudio.ca if you do not have one. This gives you direct support in addition to the theme setup tutorials located at the site. </p>
</div>
 

<form method="post">
<div class="m_opts">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
case "close":
?>
 
</div>
</div>
<br />

 
<?php break;
 
case "title":
?>
<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>

 
<?php break;
 
case 'text_colour':
?>

<div class="m_input m_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" class="color" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
 
<?php break;
 
case 'text':
?>

<div class="m_input m_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
 
<?php
break;
 
case 'textarea':
?>

<div class="m_input m_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="m_input m_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>

<?php

break;
case "radio":
?>
<div class="m_input m_select">
<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="radio" value="<?php echo $value['value']; ?>" <?php echo $selector; ?> <?php if ($get_options[$id] == $value['value'] || $get_options[$id] == ""){echo 'checked="checked"';}?> /> <?php echo $value['desc']; ?>&nbsp; &nbsp;
<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>_2" type="radio" value="<?php echo $value['value2']; ?>" <?php echo $selector; ?> <?php if ($get_options[$id] == $value['value2']){echo 'checked="checked"';}?> /> <?php echo $value['desc2']; ?>
<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>

<?php
break;
 
case "checkbox":
?>

<div class="m_input m_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case "section":

$i++;

?>

<div class="m_section">
<div class="m_title"><h3><img src="<?php bloginfo('template_directory')?>/functions/images/trans.png" class="inactive" alt="""><?php echo $value['name']; ?></h3><span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="Save changes" />
</span><div class="clearfix"></div></div>
<div class="m_options">

 
<?php break;
 
}
}
?>
 
<p class="submit">
<input name="save" type="submit" value="Save all changes" />
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>
 </div> 
 

<?php
}
?>
<?php
add_action('admin_init', 'ptstheme_add_init');
add_action('admin_menu', 'ptstheme_add_admin');
?>