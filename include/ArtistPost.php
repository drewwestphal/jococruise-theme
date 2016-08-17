<?php
use \Timber\Timber;

class ArtistPost extends JoCoCruisePost {

    public static function getPastArtists($availableCruiseYears) {
        $artistMetaQuery = array_map(function ($year) {
            return [
                // name is the name of the field in
                // the acf db (e.g. artist type 2015, 2016... blah blah
                'key'   => 'artist_type' . $year,
                // we want artists and featured artists
                'value' => [
                    'artist',
                    'featured artist',
                ],
            ];
        }, // we want everything but the first item (which is the current year)
            array_slice($availableCruiseYears, 1));

        // we want artists that were here for any
        $artistMetaQuery['relation'] = 'OR';

        $allPastArtists = Timber::get_posts(
            [
                'post_type'      => 'artist',
                'posts_per_page' => -1,
                'meta_query'     => $artistMetaQuery,
            ], 'ArtistPost'
        );
        usort($allPastArtists, [
            ArtistPost::class,
            'artistSortFunction',
        ]);
        return $allPastArtists;
    }

    public static function artistSortFunction($a, $b){
        /**
         * @var ArtistPost $a
         * @var ArtistPost $b
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