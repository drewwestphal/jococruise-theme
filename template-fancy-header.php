<?php
/* Template Name: Fancy What-Is Header Page */

$context = Timber::get_context();
$context['post'] = Timber::get_post(false, 'JoCoCruisePost');

Timber::render('fancy-header-page.twig', $context);


?>