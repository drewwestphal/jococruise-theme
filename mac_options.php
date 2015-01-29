<?php add_action( 'admin_menu', 'mac_add_admin_menu' );
add_action( 'admin_init', 'mac_settings_init' );


function mac_add_admin_menu(  ) { 

	add_submenu_page( 'themes.php', 'JoCo Cruise', 'JoCo Cruise', 'manage_options', 'mac_and_cruise', 'mac_and_cruise_options_page' );

}


function mac_settings_exist(  ) { 

	if( false == get_option( 'mac_and_cruise_settings' ) ) { 

		add_option( 'mac_and_cruise_settings' );

	}

}


function mac_settings_init(  ) { 

	register_setting( 'pluginPage', 'mac_settings' );
	
	//site settings
	add_settings_section(
		'mac_site_settings', 
		__( 'Site Options:', 'wordpress' ), 
		'mac_site_settings_callback', 
		'pluginPage'
	);	

	add_settings_field( 
		'mac_enable_booking', 
		__( 'Enable booking', 'wordpress' ), 
		'mac_booking_enabled_render', 
		'pluginPage', 
		'mac_site_settings' 
	);
	
	add_settings_field( 
		'mac_booking_url', 
		__( 'Booking Path', 'wordpress' ), 
		'mac_booking_url_render', 
		'pluginPage', 
		'mac_site_settings' 
	);
	
	add_settings_field( 
		'mac_contact_email', 
		__( 'Contact Form Email Address', 'wordpress' ), 
		'mac_contact_email_render', 
		'pluginPage', 
		'mac_site_settings' 
	);
	
	//hero settings
	add_settings_section(
		'mac_hero_settings', 
		__( 'Hero Section Options:', 'wordpress' ), 
		'mac_hero_settings_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'mac_travel_dates', 
		__( 'Travel Dates', 'wordpress' ), 
		'mac_travel_dates_render', 
		'pluginPage', 
		'mac_hero_settings'
	);
	
	add_settings_field( 
		'mac_button_cta', 
		__( 'Button Call to Action', 'wordpress' ), 
		'mac_button_cta_render', 
		'pluginPage', 
		'mac_hero_settings'
	);

	add_settings_field( 
		'mac_travel_description', 
		__( 'Travel Description', 'wordpress' ), 
		'mac_travel_description_render', 
		'pluginPage', 
		'mac_hero_settings' 
	);
	
	add_settings_field( 
		'mac_travel_description_more', 
		__( 'Travel Description (More)', 'wordpress' ), 
		'mac_travel_description_more_render', 
		'pluginPage', 
		'mac_hero_settings' 
	);
	
	//mailing list
	add_settings_field( 
		'mac_mailing_list_cta', 
		__( 'Mailing List Call to Action', 'wordpress' ), 
		'mac_mailing_list_cta_render', 
		'pluginPage', 
		'mac_hero_settings'
	);

	//social
	add_settings_field( 
		'mac_facebook_url', 
		__( 'Link to Facebook Page', 'wordpress' ), 
		'mac_facebook_url_render', 
		'pluginPage', 
		'mac_hero_settings' 
	);

	add_settings_field( 
		'mac_twitter_url', 
		__( 'Link to Twitter', 'wordpress' ), 
		'mac_twitter_url_render', 
		'pluginPage', 
		'mac_hero_settings' 
	);
	
	add_settings_field( 
		'mac_feed_url', 
		__( 'Link to RSS feed', 'wordpress' ), 
		'mac_feed_url_render', 
		'pluginPage', 
		'mac_hero_settings' 
	);
	
	//artist settings
	add_settings_section(
		'mac_artist_settings', 
		__( 'Artist Settings:', 'wordpress' ), 
		'mac_artist_settings_callback', 
		'pluginPage'
	);
	
	add_settings_field( 
		'mac_talent_header', 
		__( 'Talent Section Header:', 'wordpress' ), 
		'mac_talent_header_render', 
		'pluginPage', 
		'mac_artist_settings' 
	);
	
	//contact settings
	add_settings_section(
		'mac_contact_settings', 
		__( 'Contact Settings:', 'wordpress' ), 
		'mac_contact_settings_callback', 
		'pluginPage'
	);
	
	add_settings_field( 
		'mac_general_questions_header', 
		__( 'General Questions Header:', 'wordpress' ), 
		'mac_general_questions_header_render', 
		'pluginPage', 
		'mac_contact_settings' 
	);
	
	add_settings_field( 
		'mac_general_questions_address', 
		__( 'General Questions Address:', 'wordpress' ), 
		'mac_general_questions_address_render', 
		'pluginPage', 
		'mac_contact_settings' 
	);
	
	add_settings_field( 
		'mac_booking_questions_header', 
		__( 'Booking Questions Header:', 'wordpress' ), 
		'mac_booking_questions_header_render', 
		'pluginPage', 
		'mac_contact_settings' 
	);
	
	add_settings_field( 
		'mac_booking_questions_address', 
		__( 'Booking Questions Address:', 'wordpress' ), 
		'mac_booking_questions_address_render', 
		'pluginPage', 
		'mac_contact_settings' 
	);
	
	add_settings_field( 
		'mac_phone_questions_header', 
		__( 'Phone Questions Header:', 'wordpress' ), 
		'mac_phone_questions_header_render', 
		'pluginPage', 
		'mac_contact_settings' 
	);
	
	add_settings_field( 
		'mac_phone_questions_address', 
		__( 'Phone Questions Number:', 'wordpress' ), 
		'mac_phone_questions_address_render', 
		'pluginPage', 
		'mac_contact_settings' 
	);
	
	//map settings
	add_settings_section(
		'mac_map_settings', 
		__( 'Map Settings:', 'wordpress' ), 
		'mac_map_settings_callback', 
		'pluginPage'
	);
	
	add_settings_field( 
		'mac_map_copy', 
		__( 'Map Info Copy (narrow-width only):', 'wordpress' ), 
		'mac_map_copy_render', 
		'pluginPage', 
		'mac_map_settings' 
	);
	
	//news settings
	add_settings_section(
		'mac_news_settings', 
		__( 'News Settings:', 'wordpress' ), 
		'mac_news_settings_callback', 
		'pluginPage'
	);
	
	add_settings_field( 
		'mac_news_header', 
		__( 'News Header:', 'wordpress' ), 
		'mac_news_header_render', 
		'pluginPage', 
		'mac_news_settings' 
	);
	
	add_settings_field( 
		'mac_news_view_all', 
		__( 'News "View All" Copy:', 'wordpress' ), 
		'mac_news_view_all_render', 
		'pluginPage', 
		'mac_news_settings' 
	);

	add_settings_field( 
		'mac_news_view_all_url', 
		__( 'News "View All" URL:', 'wordpress' ), 
		'mac_news_view_all_url_render', 
		'pluginPage', 
		'mac_news_settings' 
	);

}

