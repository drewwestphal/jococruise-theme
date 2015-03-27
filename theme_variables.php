<?php

$settings = get_option('mac_settings');
//variables
$site_title = get_bloginfo('name');
$booking_url = $settings['mac_booking_url'];
$booking_enabled = $settings['mac_booking_enabled'];
$booking_cta = $settings['mac_button_cta'];
$cruise_fb = $settings['mac_facebook_url'];
$cruise_twitter = $settings['mac_twitter_url'];
$cruise_rss = $settings['mac_feed_url'];
$travel_desc = $settings['mac_travel_description'];
$travel_desc_more = $settings['mac_travel_description_more'];
$mailing_cta = $settings['mac_mailing_list_cta'];
$artists_header = $settings['mac_talent_header'];
$cont_gen_q = $settings['mac_general_questions_header'];
$cont_gen_q_addy = $settings['mac_general_questions_address_header'];
$cont_book_q = $settings['mac_booking_questions_header'];
$cont_book_q_addy = $settings['mac_booking_questions_address_header'];
$cont_tel = $settings['mac_phone_questions_header'];
$cont_tel_addy = $settings['mac_phone_questions_address_header'];
$map_copy = $settings['mac_map_copy'];
$news_header = $settings['mac_news_header'];
$news_view_all = $settings['mac_news_view_all'];
$news_view_url = $settings['mac_news_view_all_url'];
$footer_text = $settings['mac_footer_text'];
?>