<?php
namespace UniqueAddons\Widgets\InteractiveTabs\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style1 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/uae-block-features/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style1';
	}


	public function get_title() {
		return __( 'Skin Style1', 'unique-elementor-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		//classes
		$classes = array();
		$settings['classes'] = $classes;


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_shortcode_template_part( 'interactive-tabs-title-skin-style1', null, 'interactive-tabs-title/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}