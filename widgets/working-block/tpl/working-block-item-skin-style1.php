<!-- Working Block Style1-->
<?php $working_item['settings'] = $settings; ?>
<div class="working-block-style1">
	<div class="number-top">
		<span class="step-badge"><?php unique_addons_get_shortcode_template_part( 'part-count', null, 'working-block/tpl', $working_item, false );?></span>
		<?php
		$icon_classes = 'icon';
		if (
			isset( $working_item['icon_type'], $working_item['working_block_image_hover']['id'] )
			&& 'image' === $working_item['icon_type']
			&& ! empty( $working_item['working_block_image_hover']['id'] )
		) {
			$icon_classes .= ' has-icon-hover';
		}
		?>
		<div class="<?php echo esc_attr( $icon_classes ); ?>">
			<?php unique_addons_get_shortcode_template_part( 'icon-type', $working_item['icon_type'], 'working-block/tpl', $working_item, false );?>
		</div>
	</div>
	<div class="content">
		<?php unique_addons_get_shortcode_template_part( 'part-title', null, 'working-block/tpl', $working_item, false );?>
		<?php unique_addons_get_shortcode_template_part( 'part-content', null, 'working-block/tpl', $working_item, false );?>
	</div>
</div>
