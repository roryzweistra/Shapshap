<!DOCTYPE html PUBLIC "-//W3CA//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
  <title>SHAPSHAP.NL >>> AFRICA TRAVEL SPECIALIST</title>
  <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />

  <!-- **** layout stylesheet **** -->
  <link rel="stylesheet" type="text/css" href="style/style.css" />

  <!-- **** colour scheme stylesheet **** -->
  <link rel="stylesheet" type="text/css" href="style/orange.css" />

</head>

<body>
<?php

if ($type=="")
{
	$type = "home";
}


if ($ln=="")
{
	$ln = "nl";
	$togglelanguage = "English";
	$togglevalue = "en";
	$language_file = "incs/frontpage_dutch.inc.php";
	
}
elseif ($ln=="nl")
{
	$togglelanguage = "English";
	$togglevalue = "en";
	$ln = "nl";
	$language_file = "incs/frontpage_dutch.inc.php";
}
elseif ($ln=="en")
{
	$togglelanguage = "Nederlands";
	$togglevalue = "nl";
	$ln = "en";
	$language_file = "incs/frontpage_english.inc.php";
}

include($language_file);

?>

  <div id="main">
    <div id="links">
	<div id="ats">
	africa travel specialist!
	</div>
	<div id="sitenav">
      <!-- **** INSERT LINKS HERE **** -->
      <a href="?ln=<?php print "$togglevalue"; ?>&type=<?php print "$type"; ?>"><?php print "$togglelanguage"; ?></a> | <a href="#"><?php print "$ln_link_sitemap"; ?></a> | <a href="?ln=<?php print "$ln"; ?>&type=contact"><?php print "$ln_link_contact"; ?></a>
	</div>
    </div>
    <div id="logo"></div>
    <div id="menu">
      <ul>
        <!-- **** INSERT NAVIGATION ITEMS HERE (use id="selected" to identify the page you're on **** -->
        <li><a href="?ln=<?php print "$ln"; ?>&type=home"><?php print "$ln_link_home"; ?></a></li>
        <li><a href="?ln=<?php print "$ln"; ?>&type=about_us"><?php print "$ln_link_about_us"; ?></a></li>
        <li><a href="?ln=<?php print "$ln"; ?>&type=tours"><?php print "$ln_link_tours"; ?></a></li>
        <li><a href="?ln=<?php print "$ln"; ?>&type=tickets"><?php print "$ln_link_tickets"; ?></a></li>
	  <li><a href="?ln=<?php print "$ln"; ?>&type=faq"><?php print "$ln_link_faq"; ?></a></li>
        <li><a href="#"><?php print "$ln_link_gallery"; ?></a></li>
	  <li><a href="?ln=<?php print "$ln"; ?>&type=indaba"><?php print "$ln_link_indaba"; ?></a></li>
      </ul>
    </div>
    <div id="content">
      <div id="column1">
        <div class="sidebaritem">
          <div class="sbihead">
            <h1><?php print "$ln_sidebar_news"; ?></h1>
          </div>
          <div class="sbicontent">
            <!-- **** INSERT NEWS ITEMS HERE **** -->
            <h2>12.03.2007</h2>
            <p>Content en layout geheel gescheiden!</p>
            <p><a href="#">read more ...</a></p>
            <p></p>
          </div>
        </div>
        <div class="sidebaritem">
          <div class="sbihead">
            <h1><?php print "$ln_sidebar_converter"; ?></h1>
          </div>
          <div class="sbilinks">
            <!-- **** INSERT ADDITIONAL LINKS HERE **** -->
            
          </div>
        </div>
        <div class="sidebaritem">
          <div class="sbihead">
            <h1><?php print "$ln_sidebar_weather"; ?></h1>
          </div>
          <div class="sbicontent">
            <!-- **** INSERT OTHER INFORMATION HERE **** -->
            <div id="wx_module_7201">
   <a href="http://www.weather.com/weather/local/SFXX0010">Cape Town Weather Forecast, South Africa</a>
</div>

<script type="text/javascript">

   /* Locations can be edited manually by updating 'wx_locID' below.  Please also update */
   /* the location name and link in the above div (wx_module) to reflect any changes made. */
   var wx_locID = 'SFXX0010';

   /* If you are editing locations manually and are adding multiple modules to one page, each */
   /* module must have a unique div id.  Please append a unique # to the div above, as well */
   /* as the one referenced just below.  If you use the builder to create individual modules  */
   /* you will not need to edit these parameters. */
   var wx_targetDiv = 'wx_module_7201';

   /* Please do not change the configuration value [wx_config] manually - your module */
   /* will no longer function if you do.  If at any time you wish to modify this */
   /* configuration please use the graphical configuration tool found at */
   /* https://registration.weather.com/ursa/wow/step2 */
   var wx_config='SZ=180x150*WX=FHW*LNK=SSNL*UNT=C*BGI=spring*MAP=afr|null*DN=www.shapshap.nl*TIER=0*PID=1034528435*MD5=d5077acdc7b713fb8811c66f42040064';

   document.write('<scr'+'ipt src="'+document.location.protocol+'//wow.weather.com/weather/wow/module/'+wx_locID+'?config='+wx_config+'&proto='+document.location.protocol+'&target='+wx_targetDiv+'"></scr'+'ipt>');  
		</script>

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
      <a rel="license" href="http://creativecommons.org/licenses/by-nc/2.5/nl/">Creative Commons License</a> | <a href="mailto:webmaster@shapshap.nl">webmaster@shapshap.nl</a> | <a href="http://www.southafrica.net/index.cfm?CountryProfileID=9" target="_blank"><?php print "$ln_link_portal"; ?></a>
    </div>
  </div>
</body>
</html>
