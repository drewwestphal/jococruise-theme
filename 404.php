<?php get_header(); ?>
<section id="content" role="main">
    	<div style="height: 50px;"><!--PADDING--></div>
	    <section class="joco-page" id="page-page">
		<?php include 'bumper_top.php'; ?>
        <div class="container headers">
            <div class="col-xs-12 col-md-12" style="text-align: center;">
                <img src="<?php bloginfo('template_directory'); ?>/img/JoCo_dophinanchor.png" class="failboat" />
            </div>
            <div class="col-xs-12 col-md-12 text404">
                <!--<p class="text404">404: Lost at sea!</p>-->
            	<h1 class="header404">Something went overboard.</h1>
            	<p>It appears that what you're looking for has been lost at sea.
            		<br /><br />
            		We'll send out the lifeboats, but in the meantime, 
            		<br />can we interest you in something on deck?
            	</p>
            	<div class="button404">
            		<a href="/">Back to the main page</a>
            	</div>
            </div>
        </div>
        <?php include 'bumper_bottom.php'; ?>
        <?php get_footer(); ?>
    </section>
    
<script type="text/javascript">
    jQuery('.button404').click(function(){jQuery(this).find('a')[0].click();});
</script>
    
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