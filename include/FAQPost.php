<?php

class FAQPost extends JoCoCruisePost {

    public function getSectionHeader() {
        return $this->get_field('faq_section_header');
    }

    public function getSectionHeaderSlug() {
        return
            mb_strtolower(
                preg_replace("/[^[:alnum:]-]/u", '',
                             str_replace(" ", '-', $this->getSectionHeader())));
    }

}


?>