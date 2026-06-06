<div class="side-panel-trigger" data-target="<?php echo esc_attr($holder_id)?>">
	<a href="#">
		<div class="hamburger-box">
			<div class="hamburger-inner"></div>
		</div>
	</a>
</div>


<div class="side-panel-body-overlay" data-target="<?php echo esc_attr($holder_id)?>"></div>
<div id="<?php echo esc_attr($holder_id)?>" class="side-panel-container <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<div class="side-panel-wrap">
		<div class="side-panel-trigger side-panel-trigger-close" data-target="<?php echo esc_attr($holder_id)?>"><a href="#"><i class="fa fa-times side-panel-trigger-icon"></i></a></div>

		<?php if ( !$skin_side_push_panel_post_id ) : ?>
		<h4><?php esc_html_e( 'This is your Side Push Panel Sidebar!', 'unique-elementor-addons' )?></h4>
		<p><?php echo sprintf( esc_html__( 'Step 1: Please add your content to this section from %1$sAdmin Dashboard > Parts - Side Push Panel %2$s (Side Push Panel Sidebar).', 'unique-elementor-addons' ), '<strong>', '</strong>')?></p>
		<p><?php echo sprintf( esc_html__( 'Step 2: Goto %1$sTheme Options > Side Push Panel Sidebar%2$s and select it from the dropdown menu.', 'unique-elementor-addons' ), '<strong>', '</strong>')?></p>
		<p><?php echo esc_html__( 'It\'s done!', 'unique-elementor-addons' )?></p>

		<?php else: ?>
		<?php
			//query args
			$post_id = '';
			$posts = get_posts([
				'post_type' => unique_elementor_addons_get_cpt_slug( 'side_panel' ),
				'post_status' => 'publish',
				'include' => $skin_side_push_panel_post_id,
			]);
			foreach ( $posts as $post ) {
				$post_id = $post->ID;
			}
		?>
		<?php if( $post_id ) { ?>
		<div class="header-top-cpt">
			<?php
				if ( did_action( 'elementor/loaded' ) ) {
					$pluginElementor = \Elementor\Plugin::instance();
					$contentElementor = htmlentities($pluginElementor->frontend->get_builder_content($post_id));
					echo html_entity_decode($contentElementor);
				}
			?>
		</div>
		<?php } ?>
		<?php endif; ?>
	</div>
</div>