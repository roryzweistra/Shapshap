<!DOCTYPE html PUBLIC "-//W3CA//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
 	<title>
 		SHAPSHAP.NL >>> AFRICA TRAVEL SPECIALIST
	</title>
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
	<!-- **** layout stylesheet **** -->
	<link rel="stylesheet" type="text/css" href="/style/style.css" />
	<!-- **** colour scheme stylesheet **** -->
	<link rel="stylesheet" type="text/css" href="/style/orange.css" />
	<link rel="stylesheet" type="text/css" href="/style/menu.css" />
	<script type="text/javascript" language="javascript" src="js/yahoo-min.js"></script>
	<script type="text/javascript" language="javascript" src="js/yahoo-dom-event.js"></script>
	<script type="text/javascript" language="javascript" src="js/animation-min.js"></script>
	<script type="text/javascript" language="javascript" src="js/container_core-min.js"></script>
	<script type="text/javascript" language="javascript" src="js/menu-min.js"></script>
	<script type="text/javascript">
		onMenuBarReady = function()
		{
			// Animation object
			var oAnim;
			// Utility function used to setup animation for submenus
			function setupMenuAnimation(p_oMenu)
			{
				if(!p_oMenu.animationSetup)
				{
					var aItems = p_oMenu.getItemGroups();
						if(aItems && aItems[0])
						{
							var i = aItems[0].length - 1;
							var oSubmenu;
								do
								{
									oSubmenu = p_oMenu.getItem(i).cfg.getProperty("submenu");
										if(oSubmenu)
										{
											oSubmenu.beforeShowEvent.subscribe(onMenuBeforeShow, oSubmenu, true);
											oSubmenu.showEvent.subscribe(onMenuShow, oSubmenu, true);
										}
								}
								while(i--);
						}
						p_oMenu.animationSetup = true;
				}
			}
			// "beforeshow" event handler for each submenu of the menu bar
			function onMenuBeforeShow(p_sType, p_sArgs, p_oMenu)
			{
				if(oAnim && oAnim.isAnimated())
				{
					oAnim.stop();
					oAnim = null;
				}
				YAHOO.util.Dom.setStyle(this.element, "overflow", "hidden");
				YAHOO.util.Dom.setStyle(this.body, "marginTop", ("-" + this.body.offsetHeight + "px"));
			}
			// "show" event handler for each submenu of the menu bar
			function onMenuShow(p_sType, p_sArgs, p_oMenu)
			{
				oAnim = new YAHOO.util.Anim(
				this.body, 
				{
					marginTop:
					{
						to: 0
					}
				},
				.5, 
				YAHOO.util.Easing.easeOut
				);
				oAnim.animate();
				var me = this;
				function onTween()
				{
					me.cfg.refireEvent("iframe");
				}
				function onAnimationComplete()
				{
					YAHOO.util.Dom.setStyle(me.body, "marginTop", ("0px"));
					YAHOO.util.Dom.setStyle(me.element, "overflow", "visible");
	
					setupMenuAnimation(me);
				}
				/*
					Refire the event handler for the "iframe" 
					configuration property with each tween so that the  
					size and position of the iframe shim remain in sync 
					with the menu.
				*/
				if(this.cfg.getProperty("iframe") == true)
				{
					oAnim.onTween.subscribe(onTween);
				}
				oAnim.onComplete.subscribe(onAnimationComplete);
			}
			// "render" event handler for the menu bar
			function onMenuRender(p_sType, p_sArgs, p_oMenu)
			{
				setupMenuAnimation(p_oMenu);
			}
			// Instantiate and render the menu bar
			var oMenuBar = new YAHOO.widget.MenuBar("menu",
			{
				autosubmenudisplay:true, hidedelay:750, lazyload:true
			}
			);
			// Subscribe to the "render" event
			oMenuBar.renderEvent.subscribe(onMenuRender, oMenuBar, true);
			 oMenuBar.render();
			oMenuBar.show();
		};
		// Initialize and render the menu bar when it is available in the DOM
		YAHOO.util.Event.onContentReady("menu", onMenuBarReady);
</script>
</head>

