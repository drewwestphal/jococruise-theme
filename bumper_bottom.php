<div class="bumper container-fluid">
	<div class="bumper-container">
			<div class="bumper-element bumper-left" id="bumper-left">
				<?php if (get_previous_post()->ID) { ?>
					<span class="glyphicon glyphicon-menu-left"></span>
					<a href="<?php echo get_permalink( get_previous_post()->ID );?>"><?php echo get_previous_post()->post_title;?></a>
				<?php }; ?>
			</div>
			<div class="bumper-element bumper-right" id="bumper-right">
				<?php if (get_next_post()->ID) { ?>
					<a href="<?php echo get_permalink( get_next_post()->ID );?>"><?php echo get_next_post()->post_title;?></a>
					<span class="glyphicon glyphicon-menu-right"></span>
				<?php }; ?>
			</div>
	</div>
</div>