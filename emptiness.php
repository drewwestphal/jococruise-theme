<?php
/* Template Name: Emptiness (for iframes, etc) */
$post = new JoCoCruisePost();
$allowed = array('https://jococruise.com',
                 'https://elpollojjoco.wpengine.com');


if(isset($_SERVER['HTTP_ORIGIN']) && in_array($_SERVER['HTTP_ORIGIN'], $allowed)) {
    header("Access-Control-Allow-Origin: " . $_SERVER['HTTP_ORIGIN']);
}

echo $post->content();
exit();
?>