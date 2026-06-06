<?php
namespace UniqueAddons\Widgets\InteractiveTabs;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_InteractiveTabsTitle extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style( 'tm-interactive-tabs', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/interactive-tabs/interactive-tabs-loader' . $direction_suffix . '.css' );

		wp_register_script( 'tm-interactive-tabs', UNIQUE_ADDONS_ASSETS_URI . '/js/widgets/interactive-tabs.js', array('jquery'), false, true );
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
		return 'uae-interactive-tabs-title';
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
		return esc_html__( 'Interactive Tabs - Title', 'unique-elementor-addons' );
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
		return [ 'unique-addons-elementor', 'tm-interactive-tabs' ];
	}

	public function get_style_depends() {
		return [ 'tm-interactive-tabs' ];
	}


	/**
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Style1( $this ) );
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
			'slave_tab_content_id',
			[
				'label'       => esc_html__('Slave Tab Content ID', 'unique-elementor-addons'),
				'type'        => Controls_Manager::TEXT,
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__('Title', 'unique-elementor-addons'),
				'type'        => Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'activate',
			[
				'label' => esc_html__( "Make It Active?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->add_control(
			'list_items',
			[
				'label'		  => esc_html__( 'Tab Title List', 'unique-elementor-addons' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'title' => esc_html__('Creative', 'unique-elementor-addons'),
						'activate' => 'yes',
					],
					[
						'title' => esc_html__('Agency', 'unique-elementor-addons'),
					]
				],
				'title_field' => '{{{ title }}}',
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => __('Arrow Icon', 'unique-elementor-addons'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'font-awesome',
				],
			]
		);
		$this->end_controls_section();





		//Content Options
		$this->start_controls_section(
			'title_styling_options',
			[
				'label' => esc_html__( 'Title Styling', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-interactive-tabs .features-list li',
			]
		);
		$this->start_controls_tabs('tabs_title_styling');
		$this->start_controls_tab(
			'tabs_title_styling_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Title Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-tabs .features-list li' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .tm-interactive-tabs .features-list li' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_title_styling_hover',
			[
				'label' => esc_html__('Hover/Active', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Title Text Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-tabs .features-list li:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-interactive-tabs .features-list li.active-btn' => 'color: {{VALUE}};',
				]
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
					'{{WRAPPER}} .tm-interactive-tabs .features-list li:hover' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-interactive-tabs .features-list li.active-btn' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();




		//Content Options
		$this->start_controls_section(
			'icon_styling_options',
			[
				'label' => esc_html__( 'Icon Styling', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-tabs .features-list li .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs('tabs_icon_styling');
		$this->start_controls_tab(
			'tabs_icon_styling_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'icon_text_color',
			[
				'label' => esc_html__( "Icon Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-tabs .features-list li .icon' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .tm-interactive-tabs .features-list li .icon' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'icon_bg_color',
			[
				'label' => esc_html__( "Icon Bg Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-tabs .features-list li .icon' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_bg_theme_colored',
			[
				'label' => esc_html__( "Icon Bg Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-tabs .features-list li .icon' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_icon_styling_hover',
			[
				'label' => esc_html__('Hover/Active', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'icon_text_color_hover',
			[
				'label' => esc_html__( "Icon Text Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-tabs .features-list li:hover .icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-interactive-tabs .features-list li.active-btn .icon' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .tm-interactive-tabs .features-list li:hover .icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-interactive-tabs .features-list li.active-btn .icon' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'icon_bg_color_hover',
			[
				'label' => esc_html__( "Icon Bg Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-tabs .features-list li:hover .icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .tm-interactive-tabs .features-list li:active-btn .icon' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Icon Bg Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-tabs .features-list li:hover .icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .tm-interactive-tabs .features-list li:active-btn .icon' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


		//Features
		$this->start_controls_section(
			'list_styling',
			[
				'label' => esc_html__( 'List Styling', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'list_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-tabs .features-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_padding',
			[
				'label' => esc_html__( 'Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-tabs .features-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs('tabs_list_styling');
		$this->start_controls_tab(
			'tabs_list_border_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'list_bg_theme_colored',
			[
				'label' => esc_html__( "BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-tabs .features-list li' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'list_custom_bg_color',
			[
				'label' => esc_html__( "Custom BG Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-tabs .features-list li' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_border',
				'label' => esc_html__( 'List Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-interactive-tabs .features-list li',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_list_border_hover',
			[
				'label' => esc_html__('Hover/Active', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'list_bg_theme_colored_hover',
			[
				'label' => esc_html__( "BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} {{WRAPPER}} .tm-interactive-tabs .features-list li:hover, {{WRAPPER}} .tm-interactive-tabs .features-list li.active-btn' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'list_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom BG Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{WRAPPER}} .tm-interactive-tabs .features-list li:hover, {{WRAPPER}} .tm-interactive-tabs .features-list li.active-btn' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_border_hover',
				'label' => esc_html__( 'List Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-interactive-tabs .features-list li:hover, {{WRAPPER}} .tm-interactive-tabs .features-list li.active-btn',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();




		$this->start_controls_section(
			'last_item_options',
			[
				'label' => esc_html__( 'Last Child Styling', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'last_item_margin',
			[
				'label' => esc_html__( 'Item Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-tabs .features-list li:last-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'last_item_padding',
			[
				'label' => esc_html__( 'Item Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-tabs .features-list li:last-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs('tabs_list_lastchild_styling');
		$this->start_controls_tab(
			'tabs_list_lastchild_border_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_lastchild_border',
				'label' => esc_html__( 'List Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-interactive-tabs .features-list li:last-child',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_list_lastchild_border_hover',
			[
				'label' => esc_html__('Hover/Active', 'unique-elementor-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_lastchild_border_hover',
				'label' => esc_html__( 'List Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-interactive-tabs .features-list li:hover:last-child, {{WRAPPER}} .tm-interactive-tabs .features-list li.active-btn:last-child',
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

		//classes
		$classes = array();
		$settings['classes'] = $classes;


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_shortcode_template_part( 'interactive-tabs-title-default', null, 'interactive-tabs-title/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}
