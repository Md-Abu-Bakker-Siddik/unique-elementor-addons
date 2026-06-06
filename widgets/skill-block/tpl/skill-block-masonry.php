<?php $settings['settings'] = $settings; ?>
<?php if ( $skill_block_items_array ) : ?>
	<div class="tm-sc-skill tm-skill-masonry">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout masonry grid-<?php echo esc_attr( $columns ); ?> <?php echo esc_attr( $gutter );?> clearfix">
			<div class="isotope-layout-inner">
        		<div class="isotope-item isotope-item-sizer"></div>
				<!-- the loop -->
				<?php foreach (  $skill_block_items_array as $skill_item ) { ?>
				<?php $settings['skill_item'] = $skill_item; ?>
				<?php
					$animation = "";
					$animation_delay = "";
					if(isset($skill_item['wow_appear_animation']) && !empty($skill_item['wow_appear_animation'])) {
						$animation = $skill_item['wow_appear_animation'];
					}
					if(isset($skill_item['wow_animation_delay']) && !empty($skill_item['wow_animation_delay'])) {
						$animation_delay = $skill_item['wow_animation_delay'] . 'ms';
					}
				?>
				<div class="isotope-item skill-block elementor-repeater-item-<?php echo esc_attr( $skill_item['_id'] ); ?> <?php echo esc_attr($animation);?>" data-wow-delay="<?php echo esc_attr($animation_delay);?>">
					<?php unique_addons_get_shortcode_template_part( 'skill-block-item', $_skin, 'skill-block/tpl', $settings, false ); ?>
				</div>
				<?php } ?>
				<!-- end of the loop -->
			</div>
		</div>
		<?php wp_reset_postdata(); ?>
	</div>


<?php else : ?>
	<?php unique_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>