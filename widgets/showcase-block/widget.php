<?php
namespace UniqueAddons\Widgets\ShowcaseBlock;

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
class TM_Elementor_ShowcaseBlock extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style( 'tm-showcase-block', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/showcase-block' . $direction_suffix . '.css' );
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
		return 'uae-showcase-block';
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
		return esc_html__( 'Showcase Block', 'unique-elementor-addons' );
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
		return [ 'tm-showcase-block' ];
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
		//Link Options
		$this->start_controls_section(
			'service_icons_options', [
				'label' => esc_html__( 'Showcase Items', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
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
			'btn1_text',
			[
				'label' => esc_html__( "Button 1 Text", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "View Demo", 'unique-elementor-addons' ),
			]
		);
		$repeater->add_control(
			'btn1_link',
			[
				'label' => esc_html__( "Button 1 Link URL", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '',
				]
			]
		);
		$repeater->add_control(
			'btn2_text',
			[
				'label' => esc_html__( "Button 2 Text", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "View Demo", 'unique-elementor-addons' ),
			]
		);
		$repeater->add_control(
			'btn2_link',
			[
				'label' => esc_html__( "Button 2 Link URL", 'unique-elementor-addons' ),
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
		$this->add_control(
			'showcase_items_array',
			[
				'label' => esc_html__( "Showcase Items", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( 'Title #1', 'unique-elementor-addons' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'btn1_text' => esc_html__( 'View Demo', 'unique-elementor-addons' ),
						'btn2_text' => esc_html__( 'One Page', 'unique-elementor-addons' ),
					],
					[
						'title' => esc_html__( 'Title #2', 'unique-elementor-addons' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'btn1_text' => esc_html__( 'View Demo', 'unique-elementor-addons' ),
						'btn2_text' => esc_html__( 'One Page', 'unique-elementor-addons' ),
					],
					[
						'title' => esc_html__( 'Title #3', 'unique-elementor-addons' ),
						'featured_image' => Utils::get_placeholder_image_src(),
						'btn1_text' => esc_html__( 'View Demo', 'unique-elementor-addons' ),
						'btn2_text' => esc_html__( 'One Page', 'unique-elementor-addons' ),
					],
				],
			]
		);
		$this->end_controls_section();







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
					'{{WRAPPER}} .showcase-title', '{{WRAPPER}} .showcase-title a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .showcase-title:hover', '{{WRAPPER}} .showcase-title a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .showcase-title',
			]
		);
		$this->end_controls_section();







		//other settings
		$this->start_controls_section(
			'other_options',
			[
				'label' => esc_html__( 'Other Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'box_animation',
			[
				'label' => esc_html__( "Box Animation Style", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					''  =>  esc_html__( 'No Animation', 'unique-elementor-addons' ),
					'iconbox-style1-current-theme-animation'  =>  esc_html__( 'Style 1 - Current Theme Animation', 'unique-elementor-addons' ),
					'iconbox-style2-border-bottom'  =>  esc_html__( 'Style 2 - Border Bottom', 'unique-elementor-addons' ),
					'iconbox-style3-moving-border-bottom' =>  esc_html__( 'Style 3 - Moving Border Bottom', 'unique-elementor-addons' ),
					'iconbox-style4-bgcolor'  =>  esc_html__( 'Style 4 - Hover BG Color', 'unique-elementor-addons' ),
					'iconbox-style5-moving-bgcolor' =>  esc_html__( 'Style 5 - Hover Moving BG Color', 'unique-elementor-addons' ),
					'iconbox-style6-moving-double-bgcolor'  =>  esc_html__( 'Style 6 - Hover Moving Double BG Color', 'unique-elementor-addons' ),
					'iconbox-style7-hover-moving-border'  =>  esc_html__( 'Style 7 - Hover Moving Border Around Box', 'unique-elementor-addons' ),
				],
				'default' => '',
			]
		);
		$this->add_control(
			'box_shadow',
			[
				'label' => esc_html__( "Box Shadow?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'box_shadow_on_hover',
			[
				'label' => esc_html__( "Box Shadow only on Hover?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
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


		//button classes
		$settings['btn_classes'] = unique_addons_prepare_button_classes_from_params( $settings );



		$settings['holder_id'] = unique_addons_get_isotope_holder_ID('showcase-block');

		$settings['settings'] = $settings;


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_shortcode_template_part( 'showcase', $settings['display_type'], 'showcase-block/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}
