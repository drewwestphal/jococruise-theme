<?php

$settings = get_option('mac_settings');

//variables
$site_title = get_bloginfo('name');
//booking
$cruise_year = intval(jcctheme_get_option('mac_cruise_year'));
$cruise_year = $cruise_year<2015?2015:$cruise_year;
$faq_section_headers_ordered = array_map('trim', explode('|', jcctheme_get_option('mac_piped_cats')));
$booking_url = jcctheme_get_option('mac_booking_url');
$hero_book_now = jcctheme_get_option('mac_hero_book_now');
$booked = jcctheme_get_option('mac_hero_already_booked');
$booked_url = jcctheme_get_option('mac_hero_already_booked_url');
$booking_enabled = jcctheme_get_option('mac_enable_booking');
$booking_cta = jcctheme_get_option('mac_button_cta');
//cruise info
$cruise_fb = jcctheme_get_option('mac_facebook_url');
$cruise_twitter = jcctheme_get_option('mac_twitter_url');
$cruise_rss = jcctheme_get_option('mac_feed_url');
$travel_desc = jcctheme_get_option('mac_travel_description');
$travel_desc_more = jcctheme_get_option('mac_travel_description_more');
$mailing_cta = jcctheme_get_option('mac_mailing_list_cta');
//artists
$artists_header = jcctheme_get_option('mac_talent_header');
$artists_more = jcctheme_get_option('mac_enable_more');
//contact
$cont_gen_q = jcctheme_get_option('mac_general_questions_header');
$cont_gen_q_addy = jcctheme_get_option('mac_general_questions_address_header');
$cont_book_q = jcctheme_get_option('mac_booking_questions_header');
$cont_book_q_addy = jcctheme_get_option('mac_booking_questions_address_header');
$cont_tel = jcctheme_get_option('mac_phone_questions_header');
$cont_tel_addy = jcctheme_get_option('mac_phone_questions_address_header');
//map
$map_copy = jcctheme_get_option('mac_map_copy');
//news
$news_header = jcctheme_get_option('mac_news_header');
$news_view_all = jcctheme_get_option('mac_news_view_all');
$news_view_url = jcctheme_get_option('mac_news_view_all_url');
//footer
$footer_text = jcctheme_get_option('mac_footer_text');
?>