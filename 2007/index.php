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
</head>

<body>
	<?php
		if (($ln=="") || ($ln=="nl")) {
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
		else
		{
			$ln = "nl";
			$flag = "<img src='http://www.shapshap.nl/pics/uk.gif' alt='English' />";
			$togglelanguage = "English";
			$togglevalue = "en";
			$language_file = "incs/frontpage_dutch.inc.php";
			$terms = "http://www.shapshap.nl/reisvoorwaarden.pdf";	
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
		<div id="menu">
			<ul>
				<!-- **** INSERT NAVIGATION ITEMS HERE (use id="selected" to identify the page you're on **** -->
				<li>
					<a href="/<?php print "$ln"; ?>/home/">
						<?php print "$ln_link_home"; ?>
					</a>
				</li>
				<li>
					<a href="/<?php print "$ln"; ?>/photographytours/"><?php print "$ln_link_photographytours"; ?>
					</a>
				</li>
				<li><a href="/<?php print "$ln"; ?>/extremetours/">
						<?php print "$ln_link_extremetours"; ?>
					</a>
				</li>
				<li>
					<a href="/<?php print "$ln"; ?>/overlandtours/">
						<?php print "$ln_link_overlandtours"; ?>
					</a>
				</li>
				<li>
					<a href="/<?php print "$ln"; ?>/indaba/">
						<?php print "$ln_link_indaba"; ?>
					</a>
				</li>
				<li>
					<a href="/<?php print "$ln"; ?>/faq/">
						<?php print "$ln_link_faq"; ?>
					</a>
				</li>
				<li>
					<a href="/<?php print "$ln"; ?>/about/">
						<?php print "$ln_link_about_us"; ?>
					</a>
				</li>
			</ul>
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
							
						</h2>
						<p>
							
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
					include("content.php");
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