<?php include 'theme_variables.php';
get_header(); 

?>

<section id="content" role="main">
<!--hero-->
	<section id="hero" class="joco_blue">
		<div class="container">
			<div class="col-xs-12 col-md-12">
				<img src="<?php bloginfo('template_directory'); ?>/img/hero_JoCo_LoGo.svg" alt="A styled JoCo Cruise logotype." id="hero-joco-logo">
			</div>
				<?php if (isset($hero_book_now)){ ?>
					<div class="col-xs-12 col-sm-4 col-sm-offset-2">
						<a class="btn btn-lg btn-default hero-button" href="<?php echo $booking_url; ?>"><?php echo $hero_book_now; ?></a>
					</div>
				<?php };?>
				<?php if (isset($booked)){ ?>
					<div class="col-xs-12 col-sm-4"">
						<a class="btn btn-lg btn-default hero-button" href="<?php echo $booked_url; ?>"><?php echo $booked; ?></a>
					</div>
				<?php };?>
		</div>
	</section>
	<?php if (isset($travel_desc) || isset($travel_desc_more) || isset($booking_enabled)){ ?>
	<section id="hero-about">
		<div class="container">
			<div class="col-xs-12 col-md-12">
				<?php if (isset($travel_desc)){ ?>
					<p id="hero-travel-description"><?php echo $travel_desc; ?></p>
				<?php  }; ?>
			</div>
			<?php if (isset($travel_desc_more)){ ?>
				<div id="hero-travel-description-more" class="col-xs-6 col-sm-7 col-md-8 col-lg-9">
					<p ><?php echo $travel_desc_more;?></p>
					<?php if (isset($booking_enabled)) { ?>
						<div id="hero-booking">
						<?php if (strlen($booking_cta) > 0) { ?>
							<a href="<?php echo $booking_url; ?>" class="btn btn-lg btn-primary" id="hero-book-now"><?php echo get_option('mac_settings')['mac_button_cta']; ?></a>
						<?php } else { ?>
							<a href="<?php echo $booking_url; ?>" class="btn btn-lg btn-primary" id="hero-book-now">Book Now</a>
						<?php }; ?>
						</div>
					<?php }; ?>			
				</div>
				<div class="col-xs-6 col-sm-5 col-md-4 col-lg-3">
					<img id="hero-boat" class="img-responsive" src="<?php bloginfo('template_directory'); ?>/img/hero_boat.svg" alt="An animated cruise ship">
				</div>
			<?php  }; ?>
		</div>
	</section>
	<?php }; ?>
<!--news-->
<?php $n=0;
$news_args = array(
	'post_type' 	 	 => 'post',
	'posts_per_page' => 5,
	'ignore_sticky_posts' => 1
);
$news_query = new WP_Query($news_args);
$news_count = $news_query->post_count;

if ($news_query->have_posts()) {
?>
	<section id="news" class="headers joco_blue">
		<div class="container">
			<div class="col-xs-12 col-md-12">
				<div id="news-header">
					<?php if (strlen($news_header) > 0){ ?>
						<h1><?php echo $news_header; ?></h1>
					<?php  }; ?>
				</div>
				<div id="news-container" class="slick-element">
					<?php while ($news_query->have_posts()) {
							$news_query->the_post();
							echo '<div class="news-item">';
							include('news-unit.php');
							echo '</div>';
						}
					?>
				</div>
			<?php if ($news_count > 1) { ?>
				<a id="news-view-all" href="<?php echo $news_view_url; ?>"><?php echo $news_view_all; ?></a>
			<?php }; ?>
			</div>
		</div>
	</section>
<?php 
wp_reset_postdata();
}; ?>
<!--mailing list-->	
	<?php if(function_exists('mc4wp_form')) { ?>
	<section id="mailing-list" class="headers joco_beige">
		<div class="container">
			<div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
				<h1><?php echo $mailing_cta; ?></h1>
				<?php mc4wp_form(); ?>
			</div>
		</div>
	</section>
	<?php }; ?>
