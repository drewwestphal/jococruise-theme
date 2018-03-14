<?php

use \Timber\Timber;

if(!(class_exists('\Timber') && function_exists('get_field'))) {
    echo "Theme plugin requirements not met";
    return;
}


$context = Timber::get_context();
$talent_year = intval(get_field('talent_year', 'option'));
$previous_talent_year = $talent_year - 1;
$populate_prior_cruise_artists = get_field('show_previous_year_guests_too', 'option');

$context['news_posts'] = $news_posts = Timber::get_posts(
    [
        'post_type'           => 'post',
        'posts_per_page'      => 5,
        'ignore_sticky_posts' => 1,
    ], 'JoCoCruisePost');
$context['show_news'] = (bool)count($news_posts);

if(function_exists('mc4wp_form')) {
    $context['show_mailing_function'] = 'mc4wp_form';
}
// use this one if it does exist
if(function_exists('mc4wp_show_form')) {
    $context['show_mailing_function'] = 'mc4wp_show_form';
}

function getArtistPosts($key, $value) {
    return
        Timber::get_posts([
                              'post_type'      => 'artist',
                              'posts_per_page' => -1,
                              'order'          => 'ASC',
                              'meta_query'     => [
                                  [
                                      'key'   => $key,
                                      'value' => $value,
                                  ],
                              ],
                          ], 'ArtistPost');
}

function populateArtistContext(&$ctx, $target_type, $append_to_key) {
    $ctx['artists' . $append_to_key] = getArtistPosts($target_type, 'artist');
    $ctx['featured_artists' . $append_to_key] = getArtistPosts($target_type, 'featured artist');
    $ctx['spotlight_items' . $append_to_key] = getArtistPosts($target_type, 'spotlight item');
    $ctx['podcasts' . $append_to_key] = getArtistPosts($target_type, 'podcast');
}

// create variables for this year
populateArtistContext($context, 'artist_type' . $talent_year, '');
if($populate_prior_cruise_artists) {
    populateArtistContext($context, 'artist_type' . $previous_talent_year, '_prev');
}

$context['map_cities'] = Timber::get_posts(
    [
        'post_type'      => 'city',
        'posts_per_page' => -1,
    ], 'MapCityPost'
);

$skipFaq = false;
$context['front_page_faqs'] = null;
if(!$skipFaq) {
    $context['front_page_faqs'] = Timber::get_posts(
        [
            'post_type'  => 'faq',
            'orderby'    => 'ID',
            'order'      => 'ASC',
            'meta_query' => [
                [
                    'key'     => 'show_on_front_page',
                    'value'   => '"show on front page"',
                    'compare' => 'LIKE',
                ],
            ],
        ], 'JoCoCruisePost');
    $faqlink = get_page_by_title('FAQ');
    $faqlink = get_permalink($faqlink->ID);
    $context['faq_link'] = $faqlink;
}
$context['skip_map'] = $skipPortsOfCallMap = $context['options']['skip_ports_of_call_map']??false;
if($skipPortsOfCallMap) {
    $context['skip_map_post'] = Timber::get_post(
        [
            'name'      => 'ports-of-call',
            'post_type' => 'page',
        ]);
}

Timber::render('frontpage.twig', $context);
