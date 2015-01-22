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
			<a id="navbar-title" href="#" class="navbar-item-left">
				<img src="<?php bloginfo('template_directory'); ?>/img/hero_JoCo_LoGo.png" alt="A styled JoCo Cruise logotype." id="nav-joco-logo">
			</a>
			<a href="#" id="nav-arrow-to-top" class="navbar-item-right">
				<span class="glyphicon glyphicon-menu-up"></span>
				<br>Top
			</a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
				<?php
				if ($booking_enabled == 1) {  ?>
					<li><a href="<?php echo $booking_url; ?>">Book Now</a></li>
				<?php 
				}
					mac_clean_menu();
				?>				
			</ul>
		</div>
	</div>	
</nav>
