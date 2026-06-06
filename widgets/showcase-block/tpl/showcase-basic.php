<?php $settings['settings'] = $settings; ?>
<?php if ( $showcase_items_array ) : ?>
	<div class="tm-showcase-grid">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="showcase-layout">
			<!-- the loop -->
			<?php foreach (  $showcase_items_array as $showcase_item ) { ?>
			<?php $settings['showcase_item'] = $showcase_item; ?>
			<?php unique_addons_get_shortcode_template_part( 'showcase-item', $_skin, 'showcase-block/tpl', $settings, false ); ?>
			<?php } ?>
			<!-- end of the loop -->
		</div>
		<?php wp_reset_postdata(); ?>
	</div>

<?php else : ?>
	<?php unique_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>