<?php
namespace UniqueAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Swiper_Carousel_Arrow extends Widget_Base {
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        $direction_suffix = is_rtl() ? '.rtl' : '';

        wp_register_style( 'tm-swiper-carousel-arrow', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/swiper-carousel-arrow' . $direction_suffix . '.css' );
    }

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'uae-swiper-carousel-arrow';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'TM - Swiper Carousel Arrow', 'unique-elementor-addons' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-elementor';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'unique-addons' ];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'unique-addons-elementor' ];
	}

	public function get_style_depends() {
		return [ 'tm-swiper-carousel-arrow' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'tm_general',
			[
				'label' => esc_html__( 'General', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'arrow_style', [
				'label' => esc_html__( "Arrow Style", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'style1'  =>  esc_html__( 'Style 1', 'unique-elementor-addons' ),
					'style2'  =>  esc_html__( 'Style 2', 'unique-elementor-addons' )
				],
				'default' => 'style1'
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'swiper_arrow_styling', [
				'label' => esc_html__( 'Carousel Arrow Styling', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			"swiper_arrow_display_visibility", [
				'label' => esc_html__( "Visibility (Show/Hide)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex' => [
						'title' => __( 'Show', 'unique-elementor-addons' ),
						'icon' => 'eicon-check',
					],
					'none' => [
						'title' => __( 'Hide', 'unique-elementor-addons' ),
						'icon' => 'eicon-ban',
					],
				],
				'default' => 'flex',
				'selectors' => [
					'{{WRAPPER}} .tm-swiper-carousel-arrow-wrap' => 'display: {{VALUE}};'
				],
			]
		);

		$this->start_controls_tabs('tabs_swiper_arrow_styling');
		$this->start_controls_tab(
			'tabs_swiper_arrow_styling_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'swiper_arrow_bg_options',
			[
				'label' => esc_html__( 'Arrow BG Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'swiper_arrow_bg_color',
			[
				'label' => esc_html__( "Arrow BG Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'swiper_arrow_bg_theme_color',
			[
				'label' => esc_html__( "Arrow BG Theme Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'selectors' => [
					'{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_control(
			'swiper_arrow_text_options',
			[
				'label' => esc_html__( 'Arrow Text Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'swiper_arrow_text_color',
			[
				'label' => esc_html__( "Arrow Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow i' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'swiper_arrow_text_theme_color',
			[
				'label' => esc_html__( "Arrow Text Theme Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'selectors' => [
					'{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow i' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);


		$this->add_control(
			'swiper_arrow_size_options',
			[
				'label' => esc_html__( 'Arrow Size & Border', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'swiper_arrow_widthheight',
			[
				'label' => esc_html__( 'Dimension (Width and Height)', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 120,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'swiper_arrow_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'swiper_arrow_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'swiper_arrow_border_title',
			[
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'swiper_arrow_border',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'swiper_arrow_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'swiper_arrow_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow i',
			]
		);

		$this->add_control(
			'swiper_arrow_opacity_options',
			[
				'label' => esc_html__( 'Arrow Opacity', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'swiper_arrow_opacity',
			[
				'label' => esc_html__( 'Opacity', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_swiper_arrow_styling_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_responsive_control(
			'swiper_arrow_bg_color_hover',
			[
				'label' => esc_html__( "Arrow BG Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow:hover' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'swiper_arrow_bg_theme_color_hover',
			[
				'label' => esc_html__( "Arrow BG Theme Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'selectors' => [
					'{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow:hover' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'swiper_arrow_text_color_hover',
			[
				'label' => esc_html__( "Arrow Text Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow:hover i' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'swiper_arrow_text_theme_color_hover',
			[
				'label' => esc_html__( "Arrow Text Theme Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'selectors' => [
					'{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow:hover i' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'swiper_arrow_border_hover',
			[
				'label' => esc_html__( 'Border (Hover)', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'swiper_arrow_border_hover',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow:hover',
			]
		);
		$this->add_responsive_control(
			'swiper_arrow_opacity_hover',
			[
				'label' => esc_html__( 'Opacity (hover)', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-swiper-carousel-arrow-wrap .tm-swiper-arrow:hover' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$html = unique_addons_get_shortcode_template_part( 'swiper-carousel-arrow', null, 'swiper-carousel-arrow/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}