<!--artists-->
	<section id="artists" class="headers">
		<div class="container">
			<div class="col-xs-12">
				<div id="artists-header">
					<img src="<?php bloginfo('template_directory'); ?>/img/artist_divider.svg" class="img-responsive">
					<?php if (strlen($artists_header) > 0){ ?>
						<h1><?php echo $artists_header; ?></h1>
					<?php  }; ?>
				</div>
			</div>
			<?php 
				$artist_types = array('artist' => "<span>$cruise_year</span><br />Performers",
										'featured artist' => "<span>$cruise_year</span><br />Featured Guests",
										'spotlight item' => "<span>Plus</span><br />Even More!");
                $targetArtistType='artist_type'.$cruise_year;
				//get the artists
				foreach ($artist_types as $artist_type_value => $artist_type_title) {
					$args = array(
						'post_type' 	 => 'artist',
						'posts_per_page' => -1,
						'order'			 => 'ASC',
						'meta_query' => array(
							array( // made the old 'artist_type' field into the 2016 field, all other years are in field name
								'key' => $targetArtistType,
								'value' => $artist_type_value
							),
						)
					);
					$artist_query = new WP_Query($args);
					if ($artist_query->have_posts()) {
						$artists = array();
						while ($artist_query->have_posts()) {
							$artist_query->the_post();
							$artists[] = array('title' => get_the_title(), 'link' => get_the_permalink(), 
											'image' => get_the_post_thumbnail(), 'subtitle' => the_field('artist_subtitle'));
						}
						echo $twig->render('artists_frontpage.html', array('title'=>$artist_type_title, 'artists'=>$artists));
					}
					wp_reset_postdata();
				}
			?>
			<div class="clearfix"></div>
			<?php 
			$coming_soon = "More performers and guests TBA; watch this space for further announcements.";
			if (get_page_by_path("coming-soon")) {
				$coming_soon = get_page_by_path("coming-soon") -> post_content;
			}
			if ($coming_soon != "") echo "<div id='coming_soon'>".$coming_soon."</div>";
			?>
		</div>
	</section>
<!--about-->
<section id="about">
	<?php 

	//get the artists
	$args = array(
		'post_type' => 'about',
		'orderby'	=> 'ID',
		'order'		=> 'ASC'
	);
	$k=0;
	$about_query = new WP_Query( $args );
	if ( $about_query->have_posts() ) {
		while ( $about_query->have_posts() ) {
			$about_query->the_post();
			
			$thumb_id = get_post_thumbnail_id();
			$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
			$thumb_url = $thumb_url_array[0];
	?>
			<div class="about-item clearfix headers <?php if ($k % 2 == 0) { echo 'right'; };?>">
				<div class="about-image"style="background:url('<?php echo $thumb_url;?>') center center no-repeat;background-size: cover;"></div>
				<div class="about-info">
					<h1><?php the_title(); ?></h1>
					<?php if (has_excerpt()){ ?>
						<p><?php the_excerpt(); ?></p>
					<?php } else { ?>
						<p><?php the_content(); ?></p>
					<?php }; ?>
				</div>
			</div>
			<?php
			$k++;
		}
	}

	wp_reset_postdata();
	?>
</section>	
<!--map-->
	<section id="map" class="joco_beige">
		<div class="container">
			<div class="col-xs-12 col-md-12">
				<div class="map-cities">
					<img src="<?php bloginfo('template_directory'); ?>/img/map.png" id="map-background">		
					<?php 					//get the cities
					$map_width = 1650;
					$map_height = 860;
					$args = array(
						'post_type' 	 => 'city',
						'posts_per_page' => -1
					);
					$cities_query = new WP_Query($args);

					if ($cities_query->have_posts()) {
						while ($cities_query->have_posts()) {
							$cities_query->the_post();
							
							include 'map-city-logic.php';
						}
					}
					?>
				</div>
				<div class="map-info visible-xs-block">
				<?php if (isset($map_copy)) { ?>
					<p id="map-copy">
						<?php echo $map_copy; ?>
					<p>
				<?php }; 
				if ($cities_query->have_posts()) {
					while ($cities_query->have_posts()) {
						$cities_query->the_post();
				?>
					<div class="map-narrow-info headers" id="info-<?php echo $post->post_name; ?>">
						<span class="glyphicon glyphicon-remove"></span>
						<h1><?php the_title(); ?></h1>
						<?php the_excerpt(); ?>
					</div>
					
				<?php }
				}?>
				</div>
				<?php wp_reset_postdata();?>
			</div>
		</div>
	</section>
