<?php if ( get_post_type() == "post"  ) {  ?>
<div class="bumper bumper-bottom">
	<div class="container">
		<div class="col-xs-6 bumper-left">
			<?php if (isset(get_next_post()->ID)) { ?>
				<a href="<?php echo get_permalink( get_next_post()->ID );?>">
					<span class="glyphicon glyphicon-menu-left"></span>
					<?php echo get_next_post()->post_title;?>
				</a>
			<?php }; ?>
		</div>
		<div class="col-xs-6 bumper-right">
			<?php if (isset(get_previous_post()->ID)) { ?>
				<a href="<?php echo get_permalink( get_previous_post()->ID );?>">
					<?php echo get_previous_post()->post_title;?>
					<span class="glyphicon glyphicon-menu-right"></span>
				</a>
			<?php }; ?>
		</div>
	</div>
</div>
<?php }; ?>