<?php
namespace UniqueAddons\Widgets\SkillBlock\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style1 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/uae-skill-block/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style1';
	}


	public function get_title() {
		return __( 'Skin Style1', 'unique-elementor-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
		$this->start_controls_section(
			'current_skin_bg_styling',
			[
				'label' => esc_html__( 'Current Skin Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'current_skin_bg_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->start_controls_tabs('tabs_current_theme_styling');
		$this->start_controls_tab(
			'tabs_current_theme_styling_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_responsive_control(
			'current_skin_bg_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-skill .skill-block .inner-box:before' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'current_skin_bg_theme_colored',
			[
				'label' => esc_html__( "Make BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-skill .skill-block .inner-box:before' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_current_theme_styling_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_responsive_control(
			'current_skin_bg_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-skill .skill-block .inner-box:hover:before' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'current_skin_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Make BG Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}  .tm-sc-skill .skill-block .inner-box:hover:before' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();



		$this->add_control(
			'current_skin_border_options',
			[
				'label' => esc_html__( 'Border Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'current_skin_border',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-skill .skill-block .inner-box',
			]
		);
		$this->add_responsive_control(
			'current_skin_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-skill .skill-block .inner-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();




		//Counting Style
		$this->start_controls_section(
			'current_skin_counting_bg_styling',
			[
				'label' => esc_html__( 'Counting Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'current_skin_counting_bg_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->start_controls_tabs('tabs_current_theme_counting_styling');
		$this->start_controls_tab(
			'tabs_current_theme_counting_styling_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_responsive_control(
			'current_skin_counting_custom_color',
			[
				'label' => esc_html__( "Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-skill .skill-block .inner-box .skill-count' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'current_skin_counting_bg_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-skill .skill-block .inner-box .skill-count' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'current_skin_counting_bg_theme_colored',
			[
				'label' => esc_html__( "Make BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-skill .skill-block .inner-box .skill-count' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_current_theme_counting_styling_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_responsive_control(
			'current_skin_counting_custom_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-skill .skill-block .inner-box:hover .skill-count' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'current_skin_counting_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-skill .skill-block .inner-box:hover .skill-count' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'current_skin_counting_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Make BG Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-skill .skill-block .inner-box:hover .skill-count' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();



		$this->add_control(
			'current_skin_counting_border_options',
			[
				'label' => esc_html__( 'Border Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'current_skin_counting_border',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-skill .skill-block .inner-box .skill-count',
			]
		);
		$this->add_responsive_control(
			'current_skin_counting_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-skill .skill-block .inner-box .skill-count' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-skill-block-style1', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/skill-block/skill-block-style1' . $direction_suffix . '.css' );
		wp_register_script( 'skill-block-style1', UNIQUE_ADDONS_ASSETS_URI . '/js/widgets/skill-block-style1.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'skill-block-style1' );

		if( $settings['animate_icon_on_hover'] ) {
			$classes[] = 'animate-hover animate-icon-'.$settings['animate_icon_on_hover'];
		}

		//icon classes
		$icon_classes = array();
		$settings['icon_classes'] = $icon_classes;

		//button classes
		$settings['btn_classes'] = unique_addons_prepare_button_classes_from_params( $settings );


		//icon classes
		$icon_classes = array();
		$settings['icon_classes'] = $icon_classes;

		$settings['holder_id'] = unique_addons_get_isotope_holder_ID('skill-block');

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_shortcode_template_part( 'skill-block', $settings['display_type'], 'skill-block/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}