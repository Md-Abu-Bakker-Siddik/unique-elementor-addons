<!-- Pricing Block Style1-->
<?php $settings['settings'] = $settings;?>
<div class="tm-sc-pricing-plan <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?> pricing-plan-skin-style1">
	<div class="pricing-header">
		<div class="content">
			<?php unique_addons_get_shortcode_template_part( 'title', null, 'pricing-plan/tpl', $settings, false );?>
			<?php if ( $sub_title ) : ?>
				<p><?php echo esc_html( $sub_title ); ?></p>
			<?php endif; ?>
		</div>
		<h2 class="pricing-title">
			<?php if(!empty($price_prefix)): ?><?php echo esc_html($price_prefix); ?><?php endif; ?>
			<?php if(!empty($price)): ?><?php echo esc_html($price); ?><?php endif; ?>
			<?php if(!empty($price_postfix)): ?><sub><?php echo esc_html($price_postfix); ?></sub><?php endif; ?>
		</h2>
	</div>
	<div class="pricing-list-item">
		<?php if ( !empty( $settings['features_list'] ) ) :
			// Split features_list into two arrays
			$features_list_count = count( $settings['features_list'] );
			$split_point = ceil( $features_list_count / 2 );
			$features_list_first = array_slice( $settings['features_list'], 0, $split_point );
			$features_list_second = array_slice( $settings['features_list'], $split_point );
		?>
			<ul>
				<?php
				foreach ( $features_list_first as $item ) {
					?>
					<li>
						<?php
						if( $item['disable_item'] == 'yes' ) {
							if( !empty( $settings['features_list_noaction_icon'] ) ) {
								\Elementor\Icons_Manager::render_icon( $settings['features_list_noaction_icon'], [ 'aria-hidden' => 'true' ] );
							} else {
								echo '<i class="fa-solid fa-circle-check"></i>';
							}
						} else if( $item['line_through'] == 'yes' ) {
							if( !empty( $settings['features_list_line_through_icon'] ) ) {
								\Elementor\Icons_Manager::render_icon( $settings['features_list_line_through_icon'], [ 'aria-hidden' => 'true' ] );
							} else {
								echo '<i class="fa-solid fa-circle-check"></i>';
							}
						} else {
							if( !empty( $settings['features_list_icon'] ) ) {
								\Elementor\Icons_Manager::render_icon( $settings['features_list_icon'], [ 'aria-hidden' => 'true' ] );
							} else {
								echo '<i class="fa-solid fa-circle-check"></i>';
							}
						}
						?>
						<?php echo wp_kses_post( $item['content'] ); ?>
					</li>
					<?php
				}
				?>
			</ul>
			<div class="line"></div>
			<ul>
				<?php
				foreach ( $features_list_second as $item ) {
					?>
					<li>
						<?php
						if( $item['disable_item'] == 'yes' ) {
							if( !empty( $settings['features_list_noaction_icon'] ) ) {
								\Elementor\Icons_Manager::render_icon( $settings['features_list_noaction_icon'], [ 'aria-hidden' => 'true' ] );
							} else {
								echo '<i class="fa-solid fa-circle-check"></i>';
							}
						} else if( $item['line_through'] == 'yes' ) {
							if( !empty( $settings['features_list_line_through_icon'] ) ) {
								\Elementor\Icons_Manager::render_icon( $settings['features_list_line_through_icon'], [ 'aria-hidden' => 'true' ] );
							} else {
								echo '<i class="fa-solid fa-circle-check"></i>';
							}
						} else {
							if( !empty( $settings['features_list_icon'] ) ) {
								\Elementor\Icons_Manager::render_icon( $settings['features_list_icon'], [ 'aria-hidden' => 'true' ] );
							} else {
								echo '<i class="fa-solid fa-circle-check"></i>';
							}
						}
						?>
						<?php echo wp_kses_post( $item['content'] ); ?>
					</li>
					<?php
				}
				?>
			</ul>
		<?php endif; ?>
	</div>
	<?php if ( $show_view_details_button == 'yes' ) : ?>
		<a class="theme-btn-main" href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo ( ( $button['target'] == '' ) ? esc_attr( '_self' ) : esc_attr( $button['target'] ) ); ?>">
			<span class="theme-btn-arrow-left"> <i class="fa fa-arrow-right"></i> </span>
			<span class="theme-btn"><?php echo esc_html( $settings['view_details_button_text'] ); ?></span>
			<span class="theme-btn-arrow-right"> <i class="fa fa-arrow-right"></i> </span>
		</a>
	<?php endif; ?>
</div>