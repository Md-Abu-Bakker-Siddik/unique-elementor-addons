<div class="tm-sc-pie-chart <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<div class="pie-chart"
		data-bar-color="<?php echo esc_attr( $barcolor ); ?>"
		data-track-color="<?php echo esc_attr( $trackcolor ); ?>"
		data-scale-color="<?php echo esc_attr( $scalecolor ); ?>"
		data-scale-length="<?php echo esc_attr( $scalelength ); ?>"
		data-line-cap="<?php echo esc_attr( $linecap ); ?>"
		data-line-width="<?php echo esc_attr( $linewidth ); ?>"
		data-size="<?php echo esc_attr( $size ); ?>"
		data-percent="<?php echo esc_attr( $percent ); ?>"
		<?php echo wp_kses_post( $box_inline_css );?>
		>
		<span class="percent"></span>
	</div>
	<?php if ( $show_title == 'yes' ) : ?>
	<<?php echo esc_attr( $title_tag );?> class="title"><?php echo wp_kses_post( $title );?></<?php echo esc_attr( $title_tag );?>>
	<?php endif; ?>
</div>