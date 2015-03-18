<?php get_header(); ?>
	<?php include 'bumper_top.php'; ?>
	<section id="artists" class="page-artists headers">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-12">
				<h1><?php the_title(); ?></h1>
			    <?php if (have_posts()) : while (have_posts()) : the_post();?>
		            <div class="mac-page-intro"><?php the_content(); ?></div>
			    <?php endwhile; endif; ?>
				<div id="artists-artist-container">
					<div id="overflow">
						<div class="inner">
							<?php 
								$j=0;
								//get the artists
								$args = array(
									'post_type' 	 	 => 'artist',
									'posts_per_page' => -1,
									'orderby'		 => '_thumbnail_id',
									'order'			 => 'ASC'
								);
								$artist_query = new WP_Query($args);
								$count = $artist_query->post_count;
								if ($artist_query->have_posts()) {
									while ($artist_query->have_posts()) {
										$artist_query->the_post();
										if (has_post_thumbnail()){
											include 'artist_unit.php';
										} else {
											include 'artist_office_hours_logic.php';
										}
									}
								}
			
								wp_reset_postdata();
								?>
						</div>
					</div>
				</div>
				<div class="carousel" id="artist-carousel">
					<span class="glyphicon glyphicon-menu-left"></span>
					<?php for ($i=0;$i<$count;$i++){ ?>		
							<a href="#item-<?php echo $i; ?>" <?php if ($i===0) { echo 'class="orange-text unmove"';} else { echo 'class="unmove"'; };?>>&bull;</a>
					<?php 						}
					?>	
					<span class="glyphicon glyphicon-menu-right"></span>
				</div>
			</div>
		</div>
	</section>
	<?php include 'bumper_bottom.php'; ?>
<?php include 'footer.php'; ?>