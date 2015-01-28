<a class="news-item-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
<?php
if($post->post_excerpt){
	the_excerpt();
} else {
	the_content();
}
?>