<?php

use UniqueAddons\CPT\Projects\CPT_Projects;

if ( ! function_exists( 'unique_addons_get_projects' ) ) {
	/**
	 * Render project list HTML for archive views.
	 *
	 * @param string $container_type Container CSS class.
	 * @return void
	 */
	function unique_addons_get_projects( $container_type = 'container' ) {
		$settings = array(
			'container_type' => sanitize_text_field( $container_type ),
		);

		$html = unique_addons_get_cpt_shortcode_template_part( 'projects-parts', null, 'projects/archive-tpl', $settings, true );
		unique_addons_print_template_html( $html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'unique_addons_get_project_layout' ) ) {
	/**
	 * Render default project archive layout.
	 *
	 * @return void
	 */
	function unique_addons_get_project_layout() {
		$settings = array();

		$new_cpt_class           = CPT_Projects::Instance();
		$settings['ptTaxKey']    = $new_cpt_class->ptTaxKey;
		$settings['holder_id']   = unique_addons_get_isotope_holder_ID( 'projects' );
		$settings['layout_mode'] = 'fitRows';
		$settings['items_per_row'] = 3;
		$settings['gutter']      = 15;
		$settings['featured_image_size'] = 'medium';
		$settings['title_tag']   = 'h4';
		$settings['settings']    = $settings;

		$html = unique_addons_get_cpt_shortcode_template_part( 'projects-grid', null, 'projects/archive-tpl/tpl', $settings, true );
		unique_addons_print_template_html( $html ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
