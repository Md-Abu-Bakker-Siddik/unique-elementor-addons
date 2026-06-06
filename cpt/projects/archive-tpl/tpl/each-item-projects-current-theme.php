<div <?php post_class( 'tm-project' ); ?>>
	<div class="projects-current-theme-style1">
		<?php if ( has_post_thumbnail() ) { ?>
			<div class="thumb">
				<?php echo get_the_post_thumbnail( get_the_ID(), $featured_image_size, array( 'class' => 'img-fullwidth' ) );?>
			</div>
			<div class="tm-project-content-wrapper">
				<div class="tm-project-content">
					<div class="tm-project-content-inner">
						<div class="tm-project-content-inner-wrapper">
							<div class="icons-holder-inner">
								<div class="styled-icons">
									<a class="lightproject-trigger styled-icons-item" href="<?php the_permalink();?>"><i class="fa fa-plus"></i></a>
								</div>
							</div>
							<div class="project-detials">
								<ul class="cat-list">
									<?php include('term-list-each-post.php'); ?>
								</ul>
								<<?php echo esc_attr( $title_tag );?> class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></<?php echo esc_attr( $title_tag );?>>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>