<?php include 'theme_variables.php';
get_header(); 

?>

<section id="content" role="main">
<!--hero-->
	<section id="hero">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-12">
				<img src="<?php bloginfo('template_directory'); ?>/img/hero_JoCo_LoGo.png" alt="A styled JoCo Cruise logotype." id="hero-joco-logo">
				<?php if (isset($hero_book_now)){ ?>
					<div class="hero-buttons">
						<div class="hero-button"><a href="<?php echo $booking_url; ?>"><?php echo $hero_book_now; ?></a></div>
					<?php };?>
					<?php if (isset($booked)){ ?>
						<div class="hero-button"><a href="<?php echo $booked_url; ?>"><?php echo $booked; ?></a></div>
					</div>
				<?php };?>
			</div>
		</div>
	</section>
	<?php if (isset($travel_desc) || isset($travel_desc_more) || isset($booking_enabled)){ ?>
	<section id="hero-about">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-12">
				<?php if (isset($travel_desc)){ ?>
					<p id="hero-travel-description"><?php echo $travel_desc; ?></p>
				<?php  }; ?>
				<?php if (isset($travel_desc_more)){ ?>
					<div id="hero-travel-description-more">
						<p ><?php echo $travel_desc_more;?></p>				
					</div>
					<img id="hero-boat" src="<?php bloginfo('template_directory'); ?>/img/hero_boat.png" alt="An animated cruise ship">
				<?php  }; ?>
				<?php if (isset($booking_enabled)) { ?>
					<div id="hero-booking">
					<?php if (strlen($booking_cta) > 0) { ?>
						<a href="<?php echo $booking_url; ?>" id="hero-book-now"><?php echo get_option('mac_settings')['mac_button_cta']; ?></a>
					<?php } else { ?>
						<a href="<?php echo $booking_url; ?>" id="hero-book-now">Book Now</a>
					<?php }; ?>
					</div>
				<?php }; ?>
			</div>
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
	<section id="news" class="headers">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-12">
				<div id="news-header">
					<?php if (strlen($news_header) > 0){ ?>
						<h1><?php echo $news_header; ?></h1>
					<?php  }; ?>
				</div>
				<?php if ($news_count > 1) { ?>
				<div class="carousel" id="news-carousel">
					<span class="glyphicon glyphicon-menu-left"></span>
					<?php for ($m=0;$m<$news_count;$m++){ ?>		
							<a href="#news-item-<?php echo $m; ?>" <?php if ($m===0) { echo 'class="orange-text unmove"';} else { echo 'class="unmove"'; };?>>&bull;</a>
					<?php 						}
					?>	
					<span class="glyphicon glyphicon-menu-right"></span>
				</div>
				<?php }; ?>
				<div id="news-container">
					<div id="news-items">
						<?php 							while ($news_query->have_posts()) {
								$news_query->the_post();
								echo '<div class="news-item">';
								include('news-unit.php');
								echo '</div>';
							}
						?>
					</div>
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
	<section id="mailing-list" class="headers">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-12">
				<h1><?php echo $mailing_cta; ?></h1>
				<?php mc4wp_form(); ?>
			</div>
		</div>
	</section>
	<?php }; ?>
