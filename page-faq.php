<?php get_header(); ?>
<?php include 'bumper_top.php'; ?>
<div class="container">
	<div class="col-xs-12 col-md-12">
		<h1 class="header-page"><?php the_title(); ?></h1>
	    <?php if (have_posts()) : while (have_posts()) : the_post();?>
            <div class="mac-page-intro"><?php the_content(); ?></div>
	    <?php endwhile; endif; 
        $faq_query = new WP_Query( array(
            'post_type' => 'faq',
            'posts_per_page' => -1
        ));
		$faqs_by_header = array();
        while($faq_query -> have_posts()) {
            $faq_query -> the_post();
            $faqs_by_header[get_field('faq_section_header', $post -> ID)][] = array('slug' => $post -> post_name, 'title' => apply_filters( 'the_title', $post -> post_title),
							'content' => $post -> post_content ? apply_filters( 'the_content', $post -> post_content) : apply_filters( 'the_excerpt', $post -> post_excerpt));
        }
        
        $allHeadersOrdered = array_unique(array_merge($faq_section_headers_ordered, array_keys($faqs_by_header)));
		echo $twig->render('faq.html', array('faqs' => $faqs_by_header, 'headers' => $allHeadersOrdered));
        ?> 
	    <script type="text/javascript">
        (function($){ 
	        function toggleFaq(item,animate){
               var mom = item.parent();
               var bro = item.siblings('.faq-content');
               var plus = item.siblings('span');
               // set this now... timing will affect result later
               var brovis = !bro.is(':visible');
               bro.slideToggle(animate?200:0);
               mom.toggleClass('faq-article-maximize');
               plus.toggleClass('glyphicon-minus');
               return mom.attr('id');
	        }
	    
	        $('.faq-show-hide').click(function(){
                history.pushState(null, null, '#'+toggleFaq($(this),true));
               return false;
	        });
	        $('.faq-button').click(function(){
		    		$(this).siblings('.faq-show-hide').click();
		    });
            window.location.hash.length>1 && toggleFaq($('#'+location.hash.substr(1)+' a.faq-show-hide'), false);
            jQuery('a').click(function() {
	    		var target = jQuery(this.hash);
	    		if (target.length != 0 && !target.hasClass('faq-article-maximize')) {
	    			toggleFaq($(this.hash+' a.faq-show-hide'),false);
	    		}
	    	});
        })(jQuery);
	    </script>
	    </section>
		<script src="<?php bloginfo('template_directory'); ?>/js/js_behavior.js"></script>
	</div>
</div>
<?php include 'bumper_bottom_empty.php'; ?>
<?php include 'footer.php'; ?>