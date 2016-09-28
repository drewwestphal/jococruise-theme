<?php
use \Timber\Timber;
$context = Timber::get_context();
$context['post'] = new JoCoCruisePost();
Timber::render('forum.twig', $context);
return;