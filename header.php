<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( ' | ', true, 'right' ); ?></title>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php include 'theme_variables.php'; ?>
<div id="wrapper" class="hfeed">

<nav id="nav" class="navbar navbar-default <?php if (current_user_can('manage_options')) { echo 'logged-in'; }?>">
	<div class="container" id="nav-container">
		<div class="navbar-header">
			<button>
			    <span class="sr-only">Toggle navigation</span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			    <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">
				<img src="<?php bloginfo('template_directory'); ?>/img/hero_JoCo_LoGo.png" alt="A styled JoCo Cruise logotype." id="nav-joco-logo">
			</a>
			<a href="#" id="nav-arrow-to-top">
				<img src="<?php bloginfo('template_directory'); ?>/img/arrow-white.png" class="point-up">
				<br>Top
			</a>
		</div>
		<div class="navbar-dropdown">
			<ul>
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
