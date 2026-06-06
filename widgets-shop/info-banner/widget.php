<?php
namespace UniqueAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Elementor Hello World
*
* Elementor widget for hello world.
*
* @since 1.0.0
*/
class TM_Elementor_InfoBanner extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-info-banner-advanced-style', UNIQUE_ADDONS_ASSETS_URI . '/css/woo/info-banner-advanced/info-banner-advanced' . $direction_suffix . '.css' );
		wp_register_script( 'tm-info-banner-advanced-script', UNIQUE_ADDONS_ASSETS_URI . '/js/woo/info-banner.js' );
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
		return 'uae-info-banner';
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
		return esc_html__( 'Info Banner', 'unique-elementor-addons' );
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
		return [ 'unique-addons-elementor', 'tm-info-banner-advanced-script' ];
	}

	public function get_style_depends() {
		return [ 'tm-info-banner-advanced-style' ];
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
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'layout',
			[
				'label' => esc_html__( "Layout", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'layout-top-reveal' => esc_html__( 'Top Reveal', 'unique-elementor-addons' ),
					'layout-center'  => esc_html__( 'Center Standard', 'unique-elementor-addons' ),
					'layout-bottom'  => esc_html__( 'From Bottom', 'unique-elementor-addons' ),
					'layout-image-switch'  => esc_html__( 'Image Switch', 'unique-elementor-addons' ),
					'layout-basic'  => esc_html__( 'Basic', 'unique-elementor-addons' ),
				],
				'default' => 'layout-top-reveal',
			]
		);
		$this -> add_responsive_control(
			'layout_alignment',
			[
				'label'       => esc_html__( 'Alignment', 'unique-elementor-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'default'     => 'left',
				'options'     => [
					'left' => [
						'title' => esc_html__('Left', 'unique-elementor-addons'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'unique-elementor-addons'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'unique-elementor-addons'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'label_block' => false,
				'selectors'   => [
					'{{WRAPPER}} .tm-sc-info-banner-advanced' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'layout_vertical_flex_options',
			[
				'label' => esc_html__( 'Flex Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'layout_flex_vertical',
			[
				'label' => esc_html__( "Flex Vertical Alignment", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_disply_flex_vertical_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner' => 'display:flex; align-items: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'layout_flex_horizontal',
			[
				'label' => esc_html__( "Flex Horizontal Alignment", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_disply_flex_horizontal_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner' => 'display:flex; justify-content: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();









		$this->start_controls_section(
			'title_options',
			[
				'label' => esc_html__( 'Title', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "Example title", 'unique-elementor-addons' ),
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
		$this->end_controls_section();









		$this->start_controls_section(
			'subtitle_options',
			[
				'label' => esc_html__( 'Subtitle', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_subtitle', [
				'label' => esc_html__( "Show Sub Title", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__( "Sub Title", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "Example subtitle", 'unique-elementor-addons' ),
				'condition' => [
					'show_subtitle' => array('yes')
				]
			]
		);
		$this->add_control(
			'subtitle_tag',
			[
				'label' => esc_html__( "Sub Title Tag", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_heading_tag_list(),
				'default' => 'h6',
				'condition' => [
					'show_subtitle' => array('yes')
				]
			]
		);
		$this->add_responsive_control(
			'subtitle__flex_vertical',
			[
				'label' => esc_html__( "Sub Title Vertical Alignment", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_disply_flex_vertical_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'display:flex; align-items: {{VALUE}};',
				],
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'subtitle_other_text',
			[
				'label' => esc_html__( "Subtitle Text", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);
		$repeater->add_control(
			'subtitle_other_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .subtitle  {{CURRENT_ITEM}}' => 'color: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			'subtitle_other_theme_colored',
			[
				'label' => esc_html__( "Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .subtitle  {{CURRENT_ITEM}}' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_other_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .subtitle  {{CURRENT_ITEM}}',
			]
		);
		$repeater->add_responsive_control(
			'subtitle_part_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .subtitle  {{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'subtitle_list',
			[
				'label' => esc_html__( "Subtitle Other Parts", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'paragraph_opt',
			[
				'label' => esc_html__( 'Content - Paragraph', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_paragraph', [
				'label' => esc_html__( "Show Paragraph", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'content',
			[
				'label' => esc_html__( "Paragraph", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( "Write a short description", 'unique-elementor-addons' ),
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'wrapper_background_styling',
			[
				'label' => esc_html__( 'Background Image/Color', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->start_controls_tabs('tabs_wrapper_background_style');
		$this->start_controls_tab(
			'wrapper_background_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_background_background',
				'label' => esc_html__( 'Background', 'unique-elementor-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner .banner-background',
			]
		);
		$this->add_responsive_control(
			'wrapper_background_theme_colored',
			[
				'label' => esc_html__( "BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner .banner-background' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'wrapper_background_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_background_bg_color_hover',
				'label' => esc_html__( 'Background', 'unique-elementor-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}}:hover .tm-sc-info-banner-advanced .info-banner-inner .banner-background',
			]
		);
		$this->add_responsive_control(
			'wrapper_background_theme_colored_hover',
			[
				'label' => esc_html__( "BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-info-banner-advanced .info-banner-inner .banner-background' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();










		// Section Column Background Overlay.
		$this->start_controls_section(
			'section_background_overlay',
			[
				'label' => esc_html__( 'Background Overlay', 'unique-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->start_controls_tabs( 'tabs_background_overlay' );
		$this->start_controls_tab(
			'tab_background_overlay_normal',
			[
				'label' => esc_html__( 'Normal', 'unique-elementor-addons' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_overlay',
				'selector' => '{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner >  .banner-background-overlay',
			]
		);
		$this->add_control(
			'background_overlay_opacity',
			[
				'label' => esc_html__( 'Opacity', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => .5,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner >  .banner-background-overlay' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_background_overlay_hover',
			[
				'label' => esc_html__( 'Hover', 'unique-elementor-addons' ),
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background_overlay_hover',
				'selector' => '{{WRAPPER}}:hover .tm-sc-info-banner-advanced .info-banner-inner >  .banner-background-overlay',
			]
		);
		$this->add_control(
			'background_overlay_hover_opacity',
			[
				'label' => esc_html__( 'Opacity', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => .5,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-info-banner-advanced .info-banner-inner >  .banner-background-overlay' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();










		$this->start_controls_section(
			'floating_img_options',
			[
				'label' => esc_html__( 'Floating PNG Image', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'floating_banner_image',
			[
				'label' => esc_html__( "Floating PNG Image", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'floating_banner_image_hover',
			[
				'label' => esc_html__( "Floating PNG Image (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'layout' => array('layout-image-switch')
				]
			]
		);
		$this->add_control(
			'floating_banner_image_size',
			[
				'label' => esc_html__( "Floating Image Size", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_get_available_image_sizes(),
				'default' => 'large',
			]
		);
		$this->add_responsive_control(
			'floating_banner_image_custom_size',
			[
				'label' => esc_html__( "Image Custom Width", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				"description" => esc_html__( "Put custom width of the uploaded image in positive value. Example: 120px", 'unique-elementor-addons' ),
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner img' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);


		$this->add_control(
			'floating_banner_image_pos_options',
			[
				'label' => esc_html__( 'Position Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'floating_banner_image_orientation_options',
			[
				'label' => esc_html__( 'Orientation', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'floating_banner_image_orientation_horizontal',
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
			'floating_banner_image_orientation_offset_x',
			[
				'label' => __( 'Offset', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -600,
						'max' => 600,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner .banner-floating-image-wrapper' =>
							'{{floating_banner_image_orientation_horizontal.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'floating_banner_image_orientation_vertical',
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
			'floating_banner_image_orientation_offset_y',
			[
				'label' => __( 'Offset', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -600,
						'max' => 600,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner .banner-floating-image-wrapper' =>
							'{{floating_banner_image_orientation_vertical.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'title_typo_options',
			[
				'label' => esc_html__( 'Title Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_disply_type',
			[
				'label' => esc_html__('Display Type', 'unique-elementor-addons'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => unique_addons_disply_type_list_elementor(),
				'selectors' => [
					'{{WRAPPER}} .title' => 'display: {{UNIT}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .title',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( "Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: var(--theme-color{{VALUE}});'
				]
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label' => esc_html__( "Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'selectors' => [
					'{{WRAPPER}} .title' => 'background-color: var(--theme-color{{VALUE}});'
				]
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'subtitle_typo_options',
			[
				'label' => esc_html__( 'Subtitle Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'subtitle_disply_type',
			[
				'label' => esc_html__('Display Type', 'unique-elementor-addons'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => unique_addons_disply_type_list_elementor(),
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'display: {{UNIT}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .subtitle, {{WRAPPER}} .subtitle a',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__( "Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .subtitle, {{WRAPPER}} .subtitle a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_theme_colored',
			[
				'label' => esc_html__( "Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'selectors' => [
					'{{WRAPPER}} .subtitle, {{WRAPPER}} .subtitle a' => 'color: var(--theme-color{{VALUE}});'
				]
			]
		);
		$this->add_control(
			'subtitle_bg_color',
			[
				'label' => esc_html__( "Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'background-color: var(--theme-color{{VALUE}});'
				]
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'subtitle_padding',
			[
				'label' => esc_html__( 'Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'paragraph_typo_options',
			[
				'label' => esc_html__( 'Paragraph Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'paragraph_disply_type',
			[
				'label' => esc_html__('Display Type', 'unique-elementor-addons'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => unique_addons_disply_type_list_elementor(),
				'selectors' => [
					'{{WRAPPER}} .text-paragraph' => 'display: {{UNIT}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'paragraph_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .text-paragraph, {{WRAPPER}} .text-paragraph *',
			]
		);
		$this->add_control(
			'paragraph_color',
			[
				'label' => esc_html__( "Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .text-paragraph, {{WRAPPER}} .text-paragraph *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'paragraph_theme_colored',
			[
				'label' => esc_html__( "Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'selectors' => [
					'{{WRAPPER}} .text-paragraph, {{WRAPPER}} .text-paragraph *' => 'color: var(--theme-color{{VALUE}});'
				]
			]
		);
		$this->add_control(
			'paragraph_bg_color',
			[
				'label' => esc_html__( "Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .text-paragraph' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'paragraph_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'selectors' => [
					'{{WRAPPER}} .text-paragraph' => 'background-color: var(--theme-color{{VALUE}});'
				]
			]
		);
		$this->add_responsive_control(
			'paragraph_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .text-paragraph' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'paragraph_padding',
			[
				'label' => esc_html__( 'Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .text-paragraph' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'animation_options_style',
			[
				'label' => esc_html__('Animation', 'unique-elementor-addons'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_responsive_control(
			'hover_crystal_animation',
			[
				'label' => esc_html__( "Hover Crystal Animation Effect", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'hover-linear-crystal-animation' => esc_html__( 'Linear Crystal Animation', 'unique-elementor-addons' ),
					'hover-cross-crystal-animation' => esc_html__( 'Cross/Plus Crystal Animation', 'unique-elementor-addons' ),
				],
				'default' => 'hover-linear-crystal-animation',
			]
		);

		$this->add_control(
			'animation_bg_zoom_animation',
			[
				'label' => esc_html__( 'Enable Background Zoom Effect', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'prefix_class'	=> 'tm-bg-img-zoom-animation-'
			]
		);

		$this->add_control(
			'animation_show_circle_animation',
			[
				'label' => esc_html__( 'Show Circle Animation', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'prefix_class'	=> 'tm-circle-animation-'
			]
		);
		$this->add_control(
			'animation_show_circle_animation_bg_color',
			[
				'label'     => esc_html__('Circle Background Color', 'unique-elementor-addons'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}.tm-circle-animation-yes .tm-sc-info-banner-advanced:after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'animation_show_circle_animation' => array('yes')
				]
			]
		);
		$this->add_control(
			'animation_show_circle_animation_bg_opacity',
			[
				'label' => esc_html__( 'Circle Opacity', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}.tm-circle-animation-yes .tm-sc-info-banner-advanced:after' => 'opacity: {{SIZE}};'
				],
				'condition' => [
					'animation_show_circle_animation' => array('yes')
				]
			]
		);

		$this->add_control(
			'show_inner_border_around_wrapper',
			[
				'label' => esc_html__( 'Show Inner Border Around Wrapper', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
				'prefix_class'	=> 'tm-inner-border-around-wrapper-'
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'inner_border_around_wrapper',
				'label' => esc_html__( 'Inner Border Around Wrapper', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}}.tm-inner-border-around-wrapper-yes .tm-sc-info-banner-advanced:before',
				'condition' => [
					'show_inner_border_around_wrapper' => array('yes')
				]
			]
		);
		$this->add_responsive_control(
			'inner_border_around_wrapper_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}.tm-inner-border-around-wrapper-yes .tm-sc-info-banner-advanced:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
					'show_inner_border_around_wrapper' => array('yes')
				]
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'link_options',
			[
				'label' => esc_html__( 'Link URL', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__( "Button Link URL", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '',
				],
				'condition' => [
					'link_icon_title' => array('yes')
				]
			]
		);
		$this->add_control(
			'link_subtitle',
			[
				'label' => esc_html__( "Link to Subtitle?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'link_title',
			[
				'label' => esc_html__( "Link to Title?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'button_options',
			[
				'label' => esc_html__( 'Button', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'link_icon_title',
			[
				'label' => esc_html__( "Link Icon, Title and Button?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		unique_addons_get_viewdetails_button_arraylist($this, 1);
		unique_addons_get_viewdetails_button_arraylist($this, 2);
		unique_addons_get_button_arraylist($this, 1);
		unique_addons_get_button_arraylist($this, 13);
		unique_addons_get_button_arraylist($this, 14);
		unique_addons_get_button_arraylist($this, 15);
		$this->end_controls_section();




		$this->start_controls_section(
			'button_icon_options', [
				'label' => esc_html__( 'Button Icon', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'add_btnicon_left',
			[
				'label' => esc_html__( "Show Button Icon Left?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'button_icon_left',
			[
				'label' => esc_html__( 'Icon Left', 'unique-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'chevron-right',
						'angle-right',
						'angle-double-right',
						'caret-right',
						'caret-square-right',
					],
					'fa-regular' => [
						'caret-square-right',
					],
				],
				'label_block' => false,
				'skin' => 'inline',
			]
		);
		$this->add_control(
			'add_btnicon_right',
			[
				'label' => esc_html__( "Show Button Icon Right?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'button_icon_right',
			[
				'label' => esc_html__( 'Icon Right', 'unique-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'chevron-right',
						'angle-right',
						'angle-double-right',
						'caret-right',
						'caret-square-right',
					],
					'fa-regular' => [
						'caret-square-right',
					],
				],
				'label_block' => false,
				'skin' => 'inline',
			]
		);
		$this->add_responsive_control(
			'button_icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .btn .btn-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'btn_icon_color',
			[
				'label' => esc_html__( "Icon Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn .btn-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .btn .btn-icon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'btn_icon_color_hover',
			[
				'label' => esc_html__( "Icon Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .btn:hover .btn-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .btn:hover .btn-icon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'btn_icon_font_size',
			[
				'label' => esc_html__('Font Size', 'unique-elementor-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .btn .btn-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'button_color_typo_options', [
				'label' => esc_html__( 'Button Color/Typography', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		unique_addons_get_button_text_color_typo_arraylist($this, 1);
		$this->end_controls_section();









		$this->start_controls_section(
			'animation_wrapper_border_styling',
			[
				'label' => esc_html__( 'Border Around Wrapper', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'banner_wrapper_styling',
			[
				'label' => esc_html__( 'Banner Wrapper Style', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'banner_wrapper_height',
			[
				'label' => esc_html__( "Wrapper Height", 'unique-elementor-addons' ),
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
					'{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner' => 'height: {{SIZE}}{{UNIT}};',
				]
			]
		);

		$this->start_controls_tabs('tabs_iconbox_wrapper_style');
		$this->start_controls_tab(
			'iconbox_wrapper_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);

		$this->add_responsive_control(
			'iconbox_wrapper_padding',
			[
				'label' => esc_html__( 'Wrapper Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_margin',
			[
				'label' => esc_html__( 'Wrapper Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_min_height',
			[
				'label' => esc_html__( "Minimum Height", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner' => 'min-height: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'iconbox_wrapper_border_options',
			[
				'label' => esc_html__( 'Border Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'iconbox_wrapper_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner',
			]
		);
		$this->add_control(
			'iconbox_wrapper_border_theme_colored',
			[
				'label' => esc_html__( "Border Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-info-banner-advanced .info-banner-inner' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'iconbox_wrapper_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'iconbox_wrapper_border_options_hover',
			[
				'label' => esc_html__( 'Border Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_border_radius_hover',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-info-banner-advanced .info-banner-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'iconbox_wrapper_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}}:hover .tm-sc-info-banner-advanced .info-banner-inner',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'iconbox_wrapper_border_hover',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}}:hover .tm-sc-info-banner-advanced .info-banner-inner',
			]
		);
		$this->add_control(
			'iconbox_wrapper_border_theme_colored_hover',
			[
				'label' => esc_html__( "Border Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-info-banner-advanced .info-banner-inner' => 'border-color: var(--theme-color{{VALUE}});'
				],
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
		$classes[] = 'tm-'. $settings['layout'];
		$classes[] = 'tm-'. $settings['hover_crystal_animation'];
		$settings['classes'] = $classes;

		//link url
		$settings['target'] = ( $settings['link'] && $settings['link']['is_external'] ) ? ' target="_blank"' : '';
		$settings['url'] = ( $settings['link'] && $settings['link']['url'] ) ? $settings['link']['url'] : '';


		//button classes
		$settings['btn_classes'] = unique_addons_prepare_button_classes_from_params( $settings );

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_shortcode_shop_template_part( 'info-banner', $settings['layout'], 'info-banner/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}

