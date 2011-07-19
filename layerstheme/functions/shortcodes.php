<?php
// Visual Design Copyright (C) 2010 pixelthemestudio.ca - All Rights Reserved. license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html>

 
/* Drop cap - Green */
function pts_dropcap( $atts, $content = null ) {
   return '<span class="dropcap">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'pts_dropcap');

/* List Styles */
add_shortcode('list2', 'pts_list2');
function pts_list2( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="list2">', do_shortcode($content));
	return $content;
}

add_shortcode('list3', 'pts_list3');
function pts_list3( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="list3">', do_shortcode($content));
	return $content;
}

add_shortcode('list4', 'pts_list4');
function pts_list4( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="list4">', do_shortcode($content));
	return $content;
}

add_shortcode('list5', 'pts_list5');
function pts_list5( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="list5">', do_shortcode($content));
	return $content;
}
add_shortcode('listarrow', 'pts_listarrow');
function pts_listarrow( $atts, $content = null ) {
	$content = str_replace('<ul>', '<ul class="listarrow">', do_shortcode($content));
	return $content;
}
/* Quote blockquote */
function pts_blockquote( $atts, $content = null ) {
   return '<blockquote>' . do_shortcode($content) . '</blockquote>';
}
add_shortcode('blockquote', 'pts_blockquote');

function pts_quote( $atts, $content = null ) {
   return '<div class="quote">' . do_shortcode($content) . '</div>';
}
add_shortcode('quote', 'pts_quote');

/* Column four */
function pts_four( $atts, $content = null ) {
   return '<div class="four">' . do_shortcode($content) . '</div>';
}
add_shortcode('four', 'pts_four');

/* Column three */
function pts_three( $atts, $content = null ) {
   return '<div class="three">' . do_shortcode($content) . '</div>';
}
add_shortcode('three', 'pts_three');

/* Column two */
function pts_two( $atts, $content = null ) {
   return '<div class="two">' . do_shortcode($content) . '</div>';
}
add_shortcode('two', 'pts_two');

/* Column one */
function pts_one( $atts, $content = null ) {
   return '<div class="one">' . do_shortcode($content) . '</div>';
}
add_shortcode('one', 'pts_one');


?>