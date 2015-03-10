<?php 
if(function_exists("register_field_group")) {
    register_field_group(array(
        'id' => 'acf_faq',
        'title' => 'FAQ',
        'fields' => array(
            array(
                'key' => 'field_544c2ecd0555e',
                'label' => 'Show on Front Page',
                'name' => 'show_on_front_page',
                'type' => 'checkbox',
                'choices' => array('show on front page' => 'show on front page', ),
                'default_value' => '',
                'layout' => 'vertical',
            ),
            array(
                'key' => 'field_545fbfa49ce6f',
                'label' => 'FAQ Section Header',
                'name' => 'faq_section_header',
                'type' => 'select',
                'required' => 1,
                'choices' => array_combine($faq_section_headers_ordered, $faq_section_headers_ordered),
                'default_value' => 'What the heck?',
                'allow_null' => 0,
                'multiple' => 0,
            ),
        ),
        'location' => array( array( array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'faq',
                    'order_no' => 0,
                    'group_no' => 0,
                ), ), ),
        'options' => array(
            'position' => 'acf_after_title',
            'layout' => 'no_box',
            'hide_on_screen' => array(),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array(
        'id' => 'acf_artist',
        'title' => 'Artist',
        'fields' => array(
            array(
                'key' => 'field_545fe6d91480a',
                'label' => 'Artist Twitter',
                'name' => 'artist_twitter',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'text',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_545fe7111480b',
                'label' => 'Artist Facebook',
                'name' => 'artist_facebook',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'text',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_545fe7111480c',
                'label' => 'Artist Youtube',
                'name' => 'artist_youtube',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'text',
                'maxlength' => '',
            ),
        ),
        'location' => array( array( array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'artist',
                    'order_no' => 0,
                    'group_no' => 0,
                ), ), ),
        'options' => array(
            'position' => 'normal',
            'layout' => 'no_box',
            'hide_on_screen' => array(
                0 => 'discussion',
                1 => 'comments',
                2 => 'revisions',
                3 => 'slug',
                4 => 'author',
                5 => 'format',
                6 => 'categories',
                7 => 'send-trackbacks',
            ),
        ),
        'menu_order' => 0,
    ));

}
?>