<!--sponsors	-->
<section id="sponsors">
	<div class="container-fluid headers">
			<h1>Tremendous Thanks To Our Sponsors</h1>
			<?php $args = array(
				'post_type' => 'sponsor',
				'posts_per_page'	=> '-1'
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
					$double_wide = get_field('double_wide');
					?>
					<div class="<?php  echo $double_wide ? "col-xs-12 col-sm-6 col-md-4" : "col-xs-6 col-sm-4 col-md-2"; ?>">
						<div class="<?php  echo $double_wide ? "sponsor_square_double" : "sponsor_square" ?> <?php  echo $portrait ? "portrait" : "landscape"; ?>">
							<a class="sponsor-link" href="<?=  get_field('sponsor_website')?>" target="_blank">
								<?=  the_post_thumbnail($double_wide ? 'large' : 'medium', array('class'=>'img-responsive center-block'))?>
							</a>
						</div>
					</div>
				<?php 
				}
				wp_reset_postdata();
			}
			?>
			<script type="text/javascript">
			// center the sponsor images
			// safari bug is timing related... so set timeout
			// otherwise just sorta do something that works ?
			// ugh
jQuery('.sponsor-link img').ready(function(){setTimeout(function(){jQuery('.sponsor-link img').each(function(idx,img){var ih = jQuery(img).height(); var ph = jQuery(img).parent().height(); /*console.log('ph'+ph+'ih'+ih);*/ if(ph>ih+3){ jQuery('#thepre').text("done"); jQuery(img).css('margin-top',((ph-ih)/2)-2)};})},11);});
			</script>

	</div>
</section>