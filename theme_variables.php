<?php

$settings = get_option('mac_settings');

//variables
$site_title = get_bloginfo('name');
//booking
$booking_url = cctheme_get_option('mac_booking_url');
$hero_book_now = cctheme_get_option('mac_hero_book_now');
$booked = cctheme_get_option('mac_hero_already_booked');
$booked_url = cctheme_get_option('mac_hero_already_booked_url');
$booking_enabled = cctheme_get_option('mac_booking_enabled');
$booking_cta = cctheme_get_option('mac_button_cta');
//cruise info
$cruise_fb = cctheme_get_option('mac_facebook_url');
$cruise_twitter = cctheme_get_option('mac_twitter_url');
$cruise_rss = cctheme_get_option('mac_feed_url');
$travel_desc = cctheme_get_option('mac_travel_description');
$travel_desc_more = cctheme_get_option('mac_travel_description_more');
$mailing_cta = cctheme_get_option('mac_mailing_list_cta');
//artists
$artists_header = cctheme_get_option('mac_talent_header');
$artists_more = cctheme_get_option('mac_enable_more');
//contact
$cont_gen_q = cctheme_get_option('mac_general_questions_header');
$cont_gen_q_addy = cctheme_get_option('mac_general_questions_address_header');
$cont_book_q = cctheme_get_option('mac_booking_questions_header');
$cont_book_q_addy = cctheme_get_option('mac_booking_questions_address_header');
$cont_tel = cctheme_get_option('mac_phone_questions_header');
$cont_tel_addy = cctheme_get_option('mac_phone_questions_address_header');
//map
$map_copy = cctheme_get_option('mac_map_copy');
//news
$news_header = cctheme_get_option('mac_news_header');
$news_view_all = cctheme_get_option('mac_news_view_all');
$news_view_url = cctheme_get_option('mac_news_view_all_url');
//footer
$footer_text = cctheme_get_option('mac_footer_text');
?>