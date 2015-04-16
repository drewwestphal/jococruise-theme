<?php get_header(); ?>
<?php include 'bumper_top.php'; ?>
<section class="mac-page headers" id="page-faq">
	<div class="container-fluid">
		<div class="col-xs-12 col-md-12">
			<h1 class="orange-text"><?php the_title(); ?></h1>
		    <?php if (have_posts()) : while (have_posts()) : the_post();?>
	            <div class="mac-page-intro"><?php the_content(); ?></div>
		    <?php endwhile; endif; 
		    $args = array(
				'post_type' => 'faq',
				'posts_per_page' => -1 
			);
			?>
		    <section class="mac-page-toc headers">
            <?php 
                $faq_query = new WP_Query( array(
                    'post_type' => 'faq',
                    'posts_per_page' => -1
                ));
                $byHeader = array();
                while($faq_query -> have_posts()) {
                    $faq_query -> the_post();
                   
                    $byHeader[get_field('faq_section_header', $post -> ID)][] = sprintf('
                    <article class="faq-article" id="%s">
                    <span class="faq-button glyphicon glyphicon-plus"></span>
                    <a class="faq-show-hide faq-title" href="#">%s</a><br/>
                    <div style="display:none" class="faq-content">%s</div>
                    </article>
                    ', $post -> post_name, apply_filters( 'the_title', $post -> post_title), //
                    $post -> post_content ? apply_filters( 'the_content', $post -> post_content) : apply_filters( 'the_excerpt', $post -> post_excerpt));
                }
                
                $allHeadersOrdered = array_unique(array_merge($faq_section_headers_ordered, array_keys($byHeader)));
                foreach($allHeadersOrdered as $header) {
                    $posts = isset($byHeader[$header]) ? $byHeader[$header] : array();
                    if(count($posts)) {
                        printf('<h1 class="orange-text faq-section-header">%s</h1>', $header);
                        // can't use print or echo as they are not real functions
                        array_map(function($post) {
                            file_put_contents('php://output', $post);
                        }, $posts);
                    }
                }
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
</section>
<?php include 'bumper_bottom_empty.php'; ?>
<?php include 'footer.php'; ?>