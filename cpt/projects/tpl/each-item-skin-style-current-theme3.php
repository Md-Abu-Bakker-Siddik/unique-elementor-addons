<?php
//Bg Image
$thumb_id = get_post_thumbnail_id( get_the_ID() );
if ( $thumb_id ) {
	$image = wp_get_attachment_image_src( $thumb_id, 'full' );
}

?>
	<div class="project-item projects-current-theme3" data-bg="<?php if( isset($image[0]) && !empty($image[0]) ) echo esc_url( $image[0] )?>">
		<div class="inner-box">
			<div class="content">
				<?php if ( $show_cat == 'yes' ) : ?>
					<ul class="cat-list">
						<?php include('term-list-each-post.php'); ?>
					</ul>
				<?php endif; ?>
				<?php if ( $show_title == 'yes' ) : ?>
					<<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
				<?php endif; ?>
				<?php if ( $show_excerpt == 'yes' ) : ?>
					<?php if ( empty($excerpt_length) ) { ?>
						<?php $excerpt = get_the_excerpt(); ?>
						<?php if ( !empty($excerpt) ) { ?>
							<div class="excerpt">
								<?php echo esc_html( strip_shortcodes( get_the_excerpt() ) )?>
							</div>
						<?php } ?>
					<?php } else { ?>
						<?php $excerpt = get_the_excerpt(); ?>
						<?php if ( !empty($excerpt) ) { ?>
							<div class="excerpt">
								<?php echo esc_html( unique_addons_slice_excerpt_by_length( $excerpt, $excerpt_length ) ); ?>
							</div>
						<?php } ?>
					<?php } ?>
				<?php endif; ?>
				<?php if ( $show_view_details_button == 'yes' ) : ?>
					<div class="btn-box">
						<a class="btn-style2" href="<?php the_permalink();?>">
							<span class="theme-btn-arrow-left">
								<i class="flaticon-common-right-arrow"></i>
							</span>
							<span class="theme-btn"><?php echo esc_html( $view_details_button_text  ); ?></span>
							<span class="theme-btn-arrow-right">
								<i class="flaticon-common-right-arrow"></i>
							</span>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>