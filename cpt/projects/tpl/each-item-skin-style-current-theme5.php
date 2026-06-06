<!-- Project Block -->
 <div class="project-item projects-current-theme5">
	<div class="inner-box">
		<div class="image">
			<?php echo get_the_post_thumbnail( get_the_ID(), $feature_thumb_image_size, array( 'class' => 'img-fullwidth' ) );?>
		</div>
		<div class="content">
			<div class="title-area">
				<?php if ( $show_title == 'yes' ) : ?>
					<<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
				<?php endif; ?>
				<?php if ( $show_cat == 'yes' ) : ?>
					<ul class="cat-list">
						<?php include('term-list-each-post.php'); ?>
					</ul>
				<?php endif; ?>
			</div>
			<?php if ( $show_view_details_button == 'yes' ) : ?>
				<a href="<?php the_permalink();?>" class="arrow-icon">
					<i class="fa fa-arrow-right"></i>
				</a>
			<?php endif; ?>
		</div>
	</div>
</div>