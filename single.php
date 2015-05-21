<?php get_header(); ?>
<div class="page-artist container-fluid" id="page-artist-content">
	<?php include 'bumper_top.php'; ?>
	<section id="content" class="mac-page" role="main">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-12">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article id="post-artist-info" class="<?php if ( has_post_thumbnail() ) { echo 'has-image'; }; ?>">
					<div class="post-artist-image post-left">
						<?php the_post_thumbnail('full'); ?>
					</div>
					
					<div class="post-artist-text post-right headers">
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
						<p><?php the_content(); ?></p>
					<?php  } else { ?>
						<p><?php the_excerpt(); ?></p>
					<?php  }; ?>
					</div>
					<div class="post-artists-social artists-social post-left">
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
			<?php endwhile; endif; ?>
				</article>
			</div>
		</div>
	</section>
	<?php include 'bumper_bottom.php'; ?>
</div>
<?php get_footer(); ?>

