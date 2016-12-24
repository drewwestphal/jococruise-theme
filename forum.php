<?php
use \Timber\Timber;
$context = Timber::get_context();
$context['is_guest'] = !is_user_logged_in();
$context['login_return'] = wp_login_url($_SERVER['REQUEST_URI']);
Timber::render('forum.twig', $context);
return;
?>
