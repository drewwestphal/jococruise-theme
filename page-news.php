<?php get_header(); ?>
<section id="content" role="main">
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
						<article>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php if ($post->post_content) {?>
							<p><?php the_content(); ?></p>
						<?php  } else { ?>
							<p><?php the_excerpt(); ?></p>
						<?php  }; ?>	
						</article>
				<?php  }; ?>	
			<?php  }; ?>
			<?php wp_footer(); ?>	
		</div>
	</div>
</section>