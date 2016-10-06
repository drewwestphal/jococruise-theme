<?php
use \Timber\Timber;
$context = Timber::get_context();
Timber::render('forum.twig', $context);
return;
?>