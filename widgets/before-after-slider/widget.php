<?php
namespace UniqueAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Before_After_Slider extends Widget_Base {

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
		return 'uae-before-after-slider';
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
		return esc_html__( 'Before After Slider', 'unique-elementor-addons' );
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
	protected function _register_controls() {

		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'before_image',
			[
				'label' => esc_html__( "Before Image", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				"description" => esc_html__( "Upload the before image", 'unique-elementor-addons' ),
			]
		);
		$repeater->add_control(
			'after_image',
			[
				'label' => esc_html__( "After Image", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				"description" => esc_html__( "Upload the after image. Before and After image should have same dimension", 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'slider_items_array',
			[
				'label' => esc_html__( "Slider Items", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'before_image' => Utils::get_placeholder_image_src(),
						'after_image' => Utils::get_placeholder_image_src(),
					],
					[
						'before_image' => Utils::get_placeholder_image_src(),
						'after_image' => Utils::get_placeholder_image_src(),
					],
					[
						'before_image' => Utils::get_placeholder_image_src(),
						'after_image' => Utils::get_placeholder_image_src(),
					]
				],
			]
		);

		$this->add_control(
			'orientation',
			[
				'label' => esc_html__( "Orientation", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				"description" => esc_html__( "Orientation of the before and after images ('horizontal' or 'vertical')", 'unique-elementor-addons' ),
				'options' => [
					'horizontal'  => esc_html__( 'Horizontal', 'unique-elementor-addons' ),
					'vertical'  => esc_html__( 'Vertical', 'unique-elementor-addons' ),
				],
				'default' => 'horizontal',
			]
		);
		$this->add_control(
			'before_label',
			[
				'label' => esc_html__( "Custom Before Label", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Default custom before label: 'Before'", 'unique-elementor-addons' ),
				'default' => esc_html__( "Before", 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'after_label',
			[
				'label' => esc_html__( "Custom After Label", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "Default custom after label: 'After'", 'unique-elementor-addons' ),
				'default' => esc_html__( "After", 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'default_offset_pct',
			[
				'label' => esc_html__( "Offset Percentage", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( "How much of the before image is visible when the page loads(value must be between 0 to 1)", 'unique-elementor-addons' ),
				'default' => '0.5',
			]
		);
		$this->add_control(
			'no_overlay',
			[
				'label' => esc_html__( "No Overlay", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'ON', 'unique-elementor-addons' ),
				'label_off' => esc_html__( 'OFF', 'unique-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__( "Do not show the overlay with before and after", 'unique-elementor-addons' ),
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'tm_display_settings',
			[
				'label' => esc_html__( 'Display Settings', 'unique-elementor-addons' ),
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

		wp_register_style( 'twentytwenty', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/twentytwenty/twentytwenty.css' );
		wp_register_script( 'jquery-event-move', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/twentytwenty/jquery.event.move.js', array('jquery'), false, true );
		wp_register_script( 'jquery-twentytwenty', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/twentytwenty/jquery.twentytwenty.js', array('jquery'), false, true );
		wp_register_script( 'before-after-slider', UNIQUE_ADDONS_ASSETS_URI . '/js/widgets/before-after-slider.js', array('jquery'), false, true );

		wp_enqueue_style( array( 'twentytwenty' ) );
		wp_enqueue_script( array( 'jquery-event-move' ) );
		wp_enqueue_script( array( 'jquery-twentytwenty' ) );
		wp_enqueue_script( array( 'before-after-slider' ) );

		//classes
		$classes = array();
		$settings['classes'] = $classes;


		$settings['holder_id'] = unique_addons_get_isotope_holder_ID('before-after-slider-block');

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_shortcode_template_part( 'slider', $settings['display_type'], 'before-after-slider/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}



