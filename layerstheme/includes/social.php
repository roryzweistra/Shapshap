<?php // Visual Design Copyright (C) 2010 pixelthemestudio.ca - All Rights Reserved. license GPL/GNU <http://www.gnu.org/licenses/gpl-3.0.html>
// Get theme settings
include (TEMPLATEPATH . "/includes/settings.php"); 
?>
<?php if ($pts_social<>"Disable") { ?>

<table border="0" cellspacing="0" cellpadding="0" id="social">
  <tr>   
    <td>
        <?php if ($pts_edtwitter<>"Disable") { ?>
        <a id="sc1" href="<?php echo $pts_twitter; ?>" title="Twitter" target="_blank"></a>
        <?php } ?>
        <?php if ($pts_edmyspace<>"Disable") { ?>
        <a id="sc2" href="<?php echo $pts_myspace; ?>" title="MySpace" target="_blank"></a>
        <?php } ?>
        <?php if ($pts_edfacebook<>"Disable") { ?>
        <a id="sc3" href="<?php echo $pts_facebook; ?>" title="Facebook" target="_blank"></a>
        <?php } ?>
        <?php if ($pts_edlinkedin<>"Disable") { ?>
        <a id="sc4" href="<?php echo $pts_linkedin; ?>" title="Linkedin" target="_blank"></a>
        <?php } ?>
        <?php if ($pts_edrss<>"Disable") { ?>
        <a id="sc5" href="<?php bloginfo('rss2_url'); ?>" title="RSS" target="_blank"></a>
        <?php } ?>
	</td>
  </tr>
</table>

<?php } ?>