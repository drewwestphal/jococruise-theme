<?php
/* Template Name: Sponsors Page */
use \Timber\Timber;
$context = Timber::get_context();
$context['post'] = new JoCoCruisePost();
Timber::render('sponsors-page.twig', $context);
return;
