<?php
namespace UniqueAddons\Widgets\VideoPopup\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Custom_CSS_Play_Button extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/uae-video-popup/tm_general/after_section_end', [ $this, 'register_layout_controls_play_btn' ] );
	}

	public function get_id() {
		return 'custom-css-button';
	}


	public function get_title() {
		return __( 'Skin - Custom CSS Play Button', 'unique-elementor-addons' );
	}









	public function register_layout_controls_play_btn( Widget_Base $widget ) {
		$this->parent = $widget;


		$this->start_controls_section(
			'icon_styling',
			[
				'label' => esc_html__( 'Play Button Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_size_options',
			[
				'label' => esc_html__( 'Dimension/Size Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'icon_area_width',
			[
				'label' => esc_html__( "Width", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-play-button' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'icon_area_height',
			[
				'label' => esc_html__( "Height", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-play-button' => 'height: {{SIZE}}{{UNIT}};',
				]
			]
		);




		$this->start_controls_tabs('tabs_icon_style');
		$this->start_controls_tab(
			'icon_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'icon_options',
			[
				'label' => esc_html__( 'Icon Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( "Icon Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-play-button' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_theme_colored',
			[
				'label' => esc_html__( "Icon Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-play-button' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Icon Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .video-play-button',
			]
		);
		$this->add_control(
			'icon_bg_options',
			[
				'label' => esc_html__( 'Background Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'iconb_bg_color',
			[
				'label' => esc_html__( "Icon Custom Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-play-button' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_bg_theme_colored',
			[
				'label' => esc_html__( "Icon Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-play-button' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_area_border_options',
			[
				'label' => esc_html__( 'Border Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_area_border',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .video-play-button',
			]
		);
		$this->add_responsive_control(
			'icon_area_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .video-play-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_area_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .video-play-button',
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'icon_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'icon_options_hover',
			[
				'label' => esc_html__( 'Icon Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_color_hover',
			[
				'label' => esc_html__( "Icon Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup:hover .video-play-button' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_theme_colored_hover',
			[
				'label' => esc_html__( "Icon Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup:hover .video-play-button' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_bg_options_hover',
			[
				'label' => esc_html__( 'Background Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_bg_color_hover',
			[
				'label' => esc_html__( "Icon Custom Background Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup:hover .video-play-button' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Icon Background Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup:hover .video-play-button' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		//classes
		$classes = array();
		$classes[] = 'tm-sc-video-popup';

		$settings['classes'] = $classes;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_widgetcore_template_part( 'video-popup', $settings['_skin'], 'video-popup/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}