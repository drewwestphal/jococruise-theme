<?php
/* Template Name: Emptiness (for iframes, etc) */
$post = new JoCoCruisePost();
header("Access-Control-Allow-Origin: https://jococruise.com");

echo $post->content();
exit();
?>