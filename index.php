<?php

$context = Timber::get_context();
$cruise_year = $context['cruise_year'];

$context['news_posts'] = $news_posts = Timber::get_posts(
    [
        'post_type'           => 'post',
        'posts_per_page'      => 5,
        'ignore_sticky_posts' => 1,
    ]);
$context['show_news'] = (bool)count($news_posts);
$context['show_mailing_list'] = function_exists('mc4wp_form');

$targetArtistType = 'artist_type' . $cruise_year;

function artistTypeQueryArray($key, $value) {
    return
        [
            'post_type'      => 'artist',
            'posts_per_page' => -1,
            'order'          => 'ASC',
            'meta_query'     => [
                [
                    'key'   => $key,
                    'value' => $value,
                ],
            ],
        ];
}


$context['artists'] = Timber::get_posts(artistTypeQueryArray($targetArtistType, 'artist'));
$context['featured_artists'] = Timber::get_posts(artistTypeQueryArray($targetArtistType, 'featured artist'));
$context['spotlight_items'] = Timber::get_posts(artistTypeQueryArray($targetArtistType, 'spotlight item'));

$context['map_cities'] = Timber::get_posts(
    [
        'post_type'      => 'city',
        'posts_per_page' => -1,
    ], 'MapCityPost'
);


Timber::render('frontpage.twig', $context);

return;
?>

<section id="content" role="main">
    <!-- faq -->
    <div class="faq container">
        <div class="faq col-xs-12 col-md-12">
            <h1><span>Frequently Asked</span><br>Questions</h1>
        </div>
        <?php
        $args = [
            'post_type'  => 'faq',
            'orderby'    => 'ID',
            'order'      => 'ASC',
            'meta_query' => [
                [
                    'key'     => 'show_on_front_page',
                    'value'   => '"show on front page"',
                    'compare' => 'LIKE',
                ],
            ],
        ];
        $faq_query = new WP_Query($args);
        if($faq_query->have_posts()) {
            $faq_count = $faq_query->post_count;
            $faqlink = get_page_by_title('FAQ');
            $faqlink = get_permalink($faqlink->ID);
            $faq_items = [];
            while($faq_query->have_posts()) {
                $faq_query->the_post();
                $faq_items[] = [
                    'title'   => get_the_title(),
                    'slug'    => $post->post_name,
                    'content' => $post->post_excerpt ? get_the_excerpt() : get_the_content(),
                ];
            }
            wp_reset_postdata();
            echo $twig->render('faq_frontpage.html', [
                'faq_link' => $faqlink,
                'faqs'     => $faq_items,
            ]);
        }
        ?>
        <a id="faq-view-all" href="/faq/">View All FAQS</a>
    </div>


    <?php include 'footer.php' ?>


    <!--about-->
    <section id="about">
        <?php

        //for reference... about section
        $args = [
            'post_type' => 'about',
            'orderby'   => 'ID',
            'order'     => 'ASC',
        ];
        $k = 0;
        $about_query = new WP_Query($args);
        if($about_query->have_posts()) {
            while($about_query->have_posts()) {
                $about_query->the_post();

                $thumb_id = get_post_thumbnail_id();
                $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
                $thumb_url = $thumb_url_array[0];
                ?>
                <div class="about-item clearfix headers <?php if($k % 2 == 0) {
                    echo 'right';
                }; ?>">
                    <div class="about-image"
                         style="background:url('<?php echo $thumb_url; ?>') center center no-repeat;background-size: cover;"></div>
                    <div class="about-info">
                        <h1><?php the_title(); ?></h1>
                        <?php if(has_excerpt()) { ?>
                            <p><?php the_excerpt(); ?></p>
                        <?php } else { ?>
                            <p><?php the_content(); ?></p>
                        <?php }; ?>
                    </div>
                </div>
                <?php
                $k++;
            }
        }

        wp_reset_postdata();
        ?>
    </section>