function mac_booking_enabled_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<input type='checkbox' name='mac_settings[mac_booking_enabled]' <?php checked( $options['mac_booking_enabled'], 1 ); ?> value='1'>
	<?php 
}

function mac_booking_url_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<input type='text' name='mac_settings[mac_booking_url]' value='<?php echo $options['mac_booking_url']; ?>'>
	<?php 
}

function mac_contact_email_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<input type='text' name='mac_settings[mac_contact_email]' value='<?php echo $options['mac_contact_email']; ?>'>
	<?php 
}

function mac_travel_dates_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<input type='text' name='mac_settings[mac_travel_dates]' value='<?php echo $options['mac_travel_dates']; ?>'>
	<?php 
}

function mac_button_cta_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<input type='text' name='mac_settings[mac_button_cta]' value='<?php echo $options['mac_button_cta']; ?>'>
	<?php 
}

function mac_travel_description_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<textarea cols='40' rows='5' name='mac_settings[mac_travel_description]'><?php echo $options['mac_travel_description']; ?>
 	</textarea>
	<?php 
}

function mac_travel_description_more_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<textarea cols='40' rows='5' name='mac_settings[mac_travel_description_more]'><?php echo $options['mac_travel_description_more']; ?>
 	</textarea>
	<?php 
}


function mac_mailing_list_cta_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<textarea cols='40' rows='3' name='mac_settings[mac_mailing_list_cta]'><?php echo $options['mac_mailing_list_cta']; ?>
	</textarea>
	<?php 
}

