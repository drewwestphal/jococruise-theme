<!--sponsors	-->
<section id="sponsors">
	<div class="container-fluid headers">
			<h1>Tremendous Thanks To Our Sponsors</h1>
			<?php $args = array(
				'post_type' => 'sponsor',
				'LIMIT'	=> '1'
			);
			$sponsors_query = new WP_Query( $args );
			if ( $sponsors_query->have_posts() ) {
				while ( $sponsors_query->have_posts() ) {
					$sponsors_query->the_post();
					$image_id = get_post_thumbnail_id();
					$image_info = wp_get_attachment_image_src($image_id,"medium");
					//var_dump($image_info);
					$image_src = $image_info[0];
					//$image_html = get_the_post_thumbnail('medium');
					$portrait = $image_info[1] < $image_info[2] ? true : false;
					?>
					<div class="col-xs-6 col-sm-4 col-md-3">
						<div class="sponsor_square <? echo $portrait ? "portrait" : "landscape"; ?>">
							<a href="<?=get_field('sponsor_website')?>" target="_blank">
								<?=the_post_thumbnail('medium')?>
							</a>
						</div>
					</div>
				<?php 
				}
				wp_reset_postdata();
			}
			?>
	</div>
</section>