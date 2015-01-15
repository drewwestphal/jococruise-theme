<?php
	$x = get_field('city_x_position');
	$left_position = ($x/$map_width)*100;
	$y = get_field('city_y_position');
	$top_position = ($y/$map_height)*100;
?>
<div class="map-city" id="<?php echo $post->post_name; ?>" style="left:<?php echo $left_position; ?>%; top:<?php echo $top_position; ?>%;">
	<h1><?php the_title(); ?></h1>
	<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
	<p><span><?php the_title(); ?></span><?php the_excerpt(); ?></p>
</div>	