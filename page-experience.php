<?php
/* Template Name: Experience Page */
use \Timber\Timber;
$context = Timber::get_context();
// I want to use TimberImage methods
$context['exp_intro_image'] = new \Timber\Image($context['options']['exp_intro_image']);
$context['featured_events'] = Timber::get_posts(
    [
        'post_type'      => 'featured-event',
        'posts_per_page' => -1,
        'orderby'        => '_thumbnail_id',
        'order'          => 'ASC',
    ], 'JoCoCruisePost'
);

Timber::render('the-experience.twig', $context);

?>