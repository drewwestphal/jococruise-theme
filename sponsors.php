<!--sponsors	-->
<section id="sponsors">
	<div class="container-fluid headers">
		<div class="col-xs-12 col-md-12">
			<?php $args = array(
				'post_type' => 'sponsors',
				'LIMIT'	=> '1'
			);
			$sponsors_query = new WP_Query( $args );
			if ( $sponsors_query->have_posts() ) {
				while ( $sponsors_query->have_posts() ) {
					$sponsors_query->the_post();
					?>
					<h1><?php the_title(); ?></h1>
						<?php the_content();
				}
				wp_reset_postdata();
			}
			?>
		</div>
	</div>
</section>