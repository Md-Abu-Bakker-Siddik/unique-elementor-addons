<?php $settings['settings'] = $settings; ?>
<?php if ( $award_items_array ) : ?>
	<div class="tm-award-grid">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout grid-<?php echo esc_attr( $columns ); ?> <?php echo esc_attr( $gutter );?>  <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?> clearfix">
			<div class="isotope-layout-inner">
				<!-- the loop -->
				<?php foreach (  $award_items_array as $award_item ) { ?>
				<?php $settings['award_item'] = $award_item; ?>
				<?php
					$animation = "";
					$animation_delay = "";
					if(isset($award_item['wow_appear_animation']) && !empty($award_item['wow_appear_animation'])) {
						$animation = $award_item['wow_appear_animation'];
					}
					if(isset($award_item['wow_animation_delay']) && !empty($award_item['wow_animation_delay'])) {
						$animation_delay = $award_item['wow_animation_delay'] . 'ms';
					}
				?>
				<div class="isotope-item award-item elementor-repeater-item-<?php echo esc_attr( $award_item['_id'] ); ?> <?php echo esc_attr($animation);?>" data-wow-delay="<?php echo esc_attr($animation_delay);?>">
					<?php unique_addons_get_shortcode_template_part( 'award-item', $_skin, 'award-block/tpl', $settings, false ); ?>
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