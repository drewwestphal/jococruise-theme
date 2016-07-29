<?php if(is_front_page()) {

    include('index.php');

} elseif(is_page('Artists')) {

    include('page-artists.php');

} elseif(is_page('FAQ')) {

    include('page-faq.php');

} elseif(is_page('News')) {

    include('page-news.php');

} elseif(is_page('The Experience')) {

    include('page-experience.php');

} elseif(is_page('Sponsors')) {

    include('page-sponsors.php');

} else {
    // regular old page style
    include('single.php');
}
