<?php
/**
 * THIS FILE
 * is included in functions.php because it
 * affects shortcode operation.
 *
 * It is here because it is thematically (hah!)
 * related to page-experience.
 */
add_filter('post_gallery', function($output = '', $atts, $content = false, $tag = false) {
    if(!is_page('The Experience')) {
        return $output;
    }
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

    $itemtag = tag_escape($atts['itemtag']);
    $captiontag = tag_escape($atts['captiontag']);
    $icontag = tag_escape($atts['icontag']);
    $valid_tags = wp_kses_allowed_html('post');
    if(!isset($valid_tags[$itemtag])) {
        $itemtag = 'dl';
    }
    if(!isset($valid_tags[$captiontag])) {
        $captiontag = 'dd';
    }
    if(!isset($valid_tags[$icontag])) {
        $icontag = 'dt';
    }

    $columns = intval($atts['columns']);
    $itemwidth = $columns > 0 ? floor(100 / $columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-experience";

    $gallery_style = '';
    // don't include any gallery style

    $size_class = sanitize_html_class($atts['size']);
    $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    $gallery_div .= '<span class="glyphicon glyphicon-menu-left"></span>';
	$num_attachments = count($attachments);
	$max_bullets_mobile = 14;
	if ($num_attachments>$max_bullets_mobile) {
		$gallery_div .= "<div class='visible-sm-block visible-md-block visible-lg-block'>";
	}
    for($i = 0; $i < $num_attachments; $i++) {
        $gallery_div .= sprintf('<a href="#gallery-item-%d" class="gallery-bull %s">&bull;</a>', $i, $i === 0 ? 'orange-text' : '');
    }
	if ($num_attachments>$max_bullets_mobile) {
		$gallery_div .= "</div>";
	}
    $gallery_div .= '<span class="glyphicon glyphicon-menu-right"></span>';
    /**
     * Filter the default gallery shortcode CSS styles.
     *
     * @since 2.5.0
     *
     * @param string $gallery_style Default CSS styles and opening HTML div container
     *                              for the gallery shortcode output.
     */
    $output = apply_filters('gallery_style', $gallery_style . $gallery_div);

    $i = 0;
    foreach($attachments as $id => $attachment) {

        $attr = ( trim($attachment -> post_excerpt)) ? array('aria-describedby' => "$selector-$id") : '';
        if(!empty($atts['link']) && 'file' === $atts['link']) {
            $image_output = wp_get_attachment_link($id, $atts['size'], false, false, false, $attr);
        } elseif(!empty($atts['link']) && 'none' === $atts['link']) {
            $image_output = wp_get_attachment_image($id, $atts['size'], false, $attr);
        } else {
            $image_output = wp_get_attachment_link($id, $atts['size'], false, false, false, $attr);
        }
        $image_meta = wp_get_attachment_metadata($id);

        $orientation = '';
        if(isset($image_meta['height'], $image_meta['width'])) {
            $orientation = ($image_meta['height'] > $image_meta['width']) ? 'portrait' : 'landscape';
        }
        $display_none_or_blank=$i===0?'':'style="display:none;"';
        $output .= "<{$itemtag} class='gallery-item gallery-item-{$i}' {$display_none_or_blank}>";
        $output .= "
            <{$icontag} class='gallery-icon {$orientation}'>
                $image_output
            </{$icontag}>";
        if($captiontag && trim($attachment -> post_excerpt)) {
            $output .= "
                <{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
                " . wptexturize($attachment -> post_excerpt) . "
                </{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
        ++$i;
        if(!$html5 && $columns > 0 && $i % $columns == 0) {
            $output .= '<br style="clear: both" />';
        }
    }

    if(!$html5 && $columns > 0 && $i % $columns !== 0) {
        $output .= "
            <br style='clear: both' />";
    }

    $output .= "
        </div>\n";

    return $output;
}, PHP_INT_MAX, 4);
?>

