<div <?php post_class( 'tm-project' ); ?>>
	<div class="projects-mouse-follow-floating-info tm-floating-info-item">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="thumb">
				<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
				<div class="details">
					<?php if ( $show_cat == 'yes' ) : ?>
					<div class="floating-subtitle">
						<ul class="cat-list">
							<?php include('term-list-each-post.php'); ?>
						</ul>
					</div>
					<?php endif; ?>
					<?php if ( $show_title == 'yes' ) : ?>
						<<?php echo esc_attr( $title_tag );?> class="title floating-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
					<?php endif; ?>
				</div>
				<?php if ( $show_view_details_button == 'yes' ) : ?>
					<?php unique_addons_get_cpt_shortcode_template_part( 'button', null, 'projects/tpl', $settings, false ); ?>
				<?php endif; ?>
			</div>
		<?php } ?>
	</div>
</div>