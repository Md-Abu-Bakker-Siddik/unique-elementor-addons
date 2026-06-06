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
class TM_Elementor_Image_Background_Text_Effect extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-image-background-text-effect', UNIQUE_ADDONS_ASSETS_URI . '/css/widgets-core/image-background-text-effect' . $direction_suffix . '.css' );
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
		return 'uae-dropcaps';
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
		return esc_html__( 'Image Background Text Effect', 'unique-elementor-addons' );
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
		return [ 'tm-image-background-text-effect' ];
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
			'text',
			[
				'label' => esc_html__( "Text", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "Sample", 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'text_tag',
			[
				'label' => esc_html__( "Text Tag", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_heading_tag_list(),
				'default' => 'h4'
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__( "Subtitle", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);
		$this->add_control(
			'subtitle_tag',
			[
				'label' => esc_html__( "Subtitle Tag", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_heading_tag_list(),
				'default' => 'p'
			]
		);
		$this->add_responsive_control(
			'bg_animation',
			[
				'label' => esc_html__( "Background Animation", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'yes' => esc_html__( 'Yes', 'unique-elementor-addons' ),
					'no'  => esc_html__( 'No', 'unique-elementor-addons' ),
				],
				'default' => 'no',
				'separator' => 'before',
				'prefix_class' => 'bg-animation-'
			]
		);
		$this->add_control(
			'bg_animation_speed',
			[
				'label' => esc_html__( 'Animation Speed', 'unique-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 20,
				'frontend_available' => true,
				'selectors' => [
					'{{WRAPPER}} .tm-image-background-text-effect' => 'animation-duration: {{VALUE}}s;'
				]
			]
		);
		$this->add_control(
			'bg_animation_direction',
			[
				'label' => esc_html__( 'Animation Direction', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'ltr',
				'options' => [
					'ltr' => esc_html__( 'Left', 'unique-elementor-addons' ),
					'rtl' => esc_html__( 'Right', 'unique-elementor-addons' ),
				],
				'prefix_class' => 'bg-animation-dir-'
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'bg_options_styling',
			[
				'label' => esc_html__( 'Background Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'text_background',
				'label' => esc_html__( 'Background', 'unique-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tm-image-background-text-effect',
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'text_options_styling',
			[
				'label' => esc_html__( 'Text Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-image-background-text-effect > .text',
			]
		);
		$this->add_control(
			'text_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-image-background-text-effect > .text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-image-background-text-effect > .text' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'text_margin',
			[
				'label' => esc_html__( 'Text Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-image-background-text-effect > .text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'text_padding',
			[
				'label' => esc_html__( 'Text Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-image-background-text-effect > .text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'stroke_options_styling',
			[
				'label' => esc_html__( 'Stroke', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
            'stroke_text_width_normal',
            [
                'label' => esc_html__( 'Stroke Width', 'unique-elementor-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [ 'min' => 0.1, 'max' => 10 ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tm-image-background-text-effect > .text' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'stroke_text_color_normal',
			[
				'label' => esc_html__( 'Stroke Color', 'unique-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-image-background-text-effect > .text' => '-webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'stroke_text_theme_colored',
			[
				'label' => esc_html__( "Stroke Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-image-background-text-effect > .text' => '-webkit-text-stroke-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'subtitle_options_styling',
			[
				'label' => esc_html__( 'Subtitle Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-image-background-text-effect > .subtitle',
			]
		);
		$this->add_control(
			'subtitle_text_color',
			[
				'label' => esc_html__( "Subtitle Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-image-background-text-effect > .subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_theme_colored',
			[
				'label' => esc_html__( "Subtitle Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-image-background-text-effect > .subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__( 'Subtitle Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-image-background-text-effect > .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_padding',
			[
				'label' => esc_html__( 'Subtitle Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-image-background-text-effect > .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
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

	//classes
	$classes = array();


	$settings['classes'] = $classes;

	//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
	$html = unique_addons_get_widgetcore_template_part( 'text', null, 'image-background-text-effect/tpl', $settings, true );

	unique_addons_print_template_html( $html );
	}
}