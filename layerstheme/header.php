<?php // Visual Design Copyright (C) 2010 pixelthemestudio.ca - All Rights Reserved. license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html> ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php wp_title( '|', true, 'right' ); ?> <?php bloginfo('name'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<!-- stylesheets -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_head();
?>
<?php // Get theme settings
include (TEMPLATEPATH . "/includes/settings.php");
?>
<style type="text/css">
<!--
#bg-None {background-color:#<?php echo $pts_bgcolour; ?>;}
#inner4-Colour {background-color:#<?php echo $pts_headercolour; ?>;}
.kwickshadow {height: <?php echo $pts_accheight; ?>px;}
.kwicks li{width: <?php echo $pts_accwidth; ?>px; height: <?php echo $pts_accheight; ?>px;}
#s3slider {height:<?php echo $pts_ssheight; ?>px;}
a, a:visited {color:#<?php echo $pts_linkcolour; ?>;}
a:hover {color:#<?php echo $pts_linkhcolour; ?>;}
.nav li a strong, #menu .nav li:first-child a strong, #menu ul.sub-menu li.current-menu-parent li.menu-item a {color:#<?php echo $pts_menulink; ?>;}
.nav li a strong:hover, #menu .nav .current-menu-item a strong, #menu .nav .current-menu-ancestor a strong, #menu .nav li.current-menu-ancestor, #menu .nav li:first-child a:hover strong, #menu .nav ul li a:hover, #menu ul.sub-menu li.current_page_item a, #menu ul.sub-menu li.current-menu-parent a, #menu .nav ul.sub-menu li.current-menu-parent li.current_page_item a {color:#<?php echo $pts_menuhlink; ?>;}
-->
</style>

</head>

<body id="bg-<?php echo $pts_pagebg; ?>">
<div id="w1100">
  <div id="outer1"><!-- begin outer wrapper -->
    <div id="outer2">
      <div id="outer3" style="background-color:#<?php echo $pts_outer; ?>;">
        <div id="inner1"><!-- begin inner wrapper -->
          <div id="inner2">
            <div id="inner3">
              <div id="inner4-<?php echo $pts_headerbg; ?>">
                <div class="w960">
                  <div id="logowrapper">
				  
				  	
					<?php if ($pts_logo<>"") { ?>
						<a href="<?php echo get_option('home'); ?>"><span id="logo"><img src="<?php echo $pts_logo; ?>" alt="logo" /></span></a>
						<span id="caption"><h2 style="color: #<?php echo $pts_blogcaption; ?>;"><?php bloginfo('description'); ?></h2></span>
					<?php } else { ?>
						<span id="dlogo"><a href="<?php echo get_option('home'); ?>" style="color: #<?php echo $pts_blogtitle; ?>;"><h1><?php bloginfo('name'); ?></h1></a></span>
						<span id="caption"><h2 style="color: #<?php echo $pts_blogcaption; ?>;"><?php bloginfo('description'); ?></h2></span>
					<?php } ?>
					
				  </div>
				</div>
                
						<?php if (is_front_page()) { ?>		
							<?php
								switch ($pts_showcase) {
									case "Showcase - Widget":
									include (TEMPLATEPATH . "/includes/showcase/showcasewidget.php");
									break;
									case "Showcase - Accordion":
									include (TEMPLATEPATH . "/includes/showcase/showcaseaccordion.php");
									break;
									case "Showcase - Slideshow":
									include (TEMPLATEPATH . "/includes/showcase/showcaseslideshow.php");
									break;
									case "Showcase - My Own":
									include (TEMPLATEPATH . "/includes/showcase/showcasemyown.php");
									break;
									case "No Showcase":
									break;
								}
							?>
							<?php } else { ?>
							<?php include (TEMPLATEPATH . "/includes/showcase/showcasewidget.php"); ?>
						<?php } ?>
					
				<div id="inner5">
                <!-- menu group -->
    				<div id="menu"><?php wp_nav_menu( array( 'container' =>false, 'menu_class' => 'nav', 'echo' => true, 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'depth' => 0, 'walker' => new description_walker()) ); ?>
                    </div>
    <!-- end menu group -->
    <!-- begin content -->
                <div class="w940">
<?php if (is_front_page()) { ?>
  <?php } else { ?>	<div id="breadcrumbs"><?php if (function_exists('pts_breadcrumbs')) pts_breadcrumbs(); ?></div>
	<?php } ?>
                  <div class="columns clearfix">