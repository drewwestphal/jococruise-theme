<?php

if(function_exists("register_field_group")) {
    $artistTypeChoices = [
        'artist'          => 'Performer',
        'featured artist' => 'Featured Guest',
        'spotlight item'  => 'Spotlight Item',
        'did not attend'  => 'Did not attend this year',
    ];
    $artistYearAndTypeFields = [];
    // we have to do the field counter stuff bc
    // that is how they were numbered when they
    // were created and we don't want to mess with the
    // db
    $fieldCounter = 5459;
    $availableYears = [];
    for($year = 2011; $year <= $cruise_year; $year++) {
        $artistYearAndTypeFields[] = [
            // the below is post-dec, which will dec
            // after returning current val
            'key'           => 'field_54b703017' . $fieldCounter--,
            'label'         => 'Artist Type ' . $year,
            'name'          => 'artist_type' . $year,
            'type'          => 'select',
            'choices'       => $artistTypeChoices,
            'default_value' => '',
            'allow_null'    => 1,
            'multiple'      => 0,
        ];
        $availableYears[] = $year;
    }
    $availableYears = array_reverse($availableYears);
    $artistYearAndTypeFields = array_reverse($artistYearAndTypeFields);
    // share this for other pieces of theme
    $_ENV['cc_artist_type_and_year_fields_desc'] = $artistYearAndTypeFields;
    $faqHeaderArrForACF = array_map(function ($val) {
        return htmlentities($val, ENT_QUOTES);
    }, $faq_section_headers_ordered);
    $faqHeaderArrForACF = array_combine($faqHeaderArrForACF, $faqHeaderArrForACF);
    $yearArrForACF = array_combine($availableYears, $availableYears);

    // upgrades
    // UPDATE `wp__postmeta` SET meta_key='artist_type2016' WHERE `meta_key` LIKE 'artist_type';
    // UPDATE `wp__postmeta` SET meta_key='_artist_type2016' WHERE `meta_key` LIKE '_artist_type';
    register_field_group([
                             'id'         => 'acf_artist',
                             'title'      => 'Artist',
                             // add year and type to front of this array
                             'fields'     => array_merge($artistYearAndTypeFields, //
                                                         [
                                                             [
                                                                 'key'           => 'field_54b95bb123e45',
                                                                 'label'         => 'Artist Subtitle',
                                                                 'name'          => 'artist_subtitle',
                                                                 'type'          => 'text',
                                                                 'instructions'  => '[Example]<br>Title: John Roderick<br>Subtitle: The Long Winters',
                                                                 'default_value' => '',
                                                                 'placeholder'   => '',
                                                                 'prepend'       => '',
                                                                 'append'        => '',
                                                                 'formatting'    => 'html',
                                                                 'maxlength'     => '',
                                                             ],
                                                             [
                                                                 'key'           => 'field_55158a96020c0',
                                                                 'label'         => 'Artist Facebook',
                                                                 'name'          => 'artist_facebook',
                                                                 'type'          => 'text',
                                                                 'instructions'  => 'Link to artist Facebook',
                                                                 'default_value' => '',
                                                                 'placeholder'   => '',
                                                                 'prepend'       => '',
                                                                 'append'        => '',
                                                                 'formatting'    => 'html',
                                                                 'maxlength'     => '',
                                                             ],
                                                             [
                                                                 'key'           => 'field_55158ad5020c1',
                                                                 'label'         => 'Artist Twitter',
                                                                 'name'          => 'artist_twitter',
                                                                 'type'          => 'text',
                                                                 'instructions'  => 'Link to artist Twitter',
                                                                 'default_value' => '',
                                                                 'placeholder'   => '',
                                                                 'prepend'       => '',
                                                                 'append'        => '',
                                                                 'formatting'    => 'html',
                                                                 'maxlength'     => '',
                                                             ],
                                                             [
                                                                 'key'           => 'field_55158aeb020c2',
                                                                 'label'         => 'Artist YouTube',
                                                                 'name'          => 'artist_youtube',
                                                                 'type'          => 'text',
                                                                 'instructions'  => 'Link to artist YouTube',
                                                                 'default_value' => '',
                                                                 'placeholder'   => '',
                                                                 'prepend'       => '',
                                                                 'append'        => '',
                                                                 'formatting'    => 'html',
                                                                 'maxlength'     => '',
                                                             ],
                                                             [
                                                                 'key'           => 'field_55158aeb020c3',
                                                                 'label'         => 'Artist Website',
                                                                 'name'          => 'artist_website',
                                                                 'type'          => 'text',
                                                                 'instructions'  => 'Link to artist website',
                                                                 'default_value' => '',
                                                                 'placeholder'   => '',
                                                                 'prepend'       => '',
                                                                 'append'        => '',
                                                                 'formatting'    => 'html',
                                                                 'maxlength'     => '',
                                                             ],
                                                         ]),
                             'location'   => [
                                 [
                                     [
                                         'param'    => 'post_type',
                                         'operator' => '==',
                                         'value'    => 'artist',
                                         'order_no' => 0,
                                         'group_no' => 0,
                                     ],
                                 ],
                             ],
                             'options'    => [
                                 'position'       => 'normal',
                                 'layout'         => 'no_box',
                                 'hide_on_screen' => [
                                     0 => 'discussion',
                                     1 => 'comments',
                                     2 => 'revisions',
                                     3 => 'slug',
                                     4 => 'author',
                                     5 => 'format',
                                     6 => 'categories',
                                     7 => 'send-trackbacks',
                                 ],
                             ],
                             'menu_order' => 0,
                         ]);
    register_field_group([
                             'id'         => 'acf_city',
                             'title'      => 'City',
                             'fields'     => [
                                 [
                                     'key'           => 'field_54b83b55ed730',
                                     'label'         => 'City X Position',
                                     'name'          => 'city_x_position',
                                     'type'          => 'number',
                                     'instructions'  => 'The horizontal distance from the left edge of the full-size map in pixels.',
                                     'required'      => 1,
                                     'default_value' => '',
                                     'placeholder'   => '',
                                     'prepend'       => '',
                                     'append'        => '',
                                     'min'           => '',
                                     'max'           => '',
                                     'step'          => '',
                                 ],
                                 [
                                     'key'           => 'field_54b83bbced731',
                                     'label'         => 'City Y Position',
                                     'name'          => 'city_y_position',
                                     'type'          => 'number',
                                     'instructions'  => 'The vertical distance from the top edge of the full-size map in pixels.',
                                     'required'      => 1,
                                     'default_value' => '',
                                     'placeholder'   => '',
                                     'prepend'       => '',
                                     'append'        => '',
                                     'min'           => '',
                                     'max'           => '',
                                     'step'          => '',
                                 ],
                                 [
                                     'key'           => 'field_54b83bdeed732',
                                     'label'         => 'Invert Label Position',
                                     'name'          => 'invert_label_position',
                                     'type'          => 'true_false',
                                     'instructions'  => 'Enable to show the city label under its point on the map.',
                                     'message'       => '',
                                     'default_value' => 0,
                                 ],
                                 [
                                     'key'           => 'field_54c937c66bb8a',
                                     'label'         => 'Invert Info Position',
                                     'name'          => 'invert_info_position',
                                     'type'          => 'true_false',
                                     'message'       => '',
                                     'default_value' => 0,
                                 ],
                                 [
                                     'key'           => 'field_54c937d96bb8b',
                                     'label'         => '',
                                     'name'          => '',
                                     'type'          => 'text',
                                     'default_value' => '',
                                     'placeholder'   => '',
                                     'prepend'       => '',
                                     'append'        => '',
                                     'formatting'    => 'html',
                                     'maxlength'     => '',
                                 ],
                             ],
                             'location'   => [
                                 [
                                     [
                                         'param'    => 'post_type',
                                         'operator' => '==',
                                         'value'    => 'city',
                                         'order_no' => 0,
                                         'group_no' => 0,
                                     ],
                                 ],
                             ],
                             'options'    => [
                                 'position'       => 'normal',
                                 'layout'         => 'no_box',
                                 'hide_on_screen' => [],
                             ],
                             'menu_order' => 0,
                         ]);
    register_field_group([
                             'id'         => 'acf_faq',
                             'title'      => 'FAQ',
                             'fields'     => [
                                 [
                                     'key'           => 'field_544c2ecd0555e',
                                     'label'         => 'Show on Front Page',
                                     'name'          => 'show_on_front_page',
                                     'type'          => 'checkbox',
                                     'choices'       => ['show on front page' => 'show on front page',],
                                     'default_value' => '',
                                     'layout'        => 'vertical',
                                 ],
                                 [
                                     'key'               => 'field_54caf8c8c0de8',
                                     'label'             => 'FAQ Section Header',
                                     'name'              => 'faq_section_header',
                                     'type'              => 'radio',
                                     'choices'           => $faqHeaderArrForACF,
                                     'other_choice'      => 0,
                                     'save_other_choice' => 0,
                                     'default_value'     => '',
                                     'layout'            => 'vertical',
                                 ],
                                 [
                                     'key'               => 'field_569fe1ce97b8b',
                                     'label'             => 'FAQ Year',
                                     'name'              => 'faq_year',
                                     'type'              => 'select',
                                     'instructions'      => 'To which cruise-year does this FAQ item apply',
                                     'required'          => 1,
                                     'choices'           => $yearArrForACF,
                                     'other_choice'      => 0,
                                     'save_other_choice' => 0,
                                     'default_value'     => '',
                                     'default_value'     => '',
                                     'allow_null'        => 0,
                                     'multiple'          => 0,
                                 ],
                             ],
                             'location'   => [
                                 [
                                     [
                                         'param'    => 'post_type',
                                         'operator' => '==',
                                         'value'    => 'faq',
                                         'order_no' => 0,
                                         'group_no' => 0,
                                     ],
                                 ],
                             ],
                             'options'    => [
                                 'position'       => 'acf_after_title',
                                 'layout'         => 'no_box',
                                 'hide_on_screen' => [],
                             ],
                             'menu_order' => 0,
                         ]);
    register_field_group([
                             'id'         => 'acf_sponsor',
                             'title'      => 'Sponsor',
                             'fields'     => [
                                 [
                                     'key'           => 'field_544c2ecd0555f',
                                     'label'         => 'Sponsor website',
                                     'name'          => 'sponsor_website',
                                     'type'          => 'text',
                                     'instructions'  => 'Link to sponsor website',
                                     'default_value' => '',
                                     'placeholder'   => '',
                                     'prepend'       => '',
                                     'append'        => '',
                                     'formatting'    => 'html',
                                     'maxlength'     => '',
                                 ],
                                 [
                                     'key'           => 'field_544c2ecd05560',
                                     'label'         => 'Double Wide',
                                     'name'          => 'double_wide',
                                     'type'          => 'checkbox',
                                     'choices'       => ['double wide' => 'double wide',],
                                     'default_value' => '',
                                     'layout'        => 'vertical',
                                 ],
                             ],
                             'location'   => [
                                 [
                                     [
                                         'param'    => 'post_type',
                                         'operator' => '==',
                                         'value'    => 'sponsor',
                                         'order_no' => 0,
                                         'group_no' => 0,
                                     ],
                                 ],
                             ],
                             'options'    => [
                                 'position'       => 'acf_after_title',
                                 'layout'         => 'no_box',
                                 'hide_on_screen' => [],
                             ],
                             'menu_order' => 0,
                         ]);

    // for the experience page
    register_field_group([
                             'id'         => 'acf_experience-page',
                             'title'      => 'Experience Page',
                             'fields'     => [
                                 [
                                     'key'          => 'field_555280ec5a855',
                                     'label'        => 'Featured Image Clickthrough File',
                                     'name'         => 'exp_featured_image_clickthrough_file',
                                     'type'         => 'file',
                                     'instructions' => 'This the file that will be displayed when people click through on the featured image. If none is provided, the image will not be clickable.',
                                     'save_format'  => 'object',
                                     'library'      => 'all',
                                 ],
                             ],
                             'location'   => [
                                 [
                                     [
                                         'param'    => 'post_type',
                                         'operator' => '==',
                                         'value'    => 'experience',
                                         'order_no' => 0,
                                         'group_no' => 0,
                                     ],
                                 ],
                             ],
                             'options'    => [
                                 'position'       => 'normal',
                                 'layout'         => 'no_box',
                                 'hide_on_screen' => [],
                             ],
                             'menu_order' => 0,
                         ]);

    // Byline info for news posts
    register_field_group([
                             'id'         => 'acf_post-byline',
                             'title'      => 'Post byline',
                             'fields'     => [
                                 [
                                     'key'           => 'field_555dee9bf3f57',
                                     'label'         => 'Byline name',
                                     'name'          => 'byline_name',
                                     'type'          => 'text',
                                     'default_value' => '',
                                     'placeholder'   => '',
                                     'prepend'       => '',
                                     'append'        => '',
                                     'formatting'    => 'html',
                                     'maxlength'     => '',
                                 ],
                                 [
                                     'key'          => 'field_555deec1f3f58',
                                     'label'        => 'Byline image',
                                     'name'         => 'byline_image',
                                     'type'         => 'image',
                                     'save_format'  => 'object',
                                     'preview_size' => 'thumbnail',
                                     'library'      => 'all',
                                 ],
                             ],
                             'location'   => [
                                 [
                                     [
                                         'param'    => 'post_type',
                                         'operator' => '==',
                                         'value'    => 'post',
                                         'order_no' => 0,
                                         'group_no' => 0,
                                     ],
                                 ],
                             ],
                             'options'    => [
                                 'position'       => 'normal',
                                 'layout'         => 'no_box',
                                 'hide_on_screen' => [],
                             ],
                             'menu_order' => 0,
                         ]);

    register_field_group([
                             'id'         => 'acf_social-fields',
                             'title'      => 'Social Fields',
                             'fields'     => [
                                 [
                                     'key'           => 'field_5576fca5e1be5',
                                     'label'         => 'Social Post Title',
                                     'name'          => 'social_post_title',
                                     'type'          => 'text',
                                     'instructions'  => 'What title should be shown when pasting the link to this page into social media',
                                     'default_value' => '',
                                     'placeholder'   => '',
                                     'prepend'       => '',
                                     'append'        => '',
                                     'formatting'    => 'html',
                                     'maxlength'     => '',
                                 ],
                                 [
                                     'key'          => 'field_5576fccee1be6',
                                     'label'        => 'Social Post Image',
                                     'name'         => 'social_post_image_url',
                                     'type'         => 'image',
                                     'instructions' => 'What image should be used as the default image when this link is pasted into social media',
                                     'save_format'  => 'url',
                                     'preview_size' => 'thumbnail',
                                     'library'      => 'all',
                                 ],
                             ],
                             'location'   => [
                                 [
                                     [
                                         'param'    => 'post_type',
                                         'operator' => '!=',
                                         'value'    => 'city',
                                         'order_no' => 0,
                                         'group_no' => 0,
                                     ],
                                 ],
                             ],
                             'options'    => [
                                 'position'       => 'normal',
                                 'layout'         => 'no_box',
                                 'hide_on_screen' => [],
                             ],
                             'menu_order' => 1000,
                         ]);

}
?>