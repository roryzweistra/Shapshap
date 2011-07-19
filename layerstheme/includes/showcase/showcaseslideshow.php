<script src="<?php echo bloginfo('template_url'); ?>/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo bloginfo('template_url'); ?>/js/s3slider/s3Slider.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
   $('#s3slider').s3Slider({
      timeOut: 6000
   });
}); 
</script>

<div id="showcasewrap">
	<div id="showcasetop"></div>
		<div id="showcasemiddle">
			<div id="showcase">
			

<div id="s3slider">
	<ul id="s3sliderContent">
	<!-- slide 1 -->
	<?php if ($pts_s1<>"Disable") { ?>
		<li class="s3sliderImage">
			
			<img src="<?php echo $pts_s1path; ?>" alt="<?php echo $pts_s1alt; ?>" />
			<?php if ($pts_s1info<>"Disable") { ?>
				<span><?php echo $pts_s1desc; ?>...<a href="<?php echo $pts_s1link; ?>" title="<?php echo $pts_s1linktitle; ?>" class="smore"><?php echo $pts_s1more; ?></a></span>
			<?php } ?>
		</li>
	<?php } ?>
	  <!-- slide 2 -->
	 <?php if ($pts_s2<>"Disable") { ?>
		<li class="s3sliderImage">
		
			<img src="<?php echo $pts_s2path; ?>" alt="<?php echo $pts_s2alt; ?>" />
			<?php if ($pts_s2info<>"Disable") { ?>
				<span><?php echo $pts_s2desc; ?>...<a href="<?php echo $pts_s2link; ?>" title="<?php echo $pts_s2linktitle; ?>" class="smore"><?php echo $pts_s2more; ?></a></span>
			<?php } ?>
		</li>
	<?php } ?> 
	  <!-- slide 3 -->
	<?php if ($pts_s3<>"Disable") { ?>
		<li class="s3sliderImage">
			<img src="<?php echo $pts_s3path; ?>" alt="<?php echo $pts_s3alt; ?>" />
			<?php if ($pts_s3info<>"Disable") { ?>
				<span><?php echo $pts_s3desc; ?>...<a href="<?php echo $pts_s3link; ?>" title="<?php echo $pts_s3linktitle; ?>" class="smore"><?php echo $pts_s3more; ?></a></span>
			<?php } ?>
		</li>
	<?php } ?>  
	  <!-- slide 4 -->
	<?php if ($pts_s4<>"Disable") { ?>
		<li class="s3sliderImage">
			<img src="<?php echo $pts_s4path; ?>" alt="<?php echo $pts_s4alt; ?>" />
			<?php if ($pts_s4info<>"Disable") { ?>
				<span><?php echo $pts_s4desc; ?>...<a href="<?php echo $pts_s4link; ?>" title="<?php echo $pts_s4linktitle; ?>" class="smore"><?php echo $pts_s4more; ?></a></span>
			<?php } ?>
		</li>
	<?php } ?>  
	  <!-- slide 5 -->
	<?php if ($pts_s5<>"Disable") { ?>
		<li class="s3sliderImage">
			<img src="<?php echo $pts_s5path; ?>" alt="<?php echo $pts_s5alt; ?>" />
			<?php if ($pts_s5info<>"Disable") { ?>
				<span><?php echo $pts_s5desc; ?>...<a href="<?php echo $pts_s5link; ?>" title="<?php echo $pts_s5linktitle; ?>" class="smore"><?php echo $pts_s5more; ?></a></span>
			<?php } ?>
		</li>
	<?php } ?>
	  
      <div class="clear s3sliderImage"></div>
   </ul>
</div>




			</div>
		</div>
	<div id="showcasebottom"></div>
</div>