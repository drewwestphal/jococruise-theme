<?php
/* Template Name: Artists Page */
use \Timber\Timber;
$context = Timber::get_context();
$context['post'] = new JoCoCruisePost();
$context['artists'] = Timber::get_posts(
    [
        'post_type'      => 'artist',
        'posts_per_page' => -1,
        'order'          => 'ASC',
        'meta_query'     => [
            [
                'key'   => 'artist_type' . get_field('talent_year', 'option'),
                'value' => 'artist',
            ],
        ],
    ]
    , 'ArtistPost');
Timber::render('artists-page.twig', $context);
return;
