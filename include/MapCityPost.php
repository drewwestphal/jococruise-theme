<?php

class MapCityPost extends TimberPost {
    public function left_position($map_width) {
        return ($this->get_field('city_x_position') / $map_width) * 100;
    }

    public function top_position($map_height) {
        return ($this->get_field('city_y_position') / $map_height) * 100;
    }

    public function title_down_under() {
        return $this->get_field('invert_label_position');
    }

    public function info_down_under() {
        return $this->get_field('invert_info_position');
    }
}


?>