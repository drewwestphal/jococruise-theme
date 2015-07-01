<?php 
// UTILITY DEFS

function parse_piped_title($title) {
    $pcs = explode(" | ", $title, 2);
    if(count($pcs) < 2) {
        // there is no pipe here
        return $pcs[0];
    } else {
        return "<span>" . $pcs[0] . "</span>" . $pcs[1];
    }
}

function parse_piped_title2($title) {
    $pcs = explode(" | ", $title, 2);
    if(count($pcs) < 2) {
        // there is no pipe here
        return $pcs[0];
    } else {
        return "<strong>" . $pcs[0] . "</strong>&nbsp;|&nbsp" . $pcs[1];
    }
}

/**
 * Get the experience CPT pages
 * and put them into an array
 * keyed by post_name
 * assign to unique variables per spec
 */

$exp_pcs = new WP_Query( array(
    'post_type' => 'experience',
    'posts_per_page' => -1,
));
$exp_pcs = $exp_pcs -> get_posts();
wp_reset_postdata();

$exp_pcs_byname = array();
foreach($exp_pcs as $ep) {
    $exp_pcs_byname[$ep -> post_name] = $ep;
}
$introPost = $exp_pcs_byname['exp-intro'];
$mainStagePost = $exp_pcs_byname['exp-main-stage'];
$featuredEventsHeaderPost = $exp_pcs_byname['exp-featured-events-header'];
$gamingTrackPost = $exp_pcs_byname['exp-gaming-track'];
$writingTrackPost = $exp_pcs_byname['exp-writing-track'];
$shadowCruisePost = $exp_pcs_byname['exp-community'];
$photoExplPost = $exp_pcs_byname['exp-photos-expl'];
$photoGalleryPost = $exp_pcs_byname['exp-photos-gallery'];
$moreInfoPost = $exp_pcs_byname['exp-more-info'];

/**
 * Get the Featured Events
 * Sort them correctly?
 */
$featured_events = new WP_Query( array(
    'post_type' => 'featured-event',
    'posts_per_page' => -1,
    'orderby' => '_thumbnail_id',
    'order' => 'ASC'
));
$featured_events = $featured_events -> get_posts();
wp_reset_postdata();

// INTRO POST

// modified header
$introPostHeaderImageTag = sprintf('<image src="%s" alt="JoCo Cruise" id="what-is-logo"/> ', get_template_directory_uri() . '/img/WhatIs_JoCo_LoGo.svg');
$introPostHeaderParsed = $introPost -> post_title;
$introPostHeaderParsed = str_ireplace('JoCo Cruise', $introPostHeaderImageTag, $introPostHeaderParsed);

// clickthru link
// note that dims can be provided
// https://codex.wordpress.org/Function_Reference/get_the_post_thumbnail
$introPostThumbnailMarkup = get_the_post_thumbnail($introPost -> ID, array(
    256,
    256
));
$thumbnail_id = get_post_thumbnail_id($introPost->ID);
$thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

  if ($thumbnail_image && isset($thumbnail_image[0])) {
    $caption = '<span>'.$thumbnail_image[0]->post_excerpt.'</span>';
  }
$introPostFeaturedClickthroughObject = get_field('exp_featured_image_clickthrough_file', $introPost -> ID);
$introPostFeaturedClickthroughExists = (bool)$introPostFeaturedClickthroughObject;
$introPostFeaturedClickthroughURL = $introPostFeaturedClickthroughObject["url"];
//var_dump($introPostFeaturedClickthroughObject);
$introPostLinkWrappedImage = $introPostThumbnailMarkup;
if($introPostFeaturedClickthroughExists) {
    $introPostLinkWrappedImage = sprintf('<a href="%s">%s</a>', //
    $introPostFeaturedClickthroughURL, $introPostThumbnailMarkup);
}
?>

<style>
	body {
		background-color: #ffffff;
	}
</style>
<?php get_header(); ?>
<?php function split_title($title) {
	return explode(" | ", $title);
}
$lorem = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
?>

