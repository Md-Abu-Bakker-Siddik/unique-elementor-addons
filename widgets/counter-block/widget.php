<?php
namespace UniqueAddons\Widgets\CounterBlock;

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

class TM_Elementor_CounterBlock extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		if( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$direction_suffix = is_rtl() ? '.rtl' : '';
			wp_enqueue_style( 'tm-counter-block-loader', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/counter-block/counter-block-loader' . $direction_suffix . '.css' );
		}
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
		return 'uae-counter-block';
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
		return esc_html__( 'Funfact Counter - Unique Addons', 'unique-elementor-addons' );
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
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Style1( $this ) );
		$this->add_skin( new Skins\Skin_Style2( $this ) );
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
				'label' => esc_html__( 'General Settings', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
            'wow_appear_animation',
            [
                'label' => esc_html__( "Wow Appear Animation", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_animate_css_animation_list(),
            ]
        );
		$this->add_control(
			'wow_animation_delay',
			[
				'label' => esc_html__( 'Animation Delay', 'unique-elementor-addons' ) . ' (ms)',
				'type' => Controls_Manager::NUMBER,
				'default' => '',
				'min' => 0,
				'step' => 100,
				'condition' => [
					'wow_appear_animation!' => '',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'counter_position',
			[
				'label' => esc_html__( "Counter Positioning", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Icon - Title - Counter', 'unique-elementor-addons' ),
					'icon_counter_title' => esc_html__( 'Icon - Counter - Title', 'unique-elementor-addons' ),
				],
				'default' => 'icon_counter_title'
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
					'{{WRAPPER}} .uae-counter' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .uae-counter .details' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .counter-block-two .inner' => 'text-align: {{VALUE}};',
				]
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
		$this->end_controls_section();










		$this->start_controls_section(
			'counter_options',
			[
				'label' => esc_html__( 'Counter Value', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'counter_range',
			[
				'label' => esc_html__( "Counting Value/Number", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description'	=> esc_html__( 'Enter number for counter without any special character. Default: 1250', 'unique-elementor-addons' ),
				'default' => esc_html__( "1250", 'unique-elementor-addons' )
			]
		);
		$this->add_control(
			'counter_prefix',
			[
				'label' => esc_html__( "Counting Value Prefix", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Add an Unit Symbol to the Right of Percent Value", 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'counter_postfix',
			[
				'label' => esc_html__( "Counting Value Postfix", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'counter_duration',
			[
				'label' => esc_html__( "Counter Duration(ms)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description'	=> esc_html__( 'Default: 1500', 'unique-elementor-addons' ),
				'default' => '1500'
			]
		);
		$this->add_control(
			'counter_tag',
			[
				'label'   => esc_html__( 'Counter Tag', 'unique-elementor-addons' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'no',
				'options' => unique_addons_heading_tag_list(),
				'default' => 'h2'
			]
		);
		$this->end_controls_section();



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
			'subtitle_section',
			[
				'label' => esc_html__( 'Sub Title', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'subtitle_show',
			[
				'label' => esc_html__( 'Show/Hide Sub Title', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'unique-elementor-addons' ),
				'label_off' => __( 'Show', 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__( "Sub Title", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "Subtitle Here", 'unique-elementor-addons' ),
				'condition' => [
					'subtitle_show' => array('yes')
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
					'subtitle_show' => array('yes')
				]
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
			'icon_custom_css_class',
			[
				'label' => esc_html__( "Icon Custom CSS Class", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
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
					'image' => esc_html__( 'JPG/PNG Image', 'unique-elementor-addons' ),
				],
				'default' => 'no-icon'
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
				'label' => esc_html__( "Image Custom Width (Only number)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Put custom width of the uploaded image in positive integer value. Example: 120", 'unique-elementor-addons' ),
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
		$this->add_control(
			'icon_bg_img',
			[
				'label' => esc_html__( "Icon BG Image", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				"description" => esc_html__( "Upload Icon Bg image", 'unique-elementor-addons' ),
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
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'icon_text_alignment',
			[
				'label' => esc_html__( "Text Alignment", 'unique-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => unique_addons_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}} .counter-icon' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'icon_flex_horizontal_alignment',
			[
				'label' => esc_html__( "Icon Horizontal Alignment(Flex)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_disply_flex_horizontal_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .counter-icon' => 'display:inline-flex; justify-content: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_flex_vertical_alignment',
			[
				'label' => esc_html__( "Icon Vertical Alignment(Flex)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_disply_flex_vertical_align_elementor(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .counter-icon' => 'display:inline-flex; align-items: {{VALUE}};',
					'{{WRAPPER}} .icon i' => 'line-height: 1;',
				],
			]
		);

		$this->add_control(
			'icon_area_dimension_options',
			[
				'label' => esc_html__( 'Dimension Options', 'unique-elementor-addons' ),
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
					'{{WRAPPER}} .counter-icon' => 'width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'icon_area_width_auto',
			[
				'label' => esc_html__( "Make Icon Width to Auto?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .counter-icon' => 'width: auto;',
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
					'{{WRAPPER}} .counter-icon' => 'height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'icon_area_height_auto',
			[
				'label' => esc_html__( "Make Icon Height to Auto?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .counter-icon' => 'height: auto;',
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
					'{{WRAPPER}} .counter-icon' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .counter-icon i' => 'line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .counter-icon svg' => 'line-height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .counter-icon i, {{WRAPPER}} .counter-icon svg',
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
				'selector' => '{{WRAPPER}} .counter-icon',
			]
		);
		$this->add_responsive_control(
			'icon_area_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .counter-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_area_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .counter-icon',
			]
		);

		$this->add_control(
			'hr01-pos',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .counter-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .counter-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs('tabs_counter_icon_styling');
		$this->start_controls_tab(
			'tabs_counter_icon_styling_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'icon_color_options',
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
					'{{WRAPPER}} .counter-icon i' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .counter-icon svg' => 'fill: var(--theme-color{{VALUE}});',
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
					'{{WRAPPER}} .counter-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .counter-icon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'hr1-funfact',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'icon_bgcolor_options',
			[
				'label' => esc_html__( 'Icon Background Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_area_bg_theme_colored',
			[
				'label' => esc_html__( "Icon/Image Area BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .counter-icon, {{WRAPPER}} .counter-icon:after, {{WRAPPER}} .counter-icon i' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_area_custom_bg_color',
			[
				'label' => esc_html__( "Icon/Image Area Custom BG Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter-icon, {{WRAPPER}} .counter-icon:after, {{WRAPPER}} .counter-icon i' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_counter_icon_styling_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);

		$this->add_control(
			'icon_color_options_hover',
			[
				'label' => esc_html__( 'Icon Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
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
					'{{WRAPPER}}:hover .counter-icon i' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover .counter-icon svg' => 'fill: var(--theme-color{{VALUE}});',
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
					'{{WRAPPER}}:hover .counter-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .counter-icon svg' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'hr1-funfact_hover',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'icon_bgcolor_options_hover',
			[
				'label' => esc_html__( 'Icon Background Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_area_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Icon/Image Area BG Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .counter-block:hover .counter-icon, {{WRAPPER}} .counter-block:hover .counter-icon:after, {{WRAPPER}} .counter-block:hover .counter-icon i' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_area_custom_bg_color_hover',
			[
				'label' => esc_html__( "Icon/Image Area Custom BG Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter-block:hover .counter-icon, {{WRAPPER}} .counter-block:hover .counter-icon:after, {{WRAPPER}} .counter-block:hover .counter-icon i' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


















		$this->start_controls_section(
			'counter_options_styling',
			[
				'label' => esc_html__( 'Counter Value Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'counter_custom_css_class',
			[
				'label' => esc_html__( "Counter Custom CSS Class", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->start_controls_tabs('tabs_counter_styling');
		$this->start_controls_tab(
			'tabs_counter_styling_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'counter_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'counter_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .counter' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'counter_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .counter',
			]
		);
		$this->add_responsive_control(
			'counter_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'counter_padding',
			[
				'label' => esc_html__( 'Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_counter_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'counter_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .counter' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'counter_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .counter' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_counter_styling_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'counter_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .counter:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'counter_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .counter:hover' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();










		$this->start_controls_section(
			'title_options_styling',
			[
				'label' => esc_html__( 'Title Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_custom_css_class',
			[
				'label' => esc_html__( "Title Custom CSS Class", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
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
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: var(--theme-color{{VALUE}});'
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
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_title_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'title_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_title_styling_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title:hover' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();









		$this->start_controls_section(
			'subtitle_options_styling',
			[
				'label' => esc_html__( 'Subtitle Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'subtitle_custom_css_class',
			[
				'label' => esc_html__( "Subtitle Custom CSS Class", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->start_controls_tabs('tabs_subtitle_styling');
		$this->start_controls_tab(
			'tabs_subtitle_styling_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'subtitle_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .subtitle',
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
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_subtitle_styling_wrapper_hover',
			[
				'label' => esc_html__('Wrapper Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'subtitle_text_color_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_theme_colored_item_wrapper_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_subtitle_styling_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'subtitle_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .subtitle:hover' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'subtitle_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .subtitle:hover' => 'color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();











		$this->start_controls_section(
			'funfact_wrapper_styling',
			[
				'label' => esc_html__( 'Counter Wrapper Style', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('tabs_funfact_wrapper_style');
		$this->start_controls_tab(
			'funfact_wrapper_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);

		$this->add_responsive_control(
			'funfact_wrapper_padding',
			[
				'label' => esc_html__( 'Wrapper Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .uae-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'funfact_wrapper_margin',
			[
				'label' => esc_html__( 'Wrapper Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .uae-counter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'funfact_wrapper_vertical_align',
			[
				'label' => esc_html__( "Content Display Flex + Vertical Center?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .uae-counter' => 'display: flex; align-items: center;',
				]
			]
		);
		$this->add_responsive_control(
			'funfact_wrapper_min_height',
			[
				'label' => esc_html__( "Minimum Height", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'selectors' => [
					'{{WRAPPER}} .uae-counter' => 'min-height: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'funfact_wrapper_color_options',
			[
				'label' => esc_html__( 'BG Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'funfact_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .uae-counter' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'funfact_wrapper_theme_colored',
			[
				'label' => esc_html__( "BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .uae-counter' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'funfact_wrapper_border_options',
			[
				'label' => esc_html__( 'Border Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'funfact_wrapper_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .uae-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'funfact_wrapper_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .uae-counter',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .uae-counter',
			]
		);
		$this->add_control(
			'funfact_wrapper_border_theme_colored',
			[
				'label' => esc_html__( "Border Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .uae-counter' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'funfact_wrapper_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'funfact_wrapper_color_options_hover',
			[
				'label' => esc_html__( 'BG Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'funfact_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .uae-counter' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'funfact_wrapper_theme_colored_hover',
			[
				'label' => esc_html__( "BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .uae-counter' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'funfact_wrapper_border_options_hover',
			[
				'label' => esc_html__( 'Border Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'funfact_wrapper_border_radius_hover',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}:hover .uae-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'funfact_wrapper_boxshadow_hover',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}}:hover .uae-counter',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'funfact_wrapper_border_hover',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}}:hover .uae-counter',
			]
		);
		$this->add_control(
			'funfact_wrapper_border_theme_colored_hover',
			[
				'label' => esc_html__( "Border Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .uae-counter' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();









		$this->start_controls_section(
			'other_options',
			[
				'label' => esc_html__( 'Other Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_icon_image',
			[
				'label' => esc_html__( "Show Icon/Image", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'show_counter',
			[
				'label' => esc_html__( "Show Counter", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);
		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( "Show Title", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes'
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

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-counter-block-style1', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/counter-block/counter-block-style1' . $direction_suffix . '.css' );


		//classes
		$classes = array();
		if( $settings['animate_icon_on_hover'] ) {
			$classes[] = 'tm-animate-hover animate-icon-'.$settings['animate_icon_on_hover'];
		}
		if( $settings['everything_centered_in_responsive_tablet'] === 'yes' ) {
			$classes[] = 'counter-centered-in-responsive-tablet';
		}
		if( $settings['everything_centered_in_responsive_mobile'] === 'yes' ) {
			$classes[] = 'counter-centered-in-responsive-mobile';
		}
		$settings['classes'] = $classes;


		$settings['animation_duration'] = unique_addons_get_inline_attributes( $settings['counter_duration'], 'data-animation-duration' );


		//counter classes
		$counter_classes = array();
		$counter_classes[] = $settings['counter_custom_css_class'];
		$settings['counter_classes'] = $counter_classes;

		//title classes
		$title_classes = array();
		$title_classes[] = $settings['title_custom_css_class'];
		$settings['title_classes'] = $title_classes;

		wp_register_script( 'jquery-animatenumbers', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/jquery.animatenumbers.min.js', array( 'jquery' ), false, true );
		wp_register_script( 'funfact-animate-number', UNIQUE_ADDONS_ASSETS_URI . '/js/widgets/funfact-animate-number.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-animatenumbers' );
		wp_enqueue_script( 'funfact-animate-number' );
		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_shortcode_template_part( 'counter-skin-style1', null, 'counter-block/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}