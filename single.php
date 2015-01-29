<?php get_header(); ?>
<div class="page-artist container-fluid" id="page-artist-content">
	<div class="bumper container-fluid">
		<div class="bumper-element bumper-left" id="bumper-home">
			<span class="glyphicon glyphicon-menu-left"></span>
			<a href="/">Back to Site</a>
		</div>
	</div>
	<section id="content" class="mac-page" role="main">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-12">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article id="post-artist-info">
					
					<?php the_post_thumbnail('full'); ?>
					
					<div class="post-artist-text">
						<h1><?php the_title(); ?></h1>
						<?php if (get_field('artist_subtitle')) {?>
							<h2><?php the_field('artist_subtitle'); ?></h2>
						<?php }; ?>
					<?php if ($post->post_content) {?>
						<p><?php the_content(); ?></p>
					<?php  } else { ?>
						<p><?php the_excerpt(); ?></p>
					<?php  }; ?>	

					
						<div class="artists-social">
						<?php  if (get_field('artist_facebook')){ ?>
								<a href="<?php echo get_field('artist_facebook'); ?>" class="social-icon facebook" target="_blank">
								</a>
							<? };
							   if (get_field('artist_twitter')){ ?>
								<a href="<?php echo get_field('artist_twitter'); ?>"  class="social-icon twitter" target="_blank">
								</a>
							<? };
							   if (get_field('artist_youtube')){ ?>
								<a class="social-icon youtube" href="<?php echo get_field('artist_youtube'); ?>" class="social-icon youtube" target="_blank">
								</a>
							<? }; ?>
							
						</div>
					</div>
			<?php endwhile; endif; ?>
				</article>
			</div>
		</div>
	</section>
	<div class="bumper container-fluid">
		<?php if (!empty(get_previous_post())){ ?>
			<div class="bumper-element bumper-left" id="bumper-left">
				<span class="glyphicon glyphicon-menu-left"></span>
				<a href="<?php echo get_permalink( get_previous_post()->ID );?>">Previous</a>
			</div>
		<?php }; ?>
		<?php if (!empty(get_next_post())){ ?>
			<div class="bumper-element bumper-right" id="bumper-right">
				<a href="<?php echo get_permalink( get_next_post()->ID );?>">Next</a>
				<span class="glyphicon glyphicon-menu-right"></span>
			</div>
		<?php }; ?>
	</div>
</div>
<?php get_footer(); ?>

