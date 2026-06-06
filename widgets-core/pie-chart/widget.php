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
class TM_Elementor_Pie_Chart extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		wp_register_script( 'jquery-easypiechart', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/jquery.easypiechart.min.js', array('jquery'), false, true );

		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-pie-chart-style', UNIQUE_ADDONS_ASSETS_URI . '/css/widgets-core/pie-chart' . $direction_suffix . '.css' );
		wp_register_script( 'tm-pie-chart', UNIQUE_ADDONS_ASSETS_URI . '/js/widgets/pie-chart.js', array('jquery', 'jquery-easypiechart'), false, true );
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
		return 'uae-pie-chart';
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
		return esc_html__( 'Pie Chart', 'unique-elementor-addons' );
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
		return [ 'unique-addons-elementor', 'jquery-easypiechart', 'tm-pie-chart' ];
	}

	public function get_style_depends() {
		return [ 'tm-pie-chart-style' ];
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
		$this->add_responsive_control(
			'chart_flex_alignment',
			[
				'label' => esc_html__( "Chart Alignment(Flex)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_disply_flex_horizontal_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'display:flex; justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'percent',
			[
				'label' => esc_html__( "Percentage Value", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Add a Percentage Value. Maximum 100. Default: 85", 'unique-elementor-addons' ),
				'separator' => 'before',
				'default' => '85'
			]
		);
		$this->add_control(
			'barcolor',
			[
				'label' => esc_html__( "Bar Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'description' => esc_html__( "The color of the curcular bar. Leave empty for default value", 'unique-elementor-addons' ),
				'default' => '#ef1e25'
			]
		);
		$this->add_control(
			'trackcolor',
			[
				'label' => esc_html__( "Track Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'description' => esc_html__( "The color of the track, or false to disable rendering. Leave empty for default value", 'unique-elementor-addons' ),
				'default' => '#f2f2f2'
			]
		);
		$this->add_control(
			'linewidth',
			[
				'label' => esc_html__( "Line Width", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Width of the chart line in px. Default: 3", 'unique-elementor-addons' ),
				'default' => '3'
			]
		);
		$this->add_control(
			'linecap',
			[
				'label' => esc_html__( "Line Cap", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
				'square' => esc_html__( 'Square', 'unique-elementor-addons' ),
				'butt' => esc_html__( 'Butt', 'unique-elementor-addons' ),
				'round' => esc_html__( 'Round', 'unique-elementor-addons' ),
				],
				'default' => 'square'
			]
		);
		$this->add_control(
			'size',
			[
				'label' => esc_html__( "Size", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Size of the pie chart in px. It will always be a square. Default: 110", 'unique-elementor-addons' ),
				'default' => '110'
			]
		);
		$this->add_control(
			'scalecolor',
			[
				'label' => esc_html__( "Scale  Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'description' => esc_html__( "The color of the scale lines, false to disable rendering. Leave empty for default value", 'unique-elementor-addons' ),
				'default' => '#dfe0e0'
			]
		);
		$this->add_control(
			'scalelength',
			[
				'label' => esc_html__( "Scale Length", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Length of the scale lines (reduces the radius of the chart). Default: 5", 'unique-elementor-addons' ),
				'default' => '5'
			]
		);

		$this->end_controls_section();






		$this->start_controls_section(
			'percent_options',
			[
				'label' => esc_html__( 'Percent Value Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'percent_color',
			[
				'label' => esc_html__( "Percent Value Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .percent' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'percent_color_hover',
			[
				'label' => esc_html__( "Percent Value Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .percent' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'percent_theme_colored',
			[
				'label' => esc_html__( "Percent Value Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .percent' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'percent_theme_colored_hover',
			[
				'label' => esc_html__( "Percent Value Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .percent' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'percent_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .percent',
			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'title_options',
			[
				'label' => esc_html__( 'Title Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( "Show Title?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Add your Progress/Skill Title Text. Default: WordPress", 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_heading_tag_list(),
				'default' => 'h3'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-pie-chart .title',
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Title Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pie-chart .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Title Text Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-pie-chart .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Title Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pie-chart .title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Title Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-pie-chart .title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pie-chart .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		wp_register_script( 'jquery-easypiechart', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/jquery.easypiechart.min.js', array('jquery'), false, true );
		wp_enqueue_script( 'jquery-easypiechart' );

		$settings['box_inline_css'] = unique_addons_get_inline_css( unique_addons_sc_pie_chart_box_css( $settings ) );

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_widgetcore_template_part( 'pie-chart', null, 'pie-chart/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}
if(!function_exists('unique_addons_sc_pie_chart_box_css')) {
	/**
	 * Get Parent Box Styles
	 */
	function unique_addons_sc_pie_chart_box_css( $settings ) {
		$css_array = array();

		if( $settings['size'] != '' ) {
			$css_array[] = 'width: '.unique_addons_if_numeric_add_suffix($settings['size'], 'px');
			$css_array[] = 'height: '.unique_addons_if_numeric_add_suffix($settings['size'], 'px');
			$css_array[] = 'line-height: '.unique_addons_if_numeric_add_suffix($settings['size'], 'px');
		}
		return implode( '; ', $css_array );
	}
}