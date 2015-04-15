<?php get_header(); ?>
<section id="content" role="main">
    	<div style="height: 50px;"><!--PADDING--></div>
	    <section class="joco-page" id="page-page">
		<?php include 'bumper_top.php'; ?>
        <div class="container headers">
            <div class="col-xs-4 col-md-4">
                <img src="<?php bloginfo('template_directory'); ?>/img/boat_sideways.png" class="failboat" />
            </div>
            <div class="col-xs-8 col-md-8">
                <p class="text404">404: Lost at sea!</p>
            </div>
        </div>
        <?php include 'bumper_bottom.php'; ?>
        <?php get_footer(); ?>
    </section>
    
<!--<article id="post-0" class="post not-found">
<header class="header">
<h1 class="entry-title"><?php _e( 'Not Found', 'blankslate' ); ?></h1>
</header>
<section class="entry-content">
<p><?php _e( 'Nothing found for the requested page. Try a search instead?', 'blankslate' ); ?></p>
<?php get_search_form(); ?>
</section>
</article>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>-->