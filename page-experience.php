<?php

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

// INTRO POST

// modified header
$introPostHeaderImageTag = sprintf('<image src="%s" alt="JoCo Cruise"/>', get_template_directory_uri() . '/img/hero_JoCo_LoGo.png');
$introPostHeaderParsed = $introPost -> post_title;
$introPostHeaderParsed = str_ireplace('JoCo Cruise', $introPostHeaderImageTag, $introPostHeaderParsed);

// clickthru link
// note that dims can be provided
// https://codex.wordpress.org/Function_Reference/get_the_post_thumbnail
$introPostThumbnailMarkup = get_the_post_thumbnail($introPost -> ID, array(
    256,
    256
));
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

<?php get_header(); ?>
<?php
include 'bumper_top.php';
?>
<section id="page-experience" class="page-experience headers">
    <div class="container-fluid">
        <div class="col-xs-12 col-md-12">
            <?php printf('<img class="img-responsive" src="%s" alt="JoCo Boat Profile Image"/>', get_template_directory_uri() . '/img/joco-boat-profile.png'); ?>
            <h1><?=$introPostHeaderParsed; ?></h1>
            <div>
                <?=$introPostLinkWrappedImage; ?>
            </div>
            <div>
                <?=apply_filters('the_content', $introPost -> post_content); ?> 
            </div>
        </div>
    </div>

</section>
<?php
include 'bumper_bottom.php';
include 'footer.php';
?>