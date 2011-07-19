/* Author: 
Daniel Łęczycki www.designsentry.com
*/

jQuery(document).ready(function() {

	/* Search on hover effect, focus effect, and double-click to erase value */
	hasFocci = false;
	jQuery('#search_input').focus(function(){
		jQuery(this).stop().animate({"opacity": "1"},{queue:false,duration:300});
		hasFocci = true;
	}).blur(function() {
		jQuery(this).stop().animate({"opacity": "0.01"},{queue:false,duration:300});
		hasFocci = false;
	}).dblclick(function() {
		jQuery(this).val('');
		hasFocci = true;
	});
	jQuery('#search_submit').add('#search_input').hover(function(){
		jQuery(this).stop().animate({"opacity": "1"},{queue:false,duration:300});
	},function() {
		if(!hasFocci){jQuery(this).stop().animate({"opacity": "0.01"},{queue:false,duration:300});}
	});
	
	jQuery('#menu > ul > li').prepend('<span class="menu_box_left"></span>').append('<span class="menu_box_right"></span>');
	/* Menu jQuery rollout, additional styling allowing for rounded borders */
	var Menus = jQuery('#menu ul li');
	if(!(jQuery.browser.msie && jQuery.browser.version.substr(0,1)<8)){Menus.find('ul li').has('ul li').find('>a').append('<span> &raquo;</span>');}
	Menus.find('ul li:first-child').addClass('first_sub png_bg');
	Menus.find('ul').append('<li class="last_sub png_bg"></li>');
	Menus.find('ul').css({display: "none"}); // Opera Fix
	Menus.hover(function(){
		jQuery(this).not(':has(ul)').find('> a').addClass('menu_box_mid_bg');
		jQuery(this).has('ul').find('> a').addClass('menu_box_mid_bg_has_li');
		jQuery('span.menu_box_left', this).addClass('menu_box_left_bg');
		jQuery('span.menu_box_right', this).addClass('menu_box_right_bg');
	},function() {
		jQuery(this).not(':has(ul)').find('> a').removeClass('menu_box_mid_bg');
		jQuery(this).has('ul').find('> a').removeClass('menu_box_mid_bg_has_li');
		jQuery('span.menu_box_left', this).removeClass('menu_box_left_bg');
		jQuery('span.menu_box_right', this).removeClass('menu_box_right_bg');
	});
	Menus.hoverIntent({
	over: makeTall, 
	timeout: 300, 
	out: makeShort
	});
	function makeTall(){ jQuery(this).find('ul:first').slideDown({queue:false,duration:220});}
	function makeShort(){ jQuery(this).find('ul:first').fadeOut({queue:true,duration:200});}
	
	/* Automated sidebar top/bottom finishing graphics */
	if(!(jQuery.browser.msie && jQuery.browser.version=="6.0")){
	jQuery('.sidebar').wrapInner('<div class="sidebar"></div>').prepend('<div class="top_sidebar_mask"></div>').append('<div class="bottom_sidebar_mask"></div>').removeClass('sidebar');
	jQuery('.sidebar_mirror').wrapInner('<div class="sidebar_mirror"></div>').prepend('<div class="top_sidebar_mask_mirror"></div>').append('<div class="bottom_sidebar_mask_mirror"></div>').removeClass('sidebar_mirror');
	};
	
	/* Inner HR autofill */
	jQuery('.inner_main .hr').append('<div class="inner_hr"></div>');
	
	/* Pricing Table */
	var pricingcolumn = jQuery('.pricing_column');
	pricingcolumn.hover(function(){
		jQuery(this).find('.pricing_blurb').animate({top: '10px'},300);
	},function(){
		jQuery(this).find('.pricing_blurb').animate({top: '0px'},300);
	});
	
	/* Set the pricing tables to the right size */
	var pricingrowselector = jQuery('.pricing');
	pricingrowselector.each(function(){
		var numberofcolumns = jQuery(this).find('.pricing_column').length;
		var widthofrow = jQuery(this).parent().width();
		var finalresult = (11 + Math.floor(((widthofrow-2) - (numberofcolumns * (168)))/(numberofcolumns * 2)));
		jQuery(this).find('.pricing_blurb').css({marginLeft: finalresult,marginRight: finalresult});
	});
	
	/* Twitter initiates. Enter your username here. */
	jQuery(".tweeter_widget").tweet({
            username: "designsentry",
            join_text: "auto",
            avatar_size: 30,
            count: 4,
            auto_join_text_default: ",",
            auto_join_text_ed: ",",
            auto_join_text_ing: ",",
            auto_join_text_reply: "DS replied to",
            auto_join_text_url: "DS was checking out",
            loading_text: "loading tweets..."
    });
	
	/* Hack for all browsers to load the slider nicier way. The #slider has default property of display:none in css(for nice IE loading), then when js is loaded it changes to block (so Opera can
	render height of the slider properly while loading images), and then hides it again. Later, when all images are loaded - the fadeIn function kicks in. */
	jQuery('#slider').css({display: "block"}).hide();
	
	/* Social networking icons fade on hover */
	jQuery('#footer .icons li img').hover(function(){
		jQuery(this).stop().animate({"opacity": "0.45"},{queue:false,duration:300});
	}, function() {
		jQuery(this).stop().animate({"opacity": "1"},{queue:false,duration:300});
	});
	
	/* Clear input on focus in fields */
	jQuery('input').focus(function()
	{if(jQuery(this).val()==jQuery(this).attr('title'))
	{jQuery(this).val('');}
	});
	/* If field is empty afterward, add description text again */
	jQuery('input').blur(function()
	{if(jQuery(this).val()==''){
	jQuery(this).val(jQuery(this).attr('title'));
	}});
	
	/* Spyglass icon on hover over images */
	jQuery('.zoomer img').hover(function(){
		jQuery(this).animate({"opacity": "0.45"},{queue:true,duration:300});
	}, function() {
		jQuery(this).animate({"opacity": "1"},{queue:true,duration:300});
	});
	

    /* Contact form validation, ajax response */
    var paraTag = jQuery('input#submit').parent('p');
    jQuery(paraTag).children('input').remove();
    jQuery(paraTag).append('<input type="button" name="submit" id="submit" value="Send it!" class="superbutton" />');

    jQuery('#form_main input#submit').click(function() {
        jQuery('#form_main p').append('<img src="css/img/ajax-loader.gif" class="loaderIcon" alt="Loading..." />');

        var name = jQuery('input#name').val();
        var email = jQuery('input#email').val();
        var comments = jQuery('textarea#comments').val();

        jQuery.ajax({
            type: 'post',
            url: 'sendEmail.php',
            data: 'name=' + name + '&email=' + email + '&comments=' + comments,

            success: function(results) {
                jQuery('#form_main img.loaderIcon').fadeOut(5000);
                jQuery('ul#form_response').html(results);
            }
        }); // end ajax
    });
	
	/* Prepare border magic image loading */
	jQuery('.inner_main .border_magic, #footer .border_magic').css({display: "block"}).hide();
	
	jQuery("area[rel^='prettyPhoto']").add('.zoomer').prettyPhoto();
	
	/* Toggler */
	jQuery('div.toggler:not(.open)').hide();
	jQuery('.toggle').click(function(){
		jQuery(this).toggleClass("active").next().slideToggle("fast");
	});
	
});
/* End of onstart functions */

