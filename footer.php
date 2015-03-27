<div class="clear"></div>
</div>
<footer>
	<?php $settings = get_option('mac_settings'); ?>
	<?php $footer_text = $settings['mac_footer_text']; ?>
	<?php include 'sponsors.php'; ?>
	<div class="footer-info">
		<small>&copy;<?php echo date("Y"); ?> JoCoCruise<?php if (strlen($footer_text)>0){ echo ' '.$footer_text; }; ?></small>
	</div>
</footer>
</div>
<?php include 'analytics.php'; ?>
<?php wp_footer(); ?>
</body>
</html>