<!--contact-->
	<section id="contact" class="joco_blue">
		<h1 id="contact-header">Contact Us</h1>
		<div class="container">
			<div class="col-xs-12 col-sm-6 col-md-5 headers">
					<?php if (strlen($cont_gen_q_addy) > 0){ ?>
					<div class="contact-info-group">
						<div class="contact-icon" id="contact-icon-info">
							<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
						</div>
						<div class="contact-text headers">
							<h5><?php echo $cont_gen_q; ?></h5>
							<a href="mailto: <?php echo $cont_gen_q_addy; ?>"><?php echo $cont_gen_q_addy; ?></a>
						</div>
					</div>
					<?php  }; ?>
					<?php if (strlen($cont_book_q_addy) > 0){ ?>
					<div class="contact-info-group">
						<div class="contact-icon" id="contact-icon-booking">
							<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
						</div>
						<div class="contact-text headers">
							<h5><?php echo $cont_book_q; ?></h5>
							<a href="mailto: <?php echo $cont_book_q_addy; ?>"><?php echo $cont_book_q_addy; ?></a>
						</div>					
					</div>
					<?php  }; ?>
					<?php if (strlen($cont_tel_addy) > 0){ ?>					
					<div class="contact-info-group">
						<div class="contact-icon" id="contact-icon-phone">
							<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
						</div>
						<div class="contact-text headers">
							<h5><?php echo $cont_tel; ?></h5>
							<?php echo $cont_tel_addy; ?>
						</div>
					</div>
					<?php  }; ?>
					<div class="contact-info-group contact-social">
						<?php if (strlen($cruise_fb) > 0){ ?>
						<a href="<?php echo $cruise_fb; ?>" class="contact-social-icon facebook" target="_blank"></a>
						<?php  }; ?>
						<?php if (strlen($cruise_twitter) > 0){ ?>
						<a href="<?php echo $cruise_twitter; ?>" class="contact-social-icon twitter" target="_blank"></a>
						<?php  }; ?>
						<?php if (strlen($cruise_rss) > 0){ ?>
						<a href="<?php echo $cruise_rss; ?>" class="contact-social-icon rss" target="_blank"></a>
						<?php  }; ?>
					</div>
			</div>
			<div id="contact-form-container" class="col-xs-12 col-sm-6 col-md-7">
					<form name="form" action="<?php bloginfo('template_directory'); ?>/contact.php" method="post" id="contact-form" novalidate class="clearfix">
						<div class="contact-input" id="contact-input-email">
							<input name="email" type="email" id="email" placeholder="your email address*">
						</div>
						<div class="contact-input" id="contact-input-name">
							<input type="text" id="name" name="name" placeholder="your name*">
						</div>
						<input type="text" id="honeypot" name="honeypot" aria-hidden="true" placeholder="Please leave blank.">
						<div class="contact-comments" id="contact-comments">
							<textarea name="comments" id="comments" placeholder="your message*"></textarea>
						</div>
						<div class="recaptcha-container">
							<div class="g-recaptcha" data-sitekey="6LdDyQUTAAAAAHpsqVuzy36d-8y5w7y7jyPvXE_d" data-theme="dark"></div>
						</div>
						<button id="contact-button" class="btn btn-lg btn-info contact-button" type="submit" value="Submit">Submit</button>
					</form>
			</div>
		</div>
	</section>
<!-- faq -->
<div class="faq container">
	<div class="faq col-xs-12 col-md-12">
		<h1><span>Frequently Asked</span><br>Questions</h1>
	</div>
	<?php 
	$args = array(
		'post_type' => 'faq',
		'orderby'	=> 'ID',
		'order'		=> 'ASC',
		'meta_query' => array(
	        array(
	            'key' => 'show_on_front_page',
	            'value' => '"show on front page"',
	            'compare' => 'LIKE'
	        )
	    )
	);
	$faq_query = new WP_Query( $args );
	if ( $faq_query->have_posts() ) {
		$faq_count = $faq_query->post_count;
		$faqlink = get_page_by_title('FAQ');
        $faqlink = get_permalink($faqlink -> ID);
        $faq_items = array();
        while($faq_query -> have_posts()) {
        	$faq_query -> the_post();
        	$faq_items[] = array('title' => get_the_title(), 'slug' => $post->post_name, 'content' => $post->post_excerpt ? get_the_excerpt() : get_the_content());
        }
		wp_reset_postdata();
		echo $twig->render('faq_frontpage.html', array('faq_link' => $faqlink,'faqs' => $faq_items));
		}
	?>
	<a id="faq-view-all" href="/faq">View All FAQS</a>
</div>	

<!--Make entire button clickable...-->
<script type="text/javascript">
    jQuery('#hero-booking').click(function(){jQuery(this).find('a')[0].click();});
    jQuery('.hero-button').click(function(){jQuery(this).find('a')[0].click();});
</script>

<?php include 'footer.php' ?>
