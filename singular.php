<?php
use \Timber\Timber;
$context = Timber::get_context();
$context['post'] = new JoCoCruisePost();
Timber::render('single.twig', $context);
return;
?>