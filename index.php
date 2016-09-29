<?php

use \Timber\Timber;

$context = Timber::get_context();
$cruise_year = get_field('talent_year', 'option');

$context['news_posts'] = $news_posts = Timber::get_posts(
    [
        'post_type'           => 'post',
        'posts_per_page'      => 5,
        'ignore_sticky_posts' => 1,
    ], 'JoCoCruisePost');
$context['show_news'] = (bool)count($news_posts);
$context['show_mailing_list'] = function_exists('mc4wp_show_form') or function_exists('mc4wp_form');
$context['show_mailing_function'] = 'mc4wp_form';
if (!function_exists('mc4wp_form')) {
    $context['show_mailing_function'] = 'mc4wp_show_form';
}

$targetArtistType = 'artist_type' . $cruise_year;

function artistTypeQueryArray($key, $value) {
    return
        [
            'post_type'      => 'artist',
            'posts_per_page' => -1,
            'order'          => 'ASC',
            'meta_query'     => [
                [
                    'key'   => $key,
                    'value' => $value,
                ],
            ],
        ];
}


$context['artists'] = Timber::get_posts(
    artistTypeQueryArray($targetArtistType, 'artist')
    , 'ArtistPost');
$context['featured_artists'] = Timber::get_posts(
    artistTypeQueryArray($targetArtistType, 'featured artist')
    , 'ArtistPost');
$context['spotlight_items'] = Timber::get_posts(
    artistTypeQueryArray($targetArtistType, 'spotlight item')
    , 'ArtistPost');

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
$context['skip_map'] = $skipPortsOfCallMap = false;
if($skipPortsOfCallMap) {
    $context['skip_map_post'] = Timber::get_post(
        [
            'name'      => 'ports-of-call',
            'post_type' => 'page',
        ]);
}

Timber::render('frontpage.twig', $context);
