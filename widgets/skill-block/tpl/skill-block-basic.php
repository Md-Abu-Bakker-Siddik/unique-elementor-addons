<?php $settings['settings'] = $settings; ?>
<?php if ( $skill_block_items_array ) : ?>
	<div class="tm-sc-skill tm-skill-basic">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="skill-layout">
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
			<div class="<?php echo esc_attr($animation);?>" data-wow-delay="<?php echo esc_attr($animation_delay);?>">
			<?php unique_addons_get_shortcode_template_part( 'skill-block-item', $_skin, 'skill-block/tpl', $settings, false ); ?>
			</div>
			<?php } ?>
			<!-- end of the loop -->
		</div>
		<?php wp_reset_postdata(); ?>
	</div>

<?php else : ?>
	<?php unique_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>