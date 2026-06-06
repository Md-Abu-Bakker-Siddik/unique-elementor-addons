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
class TM_Elementor_Iconbox extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		$direction_suffix = is_rtl() ? '.rtl' : '';
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
		return 'uae-iconbox';
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
		return esc_html__( 'Icon Box', 'unique-elementor-addons' );
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
			'title_section',
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
				'default' => esc_html__( "This is a section title", 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_heading_tag_list(),
				'default' => 'h4'
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'icon_section',
			[
				'label' => esc_html__( 'Icon', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'icon_position',
			[
				'label' => esc_html__( "Icon Position", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'icon-top' => esc_html__( 'Top', 'unique-elementor-addons' ),
					'icon-left'  => esc_html__( 'Left', 'unique-elementor-addons' ),
					'icon-left-style2'  => esc_html__( 'Left Style2', 'unique-elementor-addons' ),
					'icon-right'  => esc_html__( 'Right', 'unique-elementor-addons' ),
					'icon-right-style2'  => esc_html__( 'Right Style2', 'unique-elementor-addons' ),
				],
				'default' => 'icon-top',
			]
		);
		$this->add_control(
			'icon_type',
			[
				'label' => esc_html__( "Icon Type", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'no-icon' => esc_html__( 'No Icon', 'unique-elementor-addons' ),
					'font-icon' => esc_html__( 'Font Icon', 'unique-elementor-addons' ),
					'icon-text' => esc_html__( 'Text', 'unique-elementor-addons' ),
					'image' => esc_html__( 'JPG/PNG Image', 'unique-elementor-addons' ),
				],
				'default' => 'font-icon'
			]
		);

		//icon type text
		$this->add_control(
			'text_icon_text',
			[
				'label' => esc_html__( "Icon Text", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "01", 'unique-elementor-addons' ),
				'condition' => [
					'icon_type' => array('icon-text')
				]
			]
		);
		$this->add_control(
			'text_icon_tag',
			[
				'label' => esc_html__( "Text Tag", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_heading_tag_list(),
				'default' => 'span',
				'condition' => [
					'icon_type' => array('icon-text')
				]
			]
		);


		//image
		$this->add_control(
			'image_icon',
			[
				'label' => esc_html__( "Upload Image Icon", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$this->add_control(
			'image_icon_predefined_image_size',
			[
				'label' => esc_html__( "Choose Predefined Image Size", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_get_available_image_sizes(),
				'default' => 'full',
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$this->add_control(
			'image_icon_custom_size',
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
					'{{WRAPPER}} .icon-type-image img' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$this->add_responsive_control(
			'image_icon_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon-type-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);




		//font icon
		$this->add_control(
			'icon',
			[
				'label' => __('Icon', 'unique-elementor-addons'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-chart-bar',
					'library' => 'font-awesome',
				],
				'condition' => [
					'icon_type' => array('font-icon')
				]
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'content_options',
			[
				'label' => esc_html__( 'Paragraph', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
				"description" => esc_html__( "It will be displayed above/under title", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( "Write a short description, that will describe something useful.", 'unique-elementor-addons' ),
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->end_controls_section();









		$this->start_controls_section(
			'link_options',
			[
				'label' => esc_html__( 'Link URL', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'link_icon_title',
			[
				'label' => esc_html__( "Add Link?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__( "Link URL", 'unique-elementor-addons' ),
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
			'link_title',
			[
				'label' => esc_html__( "Also Link to Title?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'link_icon_title' => array('yes')
				]
			]
		);
		$this->end_controls_section();















		$this->start_controls_section(
			'tm_general',
			[
				'label' => esc_html__( 'General Settings', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'unique-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => unique_addons_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} .tm-sc-icon-box' => 'text-align: {{VALUE}};'
				],
				'default' => 'center',
			]
		);
		$this->add_control(
			'iconbox_style',
			[
				'label' => esc_html__( "Icon Box Style", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'icon-default'  =>  esc_html__( 'Default', 'unique-elementor-addons' ),
					'iconbox-current-theme-style1'  =>  esc_html__( 'Current Theme Style 1', 'unique-elementor-addons' ),
				],
			]
		);
		$this->add_control(
			'iconbox_wrapper_responsive_options',
			[
				'label' => esc_html__( 'Responsive Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'everything_centered_in_responsive_tablet',
			[
				'label' => esc_html__( "Make everything centered in Tablet?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'everything_centered_in_responsive_mobile',
			[
				'label' => esc_html__( "Make everything centered in Mobile?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);





		$this->add_control(
			'iconbox_wrapper_other_options',
			[
				'label' => esc_html__( 'Other Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'iconbox_wrapper_overflow_hidden',
			[
				'label' => esc_html__( "Wrapper Overflow Hidden", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-icon-box' => 'overflow: hidden;'
				]
			]
		);
		$this->add_control(
			'switch_title_content_pos',
			[
				'label' => esc_html__( "Switch Title & Content Position", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->end_controls_section();




		//text Icon
		$this->start_controls_section(
			'text_icon_options',
			[
				'label' => esc_html__( 'Text Icon Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon_type' => array('icon-text')
				]
			]
		);
		$this->add_control(
			'text_icon_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon .icon-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_icon_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .icon .icon-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_icon_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon .icon-text' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'text_icon_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .icon .icon-text' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_icon_typography',
				'label' => esc_html__( 'Text Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .icon .icon-text',
			]
		);
		$this->add_responsive_control(
			'text_icon_margin',
			[
				'label' => esc_html__( 'Text Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon .icon-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();





















		$this->start_controls_section(
			'icon_basic_styling',
			[
				'label' => esc_html__( 'Icon Basic Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( "Predefined Icon/Image Size", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'icon-size-default' => esc_html__( 'Default', 'unique-elementor-addons' ),
					'icon-xs' => esc_html__( 'Extra Small', 'unique-elementor-addons' ),
					'icon-sm' => esc_html__( 'Small', 'unique-elementor-addons' ),
					'icon-md' => esc_html__( 'Medium', 'unique-elementor-addons' ),
					'icon-lg' => esc_html__( 'Large', 'unique-elementor-addons' ),
					'icon-xl' => esc_html__( 'Extra Large', 'unique-elementor-addons' )
				],
				'default' => 'icon-md',
			]
		);
		$this->add_control(
			'icon_border_style',
			[
				'label' => esc_html__( "Make Icon/Image Area Bordered?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'icon_vertical_flex_options',
			[
				'label' => esc_html__( 'Vertical/Horizontal Placement (Flex) Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'icon_position' => array('icon-left', 'icon-right')
				]
			]
		);
		$this->add_responsive_control(
			'icon_wrapper_flex_alignment',
			[
				'label' => esc_html__( "Icon Wrapper Horizontal Alignment(Flex)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_disply_flex_horizontal_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper' => 'display:flex; justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_flex_horizontal_alignment',
			[
				'label' => esc_html__( "Icon Inner Horizontal Alignment(Flex)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_disply_flex_horizontal_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon' => 'display:flex; justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_flex_vertical_alignment',
			[
				'label' => esc_html__( "Icon Inner Vertical Alignment(Flex)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_disply_flex_vertical_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon' => 'display:flex; align-items: {{VALUE}};',
					'{{WRAPPER}} .icon i' => 'line-height: 1;',
					'{{WRAPPER}} .icon svg' => 'line-height: 1;',
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
					'translate'  => esc_html__( 'Translate', 'unique-elementor-addons' ),
					'translate-x'  => esc_html__( 'Translate X', 'unique-elementor-addons' ),
					'translate-y'  => esc_html__( 'Translate Y', 'unique-elementor-addons' ),
					'scale'  => esc_html__( 'Scale', 'unique-elementor-addons' ),
				],
				'default' => 'rotate-y',
			]
		);
		$this->add_control(
			'animate_icon_infinity',
			[
				'label' => esc_html__( "Animate Infinity", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_get_animation_type(),
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'icon_custom_styling',
			[
				'label' => esc_html__( 'Icon Custom Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_style',
			[
				'label' => esc_html__( "Icon Border Style", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'icon-default'  =>  esc_html__( 'Default', 'unique-elementor-addons' ),
					'icon-rounded'  =>  esc_html__( 'Rounded', 'unique-elementor-addons' ),
					'icon-round'  =>  esc_html__( 'Round', 'unique-elementor-addons' ),
				],
				'default' => 'icon-round',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .icon i, {{WRAPPER}} .icon svg',
			]
		);
		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Icon Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'hr1-pos',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->start_controls_tabs('tabs_icon_wrapper_style');
		$this->start_controls_tab(
			'icon_wrapper_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'icon_area_color_options',
			[
				'label' => esc_html__( 'Icon Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_theme_colored',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon i' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .icon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'icon_custom_color',
			[
				'label' => esc_html__( "Icon Custom Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_type' => array('font-icon')
				],
				'selectors' => [
					'{{WRAPPER}} .icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_area_bg_options',
			[
				'label' => esc_html__( 'Background Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_area_bg_theme_colored',
			[
				'label' => esc_html__( "Icon BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_area_custom_bg_color',
			[
				'label' => esc_html__( "Icon BG Custom Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'icon_wrapper_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'icon_theme_colored_hover',
			[
				'label' => esc_html__( "Make Icon Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .icon i' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover .icon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'icon_custom_color_hover',
			[
				'label' => esc_html__( "Icon Custom Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'icon_type' => array('font-icon')
				],
				'selectors' => [
					'{{WRAPPER}}:hover .icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .icon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_area_bg_options_hover',
			[
				'label' => esc_html__( 'Background Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_area_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Icon BG Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .icon' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_area_custom_bg_color_hover',
			[
				'label' => esc_html__( "Icon BG Custom Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->add_control(
			'icon_area_dimension_options',
			[
				'label' => esc_html__( 'Dimension Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
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
					'{{WRAPPER}} .icon' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'icon_area_width_auto',
			[
				'label' => esc_html__( "Make Icon Width to Auto?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .icon' => 'width: auto;',
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
					'{{WRAPPER}} .icon' => 'height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'icon_area_height_auto',
			[
				'label' => esc_html__( "Make Icon Height to Auto?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .icon' => 'height: auto;',
				]
			]
		);
		$this->add_responsive_control(
			'icon-line-height',
			[
				'label' => esc_html__( "Icon Line Height", 'unique-elementor-addons' ),
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
					'{{WRAPPER}} .icon' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon i' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .icon svg' => 'line-height: {{SIZE}}{{UNIT}};',
				]
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
				'selector' => '{{WRAPPER}} .icon',
			]
		);
		$this->add_responsive_control(
			'icon_area_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_area_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .icon',
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'icon_bg_img_styling',
			[
				'label' => esc_html__( 'Icon BG Image Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'show_icon_bg_img', [
				'label' => esc_html__( "Show Icon BG Image", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->add_control(
			'icon_bg_img_bg_img_dimension_options',
			[
				'label' => esc_html__( 'Dimension', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_bg_img_width',
			[
				'label' => esc_html__( "Image Width", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'icon_bg_img_height',
			[
				'label' => esc_html__( "Image Height", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'icon_bg_img_bg_color_options',
			[
				'label' => esc_html__( 'Background Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_bg_img_custom_bg_color',
			[
				'label' => esc_html__( "Wrapper Custom Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'icon_bg_img_custom_bg_color_hover',
			[
				'label' => esc_html__( "Wrapper Custom Background Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .icon-wrapper .icon-bg-img' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'icon_bg_img_theme_colored',
			[
				'label' => esc_html__( "BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_bg_img_theme_colored_hover',
			[
				'label' => esc_html__( "BG Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .icon-wrapper .icon-bg-img' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_bg_img_bg_img_options',
			[
				'label' => esc_html__( 'Image Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_bg_img',
			[
				'label' => esc_html__( "Icon BG Image", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$this->add_control(
			'icon_bg_img_opacity_options',
			[
				'label' => esc_html__( 'Opacity Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_bg_img_opacity',
			[
				'label' => esc_html__( 'Opacity', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->add_control(
			'icon_bg_img_opacity_hover',
			[
				'label' => esc_html__( 'Opacity (Hover)', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .icon-wrapper .icon-bg-img' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->add_control(
			'icon_bg_img_border_options',
			[
				'label' => esc_html__( 'Border Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'icon_bg_img_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_bg_img_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .icon-wrapper .icon-bg-img',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_bg_img_border',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .icon-wrapper .icon-bg-img',
			]
		);
		$this->add_control(
			'icon_bg_img_z_index',
			[
				'label' => esc_html__( "Z Index", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' => 'z-index: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'icon_bg_img_pos_options',
			[
				'label' => esc_html__( 'Position Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_bg_img_orientation_options',
			[
				'label' => esc_html__( 'Orientation', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_bg_img_orientation_horizontal',
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
			'icon_bg_img_orientation_offset_x',
			[
				'label' => __( 'Offset', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' =>
							'{{icon_bg_img_orientation_horizontal.VALUE}}: {{SIZE}}%;',
				],
			]
		);
		$this->add_responsive_control(
			'icon_bg_img_orientation_vertical',
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
			'icon_bg_img_orientation_offset_y',
			[
				'label' => __( 'Offset', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .icon-wrapper .icon-bg-img' =>
							'{{icon_bg_img_orientation_vertical.VALUE}}: {{SIZE}}%;',
				],
			]
		);



		$this->add_control(
			'icon_bg_img_pos_hover_options',
			[
				'label' => esc_html__( 'Position(Hover) Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'icon_bg_img_orientation_horizontal_hover',
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
			'icon_bg_img_orientation_offset_x_hover',
			[
				'label' => __( 'Offset', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => '0',
				],
				'selectors' => [
					'{{WRAPPER}}:hover .icon-wrapper .icon-bg-img' =>
							'{{icon_bg_img_orientation_horizontal_hover.VALUE}}: {{SIZE}}%;',
				],
			]
		);
		$this->add_responsive_control(
			'icon_bg_img_orientation_vertical_hover',
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
			'icon_bg_img_orientation_offset_y_hover',
			[
				'label' => __( 'Offset', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'default' => [
					'unit' => '%',
					'size' => '0',
				],
				'selectors' => [
					'{{WRAPPER}}:hover .icon-wrapper .icon-bg-img' =>
							'{{icon_bg_img_orientation_vertical_hover.VALUE}}: {{SIZE}}%;',
				],
			]
		);
		$this->end_controls_section();







		$this->start_controls_section(
			'title_section_styling',
			[
				'label' => esc_html__( 'Title Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .icon-box-title, {{WRAPPER}} .icon-box-title a',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon-box-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .icon-box-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_margin_top',
			[
				'label' => esc_html__( "Margin Top", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .icon-box-title' => 'margin-top: {{VALUE}};',
					'{{WRAPPER}} .icon-box-title a' => 'margin-top: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_margin_bottom',
			[
				'label' => esc_html__( "Margin Bottom", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .icon-box-title' => 'margin-bottom: {{VALUE}};',
					'{{WRAPPER}} .icon-box-title a' => 'margin-bottom: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_color_options',
			[
				'label' => esc_html__( 'Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Make Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon-box-title' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .icon-box-title a' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Make Text Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .icon-box-title' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover .icon-box-title a' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-box-title a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .icon-box-title' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .icon-box-title a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_section();








		$this->start_controls_section(
			'content_styling',
			[
				'label' => esc_html__( 'Paragraph Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( "Paragraph Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .content' => 'color: {{VALUE}};',
					'{{WRAPPER}} .content *' => 'color: {{VALUE}};'
				],
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->add_control(
			'content_color_hover',
			[
				'label' => esc_html__( "Paragraph Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .content' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .content *' => 'color: {{VALUE}};'
				],
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .content, {{WRAPPER}} .content *',
				'condition' => [
					'show_paragraph' => array('yes')
				]
			]
		);
		$this->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Paragraph Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();











		$this->start_controls_section(
			'box_styling',
			[
				'label' => esc_html__( 'Icon Box Wrapper Style', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__( "Custom CSS class", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
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
					'{{WRAPPER}} .tm-sc-icon-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .tm-sc-icon-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'iconbox_wrapper_vertical_align',
			[
				'label' => esc_html__( "Content Display Flex + Vertical Center?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-icon-box' => 'display: flex; align-items: center;',
				]
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_min_height',
			[
				'label' => esc_html__( "Minimum Height", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-icon-box' => 'min-height: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'iconbox_wrapper_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'iconbox_wrapper_background',
				'label' => esc_html__( 'Background', 'unique-elementor-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tm-sc-icon-box',
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-icon-box' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_theme_colored',
			[
				'label' => esc_html__( "BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-icon-box' => 'background-color: var(--theme-color{{VALUE}});'
				],
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
					'{{WRAPPER}} .tm-sc-icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'iconbox_wrapper_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-icon-box',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-sc-icon-box',
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
					'{{WRAPPER}} .tm-sc-icon-box' => 'border-color: var(--theme-color{{VALUE}});'
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
			'iconbox_wrapper_color_options_hover',
			[
				'label' => esc_html__( 'BG Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'iconbox_wrapper_bg_color_hover',
				'label' => esc_html__( 'Background', 'unique-elementor-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}}:hover .tm-sc-icon-box',
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-icon-box' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'iconbox_wrapper_theme_colored_hover',
			[
				'label' => esc_html__( "BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-icon-box' => 'background-color: var(--theme-color{{VALUE}});'
				],
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
					'{{WRAPPER}}:hover .tm-sc-icon-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'iconbox_wrapper_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}}:hover .tm-sc-icon-box',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'iconbox_wrapper_border_hover',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}}:hover .tm-sc-icon-box',
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
					'{{WRAPPER}}:hover .tm-sc-icon-box' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();








		$this->start_controls_section(
			'bg_shadow_icon_options',
			[
				'label' => esc_html__( 'Background Shadow Icon Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'show_bg_shadow_icon',
			[
				'label' => esc_html__( "Show Background Shadow Icon?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'bg_shadow_icon_color',
			[
				'label' => esc_html__( "Icon Custom Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}} .bg-shadow-icon' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'bg_shadow_icon_color_hover',
			[
				'label' => esc_html__( "Icon Custom Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}}:hover .bg-shadow-icon' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'bg_shadow_icon_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .bg-shadow-icon',
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
			]
		);
		$this->add_control(
			'bg_shadow_icon_rotate',
			[
				'label' => esc_html__( 'Rotate Icon', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -360,
						'max' => 360,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bg-shadow-icon' => 'transform: rotate({{SIZE}}deg);',
					'{{WRAPPER}} .bg-shadow-icon' => '-ms-transform: rotate({{SIZE}}deg);',
					'{{WRAPPER}} .bg-shadow-icon' => '-webkit-transform: rotate({{SIZE}}deg);',
				],
			]
		);
		$this->add_control(
			'bg_shadow_icon_rotate_hover',
			[
				'label' => esc_html__( 'Rotate Icon (Hover)', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => -360,
						'max' => 360,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .bg-shadow-icon' => 'transform: rotate({{SIZE}}deg);',
					'{{WRAPPER}}:hover .bg-shadow-icon' => '-ms-transform: rotate({{SIZE}}deg);',
					'{{WRAPPER}}:hover .bg-shadow-icon' => '-webkit-transform: rotate({{SIZE}}deg);',
				],
			]
		);
		$this->add_control(
			'hr01-pos',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
			]
		);



		$this->add_control(
			'bg_shadow_icon_orientation_options',
			[
				'label' => esc_html__( 'Position Orientation', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs('bg_shadow_icon_orientation_tabs');
		$this->start_controls_tab(
			'bg_shadow_icon_orientation_tab_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_orientation_horizontal',
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
			'bg_shadow_icon_orientation_offset_x',
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
					'{{WRAPPER}} .bg-shadow-icon' =>
							'{{bg_shadow_icon_orientation_horizontal.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_orientation_vertical',
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
			'bg_shadow_icon_orientation_offset_y',
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
					'{{WRAPPER}} .bg-shadow-icon' =>
							'{{bg_shadow_icon_orientation_vertical.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'bg_shadow_icon_orientation_tab_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_orientation_horizontal_hover',
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
			'bg_shadow_icon_orientation_offset_x_hover',
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
					'{{WRAPPER}}:hover .bg-shadow-icon' =>
							'{{bg_shadow_icon_orientation_horizontal_hover.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_orientation_vertical_hover',
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
			'bg_shadow_icon_orientation_offset_y_hover',
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
					'{{WRAPPER}}:hover .bg-shadow-icon' =>
							'{{bg_shadow_icon_orientation_vertical_hover.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'bg_shadow_icon_orientation_tab_oldformat',
			[
				'label' => esc_html__('Old Format', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'bg_shadow_icon_pos_options',
			[
				'label' => esc_html__( 'Position Options (Old Format)', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_pos_top',
			[
				'label' => esc_html__( "Top", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}} .bg-shadow-icon' => 'top: {{VALUE}};bottom:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_pos_right',
			[
				'label' => esc_html__( "Right", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}} .bg-shadow-icon' => 'right: {{VALUE}};left:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_pos_bottom',
			[
				'label' => esc_html__( "Bottom", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}} .bg-shadow-icon' => 'bottom: {{VALUE}};top:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_pos_left',
			[
				'label' => esc_html__( "Left", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}} .bg-shadow-icon' => 'left: {{VALUE}};right:auto;'
				]
			]
		);


		$this->add_control(
			'hr1-pos-hover',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
			]
		);
		$this->add_control(
			'bg_shadow_icon_pos_hover_options',
			[
				'label' => esc_html__( 'Position(Hover) Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_pos_top_hover',
			[
				'label' => esc_html__( "Top (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}}:hover .bg-shadow-icon' => 'top: {{VALUE}};bottom:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_pos_right_hover',
			[
				'label' => esc_html__( "Right (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}}:hover .bg-shadow-icon' => 'right: {{VALUE}};left:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_pos_bottom_hover',
			[
				'label' => esc_html__( "Bottom (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}}:hover .bg-shadow-icon' => 'bottom: {{VALUE}};top:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'bg_shadow_icon_pos_left_hover',
			[
				'label' => esc_html__( "Left (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'show_bg_shadow_icon' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}}:hover .bg-shadow-icon' => 'left: {{VALUE}};right:auto;'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();







		$this->start_controls_section(
			'bg_img_options',
			[
				'label' => esc_html__( 'Background Image Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'add_bg_img_on_hover',
			[
				'label' => esc_html__( "Add BG Image on Hover?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'make_bg_img_always_visible',
			[
				'label' => esc_html__( "Make BG Image Always Visible?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'condition' => [
					'add_bg_img_on_hover' => array('yes')
				]
			]
		);
		$this->add_control(
			'bg_img_on_hover',
			[
				'label' => esc_html__( "Background Image", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'add_bg_img_on_hover' => array('yes')
				]
			]
		);
		$this->add_control(
			'bg_img_overlay_color',
			[
				'label' => esc_html__( "BG Image Overlay Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon-box.iconbox-bg-img-on-hover .bg-img-wrapper:after' => 'background-color: {{VALUE}};'
				],
				'condition' => [
					'add_bg_img_on_hover' => array('yes')
				]
			]
		);
		$this->add_control(
			'bg_img_overlay_color_hover',
			[
				'label' => esc_html__( "BG Image Overlay Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .icon-box.iconbox-bg-img-on-hover .bg-img-wrapper:after' => 'background-color: {{VALUE}};'
				],
				'condition' => [
					'add_bg_img_on_hover' => array('yes')
				]
			]
		);
		$this->add_control(
			'bg_img_overlay_theme_color',
			[
				'label' => esc_html__( "BG Image Overlay Theme Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'selectors' => [
					'{{WRAPPER}} .icon-box.iconbox-bg-img-on-hover .bg-img-wrapper:after' => 'background-color: var(--theme-color{{VALUE}});'
				],
				'condition' => [
					'add_bg_img_on_hover' => array('yes')
				]
			]
		);
		$this->add_control(
			'bg_img_overlay_theme_color_hover',
			[
				'label' => esc_html__( "BG Image Overlay Theme Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'selectors' => [
					'{{WRAPPER}}:hover .icon-box.iconbox-bg-img-on-hover .bg-img-wrapper:after' => 'background-color: var(--theme-color{{VALUE}});'
				],
				'condition' => [
					'add_bg_img_on_hover' => array('yes')
				]
			]
		);
		$this->add_control(
			'bg_img_overlay_theme_color_opacity',
			[
				'label' => esc_html__( 'BG Image Overlay Opacity', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon-box.iconbox-bg-img-on-hover .bg-img-wrapper:after' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->add_control(
			'bg_img_overlay_theme_color_opacity_hover',
			[
				'label' => esc_html__( 'BG Image Overlay Opacity (Hover)', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}}:hover .icon-box.iconbox-bg-img-on-hover .bg-img-wrapper:after' => 'opacity: {{SIZE}};'
				]
			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'button_options',
			[
				'label' => esc_html__( 'Button Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		unique_addons_get_viewdetails_button_arraylist($this, 1);
		unique_addons_get_viewdetails_button_arraylist($this, 2);
		unique_addons_get_button_arraylist($this, 1);
		$this->end_controls_section();



		$this->start_controls_section(
			'button_color_typo_options', [
				'label' => esc_html__( 'Button Color/Typography', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		unique_addons_get_button_text_color_typo_arraylist($this, 1);
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


		//link url
		$settings['target'] = ( $settings['link'] && $settings['link']['is_external'] ) ? ' target="_blank"' : '';
		$settings['url'] = ( $settings['link'] && $settings['link']['url'] ) ? $settings['link']['url'] : '';



		//classes
		$classes = array();

		if( $settings['icon_type'] ) {
			$classes[] = $settings['icon_type'];
		}
		if( $settings['iconbox_style'] ) {
			$classes[] = $settings['iconbox_style'];
		}
		if( $settings['add_bg_img_on_hover'] === 'yes' ) {
			$classes[] = 'iconbox-bg-img-on-hover' ;

			if( $settings['make_bg_img_always_visible'] === 'yes' ) {
			$classes[] = 'bg-img-hover-always-visible' ;
			}
		}
		if( $settings['everything_centered_in_responsive_tablet'] === 'yes' ) {
			$classes[] = 'responsive-tablet';
		}
		if( $settings['everything_centered_in_responsive_mobile'] === 'yes' ) {
			$classes[] = 'responsive-mobile';
		}
		if( $settings['icon_position'] ) {
			$classes[] = $settings['icon_position'];
		}
		if( $settings['animate_icon_on_hover'] ) {
			$classes[] = 'animate-hover icon-'.$settings['animate_icon_on_hover'];
		}
		if( $settings['custom_css_class'] ) {
			$classes[] = $settings['custom_css_class'];
		}
		$settings['classes'] = $classes;


		//icon classes
		$icon_classes = array();
		if( $settings['icon_style'] ) {
			$icon_classes[] = $settings['icon_style'];
		}
		if( $settings['icon_type'] ) {
			$icon_classes[] = 'icon-type-'.$settings['icon_type'];
		}
		if( $settings['icon_size'] ) {
			$icon_classes[] = $settings['icon_size'];
		}
		if( $settings['icon_border_style'] === 'yes' ) {
			$icon_classes[] = 'icon-bordered';
		}
		if( $settings['animate_icon_infinity'] ) {
			$icon_classes[] = $settings['animate_icon_infinity'];
		}

		//icon classes

		$settings['icon_classes'] = $icon_classes;

		//button classes
		$settings['btn_classes'] = unique_addons_prepare_button_classes_from_params( $settings );

		//title classes
		$title_classes = array();
		$settings['title_classes'] = $title_classes;



		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_widgetcore_template_part( 'icon-box-' . $settings['icon_position'], null, 'icon-box/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}