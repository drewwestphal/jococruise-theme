<?php
use \Timber\Timber;
$context = Timber::get_context();
$context['post'] = new JoCoCruisePost();
$args = array('post_type' => 'post',
	'posts_per_page'      => 5,
	'paged' 			  => $paged,
	'ignore_sticky_posts' => 1);
/* THIS LINE IS CRUCIAL */
/* in order for WordPress to know what to paginate */
/* your args have to be the defualt query */
query_posts($args);
/* make sure you've got query_posts in your .php file */
$context['news_posts'] = $news_posts = Timber::get_posts($args, 'JoCoCruisePost');
$context['pagination'] = Timber::get_pagination();
Timber::render('news.twig', $context);
return;
?>