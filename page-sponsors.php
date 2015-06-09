<?php get_header(); ?>
<?php include 'bumper_top.php'; ?>
<section class="mac-page headers" id="page-faq">
	<div class="container-fluid">
		<div class="col-xs-12 col-md-12">
			<h1 class="orange-text"><?php the_title(); ?></h1>
		    <?php if (have_posts()) : while (have_posts()) : the_post();?>
	            <div class="mac-page-intro"><?php the_content(); ?></div>
		    <?php endwhile; endif; 
		    $args = array(
				'post_type' => 'sponsor',
				'posts_per_page' => -1 
			);
			?>
		    <section class="mac-page-toc headers">
            <?php 
                $sponsor_query = new WP_Query( array(
                    'post_type' => 'sponsor',
                    'posts_per_page' => -1
                ));
                $byHeader = array();
                while($sponsor_query -> have_posts()) {
                	$sponsor_query->the_post();
					$image_id = get_post_thumbnail_id();
					$image_info = wp_get_attachment_image_src($image_id,"medium");
					//var_dump($image_info);
					$image_src = $image_info[0];
					//$image_html = get_the_post_thumbnail('medium');
					$portrait = $image_info[1] < $image_info[2] ? true : false;
					$double_wide = get_field('double_wide');
					?>
					<div class="row">
						<div class="col-xs-12 col-sm-3">
							<div class="sponsor_square <? echo $portrait ? "portrait" : "landscape"; ?>">
								<a href="<?=get_field('sponsor_website')?>" target="_blank">
									<?=the_post_thumbnail($double_wide ? 'large' : 'medium')?>
								</a>
							</div>
						</div>
						<div class="col-xs-12 col-sm-9">
							<h2><?=$post->post_title?></h2>
							<p><?=$post->post_content?></p>
						</div>
					</div>
				<?php 
				}
             ?>
		    </section>
			<script src="<?php bloginfo('template_directory'); ?>/js/js_behavior.js"></script>
		</div>
	</div>
</section>
<?php include 'footer.php'; ?>