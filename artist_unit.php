<div class="artist_unit artists-artist" id="item-<?php echo $j; ?>">
	<div class="artists-featured-image">
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
	</div>
	<div class="artists-name">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<p><?php the_field('artist_subtitle'); ?></p>
	</div>
	<div class="artists-description">
			<p><?php $excerpt = preg_replace('/\s+?(\S+)?$/', '', substr(get_the_excerpt(), 0,55)); echo $excerpt; ?><?php if (strlen(get_the_excerpt()) > 55) { ?><a href="<?php the_permalink(); ?>"> more&hellip;</a>
			<?php } ?></p>
	</div>
	<div class="artists-social">
	<?php  if (get_field('artist_facebook')){ ?>
			<a href="<?php echo get_field('artist_facebook'); ?>" class="social-icon facebook" target="_blank">
			</a>
		<?php  };
		   if (get_field('artist_twitter')){ ?>
			<a href="<?php echo get_field('artist_twitter'); ?>"  class="social-icon twitter" target="_blank">
			</a>
		<?php  };
		   if (get_field('artist_youtube')){ ?>
			<a class="social-icon youtube" href="<?php echo get_field('artist_youtube'); ?>" class="social-icon youtube" target="_blank">
			</a>
		<?php  }; ?>
		
	</div>
</div>
<?php $j++; ?>