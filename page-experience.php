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

?>

<?php get_header(); ?>
<?php
include 'bumper_top.php';
?>
<section id="the-experience" class="page-experience headers">
    <div class="container-fluid">
        <div class="col-xs-12 col-md-12">
            <h1></h1>

        </div>
    </div>
</section>
<?php
include 'bumper_bottom.php';
?>
<?php
include 'footer.php';
?>