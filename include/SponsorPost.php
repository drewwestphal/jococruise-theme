<?php

class SponsorPost extends JoCoCruisePost {
    public function portrait_landscape() {
        $image_id = get_post_thumbnail_id($this->id);
        $image_info = wp_get_attachment_image_src($image_id, $this->double_wide() ? 'large' : 'medium');
        $portrait = $image_info[1] < $image_info[2] ? true : false;
        if ($portrait) return 'portrait';
        else return 'landscape';
    }
}


?>