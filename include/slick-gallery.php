<?php
/**
 * THIS FILE
 * is included in functions.php because it
 * affects shortcode operation.
 */
add_filter('post_gallery', function($output = '', $atts, $content = false, $tag = false) {
    /**
     * This is copied from
     * wp-includes/media and modified...
     */

    global $post;
    $html5 = true;
    $atts = shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post ? $post -> ID : 0,
        'itemtag' => $html5 ? 'figure' : 'dl',
        'icontag' => $html5 ? 'div' : 'dt',
        'captiontag' => $html5 ? 'figcaption' : 'dd',
        // only 1 column fro this
        'columns' => 1,
        // large image
        'size' => 'large',
        'include' => '',
        'exclude' => '',
        'link' => ''
    ), $atts, 'gallery');

    $id = intval($atts['id']);

    if(!empty($atts['include'])) {
        $_attachments = get_posts(array(
            'include' => $atts['include'],
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $atts['order'],
            'orderby' => $atts['orderby']
        ));

        $attachments = array();
        foreach($_attachments as $key => $val) {
            $attachments[$val -> ID] = $_attachments[$key];
        }
    } elseif(!empty($atts['exclude'])) {
        $attachments = get_children(array(
            'post_parent' => $id,
            'exclude' => $atts['exclude'],
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $atts['order'],
            'orderby' => $atts['orderby']
        ));
    } else {
        $attachments = get_children(array(
            'post_parent' => $id,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $atts['order'],
            'orderby' => $atts['orderby']
        ));
    }

    if(empty($attachments)) {
        return '';
    }

    if(is_feed()) {
        $output = "\n";
        foreach($attachments as $att_id => $attachment) {
            $output .= wp_get_attachment_link($att_id, $atts['size'], true) . "\n";
        }
        return $output;
    }

    $attachments_context = array();
    foreach ($attachments as $id => $attachment) {
        $attachments_context[] = new \Timber\Image($id);
    }

    return \Timber\Timber::compile('slick-gallery.twig',array('attachments' => $attachments_context));
}, PHP_INT_MAX, 4);
?>