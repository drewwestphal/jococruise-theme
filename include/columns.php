<?php

add_filter('manage_faq_posts_columns', function($columns) {
    $show = get_field('show_on_front_page');

    $show = $show[0];
    return array_merge($columns, array(
        'show_on_front_page' => 'Show on Front Page',
        'faq_section_header' => 'FAQ Section Header',
    ));

}, 10, 1);

add_action('manage_faq_posts_custom_column', function($column, $post_id) {
    global $post;

    switch ( $column ) {

        case 'show_on_front_page' :
            the_field('show_on_front_page');
            break;

        case 'faq_section_header' :
            the_field('faq_section_header');
            break;
    }

}, 10, 2);

add_filter('manage_edit-faq_sortable_columns', function($columns) {
    $columns['faq_section_header'] = 'faq_section_header';
    return $columns;
}, 10, 1);

add_action('pre_get_posts', function($query) {
    if(!is_admin())
        return;

    $orderby = $query -> get('orderby');

    if('faq_section_header' == $orderby) {
        $query -> set('meta_key', 'faq_section_header');
        $query -> set('orderby', 'meta_value');
    }
    return $query;
}, PHP_INT_MAX);

?>
