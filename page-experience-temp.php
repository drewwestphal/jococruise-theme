<style>
	body {
		background-color: #ffffff;
	}
</style>
<?php get_header(); ?>
<?php
function split_title($title) {
	return explode(" | ", $title);
}
$lorem = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
?>

<?php include 'bumper_top.php'; ?>
<section id="page-experience">
	<section id="what-is">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-12">
				<img src="<?php bloginfo('template_directory'); ?>/img/sideview_boat.png" alt="Sideview of ship" id="what-is-ship" />
				<h1>What is the <img src="<?php bloginfo('template_directory'); ?>/img/WhatIs_JoCo_LoGo.png" id="what-is-logo" align="middle" /> ?</h1>
			</div>
		</div>
	</section>
	<section id="exp-intro">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-9">
				<p><?php echo $lorem; ?></p>
			</div>
			<div class="col-xs-12 col-md-3">
				<img src="" />
			</div>
		</div>
	</section>
	<section id="main-stage">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-12">
				<?php $title = split_title("On the | Main stage") ?>
				<h2><?php echo $title[0] ?></h2>
				<h1><?php echo $title[1] ?></h1>
				<p><?php echo $lorem; ?></p>
				<div class="main-stage-button button404"><a href="/#artists">See who is coming so far in 2016</a></div>
				<p>Past cruise guests include (in no particular order, OK, it's alphabetical):</p>
			</div>
		</div>
	</section>
	<section id="featured-events">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-12">
				<?php $title = split_title("JoCo Cruise 2016 | Featured Events") ?>
				<h2><?php echo $title[0] ?></h2>
				<h1><?php echo $title[1] ?></h1>
			</div>
		</div>
	</section>
	<section id="tracks">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-5">
				<img src="<?php bloginfo('template_directory'); ?>/img/dice.png" alt="Dice" class="center-block" />
				<h1>The Gaming Track & 24/7 Game Room</h1>
				<p><?php echo $lorem; ?></p>
			</div>
			<div class="col-md-2"></div>
			<div class="col-xs-12 col-md-5">
				<img src="<?php bloginfo('template_directory'); ?>/img/typewriter.png" alt="Typewriter" class="center-block" />
				<h1>The Writing Track</h1>
				<p><?php echo $lorem; ?></p>
			</div>
		</div>
	</section>
	<section id="community">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-12">
				<img src="<?php bloginfo('template_directory'); ?>/img/artist_divider.png">
				<?php $title = split_title("The Shadow Cruise | Our Amazing Community") ?>
				<h2><?php echo $title[0] ?></h2>
				<h1><?php echo $title[1] ?></h1>
				<p class="center-block"><?php echo $lorem; ?></p>
			</div>
		</div>
	</section>
	<section id="exp-photos">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-12">
				<p><?php echo $lorem; ?></p>
				<h3><strong>Photos</strong> | JoCo Cruise 2014</h3>
			</div>
		</div>
	</section>
	<section id="exp-more">
		<div class="container-fluid">
			<div class="col-xs-12 col-md-12">
				<h4>More Information and Links</h4>
				<p><?php echo $lorem; ?></p>
			</div>
		</div>
	</section>
</section>

<?php get_footer(); ?>	