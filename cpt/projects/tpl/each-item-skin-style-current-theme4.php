<div class="projects-current-theme4">
	<div class="inner-block">
		<div class="image">
				<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
				<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
		</div>
		<div class="content">
			<?php if ( $show_cat == 'yes' ) : ?>
			<div class="categories-box">
				<?php include('term-list-each-post.php'); ?>
			</div>
			<?php endif; ?>

			<?php if ( $show_title == 'yes' ) : ?>
				<<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
			<?php endif; ?>

		</div>
	</div>
</div>