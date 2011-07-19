<?php if (is_front_page()) { ?>		
	<?php
switch ($pts_featstyle) {
	case "Kwicks Slides":
		include (TEMPLATEPATH . "/includes/featured/home-kwicks.php");
		break;
	case "Slider Scroll":
		include (TEMPLATEPATH . "/includes/featured/home-slider.php");
		break;
	case "jQfancy Slides":
		include (TEMPLATEPATH . "/includes/featured/home-jqfancy.php");
		break;
}
?>
<?php } else { ?>
<?php include (TEMPLATEPATH . "/includes/showcase/showcasewidget.php"); ?>
<?php } ?>