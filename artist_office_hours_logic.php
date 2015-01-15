<?php
//if it's the first item
if ($i == -4){
	?>
	<div class="artist_unit">
		<div class="headers" id="office-hours">
			<h1><span>Plus</span><br>Office Hours<br><span>With</span></h1>
		</div>
		<div class="artists-name artist-office">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>
		<?php $i++;
//if it's the last item *and* a multiple of 8 (or 0), start and close the div
} else if ( ($i % 8 == 0 || $i ==0) && ($i == ($oh_count-5))){ ?>
	</div>
	<div class="artist_unit">
		<div class="artists-name artist-office">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>
	</div>
	<?php $i++;
// if it's a multiple of 8 or 0, close the prev div, start a new one
} else if ($i % 8 == 0 || $i ==0){ ?>
	</div>
	<div class="artist_unit">
		<div class="artists-name artist-office">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>
	<?php $i++;
//if it's the last item on the list, close the tag
} else if ($i == ($oh_count-5)){ ?>
		<div class="artists-name artist-office">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>
	</div>
	<?php $i++;
//otherwise just add a name to the list
} else { ?>
		<div class="artists-name artist-office">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>
	<?php $i++; 
}