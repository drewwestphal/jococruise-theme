<?php get_header(); ?>
<?php include 'bumper_top.php'; ?>
<div class="container nav-spacer">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		if ( has_post_thumbnail() ) { ?>
			<div class="col-xs-12 col-sm-5 col-md-4">
				<?php echo str_replace('class="','class="img-responsive artist-page-image ',get_the_post_thumbnail()); ?>
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
						<a href="<?php echo get_field('artist_youtube'); ?>" class="social-icon youtube" target="_blank">
						</a>
					<?php  };
					   if (get_field('artist_website')){ ?>
						<a href="<?php echo get_field('artist_website'); ?>" class="social-icon website" target="_blank">
						</a>
					<?php  }; ?>
				</div>
			</div>
		<?php } ?>
			<div class="col-xs-12 <?php echo has_post_thumbnail() ? "col-sm-7 col-md-8" : "col-sm-12 col-lg-10 col-lg-offset-1"; ?>">
				<h1><?php the_title(); ?></h1>
				<?php if (get_field('artist_subtitle')) {?>
					<h2><?php the_field('artist_subtitle'); ?></h2>
				<?php }; ?>
				<?php if (get_field('byline_image')) {
					$image = get_field('byline_image');
					//var_dump($image);
					?>
					<div class="byline">
						<img src="<?php echo $image['sizes']['thumbnail']; ?>" alt="<?php echo $image['alt']; ?>" width="<?=$image['sizes']['thumbnail-width']?>" />
						<span><?=get_field('byline_name')?></span>
					</div>
					<?php
				}					
				?>
				<?php if ($post->post_content) {?>
					<div class="artist-text"><?php the_content(); ?></div>
				<?php  } else { ?>
					<div class="artist-text"><?php the_excerpt(); ?></div>
				<?php  }; ?>
			</div>
	<?php endwhile; endif; ?>
</div>
<?php include 'bumper_bottom.php'; ?>
<?php get_footer(); ?>

