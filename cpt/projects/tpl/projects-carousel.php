<?php $settings['settings'] = $settings; ?>
<?php
	wp_enqueue_style( 'swiper' );
	wp_enqueue_script( 'swiper' );
	//Swiper Slider Data
	$swiper_slide_data_info = unique_addons_swiper_data_params( $settings );
?>
<?php if ( $the_query->have_posts() ) : ?>
	<div id="<?php echo esc_attr( $holder_id ) ?>" class="tm-sc-projects tm-sc-projects-carousel tm-swiper-container <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>" <?php echo html_entity_decode( esc_attr( implode(' ', $swiper_slide_data_info) ) ) ?>>
		<div class="swiper-container-inner">
			<div class="swiper-wrapper">
				<!-- the loop -->
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<div class="swiper-slide">
					<?php unique_addons_get_cpt_shortcode_template_part( 'each-item', $_skin, 'projects/tpl', $settings, false ); ?>
				</div>
				<?php endwhile; ?>
				<!-- end of the loop -->
			</div>
		</div>

		<div class="swiper-pagination <?php if( $bullets !== 'yes' ) echo esc_attr( "d-none" ); ?>"></div>

		<div class="tm-swiper-arrow tm-swiper-button-wrap <?php if( $arrow !== 'yes' ) echo esc_attr( "d-none" ); ?>">
			<div class="tm-swiper-arrow tm-swiper-button-prev"><i class="lnr-icon-arrow-left"></i></div>
			<div class="tm-swiper-arrow tm-swiper-button-next"><i class="lnr-icon-arrow-right"></i></div>
		</div>
		<?php wp_reset_postdata(); ?>
	</div>

<?php else : ?>
	<?php unique_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>