<!--artists-->
	<section id="artists" class="headers">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-12">
				<div id="artists-header">
					<img src="<?php bloginfo('template_directory'); ?>/img/artist_divider.png">
					<?php if (strlen($artists_header) > 0){ ?>
						<h1><?php echo $artists_header; ?></h1>
					<?php  }; ?>
				</div>
				<div id="artists-artist-container">
					<div id="overflow">
						<div class="inner">
							<?php 
								$j=0;
								//get the artists
								$args = array(
									'post_type' 	 => 'artist',
									'posts_per_page' => -1,
									'order'			 => 'ASC',
									'meta_query' => array(
										array(
											'key' => 'artist_type',
											'value' => 'artist'
										),
									)
								);
								$artist_query = new WP_Query($args);
								$artist_count = $artist_query->post_count;
								if ($artist_query->have_posts()) {
									while ($artist_query->have_posts()) {
										$artist_query->the_post();
			
										include 'artist_unit.php';
									}
								}
			
								wp_reset_postdata();
								
								//get the featured artists
								$args = array(
									'post_type' 	 => 'artist',
									'posts_per_page' => -1,
									'order'			 => 'ASC',
									'meta_query' => array(
										array(
											'key' => 'artist_type',
											'value' => 'featured artist'
										),
									)
								);
								$feat_artist_query = new WP_Query($args);
								$feat_count = $feat_artist_query->post_count;
								$artist_count += $feat_count;
								if ($feat_count > 0) {
									$artist_count += 1;
									echo '
									<div class="artist_unit artists-artist headers featured-guests" id="item-'.$j.'">
										<h1><span>And</span><br>Featured Guests</h1>
									</div>
									';
									$j++;	
								};
								if ($feat_artist_query->have_posts()) {
									while ($feat_artist_query->have_posts()) {
										$feat_artist_query->the_post();
										
										include 'artist_unit.php';
									}
								}
			
								wp_reset_postdata();
								
								//get the office hours artists
								$args = array(
									'post_type' 	 => 'artist',
									'posts_per_page' => -1,
									'order'			 => 'ASC',
									'meta_query' => array(
										array(
											'key' => 'artist_type',
											'value' => 'office hours'
										),
									)
								);
								$oh_artist_query = new WP_Query($args);
								$oh_count = $oh_artist_query->post_count;
			
								$i=-4;
								if ($oh_artist_query->have_posts()) {
									while ($oh_artist_query->have_posts()) {
										$oh_artist_query->the_post();
										
										include 'artist_office_hours_logic.php';
									}
								}
								wp_reset_postdata();
							?>
						
							<?php if ($artists_more == 1) { 
								$artist_count++; ?>
								<div class="artist_unit artists-artist headers featured-guests" id="item-<?php echo $j; ?>">
									<h1><span>Plus</span><br>More to Come Soon!</h1>
								</div>
							<?php }; ?>
						</div>
					</div>
				</div>
				<div class="carousel" id="artist-carousel">
					<span class="glyphicon glyphicon-menu-left"></span>
					<?php for ($i=0;$i<$artist_count;$i++){ ?>		
							<a href="#item-<?php echo $i; ?>" <?php if ($i===0) { echo 'class="orange-text unmove"';} else { echo 'class="unmove"'; };?>>&bull;</a>
					<?php 						}
					?>	
					<span class="glyphicon glyphicon-menu-right"></span>
				</div>
			</div>
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
	<section id="map">
		<div class="container-fluid">
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
	<section id="contact">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-12 headers">
				<h1 id="contact-header">Contact Us</h1>
				<div id="contact-info-container">
					<?php if (strlen($cont_gen_q_addy) > 0){ ?>
					<div class="contact-info-group">
						<div class="contact-icon" id="contact-icon-info">
							<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
						</div>
						<div class="contact-text headers">
							<h1><?php echo $cont_gen_q; ?></h1>
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
							<h1><?php echo $cont_book_q; ?></h1>
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
							<h1><?php echo $cont_tel; ?></h1>
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
				<div id="contact-form-container">
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
						<button type="submit" value="Submit">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</section>
<!-- faq -->
<div class="faq container-fluid">
	<div class="faq col-xs-12 col-md-12">
		<section id="faq" class="headers">
				<h1><span>Frequently Asked</span><br>Questions</h1>
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
				$l=0;
				$faq_query = new WP_Query( $args );
				if ( $faq_query->have_posts() ) {
					$faq_count = $faq_query->post_count;
					?>
					
					<div class="faq-carousel carousel visible-xs-block" id="faq-carousel-small">
						<span class="glyphicon glyphicon-menu-left"></span>
						<?php for ($l=0;$l<$faq_count;$l++){ ?>		
								<a href="#faq-item-small-<?php echo $l; ?>" <?php if ($l===0) { echo 'class="orange-text unmove"'; } else { echo 'class="unmove"';};?>>&bull;</a>
						<?php 							}
						?>	
						<span class="glyphicon glyphicon-menu-right"></span>
					</div>
					<div class="faq-carousel carousel hidden-xs <?php if ($faq_count <= 3) { echo 'hidden'; } ?>" id="faq-carousel-wide">
						<span class="arrow arrow-left"></span>
						<?php 							$wide_count = ceil($faq_count/3);
							for ($l=0;$l<$wide_count;$l++){ ?>		
								<a href="#faq-item-wide-<?php echo $l; ?>" <?php if ($l===0) { echo 'class="orange-text"'; };?>>&bull;</a>
						<?php 							}
						?>	
						<span class="arrow arrow-right"></span>
					</div>	
					<div id="faq-overflow" style="left:0;">
						<?php 						$faqlink = get_page_by_title('FAQ');
                        $faqlink = get_permalink($faqlink -> ID);
                        $markup = '<div class="faq-group">';
                        $m = 1;
                        while($faq_query -> have_posts()) {
                            $faq_query -> the_post();
                            $markup .= sprintf('<div class="faq-item-container" id="faq-item-%d">', $m);
                            $markup .= sprintf('<div class="faq-item-question"><a href="%s"><h2>%s</h2></a></div>', //
                            $faqlink . '#' . $post -> post_name, get_the_title());
                            $markup .= sprintf('<div class="faq-item-answer">%s</div>', //
                            $post -> post_excerpt ? get_the_excerpt() : get_the_content());
                            $markup .= '</div>';
                            // close faq group && reopen every 3 faq items
                            if($m % 3 === 0) {
                                $markup .= '</div><div class="faq-group">';
                            }
                            $m++;
                        }
                        $markup .= "</div>";
                        echo $markup;
						wp_reset_postdata();
						?>
					</div>
					
				<?php 				}
				?>
				<a id="faq-view-all" href="/faq">View All FAQS</a>
		</section>
	</div>
</div>	
							
<style type="text/css">
    #wpadminbar{
	    position: fixed !important;
    }
    /* FAQ */
    #faq-overflow{
	    width:<?php echo $faq_count; ?>00%;
    }
    .faq-item-container{
	    width:<?php echo 100/$faq_count; ?>%;
    }
	@media screen and (min-width:768px){ 
		#faq-overflow{
		    width:<?php echo $faq_count; ?>00%;
	    }
	    .faq-item-container{
		    width:<?php echo 100/$faq_count; ?>%;
	    }
	    #faq-overflow{
		    width:<?php echo $wide_count; ?>00%;
	    }
	    .faq-group{
		    width:<?php echo 100/$wide_count; ?>%;
	    }
	    .faq-item-container{
		    width:33%;
	    }
	}
	/* Artists */
	#overflow{
	    width:<?php echo $artist_count; ?>00%;
    }
	.artists-artist{
	    width:<?php echo 100/($artist_count===0?1:$artist_count); ?>%;
    }
    @media screen and (min-width:768px){ 
	    #overflow{
	    	width:100%;
	    }
	    .artists-artist{
		    width:200px;
	    }
    }
    /* Artists */
    #news-items{
	    width:<?php echo $news_count; ?>00%;
    }
    .news-item{
	    width:<?php echo 100/$news_count; ?>%;
    }

