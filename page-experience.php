<?php
use \Timber\Timber;
$context = Timber::get_context();

/**
 * Get the experience CPT pages
 * and put them into an array
 * keyed by post_name
 * assign to unique variables per spec
 */

$experiencePosts = Timber::get_posts(
    [
        'post_type'      => 'experience',
        'posts_per_page' => -1,
    ], 'ExperiencePiecePost');
// put experience posts in context by post_name
$exp_pcs_byname = [];
foreach($experiencePosts as $ep) {
    $exp_pcs_byname[$ep->post_name] = $ep;
}
$introPost = $context['introPost'] = $exp_pcs_byname['exp-intro'];
$mainStagePost = $context['mainStagePost'] = $exp_pcs_byname['exp-main-stage'];
$featuredEventsHeaderPost = $context['featuredEventsHeaderPost'] = $exp_pcs_byname['exp-featured-events-header'];
$gamingTrackPost = $context['gamingTrackPost'] = $exp_pcs_byname['exp-gaming-track'];
$writingTrackPost = $context['writingTrackPost'] = $exp_pcs_byname['exp-writing-track'];
$shadowCruisePost = $context['shadowCruisePost'] = $exp_pcs_byname['exp-community'];
$photoGalleryPost = $context['photoGalleryPost'] = $exp_pcs_byname['exp-photos-gallery'];
$moreInfoPost = $context['moreInfoPost'] = $exp_pcs_byname['exp-more-info'];

$showArtistSection = false;
if($showArtistSection) {
    $artistMetaQuery = array_map(function ($artistFieldDefinition) {
        return [
            // name is the name of the field in
            // the acf db (e.g. artist type 2015, 2016... blah blah
            'key'   => $artistFieldDefinition['name'],
            // we want artists and featured artists
            'value' => [
                'artist',
                'featured artist',
            ],
        ];
    }, // we want everything but the first item (which is the current year)
        array_slice($_ENV['cc_artist_type_and_year_fields_desc'], 1));

// we want artists that were here for any
// of the target years
    $artistMetaQuery['relation'] = 'OR';

    $allPastArtists = Timber::get_posts(
        [
            'post_type'      => 'artist',
            'posts_per_page' => -1,
            'meta_query'     => $artistMetaQuery,
        ], 'ExperiencePiecePost'
    );

    usort($allPastArtists, [
        ExperiencePiecePost::class,
        'artistSortFunction',
    ]);

    $context['past_artists'] = $allPastArtists;
    $leftCount = ceil(count($allPastArtists) / 2);
    $context['past_artists_left'] = array_slice($allPastArtists, 0, $leftCount);
    $context['past_artists_right'] = array_slice($allPastArtists, $leftCount);
}
$context['show_artist_section'] = $showArtistSection;

$context['featured_events'] = Timber::get_posts(
    [
        'post_type'      => 'featured-event',
        'posts_per_page' => -1,
        'orderby'        => '_thumbnail_id',
        'order'          => 'ASC',
    ], 'JoCoCruisePost'
);

// INTRO POST


Timber::render('the-experience.twig', $context);

?>