<?php
/* Template Name: Fancy Header Page Without Boat */
use \Timber\Timber;
$context = Timber::get_context();
$context['post'] = Timber::get_post(false, 'JoCoCruisePost');
$context['show_boat'] = isset($showBoat) ? $showBoat : false;

Timber::render('fancy-header-page.twig', $context);


?>