/* Start of functions initialized after full load of page */
jQuery(window).load(function(){
	
	/* Load the slider nicely with fade-in effect and wait till all images are loaded */
	jQuery('#slider').fadeIn(900);
	jQuery('.inner_main .loader').css({display: "none"});
	/* Innitialize Nivo Slider */
	jQuery('#slider').nivoSlider({
	directionNav:false,
	captionOpacity:0.85,
	slices:10,
	pauseTime:6000,
	keyboardNav:true,
	pauseOnHover:true
	});

	/* Add special rounded corners to the Slider */
	jQuery('.inner_main .nivoSlider').append('<div class="slider_cover_tl png_bg"></div><div class="slider_cover_tr png_bg"></div><div class="slider_cover_br png_bg"></div><div class="slider_cover_bl png_bg"></div>');
	
	/* Make the Slider navigation bullets align to center automaticly */
	var dotsMargin = jQuery('.inner_main .nivo-controlNav').width();
	jQuery('.inner_main .nivo-controlNav').css('margin-left', -dotsMargin/2);
	
	/* Adding some Border magic */
	var borderSubject = jQuery('.inner_main .border_magic, #footer .border_magic');
	borderSubject.wrap('<div class="add_border" />');
	
	/* Transfering alignment to added border */
	var bordered = jQuery('.inner_main .add_border, #footer .add_border');
	bordered.find('.alignleft').removeClass('alignleft').parent().addClass('alignleft');
	bordered.find('.alignright').removeClass('alignright').parent().addClass('alignright');
	bordered.find('.no_bottom_margin').removeClass('no_bottom_margin').parent().addClass('no_bottom_margin');
	
	
	/* Making the added border width completely automatic */
	borderSubject.each(function(){
	var addBordi = jQuery(this).width();
	jQuery(this).parent().width(addBordi+10);
	});
	
	/* Smooth image load */
	borderSubject.fadeIn(1500).parent().delay(1500).queue(function() {jQuery(this).css('background-image','url(css/img/zoom.png)');});
	
	/* Catch the height of longest footer column and stretch the others to the same size */
	var highHeels = 0;
	jQuery('#footer .widget').each(function(){
	var topHeels = jQuery(this).height();
	if(topHeels > highHeels){highHeels = topHeels};
	});
	jQuery('#footer .widget').height(highHeels);
	
	/* Cycle the "Hot stuff this week" */
	jQuery('.hotstuff ul, ul.testimonials').cycle({
		fx: 'fade',
		timeout:       4000,
		speed:         1000,
		before: onAfter
	});
	function onAfter(curr, next, opts, fwd){
        //get the height of the current slide
        var ht = jQuery(this).height();
        //set the container's height to that of the current slide
        jQuery(this).parent().animate({height: ht});
	}
});