<?php if(is_front_page()) { ?>
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="header">
                <h1 class="entry-title"><?php the_title(); ?></h1> <?php edit_post_link(); ?>
            </header>
            <section class="entry-content">
                <?php if(has_post_thumbnail()) {
                    the_post_thumbnail();
                } ?>
                <?php the_content(); ?>
                <div class="entry-links"><?php wp_link_pages(); ?></div>
            </section>
        </article>
        <?php if(!post_password_required()) {
            comments_template('', true);
        } ?>
    <?php endwhile; endif; ?>
    </section>
    <?php get_sidebar(); ?>
    <?php get_footer();

} elseif(is_page('Artists')) {

    include('page-artists.php');

} elseif(is_page('FAQ')) {

    include('page-faq.php');

} elseif(is_page('News')) {

    include('page-news.php');

} elseif(is_page('The Experience')) {

    include('page-experience.php');

} elseif(is_page('Sponsors')) {

    include('page-sponsors.php');

} else {
    // regular old page style
    ?>


    <section class="joco-page" id="page-page">
        <?php include 'bumper_top.php'; ?>
        <div class="container nav-spacer">
            <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                <h1><?php the_title() ?></h1>
                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                    <p><?php the_content(); ?></p>
                <?php endwhile; endif; ?>
            </div>
        </div>
        <?php include 'bumper_bottom.php'; ?>
        <?php get_footer(); ?>
    </section>

<?php }; ?>