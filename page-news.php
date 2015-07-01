<?php get_header(); ?>
<?php include 'bumper_top.php'; ?>
<div class="container nav-spacer">
	<div class="col-xs-12">
		<h1>News</h1>
	    <?php if (have_posts()) : while (have_posts()) : the_post();?>
            <p><?php the_content(); ?></p>
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
					<article class="news-page-item">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<?php if ($post->post_content) {?>
						<div><?php the_content(); ?></div>
					<?php  } else { ?>
						<div><?php the_excerpt(); ?></div>
					<?php  }; ?>	
					</article>
			<?php  }; ?>	
		<?php  }; ?>
	</div>
</div>
<?php get_footer(); ?>	