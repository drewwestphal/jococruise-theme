<a class="news-item-title" href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a>
<?php
if($post->post_excerpt){
	the_excerpt();
} else {
	the_content('more&hellip;');
}
?>