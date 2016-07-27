<!--sponsors	-->
<section id="sponsors">
	<div class="container headers">
		<h1>Thanks To Our Sponsors</h1>
		<div>
			<?php $args = array(
				'post_type' => 'sponsor',
				'posts_per_page'	=> '-1'
			);
			$sponsors_query = new WP_Query( $args );
			if ( $sponsors_query->have_posts() ) {
				while ( $sponsors_query->have_posts() ) {
					$sponsors_query->the_post();
					$image_id = get_post_thumbnail_id();
                    $double_wide = get_field('double_wide');
					$image_info = wp_get_attachment_image_src($image_id,$double_wide?'large':'medium');
					$portrait = $image_info[1] < $image_info[2] ? true : false;
                    // don't write a tag unless image exist
                    $image_tag = $image_info[0]?sprintf('<img src="%s" alt="%s" />', $image_info[0], get_the_title().' Logo'):'';
					?>
					<div class="<?php  echo $double_wide ? "col-xs-12 col-sm-6 col-lg-4" : "col-xs-6 col-sm-3 col-lg-2"; ?>">
						<div class="<?php  echo $double_wide ? "sponsor_square_double" : "sponsor_square" ?> <?php  echo $portrait ? "portrait" : "landscape"; ?>">
							<a href="<?=  get_field('sponsor_website')?>" target="_blank">
								<?= $image_tag; ?>
							</a>
						</div>
					</div>
				<?php 
				}
				wp_reset_postdata();
			}
			?>
		</div>
	</div>
</section>