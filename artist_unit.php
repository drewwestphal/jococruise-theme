<div class="artist_unit">
	<div class="artists-featured-image">
		<?php the_post_thumbnail(); ?>
	</div>
	<div class="artists-name">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<p><?php the_field('artist_subtitle'); ?></p>
	</div>
	<div class="artists-description">
		<?php the_excerpt(); ?>
	</div>
	<div class="artists-social">
	<?php  if (get_field('artist_facebook')){ ?>
			<a href="<?php echo get_field('artist_facebook'); ?>" class="social-icon facebook">
			</a>
		<? };
		   if (get_field('artist_twitter')){ ?>
			<a href="<?php echo get_field('artist_twitter'); ?>"  class="social-icon twitter">
			</a>
		<? };
		   if (get_field('artist_youtube')){ ?>
			<a class="social-icon youtube" href="<?php echo get_field('artist_youtube'); ?>" class="social-icon youtube">
			</a>
		<? }; ?>
		
	</div>
</div>