<?php
namespace UniqueAddons\Widgets\AwardBlock;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_AwardBlock extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		if( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$direction_suffix = is_rtl() ? '.rtl' : '';
			wp_enqueue_style( 'tm-award-block-loader', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/award-block/award-block-loader' . $direction_suffix . '.css' );
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
		return 'uae-award-block';
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
		return esc_html__( 'Award Block', 'unique-elementor-addons' );
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
		return [ 'tm-award-block' ];
	}


	/**
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Style1( $this ) );
		$this->add_skin( new Skins\Skin_Style2( $this ) );
		$this->add_skin( new Skins\Skin_Style3( $this ) );
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
			'display_type', [
				'label' => esc_html__( "Display Type", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'grid'  =>  esc_html__( 'Grid', 'unique-elementor-addons' ),
					'masonry' =>  esc_html__( 'Masonry', 'unique-elementor-addons' ),
					'carousel'  =>  esc_html__( 'Carousel/Slider', 'unique-elementor-addons' ),
					'basic'  =>  esc_html__( 'Basic', 'unique-elementor-addons' )
				],
				'default' => 'grid'
			]
		);
		$this->add_control(
			'columns', [
				'label' => esc_html__( "Columns Layout", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1'  =>  '1',
					'2'  =>  '2',
					'3'  =>  '3',
					'4'  =>  '4',
					'5'  =>  '5',
					'6'  =>  '6',
				],
				'default' => '4',
				'condition' => [
					'display_type!' => array('carousel')
				]
			]
		);

		//responsive grid layout
		unique_addons_elementor_grid_responsive_columns($this);

		$this->add_control(
			'gutter',
			[
				'label' => esc_html__( "Gutter", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_isotope_gutter_list_elementor(),
				'default' => 'gutter-10',
				'condition' => [
					'display_type' => array('grid', 'masonry', 'masonry-tiles')
				]
			]
		);
		$this->end_controls_section();





		//Swiper Slider Options
		unique_addons_get_swiper_slider_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );
		unique_addons_get_swiper_slider_nav_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );
		unique_addons_get_swiper_slider_dots_arraylist( $this, 1, '', array('display_type' => array('carousel') ) );






		//Link Options
		$this->start_controls_section(
			'service_icons_options', [
				'label' => esc_html__( 'Award Items', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'custom_css_class',
			[
				'label' => esc_html__( "Custom CSS class", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "This is a section title", 'unique-elementor-addons' ),
			]
		);
		$repeater->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Title Tag", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_heading_tag_list(),
				'default' => 'h4'
			]
		);
		$repeater->add_control(
			'subtitle',
			[
				'label' => esc_html__( "Subtitle", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "This is a section subtitle", 'unique-elementor-addons' ),
			]
		);
		$repeater->add_control(
			'subtitle_tag',
			[
				'label' => esc_html__( "Subtitle Tag", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_heading_tag_list(),
				'default' => 'h5'
			]
		);
		$repeater->add_control(
			'count',
			[
				'label' => esc_html__( "Count", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "01", 'unique-elementor-addons' ),
			]
		);
		$repeater->add_control(
			'year',
			[
				'label' => esc_html__( "Year", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "2023", 'unique-elementor-addons' ),
			]
		);
		$repeater->add_control(
			'company',
			[
				'label' => esc_html__( "Company", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Graphicriver", 'unique-elementor-addons' ),
			]
		);
		$repeater->add_control(
			'feature_link',
			[
				'label' => esc_html__( "Link URL", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '',
				]
			]
		);
		$repeater->add_control(
			'featured_image',
			[
				'label' => __('Featured Images', 'unique-elementor-addons'),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$repeater->add_control(
			'featured_image_size', [
				'label' => esc_html__( "Featured Image Size", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_get_available_image_sizes(),
				'default' => 'thumbnail',
			]
		);
		$repeater->add_control(
			'company_image',
			[
				'label' => __('Company Images', 'unique-elementor-addons'),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
		$repeater->add_control(
			'company_image_size', [
				'label' => esc_html__( "Company Image Size", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_get_available_image_sizes(),
				'default' => 'thumbnail',
			]
		);
		$repeater->add_control(
			'content',
			[
				'label' => esc_html__( "Paragraph", 'unique-elementor-addons' ),
				"description" => esc_html__( "It will be displayed above/under title", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( "Write a short description, that will describe the title or something informational and useful.", 'unique-elementor-addons' ),
			]
		);
		$repeater->add_control(
			'section_effects',
			[
				'label' => esc_html__( 'Motion Effects', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'wow_appear_animation',
			[
				'label' => esc_html__( "Wow Appear Animation", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_animate_css_animation_list(),
			]
		);
		$repeater->add_control(
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
			'award_items_array',
			[
				'label' => esc_html__( "Award Items", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Title #1', 'unique-elementor-addons' ),
						'subtitle' => esc_html__( 'subtitle #1', 'unique-elementor-addons' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'content' => esc_html__( 'Item content. Click the edit button to change this text.', 'unique-elementor-addons' ),
						'count' => esc_html__( '01', 'unique-elementor-addons' ),
						'year' => esc_html__( '2018-2019', 'unique-elementor-addons' ),
						'company' => esc_html__( 'Graphicriver', 'unique-elementor-addons' ),
					],
					[
						'title' => esc_html__( 'Title #2', 'unique-elementor-addons' ),
						'subtitle' => esc_html__( 'Title #2', 'unique-elementor-addons' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'content' => esc_html__( 'Item content. Click the edit button to change this text.', 'unique-elementor-addons' ),
						'count' => esc_html__( '02', 'unique-elementor-addons' ),
						'year' => esc_html__( '2020-2021', 'unique-elementor-addons' ),
						'company' => esc_html__( 'Creative Agency', 'unique-elementor-addons' ),
					],
					[
						'title' => esc_html__( 'Title #3', 'unique-elementor-addons' ),
						'subtitle' => esc_html__( 'Title #3', 'unique-elementor-addons' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'content' => esc_html__( 'Item content. Click the edit button to change this text.', 'unique-elementor-addons' ),
						'count' => esc_html__( '03', 'unique-elementor-addons' ),
						'year' => esc_html__( '2022-2023', 'unique-elementor-addons' ),
						'company' => esc_html__( 'Design Studio', 'unique-elementor-addons' ),
					],
				],
			]
		);
		$this->end_controls_section();













		$this->start_controls_section(
			'icon_styling',
			[
				'label' => esc_html__( 'Icon Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
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

		$this->end_controls_section();




		$this->start_controls_section(
			'title_section',
			[
				'label' => esc_html__( 'Title Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feature-title', '{{WRAPPER}} .feature-title a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feature-title:hover', '{{WRAPPER}} .feature-title a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .feature-title',
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'subtitle_section',
			[
				'label' => esc_html__( 'Subtitle Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'subtitle_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feature-subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feature-subtitle:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .feature-subtitle',
			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Paragraph Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( "Paragraph Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feature-details' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'content_color_hover',
			[
				'label' => esc_html__( "Paragraph Color on Hover", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .feature-details' => 'color: {{VALUE}};'
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


		if( $settings['animate_icon_on_hover'] ) {
			$classes[] = 'animate-hover animate-icon-'.$settings['animate_icon_on_hover'];
		}

		//icon classes
		$icon_classes = array();
		$settings['icon_classes'] = $icon_classes;

		//button classes
		$settings['btn_classes'] = unique_addons_prepare_button_classes_from_params( $settings );


		//icon classes
		$icon_classes = array();
		$settings['icon_classes'] = $icon_classes;

		$settings['holder_id'] = unique_addons_get_isotope_holder_ID('award-block');

		$settings['settings'] = $settings;


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_shortcode_template_part( 'award', $settings['display_type'], 'award-block/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}
