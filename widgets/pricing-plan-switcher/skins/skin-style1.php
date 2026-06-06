<?php
namespace UniqueAddons\Widgets\PricingPlanSwitcher\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style1 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/uae-pricing-plan-switcher/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style1';
	}


	public function get_title() {
		return __( 'Skin Style1', 'unique-elementor-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;


		//Title
		$this->start_controls_section(
			'variant_text_default_options',
			[
				'label' => esc_html__( 'Default Variant Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'variant_text_default_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher .title-normal' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'variant_text_default_text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher .title-normal' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'variant_text_default_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-pricing-plan-switcher .title-normal',
			]
		);
		$this->add_responsive_control(
			'variant_text_default_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher .title-normal' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();




		//Title
		$this->start_controls_section(
			'variant_text_secondary_options',
			[
				'label' => esc_html__( 'Secondary Variant Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'variant_text_secondary_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher .title-secondary' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'variant_text_secondary_text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher .title-secondary' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'variant_text_secondary_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-pricing-plan-switcher .title-secondary',
			]
		);
		$this->add_responsive_control(
			'variant_text_secondary_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher .title-secondary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();




		//Title
		$this->start_controls_section(
			'variant_text_offer_options',
			[
				'label' => esc_html__( 'Offer Text Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'variant_text_offer_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher .price-offer' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'variant_text_offer_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-pricing-plan-switcher .price-offer',
			]
		);
		$this->add_control(
			'variant_text_offer_custom_bg_color',
			[
				'label' => esc_html__( "Text Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher .price-offer' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'variant_text_offer_bg_theme_colored',
			[
				'label' => esc_html__( "Text BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher .price-offer' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'variant_text_offer_padding',
			[
				'label' => esc_html__( 'Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher .price-offer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();






		//Title
		$this->start_controls_section(
			'variant_bullet_options',
			[
				'label' => esc_html__( 'Bullet Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'variant_bullet_custom_bg_color',
			[
				'label' => esc_html__( "Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher .pricing-switcher-btn .btn-toggle' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'variant_bullet_custom_bg_color_active',
			[
				'label' => esc_html__( "Background Color (Active)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher .pricing-switcher-btn .btn-toggle.secondary-active' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'variant_bullet_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher .pricing-switcher-btn .btn-toggle' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'variant_bullet_bg_theme_colored_active',
			[
				'label' => esc_html__( "Background Theme Colored (Active)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-pricing-plan-switcher .pricing-switcher-btn .btn-toggle.secondary-active' => 'background-color: var(--theme-color{{VALUE}});'
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