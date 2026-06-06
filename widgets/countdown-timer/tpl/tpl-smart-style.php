<?php
  $random_number = wp_rand( 111111, 999999 );
?>
<div class="tm-sc-countdown-timer final-countdown countdown-timer-current-style <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<div id="final-countdown-clock-<?php echo esc_attr( $random_number.'-'.get_the_ID() );?>" class="countdown-timer" data-future-date="<?php echo esc_attr( $countdown_future_date_time );?>" data-showtime="<?php echo esc_attr( $show_time );?>"
		data-word-month="<?php echo esc_attr( $word_month );?>"
		data-word-weeks="<?php echo esc_attr( $word_week );?>"
		data-word-days="<?php echo esc_attr( $word_day );?>"
		data-word-hr="<?php echo esc_attr( $word_hr );?>"
		data-word-min="<?php echo esc_attr( $word_min );?>"
		data-word-sec="<?php echo esc_attr( $word_sec );?>"
	></div>
</div>