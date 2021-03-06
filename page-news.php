<?php get_header(); ?>
<section id="content" role="main">
<?php include 'bumper_top.php'; ?>
<section class="mac-page headers" id="page-news">
	<div class="container-fluid">
		<div class="col-xs-12 col-md-12">
			<h1 class="orange-text">News</h1>
		    <?php if (have_posts()) : while (have_posts()) : the_post();?>
	            <p class="mac-page-intro"><?php the_content(); ?></p>
		    <?php endwhile; endif; ?>
		<?php 
			$args = array(
				'post_type' => 'post'
			);
			$post_query = new WP_Query( $args );
			if ( $post_query->have_posts() ) {
				while ( $post_query->have_posts() ) {
					$post_query->the_post();
					?>
						<article id="post-artist-info">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php if ($post->post_content) {?>
							<div class="post-artist-text"><?php the_content(); ?></div>
						<?php  } else { ?>
							<div class="post-artist-text"><?php the_excerpt(); ?></div>
						<?php  }; ?>	
						</article>
				<?php  }; ?>	
			<?php  }; ?>
			
		</div>
	</div>
</section>
<?php include 'bumper_bottom_empty.php'; ?>
<?php get_footer(); ?>	