//social
function mac_facebook_url_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<input type='text' name='mac_settings[mac_facebook_url]' value='<?php echo $options['mac_facebook_url']; ?>'>
	<?php 
}


function mac_twitter_url_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<input type='text' name='mac_settings[mac_twitter_url]' value='<?php echo $options['mac_twitter_url']; ?>'>
	<?php 
}

function mac_feed_url_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<input type='text' name='mac_settings[mac_feed_url]' value='<?php echo $options['mac_feed_url']; ?>'>
	<?php 
}

//talent
function mac_talent_header_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<textarea cols='40' rows='3' name='mac_settings[mac_talent_header]'><?php echo $options['mac_talent_header']; ?>
	</textarea>
	<?php 
}

//contact info
function mac_general_questions_header_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<input name='mac_settings[mac_general_questions_header]' value='<?php echo $options['mac_general_questions_header']; ?>'>
	</input>
	<?php 
}

function mac_general_questions_address_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<input name='mac_settings[mac_general_questions_address_header]' value='<?php echo $options['mac_general_questions_address_header']; ?>'>
	</input>
	<?php 
}

function mac_booking_questions_header_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<input name='mac_settings[mac_booking_questions_header]' value='<?php echo $options['mac_booking_questions_header']; ?>'>
	</input>
	<?php 
}

function mac_booking_questions_address_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<input name='mac_settings[mac_booking_questions_address_header]' value='<?php echo $options['mac_booking_questions_address_header']; ?>'>
	</input>
	<?php 
}

function mac_phone_questions_header_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<input name='mac_settings[mac_phone_questions_header]' value='<?php echo $options['mac_phone_questions_header']; ?>'>
	</input>
	<?php 
}

function mac_phone_questions_address_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<input name='mac_settings[mac_phone_questions_address_header]' value='<?php echo $options['mac_phone_questions_address_header']; ?>'>
	</input>
	<?php 
}
//map
function mac_map_copy_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<textarea cols='40' rows='3' name='mac_settings[mac_map_copy]'><?php echo $options['mac_map_copy']; ?>
	</textarea>
	<?php 
}
//news

function mac_news_header_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<textarea cols='40' rows='3' name='mac_settings[mac_news_header]'><?php echo $options['mac_news_header']; ?>
	</textarea>
	<?php 
}
function mac_news_view_all_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<input name='mac_settings[mac_news_view_all]' value='<?php echo $options['mac_news_view_all']; ?>'></input>
	<?php 
}
function mac_news_view_all_url_render(  ) { 

	$options = get_option( 'mac_settings' );
	?>
	<input name='mac_settings[mac_news_view_all_url]' value='<?php echo $options['mac_news_view_all_url']; ?>'></input>
	<?php 
}


function mac_site_settings_callback(  ) { 
	echo __( 'site-wide settings', 'wordpress' );
}

function mac_hero_settings_callback(  ) { 
	echo __( 'settings for the hero section on the homepage', 'wordpress' );
}

function mac_artist_settings_callback(  ) { 
	echo __( 'settings for the artists section on the homepage', 'wordpress' );
}

function mac_contact_settings_callback(  ) { 
	echo __( 'settings for the contact section on the homepage', 'wordpress' );
}

function mac_map_settings_callback(  ) { 
	echo __( 'settings for the map section on the homepage', 'wordpress' );
}

function mac_news_settings_callback(  ) { 
	echo __( 'settings for the map section on the homepage', 'wordpress' );
}


function mac_and_cruise_options_page(  ) { 

	?>
	<form action='options.php' method='post'>
		
		<h2>JoCo Cruise</h2>
		<?php 		settings_fields( 'pluginPage' );
		?>
		<?php 		do_settings_sections( 'pluginPage' );
		submit_button();
		?>
		
	</form>
	<?php 
}

?>