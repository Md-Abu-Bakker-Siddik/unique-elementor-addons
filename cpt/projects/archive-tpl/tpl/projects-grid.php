	<div class="tm-sc-projects tm-sc-projects-grid ">
		<!-- Isotope Gallery Grid -->
		<div id="<?php echo esc_attr( $holder_id ) ?>" class="isotope-layout <?php echo esc_attr( $layout_mode ); ?> grid-<?php echo esc_attr( $items_per_row ); ?> <?php echo esc_attr( $gutter ); ?> clearfix">
			<div class="isotope-layout-inner">
				<?php if( $layout_mode == 'masonry' ) { ?>
				<div class="isotope-item isotope-item-sizer"></div>
				<?php } ?>

				<!-- the loop -->
				<?php
				if ( have_posts() ) :
					// Start the Loop.
					$i = 0;
					while ( have_posts() ) : the_post();
				?>
				<?php include('filter-term-list-each-post.php'); ?>
				<div class="isotope-item <?php echo esc_attr( $term_slugs_list_string );?>">
					<?php unique_addons_get_cpt_shortcode_template_part( 'each-item-projects-current-theme', null, 'projects/archive-tpl/tpl', $settings, false ); ?>
				</div>
				<?php
						$i++;
					endwhile;
				else :
					// If no content, include the "No posts found" template.
					echo esc_html( "No posts found!" );
				endif;
				?>
			</div>
		</div>
		<?php wp_reset_postdata(); ?>
	</div>
