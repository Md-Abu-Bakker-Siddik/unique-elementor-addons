<!-- Project Block Style2 -->
<div class="project-item projects-current-theme2">
	<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'alt' => get_the_title() ) );?>
	<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'alt' => get_the_title() ) );?>
	<div class="content">
		<?php if ( $show_title == 'yes' ) : ?>
			<<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
		<?php endif; ?>
		<?php if ( $show_cat == 'yes' ) : ?>
			<ul>
				<?php
				$terms = get_the_terms(get_the_ID(), $ptTaxKey);
				if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
					$term_count = count($terms);
					$current_index = 0;
					foreach ($terms as $term) {
						$term_link = get_term_link( $term );
						$current_index++;
						?>
						<li>
							<a href="<?php echo esc_url( $term_link ); ?>"><?php echo esc_html( $term->name ); ?></a>
						</li>
						<?php
						if ( $current_index < $term_count ) {
							?>
							<li class="dot"></li>
							<?php
						}
					}
				}
				?>
			</ul>
		<?php endif; ?>
	</div>
</div>