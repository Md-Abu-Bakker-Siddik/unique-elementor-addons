<?php
namespace UniqueAddons\Widgets\PricingPlan;

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
class TM_Elementor_Pricing_Plan extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		if( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$direction_suffix = is_rtl() ? '.rtl' : '';
			wp_enqueue_style( 'tm-pricing-plan-style', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/pricing-plan/pricing-plan-loader' . $direction_suffix . '.css' );
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
		return 'uae-pricing-plan';
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
		return esc_html__( 'Pricing Plan - Unique Addons', 'unique-elementor-addons' );
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
		$this->add_skin( new Skins\Skin_Pricing_Style1( $this ) );
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
				'default' => ''
			]
		);
		$this->add_control(
			'plan_active',
			[
				'label' => esc_html__( "Make It Active?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);
		$this->add_control(
			'custom_css_class',
			[
				'label' => esc_html__( "Custom CSS class", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Sample Title", 'unique-elementor-addons' )
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
		$this->add_control(
			'sub_title',
			[
				'label' => esc_html__( "Sub Title", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "Starts at $14. Includes 2 users", 'unique-elementor-addons' )
			]
		);
		$this->add_control(
			'subtitle_tag',
			[
				'label' => esc_html__( "Sub Title Tag", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_heading_tag_list(),
				'default' => 'p'
			]
		);
		$this->add_control(
			'label_text',
			[
				'label' => esc_html__( "Label/Offer/Tag Text", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Most Popular", 'unique-elementor-addons' )
			]
		);
		$this->add_control(
			'footer_hint_text',
			[
				'label' => esc_html__( "Footer Hint Text", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "* No credit card required", 'unique-elementor-addons' )
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
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'background_hover_image',
			[
				'label' => esc_html__( "Background Hover Image", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				"description" => esc_html__( "Upload the image", 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'featured_image_size',
			[
				'label' => esc_html__( "Featured Image Size", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_get_available_image_sizes(),
				'default' => 'medium',
			]
		);
		$this->end_controls_section();



		//Plan Default
		$this->start_controls_section(
			'price_plan_default',
			[
				'label' => esc_html__( 'Price Plan - Default', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'price',
			[
				'label' => esc_html__( "Price", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "199", 'unique-elementor-addons' )
			]
		);
		$this->add_control(
			'on_sale', [
				'label' => esc_html__( "On sale?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'price_sale',
			[
				'label' => esc_html__( "Sale Price", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "149", 'unique-elementor-addons' ),
				'condition' => [
					'on_sale' => array('yes')
				],
			]
		);
		$this->add_control(
			'price_prefix',
			[
				'label' => esc_html__( "Prefix (Currency)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "$", 'unique-elementor-addons' )
			]
		);
		$this->add_control(
			'price_separator',
			[
				'label' => esc_html__( "Separator", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "/", 'unique-elementor-addons' )
			]
		);
		$this->add_control(
			'price_postfix',
			[
				'label' => esc_html__( "Postfix (Period)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Monthly", 'unique-elementor-addons' )
			]
		);
		$this->end_controls_section();



		//Plan Secondary
		$this->start_controls_section(
			'price_plan_secondary',
			[
				'label' => esc_html__( 'Price Plan - Secondary', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'price_secondary',
			[
				'label' => esc_html__( "Price", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'on_sale_secondary', [
				'label' => esc_html__( "On sale?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'price_sale_secondary',
			[
				'label' => esc_html__( "Sale Price", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "349", 'unique-elementor-addons' ),
				'condition' => [
					'on_sale_secondary' => array('yes')
				],
			]
		);
		$this->add_control(
			'price_prefix_secondary',
			[
				'label' => esc_html__( "Prefix (Currency)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "$", 'unique-elementor-addons' )
			]
		);
		$this->add_control(
			'price_separator_secondary',
			[
				'label' => esc_html__( "Separator", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "/", 'unique-elementor-addons' )
			]
		);
		$this->add_control(
			'price_postfix_secondary',
			[
				'label' => esc_html__( "Postfix (Period)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Yearly", 'unique-elementor-addons' )
			]
		);
		$this->end_controls_section();







		//Features
		$this->start_controls_section(
			'features_list_repeater',
			[
				'label' => esc_html__( 'Features/Options List', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'features_list_title',
			[
				'label' => esc_html__( "Features Title", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "All basic services include:", 'unique-elementor-addons' )
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'disable_item', [
				'label' => esc_html__( "Disable This Item (Blur)?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'line_through', [
				'label' => esc_html__( "Add Line Through Text?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$repeater->add_control(
			'tooltip_text',
			[
				'label' => esc_html__( "Tooltip Text", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Start your free trial", 'unique-elementor-addons' )
			]
		);
		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( "Text", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => ''
			]
		);
		$this->add_control(
			'features_list',
			[
				'label' => esc_html__( "Features Items", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'content' => esc_html__( "Full Access to the Library", 'unique-elementor-addons' ),
					],
					[
						'content' => esc_html__( "Complete Documentation", 'unique-elementor-addons' ),
					],
					[
						'disable_item' => 'yes',
						'content' => esc_html__( "24/7 Free Support", 'unique-elementor-addons' ),
					],
					[
						'line_through' => 'yes',
						'content' => esc_html__( "Cloud Storage Backup", 'unique-elementor-addons' ),
					],
				],
			]
		);
		$this->end_controls_section();




		//Thumb
		$this->start_controls_section(
			'thumb_options',
			[
				'label' => esc_html__( 'Thumb Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'icon_type',
			[
				'label' => esc_html__( "Thumb Type", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'font-icon' => esc_html__( 'Font/Flat Icon', 'unique-elementor-addons' ),
					'image' => esc_html__( 'JPG/PNG Image', 'unique-elementor-addons' ),
				],
				'default' => 'font-icon'
			]
		);
		$this->add_responsive_control(
			'thumb_icon_text_color',
			[
				'label' => esc_html__( "Icon Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-skin-style2 .title-box .icon' => '-webkit-text-fill-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'thumb_icon_text_theme_color',
			[
				'label' => esc_html__( "Icon Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-skin-style2 .title-box .icon' => '-webkit-text-fill-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'pricing_image',
			[
				'label' => esc_html__( "Thumbnail Image", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( "This image will be shown on the top of the pricing table", 'unique-elementor-addons' ),
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$this->add_control(
			'pricing_image_hover',
			[
				'label' => esc_html__( "Thumbnail Image (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'description' => esc_html__( "This image will be shown on the top of the pricing table", 'unique-elementor-addons' ),
				'condition' => [
					'icon_type' => array('image')
				]
			]
		);
		$this->add_control(
			'pricing_predefined_image_size',
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
		$this->add_responsive_control(
			'pricing_image_width',
			[
				'label' => esc_html__( "Image Custom Width", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'separator' => 'before',
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 400,
						'step' => 1,
					],
					'%' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'condition' => [
					'icon_type' => array('image')
				],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-thumb img' => 'width: {{SIZE}}{{UNIT}};'
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
		$this->add_responsive_control(
			'pricing_image_margin',
			[
				'label' => esc_html__( 'Image Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-thumb' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'pricing_image_padding',
			[
				'label' => esc_html__( 'Image Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();












		//Features
		$this->start_controls_section(
			'features_list_icon_options',
			[
				'label' => esc_html__( 'List Icons Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'hide_icon',
			[
				'label' => esc_html__( 'Show/Hide Features Icon', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'unique-elementor-addons' ),
				'label_off' => __( 'Show', 'unique-elementor-addons' ),
				'return_value'	=> 'none',
				'default'	=> 'inline-block',
				'selectors' => [
					'{{WRAPPER}} .features-list .icon' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'features_list_icon',
			[
				'label' => esc_html__( 'Icon', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-check',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'features_list_icon_color',
			[
				'label' => esc_html__( "Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list .icon' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'features_list_icon_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list li:hover .icon' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'features_list_icon_theme_colored',
			[
				'label' => esc_html__( "Make Icon Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-list li i' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'features_list_icon_theme_colored_hover',
			[
				'label' => esc_html__( "Make Icon Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-list li:hover .icon' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'features_list_icon_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .features-list .icon',
			]
		);
		$this->add_responsive_control(
			'features_icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .features-list .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();














		//Features
		$this->start_controls_section(
			'features_list_styling',
			[
				'label' => esc_html__( 'List Styling', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'features_list_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list li' => 'color: {{VALUE}};',
					'{{WRAPPER}} .features-list li strong' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'features_list_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .features-list li' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .features-list li strong' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'features_list_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .features-list li',
			]
		);
		$this->add_control(
			'list_bordered',
			[
				'label' => esc_html__( "Make List(ul, li) Border Bottom?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'features_list_custom_border',
				'label' => esc_html__( 'Custom Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .features-list li',
			]
		);
		$this->add_control(
			'features_list_border_color',
			[
				'label' => esc_html__( "Border Bottom Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'list_bordered' => array('yes')
				],
				'selectors' => [
					'{{WRAPPER}} .features-list li' => 'border-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'features_list_border_color_hover',
			[
				'label' => esc_html__( "Border Bottom Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .features-list li' => 'border-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'features_list_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .features-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'features_list_padding',
			[
				'label' => esc_html__( 'Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .features-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();













		//Features
		$this->start_controls_section(
			'features_list_noaction_icon_options',
			[
				'label' => esc_html__( 'List Disabled Icons Styling', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'features_list_noaction_icon',
			[
				'label' => esc_html__( 'Icon', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-circle',
					'library' => 'regular',
				],
			]
		);
		$this->add_control(
			'features_list_noaction_icon_color',
			[
				'label' => esc_html__( "Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list .no-action i' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'features_list_noaction_icon_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list .no-action:hover i' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'features_list_noaction_icon_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .features-list .no-action i',
			]
		);
		$this->end_controls_section();


		//Features
		$this->start_controls_section(
			'features_list_noaction_styling',
			[
				'label' => esc_html__( 'List Disabled Text Styling', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'features_list_noaction_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list li.no-action' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'features_list_noaction_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .features-list li.no-action' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'features_list_noaction_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .features-list li.no-action',
			]
		);
		$this->end_controls_section();












		//Features
		$this->start_controls_section(
			'features_list_line_through_icon_options',
			[
				'label' => esc_html__( 'List Line Through Icons Styling', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'features_list_line_through_icon',
			[
				'label' => esc_html__( 'Icon', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-circle',
					'library' => 'regular',
				],
			]
		);
		$this->add_control(
			'features_list_line_through_icon_color',
			[
				'label' => esc_html__( "Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list .line-through i' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'features_list_line_through_icon_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list .line-through:hover i' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'features_list_line_through_icon_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .features-list .line-through i',
			]
		);
		$this->end_controls_section();


		//Features
		$this->start_controls_section(
			'features_list_line_through_styling',
			[
				'label' => esc_html__( 'List Line Through Text Styling', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'features_list_line_through_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list li.line-through' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'features_list_line_through_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .features-list li.line-through' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'features_list_line_through_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .features-list li.line-through',
			]
		);
		$this->end_controls_section();






		//Footer Hint Text
		$this->start_controls_section(
			'list_tooltip_options',
			[
				'label' => esc_html__( 'List Tooltip Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'hide_features_list_tooltip',
			[
				'label' => esc_html__( 'Show/Hide Features Tooltip', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Hide', 'unique-elementor-addons' ),
				'label_off' => __( 'Show', 'unique-elementor-addons' ),
				'return_value'	=> 'none',
				'default'	=> 'block',
				'selectors' => [
					'{{WRAPPER}} .features-list .has-tooltip' => 'display: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'list_tooltip_icon_color',
			[
				'label' => esc_html__( "Tooltip Icon Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list .has-tooltip i' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'list_tooltip_icon_typography',
				'label' => esc_html__( 'Tooltip Icon Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .features-list .has-tooltip i',
			]
		);

		$this->add_control(
			'list_tooltip_text_color',
			[
				'label' => esc_html__( "Tooltip Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list .has-tooltip:before' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'list_tooltip_text_typography',
				'label' => esc_html__( 'Tooltip Text Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .features-list .has-tooltip:before',
			]
		);

		$this->add_control(
			'list_tooltip_custom_bg_color',
			[
				'label' => esc_html__( "Tooltip Text Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .features-list .has-tooltip:before' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'list_tooltip_bg_theme_colored',
			[
				'label' => esc_html__( "Tooltip Text BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .features-list .has-tooltip:before' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();







		//Title
		$this->start_controls_section(
			'title_options',
			[
				'label' => esc_html__( 'Title Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_custom_css_class',
			[
				'label' => esc_html__( "Title Custom CSS Class", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Title Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-title-area .pricing-plan-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Title Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-title-area .pricing-plan-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .pricing-plan-title-area .pricing-plan-title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'label' => esc_html__( 'Title Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .pricing-plan-title-area .pricing-plan-title',
			]
		);
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-title-area .pricing-plan-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pricing-plan-title-area .pricing-plan-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();








		//Sub Title
		$this->start_controls_section(
			'sub_title_options',
			[
				'label' => esc_html__( 'Sub Title Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'subtitle_custom_css_class',
			[
				'label' => esc_html__( "Sub Title Custom CSS Class", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		//Content
		$this->add_control(
			'subtitle_text_color',
			[
				'label' => esc_html__( "Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_text_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .pricing-plan-subtitle',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'subtitle_border',
				'label' => esc_html__( 'Sub Title Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .pricing-plan-subtitle',
			]
		);
		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .pricing-plan-subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();





		//Price
		$this->start_controls_section(
			'price_options',
			[
				'label' => esc_html__( 'Price Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('price_info_style');
		$this->start_controls_tab(
			'price_value_style',
			[
				'label' => esc_html__('Price Value', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'price_text_color',
			[
				'label' => esc_html__( "Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-price' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'price_text_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-pricing .pricing-plan-price' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .pricing-plan-pricing .pricing-plan-price',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'pricing_border',
				'label' => esc_html__( 'Price Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .pricing-plan-pricing',
			]
		);
		$this->add_responsive_control(
			'price_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_padding',
			[
				'label' => esc_html__( 'Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'price_prefix_style',
			[
				'label' => esc_html__('Prefix', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'price_prefix_options',
			[
				'label' => esc_html__( 'Price Prefix Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'price_prefix_text_color',
			[
				'label' => esc_html__( "Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-prefix, {{WRAPPER}} .pricing-plan-pricing .pricing-plan-prefix *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'price_prefix_text_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-pricing .pricing-plan-prefix, {{WRAPPER}}:hover .pricing-plan-pricing .pricing-plan-prefix *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_prefix_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .pricing-plan-pricing .pricing-plan-prefix, {{WRAPPER}} .pricing-plan-pricing .pricing-plan-prefix *',
			]
		);
		$this->add_responsive_control(
			'price_prefix_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-prefix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_prefix_padding',
			[
				'label' => esc_html__( 'Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-prefix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'price_separator_style',
			[
				'label' => esc_html__('Separator', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'price_separator_options',
			[
				'label' => esc_html__( 'Price Separator Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'price_separator_text_color',
			[
				'label' => esc_html__( "Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-separator, {{WRAPPER}} .pricing-plan-pricing .pricing-plan-separator *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'price_separator_text_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-pricing .pricing-plan-separator, {{WRAPPER}}:hover .pricing-plan-pricing .pricing-plan-separator *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_separator_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .pricing-plan-pricing .pricing-plan-separator, {{WRAPPER}} .pricing-plan-pricing .pricing-plan-separator *',
			]
		);
		$this->add_responsive_control(
			'price_separator_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-separator' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_separator_padding',
			[
				'label' => esc_html__( 'Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-separator' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'price_postfix_style',
			[
				'label' => esc_html__('Postfix', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'price_postfix_options',
			[
				'label' => esc_html__( 'Price Postfix Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'price_postfix_text_color',
			[
				'label' => esc_html__( "Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-postfix, {{WRAPPER}} .pricing-plan-pricing .pricing-plan-postfix *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'price_postfix_text_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-pricing .pricing-plan-postfix, {{WRAPPER}}:hover .pricing-plan-pricing .pricing-plan-postfix *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_postfix_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .pricing-plan-pricing .pricing-plan-postfix, {{WRAPPER}} .pricing-plan-pricing .pricing-plan-postfix *',
			]
		);
		$this->add_responsive_control(
			'price_postfix_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-postfix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'price_postfix_padding',
			[
				'label' => esc_html__( 'Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-pricing .pricing-plan-postfix' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();





























		//Title
		$this->start_controls_section(
			'label_offer_options',
			[
				'label' => esc_html__( 'Label/Offer/Tag Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'label_offer_text_color',
			[
				'label' => esc_html__( "Label Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-label' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'label_offer_text_color_hover',
			[
				'label' => esc_html__( "Label Text Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-label' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'label_offer_typography',
				'label' => esc_html__( 'Label Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .pricing-plan-label',
			]
		);
		$this->add_control(
			'label_offer_custom_bg_color',
			[
				'label' => esc_html__( "Label Custom Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-label' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'label_offer_custom_bg_color_hover',
			[
				'label' => esc_html__( "Label Custom Background Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-label' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'label_offer_theme_colored',
			[
				'label' => esc_html__( "Label Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-plan-label' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'label_offer_theme_colored_hover',
			[
				'label' => esc_html__( "Label Background Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .pricing-plan-label' => 'background-color: var(--theme-color{{VALUE}});'
				],
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
		$this->add_control(
			'link',
			[
				'label' => esc_html__( "Link URL", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'default' => [
				'url' => '',
				'is_external' => true,
				'nofollow' => true,
				],
			]
		);
		$this->add_control(
			'link_secondary',
			[
				'label' => esc_html__( "Link URL - Secondary", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'default' => [
				'url' => '',
				'is_external' => true,
				'nofollow' => true,
				],
			]
		);
		unique_addons_get_viewdetails_button_arraylist($this, 1);
		unique_addons_get_viewdetails_button_arraylist($this, 2);
		unique_addons_get_button_arraylist($this, 1);
		$this->end_controls_section();



		$this->start_controls_section(
			'button_color_typo_options', [
				'label' => esc_html__( 'Button Color/Typography', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		unique_addons_get_button_text_color_typo_arraylist($this, 1);
		$this->end_controls_section();










		//Footer Hint Text
		$this->start_controls_section(
			'footer_hint_text_options',
			[
				'label' => esc_html__( 'Footer Hint Text Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		//Content
		$this->add_control(
			'footer_hint_text_color',
			[
				'label' => esc_html__( "Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .footer-hint-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'footer_hint_text_color_hover',
			[
				'label' => esc_html__( "Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .footer-hint-text' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'footer_hint_text_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .footer-hint-text',
			]
		);
		$this->add_responsive_control(
			'footer_hint_text_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .footer-hint-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();








		$this->start_controls_section(
			'bg_wrapper_options',
			[
				'label' => esc_html__( 'Wrapper Background Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->start_controls_tabs('bg_wrapper_option_tabs');
		$this->start_controls_tab(
			'bg_wrapper_option_tab_default',
			[
				'label' => esc_html__('Default', 'unique-elementor-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bg_wrapper_background',
				'label' => esc_html__( 'Background', 'unique-elementor-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper',
			]
		);
		$this->add_control(
			'parent_wrapper_bg_theme_colored',
			[
				'label' => esc_html__( "Wrapper BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'parent_wrapper_border',
				'label' => esc_html__( 'Wrapper Border', 'unique-elementor-addons' ),
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'parent_wrapper_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper',
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'bg_wrapper_option_tab_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'bg_wrapper_background_hover',
				'label' => esc_html__( 'Background', 'unique-elementor-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}}:hover .tm-sc-pricing-plan .pricing-plan-inner-wrapper',
			]
		);
		$this->add_control(
			'parent_wrapper_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Wrapper BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-sc-pricing-plan .pricing-plan-inner-wrapper' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'parent_wrapper_border_hover',
				'label' => esc_html__( 'Wrapper Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}}:hover .tm-sc-pricing-plan .pricing-plan-inner-wrapper',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'parent_wrapper_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'wrapper_margin',
			[
				'label' => esc_html__( 'Parent Wrapper Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'wrapper_padding',
			[
				'label' => esc_html__( 'Parent Wrapper Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Inner Content Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper .pricing-plan-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'parent_wrapper_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_control(
			'add_box_shadow_around_table',
			[
				'label' => esc_html__( "Add Default Box Shadow Around Plan?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'make_this_table_featured',
			[
				'label' => esc_html__( "Make This Plan Featured?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'description' => esc_html__( "Featured Pricing Plan has some different looks to highlight it", 'unique-elementor-addons' ),
				'default' => 'no',
			]
		);
		$this->add_control(
			'make_hover_effect',
			[
				'label' => esc_html__( "Make Hover Effect on This Plan?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
				'description' => esc_html__( "There will be a transition when hovering on this table", 'unique-elementor-addons' ),
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'wrapper_bg_before_options',
			[
				'label' => esc_html__( 'Wrapper Background - Before', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('wrapper_bg_before_option_tabs');
		$this->start_controls_tab(
			'wrapper_bg_before_option_tab_default',
			[
				'label' => esc_html__('Default', 'unique-elementor-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_bg_before_background',
				'label' => esc_html__( 'Background', 'unique-elementor-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper:before',
			]
		);
		$this->add_control(
			'wrapper_bg_before_background_opacity',
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
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper:before' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'wrapper_bg_before_option_tab_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_bg_before_background_hover',
				'label' => esc_html__( 'Background', 'unique-elementor-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}}:hover .tm-sc-pricing-plan .pricing-plan-inner-wrapper:before',
			]
		);
		$this->add_control(
			'wrapper_bg_before_background_hover_opacity',
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
					'{{WRAPPER}}:hover .tm-sc-pricing-plan .pricing-plan-inner-wrapper:before' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();



		$this->start_controls_section(
			'wrapper_bg_after_options',
			[
				'label' => esc_html__( 'Wrapper Background - After', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('wrapper_bg_after_option_tabs');
		$this->start_controls_tab(
			'wrapper_bg_after_option_tab_default',
			[
				'label' => esc_html__('Default', 'unique-elementor-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_bg_after_background',
				'label' => esc_html__( 'Background', 'unique-elementor-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper:after',
			]
		);
		$this->add_control(
			'wrapper_bg_after_background_opacity',
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
					'{{WRAPPER}} .tm-sc-pricing-plan .pricing-plan-inner-wrapper:after' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'wrapper_bg_after_option_tab_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_bg_after_background_hover',
				'label' => esc_html__( 'Background', 'unique-elementor-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}}:hover .tm-sc-pricing-plan .pricing-plan-inner-wrapper:after',
			]
		);
		$this->add_control(
			'wrapper_bg_after_background_hover_opacity',
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
					'{{WRAPPER}}:hover .tm-sc-pricing-plan .pricing-plan-inner-wrapper:after' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	public function get_classes( $settings = array() ) {
		$classes = array();
		$classes[] = (!empty($settings['label_text']) ) ? 'has-label' : '';

		if( $settings['plan_active'] === 'yes' ) {
			$classes[] = 'pricing-active';
		}
		if( $settings['list_bordered'] == 'yes' ) {
			$classes[] = 'pricing-list-bordered';
		}
		if( $settings['make_this_table_featured'] == 'yes' ) {
			$classes[] = 'pricing-plan-featured';
		}
		if( $settings['make_hover_effect'] == 'yes' ) {
			$classes[] = 'pricing-plan-hover-effect';
		}
		if( $settings['add_box_shadow_around_table'] == 'yes' ) {
			$classes[] = 'pricing-plan-box-shadow';
		}
		$classes[] = $settings['custom_css_class'];

		return $classes;
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
		wp_enqueue_style( 'tm-pricing-skin-style1', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/pricing-plan/pricing-skin-style1' . $direction_suffix . '.css' );

		//link url
		$settings['button']['target'] = $settings['link']['is_external'] ? ' target="_blank"' : '';
		$settings['button']['url'] = $settings['link']['url'];

		//link url - secondary
		$settings['button_secondary_url'] = '';
		if(!empty($settings['link_secondary']['url'])) {
			$settings['button_secondary_url'] = $settings['link_secondary']['url'];
		}

		//classes
		$settings['classes'] = $this->get_classes($settings);

		//button classes
		$settings['btn_classes'] = unique_addons_prepare_button_classes_from_params( $settings );

		//title classes
		$title_classes = array();
		$title_classes[] = $settings['title_custom_css_class'];
		$settings['title_classes'] = $title_classes;

		//sub title classes
		$sub_title_classes = array();
		$sub_title_classes[] = $settings['subtitle_custom_css_class'];
		$settings['sub_title_classes'] = $sub_title_classes;

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_shortcode_template_part( 'pricing-plan-skin-default', null, 'pricing-plan/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}