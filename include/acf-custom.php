<?php
// add the options page
if(function_exists('acf_add_options_page')) {
    acf_add_options_page([
                             'page_title' => 'Theme General Settings',
                             'menu_title' => 'Theme Settings',
                             'menu_slug'  => 'theme-general-settings',
                             'capability' => 'edit_posts',
                             'redirect'   => false,
                             'autoload'   => true,
                         ]);
}

add_filter('acf/load_field/name=faq_section_header', function ($field) {
// Loads FAQ categories from theme page as options for FAQ post type
    $field['choices'] = [];
    $choices = get_field('faq_categories', 'option', false);
    $choices = explode("\n", $choices);
    $choices = array_map('trim', $choices);
    if(is_array($choices)) {
        foreach($choices as $choice) {
            if(strlen($choice)) {
                $field['choices'][$choice] = $choice;
            }
        }
    }
    return $field;
});

add_action('acf/init', function () {
    $GLOBALS['cruise_year'] = $cruise_year = get_field('cruise_year', 'option');
    // include one year in the future
    $GLOBALS['available_cruise_years'] = $availableCruiseYears = array_reverse(range(2011, intval($cruise_year) + 1, 1));

    add_filter('acf/load_field/name=faq_year', function ($field) use ($availableCruiseYears) {
        foreach($availableCruiseYears as $year) {
            $field['choices'][$year] = $year;
        }
        return $field;
    });

// create a year / type entry for each artist
    foreach($availableCruiseYears as $year) {
        acf_add_local_field([
                                'key'           => 'field_customArtistType_' . $year,
                                'name'          => 'artist_type' . $year,
                                'label'         => 'Artist Type ' . $year,
                                'type'          => 'select',
                                'parent'        => 'group_acf_artist',
                                'choices'       => [
                                    'artist'          => "Performer",
                                    'featured artist' => "Featured Guest",
                                    'spotlight item'  => "Spotlight Item",
                                    'podcast'         => "Podcast",
                                    'did not attend'  => "Did not attend this year",
                                ],
                                'default_value' => 'did not attend',
                            ]);
    }
});

?>