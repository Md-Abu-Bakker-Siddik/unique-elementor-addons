<?php
namespace UniqueAddons\Widgets\PricingPlanSwitcher\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style2 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/uae-pricing-plan-switcher/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style2';
	}


	public function get_title() {
		return __( 'Skin Style2', 'unique-elementor-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
		//Title
		$this->start_controls_section(
			'default_options',
			[
				'label' => esc_html__( 'Default Settings', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'btn_horizontal_alignment',
			[
				'label' => esc_html__( "Block Horizontal Alignment(Flex)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_disply_flex_horizontal_align_elementor(),
				'label_block' => true,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons' => 'display:flex; justify-content: {{VALUE}};',
				],
			]
		);
        $this->add_control(
            'round_button',
            [
                'label' => esc_html__( 'Round Button', 'unique-elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'tm-switch-buttons-round-',
            ]
        );
		$this->end_controls_section();


		//Button
		$this->start_controls_section(
			'button_default_options',
			[
				'label' => esc_html__( 'Button Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'button_default_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a:not(.active)' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'button_default_text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a:not(.active)' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_default_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a:not(.active)',
			]
		);
		$this->add_responsive_control(
			'button_default_padding',
			[
				'label' => esc_html__( 'Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a:not(.active)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_default_bg_color',
			[
				'label' => esc_html__( "Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a:not(.active)' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'button_default_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a:not(.active)' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'button_default_border_color',
			[
				'label' => esc_html__( "Border Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a:not(.active)' => 'border-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'button_default_border_theme_colored',
			[
				'label' => esc_html__( "Border Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a:not(.active)' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();


		//Button Active
		$this->start_controls_section(
			'button_hover_default_options',
			[
				'label' => esc_html__( 'Button Active/Hover Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'button_hover_default_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a.active' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'button_hover_default_text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a.active' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'button_hover_default_bg_color',
			[
				'label' => esc_html__( "Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a.active' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'button_hover_default_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a:hover' => 'background-color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a.active' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'button_hover_default_border_color',
			[
				'label' => esc_html__( "Border Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a.active' => 'border-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'button_hover_default_border_theme_colored',
			[
				'label' => esc_html__( "Border Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a:hover' => 'border-color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a.active' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();



		//Offer Text
		$this->start_controls_section(
			'text_offer_options',
			[
				'label' => esc_html__( 'Offer Text Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'text_offer_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a span.price-offer' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_offer_text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a span.price-offer' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_offer_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a span.price-offer',
			]
		);
		$this->add_control(
			'text_offer_custom_bg_color',
			[
				'label' => esc_html__( "Text Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a span.price-offer' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_offer_bg_theme_colored',
			[
				'label' => esc_html__( "Text BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a span.price-offer' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'text_offer_padding',
			[
				'label' => esc_html__( 'Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher-button .switch-buttons li a span.price-offer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();



	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$html = unique_addons_get_shortcode_template_part( 'switcher', $settings['_skin'], 'pricing-plan-switcher/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}