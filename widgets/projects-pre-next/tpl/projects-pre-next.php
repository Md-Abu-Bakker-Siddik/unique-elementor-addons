<div class="single-post-next-prev-links">
	<div class="nav-previous">
		<?php
			$prev_post = get_previous_post();
			if($prev_post) {
				$prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
				echo '<a rel="prev" href="' . get_permalink($prev_post->ID) . '" title="' . $prev_title. '" class=" "><span>'. $prev_title . '</span></a>';
			}
		?>
	</div>

	<div class="nav-next ">
		<?php
			$next_post = get_next_post();
			if($next_post) {
				$next_title = strip_tags(str_replace('"', '', $next_post->post_title));
				echo '<a rel="next" href="' . get_permalink($next_post->ID) . '" title="' . $next_title. '" class=" "><span>'. $next_title . '</span></a>';
			}
		?>
	</div>
</div> 