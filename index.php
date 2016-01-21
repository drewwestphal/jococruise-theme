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
    <!--contact-->
    <section id="contact" class="joco_blue">
        <h1 id="contact-header">Contact Us</h1>

        <div class="container">
            <div class="col-xs-12 col-sm-6 col-md-5 headers">
                <?php if(strlen($cont_gen_q_addy) > 0) { ?>
                    <div class="contact-info-group">
                        <div class="contact-icon" id="contact-icon-info">
                            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
                        </div>
                        <div class="contact-text headers">
                            <h5><?php echo $cont_gen_q; ?></h5>
                            <a href="mailto: <?php echo $cont_gen_q_addy; ?>"><?php echo $cont_gen_q_addy; ?></a>
                        </div>
                    </div>
                <?php }; ?>
                <?php if(strlen($cont_book_q_addy) > 0) { ?>
                    <div class="contact-info-group">
                        <div class="contact-icon" id="contact-icon-booking">
                            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>
                        </div>
                        <div class="contact-text headers">
                            <h5><?php echo $cont_book_q; ?></h5>
                            <a href="mailto: <?php echo $cont_book_q_addy; ?>"><?php echo $cont_book_q_addy; ?></a>
                        </div>
                    </div>
                <?php }; ?>
                <?php if(strlen($cont_tel_addy) > 0) { ?>
                    <div class="contact-info-group">
                        <div class="contact-icon" id="contact-icon-phone">
                            <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
                        </div>
                        <div class="contact-text headers">
                            <h5><?php echo $cont_tel; ?></h5>
                            <?php echo $cont_tel_addy; ?>
                        </div>
                    </div>
                <?php }; ?>
                <div class="contact-info-group contact-social">
                    <?php if(strlen($cruise_fb) > 0) { ?>
                        <a href="<?php echo $cruise_fb; ?>" class="contact-social-icon facebook" target="_blank"></a>
                    <?php }; ?>
                    <?php if(strlen($cruise_twitter) > 0) { ?>
                        <a href="<?php echo $cruise_twitter; ?>" class="contact-social-icon twitter"
                           target="_blank"></a>
                    <?php }; ?>
                    <?php if(strlen($cruise_rss) > 0) { ?>
                        <a href="<?php echo $cruise_rss; ?>" class="contact-social-icon rss" target="_blank"></a>
                    <?php }; ?>
                </div>
            </div>
            <div id="contact-form-container" class="col-xs-12 col-sm-6 col-md-7">
                <form name="form" action="<?php bloginfo('template_directory'); ?>/contact.php" method="post"
                      id="contact-form" novalidate class="clearfix">
                    <div class="contact-input" id="contact-input-email">
                        <input name="email" type="email" id="email" placeholder="your email address*">
                    </div>
                    <div class="contact-input" id="contact-input-name">
                        <input type="text" id="name" name="name" placeholder="your name*">
                    </div>
                    <input type="text" id="honeypot" name="honeypot" aria-hidden="true"
                           placeholder="Please leave blank.">

                    <div class="contact-comments" id="contact-comments">
                        <textarea name="comments" id="comments" placeholder="your message*"></textarea>
                    </div>
                    <div style="width:75%; margin:auto;">
                        <div class="recaptcha-container">
                            <div class="g-recaptcha" data-sitekey="6LdDyQUTAAAAAHpsqVuzy36d-8y5w7y7jyPvXE_d"
                                 data-theme="dark"></div>
                        </div>
                        <button id="contact-button" class="btn btn-lg btn-info contact-button" type="submit"
                                value="Submit">Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
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
