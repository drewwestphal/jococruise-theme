<?php
use \Timber\Timber;
$context = Timber::get_context();
$context['is_guest'] = !is_user_logged_in();
$context['login_return'] = wp_login_url($_SERVER['REQUEST_URI']);
if (!@$context['post']) {
    $context['post']['title'] = bbp_get_topic_title();
}
Timber::render('forum.twig', $context);
return;
?>