<body>
	<?php
		if ($ln=="" || $ln=="nl") {
			$ln = "nl";
			$flag = "<img src='http://www.shapshap.nl/pics/uk.gif' alt='English' />";
			$togglelanguage = "English";
			$togglevalue = "en";
			$language_file = "incs/frontpage_dutch.inc.php";
			$terms = "http://www.shapshap.nl/reisvoorwaarden.pdf";	
		}
		elseif ($ln=="en") {
			$togglelanguage = "Nederlands";
			$flag = "<img src='http://www.shapshap.nl/pics/nl.gif' alt='Dutch' />";
			$togglevalue = "nl";
			$ln = "en";
			$language_file = "incs/frontpage_english.inc.php";
			$terms = "http://www.shapshap.nl/terms.pdf";
		}
		
		include($language_file);
		
		if($type=="") {
			$type = "home";
		}
	?>
	<div id="main">
		<div id="links">
			<div id="ats">
				africa travel specialist!
			</div>
			<div id="sitenav">
				<!-- **** INSERT LINKS HERE **** -->
				<a href="/<?php print "$togglevalue"; ?>/<?php print "$type"; ?>/">
					<?php print "$flag $togglelanguage"; ?>
				</a>
				 | 
				<a href="#">
					<?php print "$ln_link_sitemap"; ?>
				</a>
				 | 
				<a href="/<?php print "$ln"; ?>/contact/">
					<?php print "$ln_link_contact"; ?>
				</a>
			</div>
		</div>
		<div id="logo"></div>
		
		<div id="menu" class="yuimenubar yuimenubarnav">
			 <div class="bd">
			 	<ul class="first-of-type">
					<li class="yuimenubaritem">
						<a class="yuimenubaritemlabel" href="/<?php print "$ln"; ?>/home/">
							<?php print "$ln_link_home"; ?>
						</a>
					</li>
					<li class="yuimenubaritem">
						<a class="yuimenubaritemlabel" href="/<?php print "$ln"; ?>/photographytours/">
							<?php print "$ln_link_photographytours"; ?>
						</a>
					</li>
					<li class="yuimenubaritem">
						<a class="yuimenubaritemlabel" href="/<?php print "$ln"; ?>/extremetours/">
							<?php print "$ln_link_extremetours"; ?>
						</a>
					</li>
					<li class="yuimenubaritem">
						<a class="yuimenubaritemlabel" href="#">
							<?php print "$ln_link_accomodated"; ?>
						</a>
						<div id="accomodated" class="yuimenu">
							<div class="bd">
								<ul class="first-of-type">
									<li class="yuimenuitem">
										<a class="yuimenuitemlabel" href="/<?php print "$ln"; ?>/Beste_van_Afrika,_56_dagen/">
											Reis 1
										</a>
									</li>
									<li class="yuimenuitem">
										<a class="yuimenuitemlabel" href="/<?php print "$ln"; ?>/extremetours/">
											Reis 2
										</a>
									</li>
								</ul>            
							</div>
						</div>   
					</li>
					<li class="yuimenubaritem">
						<a class="yuimenubaritemlabel" href="#">
							<?php print "$ln_link_camping"; ?>
						</a>
						<div id="camping" class="yuimenu">
							<div class="bd">
								<ul class="first-of-type">
									<li class="yuimenuitem">
										<a class="yuimenuitemlabel" href="#">
											Reis 1
										</a>
									</li>
									<li class="yuimenuitem">
										<a class="yuimenuitemlabel" href="#">
											Reis 2
										</a>
									</li>
								</ul>            
							</div>
						</div>   
					</li>
					<li class="yuimenubaritem">
						<a class="yuimenubaritemlabel" href="/<?php print "$ln"; ?>/indaba/">
						<?php print "$ln_link_indaba"; ?>
						</a>
					</li>
					<li class="yuimenubaritem">
						<a class="yuimenubaritemlabel" href="/<?php print "$ln"; ?>/faq/">
							<?php print "$ln_link_faq"; ?>
						</a>
					</li>
					<li class="yuimenubaritem">
						<a class="yuimenubaritemlabel" href="/<?php print "$ln"; ?>/about/">
							<?php print "$ln_link_about_us"; ?>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="content">
			<div id="column1">
				<div class="sidebaritem">
					<div class="sbihead">
						<h1>
							<a href="/pics/fotogalerij/index.htm" target="_blank">
								<?php print "$ln_link_gallery"; ?>
							</a>
						</h1>
					</div>
				</div>
				<div class="sidebaritem">
					<div class="sbihead">
						<h1>
							<a href="/<?php print "$ln"; ?>/savetheplanet/">
								<?php print "$ln_link_planet"; ?>
							</a>
						</h1>
					</div>
				</div>
				<div class="sidebaritem">
					<div class="sbihead">
						<h1>
							<?php print "$ln_sidebar_news"; ?>
						</h1>
					</div>
					<div class="sbicontent">
						<!-- **** INSERT NEWS ITEMS HERE **** -->
						<h2>
							05.12.2007
						</h2>
						<p>
							We changed our navigation, still working on it though....
						</p>
					</div>
				</div>
				<div class="sidebaritem">
					<div class="sbihead">
						<h1>
							<a href="http://www.shapshap.nl/xe.html" target="_blank">
								<?php print "$ln_sidebar_converter"; ?>
							</a>
						</h1>
					</div>
					<div class="sbilinks">
						<!-- **** INSERT ADDITIONAL LINKS HERE **** -->
					</div>
				</div>
				<div class="sidebaritem">
					<div class="sbihead">
						<h1>
							Links
						</h1>
					</div>
					<div class="sbicontent">
					</div>
				</div>  
			</div>
			<div id="column2">
				<!-- **** INSERT PAGE CONTENT HERE **** -->
				<?php
					include("content2.php");
				?>
			</div>
		</div>
		<div id="footer">
			<a href="<?php print $terms; ?>" target="_blank">
				<?php echo $ln_link_terms; ?>
			</a>
				 | 
			<a href="mailto:webmaster@shapshap.nl">
				webmaster@shapshap.nl
			</a>
				 | 
			<a href="http://www.southafrica.net/index.cfm?CountryProfileID=9" target="_blank">
				<?php print "$ln_link_portal"; ?>
			</a>
		</div>
	</div>
</body>

</html>