<?php include 'bumper_top.php'; ?>
<section id="page-experience">
	<section id="what-is" class="nav-spacer">
		<div class="container">
			<div class="col-xs-12">
				<?php printf('<img class="img-responsive" style="width:678px;" src="%s" alt="JoCo Boat Profile Image" id="what-is-ship" />', get_template_directory_uri() . '/img/joco-boat-profile.svg'); ?>
				<!--<img src="<?php bloginfo('template_directory'); ?>/img/sideview_boat.png" alt="Sideview of ship" id="what-is-ship" />-->
				<h1><?= $introPostHeaderParsed; ?></h1>
					<!--<img src="<?php bloginfo('template_directory'); ?>/img/WhatIs_JoCo_LoGo.png" id="what-is-logo" align="middle" /> ?-->
			</div>
		</div>
	</section>
	<section id="exp-intro" class="joco_beige">
		<div class="container">
			<div class="col-xs-12 col-md-9 exp-intro-text">
				<?= apply_filters('the_content', $introPost -> post_content); ?>
			</div>
			<div class="col-xs-12 col-md-3 center-block" style="text-align: center;">
				<?= $introPostLinkWrappedImage; ?>
				<div class="caption"><?=$caption; ?></div>
			</div>
		</div>
	</section>
	<section id="main-stage" class="joco_offwhite">
		<div class="container">
			<div class="col-xs-12">
				<?php $title = split_title($mainStagePost -> post_title) ?>
				<h1><span><?php echo $title[0] ?></span><br /><?php echo $title[1] ?></h1>
				<?= apply_filters('the_content', $mainStagePost -> post_content); ?>
				<a href="/#artists" class="main-stage-button btn btn-lg btn-default">See who is coming so far in 2016</a>
				<p>Past cruise guests include (in no particular order, OK, it's alphabetical):</p>
				<div class="col-xs-12 col-sm-6">
					<ul>
					<?php
						$past_guests = file_get_contents(__DIR__."/past_performers.txt");
						$past_guests = explode(PHP_EOL, $past_guests);
						if (count($past_guests)<=1) {
							$past_guests = array("Jonathan Coulton","Paul and Storm","The Both (Aimee Mann and Ted Leo)","Rhea Butcher","Marian Call",
								"Chris Collingwood (Fountains of Wayne)","Bill Corbett and Kevin Murphy (Rifftrax)","The Doubleclicks",
								"John Flansburgh (They Might Be Giants)","MC Frontalot","Jean Grae","Hank Green","Vi Hart","John Hodgman",
								"Grant Imahara (Mythbusters)","Mathew Inman (The Oatmeal)","Steve Jackson (Steve Jackson Games)","Zoe Keating",
								"Hari Kondabolu","Molly Lewis","Merlin Mann","Opus Moreschi (Colbert Report)","Randall Munroe (xkcd)","Mike Phirman",
								"Pomplamoose","David Rees","John Roderick","Pat Rothfuss","Peter Sagal","Nathan Sowaya","John Scalzi",
								"Joseph Scrimshaw","Sara and Sean Watkins (Nickel Creek)","and Will Wheaton");
						}
						$i = 0;
						foreach ($past_guests as $guest) {
							if (abs($i*2 - count($past_guests)) <= 1) {
								echo "</ul></div><div class='col-xs-12 col-sm-6'><ul>";
							}
							$i++;
							echo "<li>$guest</li>";
						} ?>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<section id="featured-events" class="joco_beige">
		<div class="container">
			<div class="col-xs-12">
				<?php $title = split_title($featuredEventsHeaderPost -> post_title) ?>
				<h1><span><?php echo $title[0] ?></span><br /><?php echo $title[1] ?></h1>
				<?= trim(apply_filters('the_content', $featuredEventsHeaderPost -> post_content)); ?>
            	<div class="slick-element">
        			<?php
        			foreach($featured_events as $fe) { ?>
        				<div>
        					<div class="col-xs-12 col-sm-3">
			                	<div class="featured-event-image" style="cursor: default;">
									<?php echo get_the_post_thumbnail($fe -> ID); ?>
								</div>
							</div>
							<div class="col-xs-12 col-sm-9 event-description">
								<div class="event-name"><?php echo $fe -> post_title; ?></div>
								<p><?php echo ($fe->post_excerpt) ? $fe->post_excerpt : $fe -> post_content; ?></p>
							</div>
						</div>
						<?php 
        			} ?>
				</div>
			</div>
		</div>
	</section>
	<section id="tracks" class="joco_offwhite">
		<div class="container">
			<div class="col-xs-12 col-sm-6 col-lg-5">
				<img src="<?php bloginfo('template_directory'); ?>/img/D20s.svg" style="width: 255px; margin: 25px auto;" alt="Dice" class="center-block" />
				<h2><?= $gamingTrackPost -> post_title; ?></h2>
				<?= apply_filters('the_content', $gamingTrackPost -> post_content); ?>
			</div>
			<div class="col-md-2 hidden-xs hidden-sm"></div>
			<div class="col-xs-12 col-sm-6 col-lg-5">
				<img src="<?php bloginfo('template_directory'); ?>/img/typewriter.svg" alt="Typewriter" class="center-block" style="width: 190px; margin: 25px auto;" />
				<h2><?= $writingTrackPost -> post_title; ?></h2>
				<?= apply_filters('the_content', $writingTrackPost -> post_content); ?>
			</div>
		</div>
	</section>
	<section id="community" class="joco_beige">
		<div class="container">
			<div class="col-xs-12">
				<img src="<?php bloginfo('template_directory'); ?>/img/artist_divider.png">
				<?php $title = split_title($shadowCruisePost -> post_title) ?>
				<h1><span><?php echo $title[0] ?></span><br /><?php echo $title[1] ?></h1>
				<?= str_ireplace("<p>","<p class='center-block'>",apply_filters('the_content', $shadowCruisePost -> post_content)); ?>
			</div>
		</div>
	</section>
	<section id="exp-photos" class="joco_offwhite">
		<div class="container">
			<div class="col-xs-12">
				<?= '';//apply_filters('the_content', $photoExplPost -> post_content); ?>
				<h3><?= parse_piped_title2($photoExplPost -> post_title)?></h3>
				<!--<h3><strong>Photos</strong> | JoCo Cruise 2014</h3>-->
			</div>
			<div class="col-xs-12">
				<?= apply_filters('the_content', $photoGalleryPost -> post_content); ?>
			</div>
		</div>
	</section>
	<section id="exp-more">
		<div class="container">
			<div class="col-xs-12">
				<h4><?= parse_piped_title($moreInfoPost -> post_title); ?></h4>
				<?= apply_filters('the_content', $moreInfoPost -> post_content); ?>
			</div>
		</div>
	</section>
</section>

<?php get_footer(); ?>	