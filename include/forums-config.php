<?php

add_action('bp_init', function () {
    $fields = [
        [
            'field_group_id' => 1,
            'name'           => 'About',
            'description'    => 'Tell us about yourself',
            'field_order'    => 1,
            'is_required'    => false,
            'type'           => 'textbox',
        ],
        [
            'field_group_id' => 1,
            'name'           => 'Twitter',
            'field_order'    => 2,
            'is_required'    => false,
            'type'           => 'textbox',
        ],
        [
            'field_group_id' => 1,
            'name'           => 'Facebook',
            'field_order'    => 3,
            'is_required'    => false,
            'type'           => 'url',
        ],
        [
            'field_group_id' => 1,
            'name'           => 'Instagram',
            'field_order'    => 4,
            'is_required'    => false,
            'type'           => 'url',
        ],
        [
            'field_group_id' => 1,
            'name'           => 'Google+',
            'field_order'    => 5,
            'is_required'    => false,
            'type'           => 'url',
        ],
        [
            'field_group_id' => 1,
            'name'           => 'LinkedIn',
            'field_order'    => 6,
            'is_required'    => false,
            'type'           => 'url',
        ],
    ];
    if(function_exists('xprofile_get_field_id_from_name')) {
        foreach($fields as $field) {
            if(!xprofile_get_field_id_from_name($field['name'])) {
                xprofile_insert_field($field);
            }
        }
    }
});


?>