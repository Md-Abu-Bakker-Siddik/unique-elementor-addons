<?php
namespace UniqueAddons\Widgets\Projects\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

use UniqueAddons\Lib;
use UniqueAddons\CPT\Projects\CPT_Projects;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style_Mouse_Follow_Floating_Info extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/uae-cpt-projects/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style-mouse-follow-floating-info';
	}


	public function get_title() {
		return __( 'Skin - Mouse Follow Floating Info', 'unique-elementor-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-project-skin-mouse-follow-floating-info', UNIQUE_ADDONS_ASSETS_URI . '/css/cpt/projects/project-skin-mouse-follow-floating-info' . $direction_suffix . '.css' );

		$new_cpt_class = CPT_Projects::Instance();
		$class_instance =  (array) $new_cpt_class;
		$settings['holder_id'] = unique_addons_get_isotope_holder_ID('projects');

		$project_image_size_array_new = array();
		if ( $settings['project_image_size_array'] ) :
			foreach (  $settings['project_image_size_array'] as $each_item ) {
				$project_image_size_array_new[$each_item['image_for_project']] = $each_item['image_size'];
			}
		endif;
		$settings['project_image_size_array_new'] = $project_image_size_array_new;

		$this->render_output( $class_instance, $settings );
	}

	public function render_output( $class_instance, $settings ) {
		$new_cpt_class = $class_instance;

		$settings['the_query'] = $this->parent->query_posts($new_cpt_class);

		//classes
		$classes = array();
		if( $settings['add_border_radius'] ) {
			$classes[] = 'border-radius-around-box';
		}
		$classes[] = 'tm-has-mouse-follow-floating-info';
		$settings['classes'] = $classes;

		//button classes
		$settings['btn_classes'] = unique_addons_prepare_button_classes_from_params( $settings );

		//ptTaxKey
		$settings['ptTaxKey'] = $new_cpt_class['ptTaxKey'];

		$settings['settings'] = $settings;

		$html = unique_addons_get_cpt_shortcode_template_part( 'projects', $settings['display_type'], 'projects/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}
