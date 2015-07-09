<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.png" />
<title><?php wp_title( ' | ', true, 'right' ); ?></title>

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper" class="hfeed">
<div id="mainsitenav">
<nav class="navbar navbar-default navbar-fixed-top<?php if (is_admin_bar_showing()) echo " wp_admin_bar_showing"; ?>">
	<div class="container">
		<div class="col-xs-3">
			<ul class="nav">
				<li role="presentation" class="dropdown">
				    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">
				      Menu
				    </a>
				    <?php
	                wp_nav_menu( array( 
	                		'theme_location' => 'primary',
	                        'depth'             => 2,
	                        'container'         => false,
	                        'menu_class' => 'dropdown-menu',
	                        'menu_id' => 'nav-dropdown',
	                        'fallback_cb' => 'CCWPNavWalker_RecursiveTwigTemplate::fallback',
	                        //Process nav menu using our custom nav walker
	                        'walker' => new CCWPNavWalker_RecursiveTwigTemplate('navitems.html', 'item')));
					?>
				</li>
			</ul>
		</div>
		<div class="col-xs-6 navbar-header">
	      <a href="/">
	        <img alt="Brand" src="<?php bloginfo('template_directory'); ?>/img/hero_JoCo_LoGo.svg">
	      </a>
	    </div>
	    <div class="col-xs-3">
	    	<a onclick="$('body').animate({ scrollTop: 0 }, 'fast');" id="nav-arrow-to-top" class="navbar-item-right">
				<span class="glyphicon glyphicon-menu-up"></span>
				<br>Top
			</a>
	    </div>
	</div>
</nav>
</div>
<!--
<nav id="nav" class="navbar navbar-default navbar-static-top <?php if (current_user_can('manage_options')) { echo 'logged-in'; }?>">
	<div class="container" id="nav-container">
		<div class="navbar-top">
			<div id="nav-button" class="navbar-item-left">
				<button type="button" id="nav-button-inner" class="navbar-toggle navbar-item-left collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
        				<p class="nav-button-title hidden-xs">Menu</p>
				</button>
			</div>
			<?php 
			$sticky = get_option('sticky_posts');
			$nav_args = array(
				'posts_per_page' => 1,
				'post__in'  => $sticky,
				'ignore_sticky_posts' => 1
			);
			$stick_query = new WP_Query($nav_args);
			if (isset($sticky[0]) && is_home()) { ?>
				<a id="navbar-title-headline" href="<?php the_permalink(); ?>" class="navbar-item-left toggle">
				<span class="nav-headline"><?php the_title(); ?></span><span class="glyphicon glyphicon glyphicon-menu-right"></span>
				</a>
				<a id="navbar-title" href="#wrapper" class="navbar-item-left toggle nav-hidden">
					<img src="<?php bloginfo('template_directory'); ?>/img/hero_JoCo_LoGo.png" alt="A styled JoCo Cruise logotype." id="nav-joco-logo">
				</a>
			<?php } else { ?>
				<a id="navbar-title" href="/" class="navbar-item-left">
					<img src="<?php bloginfo('template_directory'); ?>/img/hero_JoCo_LoGo.png" alt="A styled JoCo Cruise logotype." id="nav-joco-logo">
				</a>
			<?php } ?>
			<a href="#wrapper" id="nav-arrow-to-top" class="navbar-item-right<?php if (isset($sticky[0])) { echo ' toggle nav-hidden'; }; ?>">
				<span class="glyphicon glyphicon-menu-up"></span>
				<br>Top
			</a>
				<?php
                wp_nav_menu( array( 'theme_location' => 'primary',
                        'depth' => 2,
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => 'collapse navbar-collapse',
                        'container_id'      => 'bs-example-navbar-collapse-1',
                        'menu_class' => 'nav navbar-nav',
                        'menu_id' => 'nav-dropdown',
                        'fallback_cb' => 'CCWPNavWalker_RecursiveTwigTemplate::fallback',
                        //Process nav menu using our custom nav walker
                        'walker' => new CCWPNavWalker_RecursiveTwigTemplate('navitems.html', 'item')));
				?>	
		</div>			
	</div>	
<?php wp_reset_postdata(); ?>
</nav>
-->
