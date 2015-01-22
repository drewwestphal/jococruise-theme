<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( ' | ', true, 'right' ); ?></title>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">

<nav id="nav" class="navbar-default <?php if (current_user_can('manage_options')) { echo 'logged-in'; }?>">
	<div class="container" id="nav-container">
		<div class="navbar-top">
			<div id="nav-button" class="navbar-item-left">
				<button type="button" id="nav-button-inner" class="navbar-toggle navbar-item-left collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
				</button>
			</div>
			<?
			$sticky = get_option('sticky_posts');
			$args = array(
				'posts_per_page' => 1,
				'post__in'  => $sticky,
				'ignore_sticky_posts' => 1
			);
			$stick_query = new WP_Query($args);
			if (isset($sticky[0])) { ?>
				<a id="navbar-title-headline" href="<?php the_permalink(); ?>" class="navbar-item-left">
				<span class="nav-headline"><?php the_title(); ?></span><span class="glyphicon glyphicon glyphicon-menu-right"></span>
				</a>
				<a id="navbar-title" href="#" class="navbar-item-left nav-hidden">
					<img src="<?php bloginfo('template_directory'); ?>/img/hero_JoCo_LoGo.png" alt="A styled JoCo Cruise logotype." id="nav-joco-logo">
				</a>
	  <?php } else { ?>
				<a id="navbar-title" href="#" class="navbar-item-left">
					<img src="<?php bloginfo('template_directory'); ?>/img/hero_JoCo_LoGo.png" alt="A styled JoCo Cruise logotype." id="nav-joco-logo">
				</a>
	  <?php } ?>
			<a href="#" id="nav-arrow-to-top" class="navbar-item-right<?php if (isset($sticky[0])) { echo ' nav-hidden'; }; ?>">
				<span class="glyphicon glyphicon-menu-up"></span>
				<br>Top
			</a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
				<?php
				$booking_enabled  = get_option('mac_settings')['mac_booking_enabled'];	
				if ($booking_enabled == 1) {  ?>
					<li><a href="<?php echo $booking_url; ?>"><span>Book Now</span></a></li>
				<?php 
				}
					mac_clean_menu();
				?>				
			</ul>
		</div>
	</div>	
</nav>
