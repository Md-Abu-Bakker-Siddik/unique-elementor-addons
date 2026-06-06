<?php
namespace UniqueAddons\Widgets\InteractiveList\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style1 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/uae-interactive-list/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
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

		//link url
		$settings['target'] = ( $settings['link'] && $settings['link']['is_external'] ) ? ' target="_blank"' : '';
		$settings['url'] = ( $settings['link'] && $settings['link']['url'] ) ? $settings['link']['url'] : '';



		//classes
		$classes = array();
		$classes[] = $settings['custom_css_class'];

		if( $settings['animate_icon_on_hover'] ) {
			$classes[] = 'animate-hover animate-icon-'.$settings['animate_icon_on_hover'];
		}
		$settings['classes'] = $classes;

		//classes


		//icon classes
		$icon_classes = array();
		$settings['icon_classes'] = $icon_classes;

		//button classes
		$settings['btn_classes'] = unique_addons_prepare_button_classes_from_params( $settings );

		//title classes
		$title_classes = array();
		$settings['title_classes'] = $title_classes;

		//subtitle classes
		$subtitle_classes = array();
		$settings['subtitle_classes'] = $subtitle_classes;

		//icon classes
		$icon_classes = array();
		$settings['icon_classes'] = $icon_classes;

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_shortcode_template_part( 'interactive-list-' . $settings['_skin'], null, 'interactive-list/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}