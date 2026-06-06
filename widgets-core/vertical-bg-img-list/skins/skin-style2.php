<?php
namespace UniqueAddons\Widgets\VerticalBgImgList\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style2 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/uae-vertical-bg-img-list/tm_general/before_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style2';
	}


	public function get_title() {
		return __( 'Skin Style2', 'unique-elementor-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		//button classes
		$settings['btn_classes'] = unique_addons_prepare_button_classes_from_params( $settings );

		if(!empty($settings['slides'])) {
			$count_slides = count($settings['slides']);
			switch($count_slides) {
				case 1:
					$column_class = 'one-column';
				break;

				case 2:
					$column_class = 'two-column';
				break;

				case 3:
					$column_class = 'three-column';
				break;

				case 4:
				default:
					$column_class = 'four-column';
				break;
			}
		}
		$settings['column_class'] = $column_class;
		$settings['count_slides'] = $count_slides;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_widgetcore_template_part( 'each-list', $settings['_skin'], 'vertical-bg-img-list/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}