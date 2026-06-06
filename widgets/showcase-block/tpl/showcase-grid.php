<?php $settings['settings'] = $settings; ?>
<?php if ( $showcase_items_array ) : ?>
	<div class="tm-showcase-grid">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout grid-<?php echo esc_attr( $columns ); ?> <?php echo esc_attr( $gutter );?> clearfix">
			<div class="isotope-layout-inner">
				<!-- the loop -->
				<?php foreach (  $showcase_items_array as $showcase_item ) { ?>
				<?php $settings['showcase_item'] = $showcase_item; ?>
				<div class="isotope-item">
					<?php unique_addons_get_shortcode_template_part( 'showcase-item', $_skin, 'showcase-block/tpl', $settings, false ); ?>
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