</style>

<?php include 'footer.php';
/*
echo get_option('permalink_structure');
echo "\nPRINT booking url:\n";
var_dump($booked_url);
echo "\nRESET with get_site_option\n";
$settings = get_site_option('mac_settings');
var_dump($settings);

$string_bloop = 'a:27:{s:19:"mac_booking_enabled";s:1:"1";s:15:"mac_booking_url";s:21:"/booking-opening-soon";s:17:"mac_contact_email";s:22:"booking@jococruise.com";s:16:"mac_travel_dates";s:37:"Feb 21 - Feb 28, 2016 (Sunday-Sunday)";s:14:"mac_button_cta";s:34:"Booking for 2016 is coming Soon™";s:22:"mac_travel_description";s:199:"<span class="bold">JoCo Cruise 2016</span> is a 7-night Eastern Caribbean cruise on Royal Caribbean’s <span class="italic">Freedom of the Seas</span> celebrating music, comedy, and general nerdery.";s:27:"mac_travel_description_more";s:369:"<p>The 2016 cruise will depart from Port Canaveral, Florida on <span class="bold">Sunday, February 21</span> and return on <span class="bold">Sunday, February 28th</span>, with ports of call at CocoCay, St. Thomas, and St. Maarten.<br><br>rnPerformers include Jonathan Coulton, Paul and Storm, and friends from across the music, comedy, gaming, and writing worlds. </p>";s:17:"mac_hero_book_now";s:9:"Book Now!";s:23:"mac_hero_already_booked";s:21:”Im Booked! Now What?";s:27:"mac_hero_already_booked_url";s:13:"/faq/#prepare";s:20:"mac_mailing_list_cta";s:75:"<h1><span>Join the</span><br>JoCo Cruise Mailing List																	</h1>";s:16:"mac_facebook_url";s:40:"https://www.facebook.com/JoCoCruiseCrazy";s:15:"mac_twitter_url";s:30:"https://twitter.com/jococruise";s:12:"mac_feed_url";s:24:"jococruise.com/?feed=rss";s:17:"mac_talent_header";s:66:"<span>Enjoy the Following</span><br>Performers and Featured Guests";s:15:"mac_enable_more";s:1:"1";s:28:"mac_general_questions_header";s:17:"GENERAL QUESTIONS";s:36:"mac_general_questions_address_header";s:19:"info@jococruise.com";s:28:"mac_booking_questions_header";s:15:"CRUISE BOOKINGS";s:36:"mac_booking_questions_address_header";s:23:"bookings@jococruise.com";s:26:"mac_phone_questions_header";s:18:"LEAVE US A MESSAGE";s:34:"mac_phone_questions_address_header";s:31:"(256) 3GO-JCCC / (256) 346-5222";s:12:"mac_map_copy";s:0:"";s:15:"mac_news_header";s:0:"";s:17:"mac_news_view_all";s:8:"All News";s:21:"mac_news_view_all_url";s:6:"/news/";s:15:"mac_footer_text";s:187:"  |  <small>Agency of record for JoCo Cruise 2016 is Worldwide Travel and Cruise Associates, Inc. a licensed seller of travel in the state of Florida. License number 10505316.</small>";}';
echo "\nUNSERIALIZE:\n".unserialize($string_bloop);
 * 
 */
 ?>