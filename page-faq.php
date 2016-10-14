<?php
/* Template Name: FAQ Display Page */
use \Timber\Timber;

/**
 * @var TimberPost $post
 */
$post = Timber::get_post();
// only numbers in the page slug... to int
$guessYear = (int)preg_replace('/\D/', '', $post->slug);
// if it's a cruise year... guess the year otherwise false
$guessYear = in_array($guessYear, $availableCruiseYears) ? $guessYear : false;
// default to current year... unless a year is in the slug
$targetFaqYear = $guessYear ? $guessYear : $cruise_year;

/**
 * @var FAQPost[] $faqPosts
 */
$faqPosts = Timber::get_posts(
    [
        'post_type'      => 'faq',
        'posts_per_page' => -1,
        'meta_query'     => [
            [
                'key'   => 'faq_year',
                'value' => $targetFaqYear,
            ],
        ],
    ], 'FAQPost');
// create the ordered array
$sectionHeadersInOrder = array_map('trim', explode('\n', get_field('faq_categories', 'option')));
$faqsByHeader = array_combine($sectionHeadersInOrder, array_fill(0, count($sectionHeadersInOrder), []));
foreach($faqPosts as $item) {
    $faqsByHeader[$item->getSectionHeader()][] = $item;
}

$context = Timber::get_context();
$context['post'] = $post;
$context['faqs_by_header'] = $faqsByHeader;
Timber::render('faq.twig', $context);

?>