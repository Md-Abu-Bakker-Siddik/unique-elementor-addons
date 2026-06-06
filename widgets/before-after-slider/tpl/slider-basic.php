<?php $settings['settings'] = $settings; ?>
<?php if ( $slider_items_array ) : ?>
	<div class="tm-twentytwenty-slider tm-twentytwenty-slider-basic">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="feature-layout clearfix">
				<!-- the loop -->
				<?php foreach (  $slider_items_array as $slider_items ) { ?>
					<?php $settings['slider_items'] = $slider_items; ?>
					<?php unique_addons_get_shortcode_template_part( 'before-after-slider', null, 'before-after-slider/tpl', $settings, false ); ?>
				<?php } ?>
				<!-- end of the loop -->
		</div>
		<?php wp_reset_postdata(); ?>
	</div>

<?php else : ?>
	<?php unique_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>
