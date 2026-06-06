
			<div class="pricing-plan-title-area">
				<?php if ( $title ) { ?>
				<?php unique_addons_get_shortcode_template_part( 'title', null, 'pricing-plan/tpl', $settings, false );?>
				<?php } ?>
				<?php if ( $sub_title ) { ?>
				<?php unique_addons_get_shortcode_template_part( 'subtitle', null, 'pricing-plan/tpl', $settings, false );?>
				<?php } ?>
			</div>