<?php $settings['settings'] = $settings; ?>
<?php if ( $slider_items_array ) : ?>
	<div class="tm-twentytwenty-slider tm-twentytwenty-slider-grid">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout grid-<?php echo esc_attr( $columns ); ?> <?php echo esc_attr( $gutter );?> clearfix">
			<div class="isotope-layout-inner">
				<!-- the loop -->
				<?php foreach (  $slider_items_array as $slider_items ) { ?>
				<?php $settings['slider_items'] = $slider_items; ?>
				<div class="isotope-item features-item elementor-repeater-item-<?php echo esc_attr( $slider_items['_id'] ); ?>">
					<?php unique_addons_get_shortcode_template_part( 'before-after-slider', null, 'before-after-slider/tpl', $settings, false ); ?>
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
