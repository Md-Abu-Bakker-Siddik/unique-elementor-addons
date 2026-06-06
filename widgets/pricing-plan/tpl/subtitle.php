
			<?php if ( $sub_title ) { ?>
				<<?php echo esc_attr( $subtitle_tag );?> class="pricing-plan-subtitle <?php echo esc_attr(implode(' ', $sub_title_classes)); ?>"><?php echo esc_html( $sub_title ); ?></<?php echo esc_attr( $subtitle_tag );?>>
			<?php } ?>
