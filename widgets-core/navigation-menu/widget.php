<?php
namespace UniqueAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Navigation_Menu extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-navigation-menu-style', UNIQUE_ADDONS_ASSETS_URI . '/css/widgets-core/navigation-menu' . $direction_suffix . '.css' );
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
		return 'uae-navigation-menu';
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
		return esc_html__( 'TM Navigation Menu', 'unique-elementor-addons' );
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
		return [ 'tm-navigation-menu-style' ];
	}

	/**
	 * Get all registered menus.
	 *
	 * @return array of menus.
	 */
	private function get_simple_menus()
	{
		$menus   = wp_get_nav_menus();
		$options = [];

		if (empty($menus)) {
			return $options;
		}

		foreach ($menus as $menu) {
			$options[$menu->term_id] = $menu->name;
		}

		return $options;
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
			'custom_css_class',
			[
				'label' => esc_html__( "Custom CSS class", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$simple_menus = $this->get_simple_menus();

		if ($simple_menus) {
			$this->add_control(
				'tm_menu_selected',
				[
					'label'       => esc_html__('Select Menu', 'unique-elementor-addons'),
					'description' => sprintf(__('Go to the <a href="%s" target="_blank">Menu screen</a> to manage your menus.', 'unique-elementor-addons'), admin_url('nav-menus.php')),
					'type'        => Controls_Manager::SELECT,
					'label_block' => false,
					'options'     => $simple_menus,
					'default'     => array_keys($simple_menus)[0],
				]
			);
					$this->add_control(
						'split_nav', [
							'label' => esc_html__( "Split This Nav Menu Into Two Columns", 'unique-elementor-addons' ),
							'type' => \Elementor\Controls_Manager::SWITCHER,
							'default' => 'no',
						]
					);
		} else {
			$this->add_control(
				'menu',
				[
					'type'      => Controls_Manager::RAW_HTML,
					'raw'       => sprintf(__('<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'unique-elementor-addons'), admin_url('nav-menus.php?action=edit&menu=0')),
					'separator' => 'after',
				]
			);
		}
		$this->end_controls_section();


		$this->start_controls_section(
			'horizontal_list_options',
			[
				'label' => esc_html__( 'Horizontal List Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'list_disply_type',
			[
				'label' => esc_html__('Display Property', 'unique-elementor-addons'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => unique_addons_disply_type_list_elementor(),
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu ul li' => 'display: {{UNIT}}',
				],
			]
		);
		$this->add_responsive_control(
			'list_text_alignment',
			[
				'label' => esc_html__( "List Alignment", 'unique-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => unique_addons_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu ul' => 'text-align: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'hide_first_icon',
			[
				'label' => esc_html__( "Hide First Icon", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Default', 'unique-elementor-addons' ),
					'none'  => esc_html__( 'Hide', 'unique-elementor-addons' ),
					'block'  => esc_html__( 'Show', 'unique-elementor-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li:first-child .tm-nav-arrow-icon' => 'display: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'hide_last_icon',
			[
				'label' => esc_html__( "Hide Last Icon", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Default', 'unique-elementor-addons' ),
					'none'  => esc_html__( 'Hide', 'unique-elementor-addons' ),
					'block'  => esc_html__( 'Show', 'unique-elementor-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li:last-child .tm-nav-arrow-icon' => 'display: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'hide_all_icons',
			[
				'label' => esc_html__( "Hide All Icon", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'Default', 'unique-elementor-addons' ),
					'none'  => esc_html__( 'Hide', 'unique-elementor-addons' ),
					'block'  => esc_html__( 'Show', 'unique-elementor-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li .tm-nav-arrow-icon' => 'display: {{VALUE}};',
				]
			]
		);
		$this->end_controls_section();












		//Features
		$this->start_controls_section(
			'list_icon_options',
			[
				'label' => esc_html__( 'Icons Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'hide_icon',
			[
				'label' => esc_html__( 'Hide Icon', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li .tm-nav-arrow-icon' => 'display: none',
				],
			]
		);
		$this->add_control(
			'list_icon',
			[
				'label' => esc_html__( 'Icon from Library', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'animate_icon_on_hover',
			[
				'label' => esc_html__( "Animate Icon on Hover", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__( 'None', 'unique-elementor-addons' ),
					'rotate' => esc_html__( 'Rotate', 'unique-elementor-addons' ),
					'rotate-x' => esc_html__( 'Rotate X', 'unique-elementor-addons' ),
					'rotate-y' => esc_html__( 'Rotate Y', 'unique-elementor-addons' ),
					'scale'  => esc_html__( 'Scale', 'unique-elementor-addons' ),
					'translate'  => esc_html__( 'Translate', 'unique-elementor-addons' ),
					'translate-x'  => esc_html__( 'Translate X Left', 'unique-elementor-addons' ),
					'translate-x-right'  => esc_html__( 'Translate X Right', 'unique-elementor-addons' ),
					'translate-y'  => esc_html__( 'Translate Y', 'unique-elementor-addons' ),
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'breadcrumb_nav_icon_typography',
				'label' => esc_html__( 'Icon Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-simple-nav-menu li .tm-nav-arrow-icon',
			]
		);
		$this->start_controls_tabs('tabs_nav_icon_style');
		$this->start_controls_tab(
			'tab_nav_icon_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'list_icon_color_options',
			[
				'label' => esc_html__( 'Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_icon_color',
			[
				'label' => esc_html__( "Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li .tm-nav-arrow-icon' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_icon_theme_colored',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li .tm-nav-arrow-icon' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'list_icon_bgcolor_options',
			[
				'label' => esc_html__( 'Background Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_icon_bg_color',
			[
				'label' => esc_html__( "Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li .tm-nav-arrow-icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_icon_bg_theme_colored',
			[
				'label' => esc_html__( "Icon BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li .tm-nav-arrow-icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'list_icon_pos_options',
			[
				'label' => esc_html__( 'Postion Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_vertical',
			[
				'label' => __( 'Vertical Orientation', 'unique-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'unique-elementor-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'unique-elementor-addons' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_offset_y',
			[
				'label' => __( 'Offset', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li .tm-nav-arrow-icon' =>
							'{{list_icon_orientation_vertical.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_horizontal',
			[
				'label' => __( 'Horizontal Orientation', 'unique-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => is_rtl() ? 'right' : 'left',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'unique-elementor-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'unique-elementor-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_offset_x',
			[
				'label' => __( 'Offset', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li .tm-nav-arrow-icon' =>
							'{{list_icon_orientation_horizontal.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'list_icon_dimension_options',
			[
				'label' => esc_html__( 'Dimension Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'list_icon_width',
			[
				'label' => esc_html__( 'Width', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 11,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li .tm-nav-arrow-icon' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_height',
			[
				'label' => esc_html__( 'Height', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 11,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li .tm-nav-arrow-icon' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'list_icon_border_options',
			[
				'label' => esc_html__( 'Border/Shadow Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_icon_border_color',
				'label' => esc_html__( 'Icon Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-simple-nav-menu li .tm-nav-arrow-icon',
			]
		);
		$this->add_control(
			'list_icon_border_theme_colored',
			[
				'label' => esc_html__( "Icon Border Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li .tm-nav-arrow-icon' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li .tm-nav-arrow-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'list_icon_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-simple-nav-menu li .tm-nav-arrow-icon',
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'tab_nav_icon_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'list_icon_color_options_hover',
			[
				'label' => esc_html__( 'Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_icon_color_hover',
			[
				'label' => esc_html__( "Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li:hover .tm-nav-arrow-icon' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'list_icon_theme_colored_hover',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li:hover .tm-nav-arrow-icon' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'list_icon_bgcolor_options_hover',
			[
				'label' => esc_html__( 'Background Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_icon_bg_color_hover',
			[
				'label' => esc_html__( "Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li:hover .tm-nav-arrow-icon' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'list_icon_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Icon BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li:hover .tm-nav-arrow-icon' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'list_icon_pos_options_hover',
			[
				'label' => esc_html__( 'Postion Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_vertical_hover',
			[
				'label' => __( 'Vertical Orientation', 'unique-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'unique-elementor-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'unique-elementor-addons' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_offset_y_hover',
			[
				'label' => __( 'Offset', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li:hover .tm-nav-arrow-icon' =>
							'{{list_icon_orientation_vertical_hover.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_horizontal_hover',
			[
				'label' => __( 'Horizontal Orientation', 'unique-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => is_rtl() ? 'right' : 'left',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'unique-elementor-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'unique-elementor-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_offset_x_hover',
			[
				'label' => __( 'Offset', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li:hover .tm-nav-arrow-icon' =>
							'{{list_icon_orientation_horizontal_hover.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'list_icon_dimension_options_hover',
			[
				'label' => esc_html__( 'Dimension Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'list_icon_width_hover',
			[
				'label' => esc_html__( 'Width', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 11,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li:hover .tm-nav-arrow-icon' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_height_hover',
			[
				'label' => esc_html__( 'Height', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 11,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li:hover .tm-nav-arrow-icon' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'list_icon_border_options_hover',
			[
				'label' => esc_html__( 'Border/Shadow Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_icon_border_color_hover',
				'label' => esc_html__( 'Icon Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-simple-nav-menu li:hover .tm-nav-arrow-icon',
			]
		);
		$this->add_control(
			'list_icon_border_hover_theme_colored',
			[
				'label' => esc_html__( "Icon Border Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li:hover .tm-nav-arrow-icon' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_border_radius_hover',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li:hover .tm-nav-arrow-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'list_icon_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-simple-nav-menu li:hover .tm-nav-arrow-icon',
			]
		);
		$this->end_controls_tab();






		$this->start_controls_tab(
			'tab_nav_icon_active',
			[
				'label' => esc_html__('Active', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'list_icon_color_options_active',
			[
				'label' => esc_html__( 'Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_icon_color_active',
			[
				'label' => esc_html__( "Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item .tm-nav-arrow-icon' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_icon_theme_colored_active',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item .tm-nav-arrow-icon' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'list_icon_bgcolor_options_active',
			[
				'label' => esc_html__( 'Background Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_icon_bg_color_active',
			[
				'label' => esc_html__( "Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item .tm-nav-arrow-icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_icon_bg_theme_colored_active',
			[
				'label' => esc_html__( "Icon BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item .tm-nav-arrow-icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'list_icon_pos_options_active',
			[
				'label' => esc_html__( 'Postion Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_vertical_active',
			[
				'label' => __( 'Vertical Orientation', 'unique-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'unique-elementor-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'unique-elementor-addons' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_offset_y_active',
			[
				'label' => __( 'Offset', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item .tm-nav-arrow-icon' =>
							'{{list_icon_orientation_vertical_active.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_horizontal_active',
			[
				'label' => __( 'Horizontal Orientation', 'unique-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => is_rtl() ? 'right' : 'left',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'unique-elementor-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'unique-elementor-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'list_icon_orientation_offset_x_active',
			[
				'label' => __( 'Offset', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item .tm-nav-arrow-icon' =>
							'{{list_icon_orientation_horizontal_active.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'list_icon_dimension_options_active',
			[
				'label' => esc_html__( 'Dimension Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'list_icon_width_active',
			[
				'label' => esc_html__( 'Width', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 11,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item .tm-nav-arrow-icon' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_height_active',
			[
				'label' => esc_html__( 'Height', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 11,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item .tm-nav-arrow-icon' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'list_icon_border_options_active',
			[
				'label' => esc_html__( 'Border/Shadow Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_icon_border_color_active',
				'label' => esc_html__( 'Icon Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item .tm-nav-arrow-icon',
			]
		);
		$this->add_control(
			'list_icon_border_active_theme_colored',
			[
				'label' => esc_html__( "Icon Border Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item .tm-nav-arrow-icon' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'list_icon_border_radius_active',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item .tm-nav-arrow-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'list_icon_box_shadow_active',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item .tm-nav-arrow-icon',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();




		//Features
		$this->start_controls_section(
			'list_styling',
			[
				'label' => esc_html__( 'Typography/Color Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'list__typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-simple-nav-menu li, {{WRAPPER}} .tm-sc-simple-nav-menu li a',
			]
		);
		$this->start_controls_tabs('tabs_list_style');
		$this->start_controls_tab(
			'tab_list_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'list_text_color_options',
			[
				'label' => esc_html__( 'Text Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-sc-simple-nav-menu li a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_text_theme_colored',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-sc-simple-nav-menu li a' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_control(
			'bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => esc_html__( "Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li a' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li a' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_control(
			'border_options',
			[
				'label' => esc_html__( 'Border/Shadow Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_border',
				'label' => esc_html__( 'List Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-simple-nav-menu li a',
			]
		);
		$this->add_responsive_control(
			'border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-simple-nav-menu li a',
			]
		);
		$this->end_controls_tab();






		$this->start_controls_tab(
			'tab_list_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'list_text_color_options_hover',
			[
				'label' => esc_html__( 'Text Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li a:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'list_text_theme_colored_hover',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li a:hover' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);

		$this->add_control(
			'bg_color_options_hover',
			[
				'label' => esc_html__( 'Background Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'bg_color_hover',
			[
				'label' => esc_html__( "Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li a:hover' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'bg_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li a:hover' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);

		$this->add_control(
			'border_options_hover',
			[
				'label' => esc_html__( 'Border/Shadow Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_border_hover',
				'label' => esc_html__( 'List Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-simple-nav-menu li a:hover',
			]
		);
		$this->add_responsive_control(
			'border_radius_hover',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-simple-nav-menu li a:hover',
			]
		);
		$this->end_controls_tab();








		$this->start_controls_tab(
			'tab_list_active',
			[
				'label' => esc_html__('Active', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'list_text_color_options_active',
			[
				'label' => esc_html__( 'Text Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'list_text_color_active',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_text_theme_colored_active',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item a' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_control(
			'bg_color_options_active',
			[
				'label' => esc_html__( 'Background Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'bg_color_active',
			[
				'label' => esc_html__( "Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item a' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bg_theme_colored_active',
			[
				'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item a' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_control(
			'border_options_active',
			[
				'label' => esc_html__( 'Border/Shadow Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_border_active',
				'label' => esc_html__( 'List Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item a',
			]
		);
		$this->add_responsive_control(
			'border_radius_active',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_active',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-simple-nav-menu li.current-menu-item a',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();






		//Features
		$this->start_controls_section(
			'list_spacing',
			[
				'label' => esc_html__( 'List Spacing', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'list_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-simple-nav-menu li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .tm-sc-simple-nav-menu li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$classes[] = $settings['custom_css_class'];
		if( $settings['split_nav']  && $settings['split_nav'] == 'yes') {
			$classes[] = 'split-nav-menu';
		}

		if( $settings['animate_icon_on_hover'] ) {
			$classes[] = 'tm-animate-hover animate-icon-'.$settings['animate_icon_on_hover'];
		}

		$settings['classes'] = $classes;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_widgetcore_template_part( 'navigation-menu', null, 'navigation-menu/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}