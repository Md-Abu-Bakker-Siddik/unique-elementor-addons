<?php $settings['settings'] = $settings; ?>
<?php if ( $the_query->have_posts() ) : ?>
	<div class="tm-sc-projects tm-sc-projects-grid <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
		<?php include('filter.php'); ?>

		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout grid-<?php echo esc_attr( $columns ); ?> <?php echo esc_attr( $gutter );?> clearfix">
			<div class="isotope-layout-inner">

                <!-- the loop -->
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <?php include('filter-term-list-each-post.php'); ?>
                <div class="isotope-item projct-order <?php echo esc_attr( $term_slugs_list_string );?>">
                    <?php unique_addons_get_cpt_shortcode_template_part( 'each-item', $_skin, 'projects/tpl', $settings, false ); ?>
                </div>
                <?php endwhile; ?>
                <!-- end of the loop -->
			</div>
		</div>
		<?php wp_reset_postdata(); ?>
	</div>


<?php else : ?>
	<?php unique_addons_no_posts_match_criteria_text(); ?>
<?php endif; ?>