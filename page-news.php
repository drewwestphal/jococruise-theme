<section class="mac-page" id="page-news">
	<div class="container">
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
							<h1 class="orange-text"><?php the_title(); ?></h1>
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