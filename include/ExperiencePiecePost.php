<?php

class ExperiencePiecePost extends JoCoCruisePost {

    // UTILITY DEFS
    public function parse_piped_title() {
        $pcs = explode(" | ", $this->title(), 2);
        if(count($pcs) < 2) {
            // there is no pipe here
            return $pcs[0];
        } else {
            return "<span>" . $pcs[0] . "</span><br/>" . $pcs[1];
        }
    }

    public function parse_piped_title2() {
        $pcs = explode(" | ", $this->title(), 2);
        if(count($pcs) < 2) {
            // there is no pipe here
            return $pcs[0];
        } else {
            return "<strong>" . $pcs[0] . "</strong>&nbsp;|&nbsp" . $pcs[1];
        }
    }

    public static function artistSortFunction($a, $b){
        /**
         * @var ExperiencePiecePost $a
         * @var ExperiencePiecePost $b
         */
        $aname = $a->post_title;
        $bname = $b->post_title;

        // jonathan coulton comes first
        if(stripos($aname, 'coulton')) {
            return -2;
        }
        if(stripos($bname, 'coulton')) {
            return 2;
        }
        // p&s come second
        if(stripos($aname, 'storm')) {
            return -1;
        }
        if(stripos($bname, 'storm')) {
            return 1;
        }

        $asplit = preg_split('/\s+/', $aname);
        $bsplit = preg_split('/\s+/', $bname);

        // if there are one, two or three words in a name
        // we'll compare based on the last word (last name?)
        // if there are more we'll compare on word 2,
        // which might be the name of the first artist
        // or could just be bullshit
        $acmpval = count($asplit) < 4 ? array_pop($asplit) : $asplit[1];
        $bcmpval = count($bsplit) < 4 ? array_pop($bsplit) : $bsplit[1];

        //printf('%s = %s ; %s = %s'."\n", $aname,$acmpval,$bname,$bcmpval);

        return strcasecmp($acmpval, $bcmpval);
    }
}


?>