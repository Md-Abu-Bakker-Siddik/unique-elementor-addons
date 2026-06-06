<?php
namespace UniqueAddons\Widgets\VerticalImageSlider;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Vertical Image Slider
 *
 * Elementor widget for vertical image slider with free mode.
 *
 * @since 1.0.0
 */
class TM_Elementor_Vertical_Image_Slider extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		if( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$direction_suffix = is_rtl() ? '.rtl' : '';
			wp_enqueue_style( 'tm-vertical-image-slider-loader', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/vertical-image-slider/vertical-image-slider-loader' . $direction_suffix . '.css' );
		}

		wp_enqueue_style( 'swiper' );
		wp_enqueue_script( 'swiper' );
		wp_register_script( 'tm-vertical-image-slider', UNIQUE_ADDONS_ASSETS_URI . '/js/widgets/vertical-image-slider.js', array('jquery', 'swiper'), false, true );
		wp_enqueue_script( array( 'tm-vertical-image-slider' ) );
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
		return 'uae-vertical-image-slider';
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
		return esc_html__( 'Vertical Image Slider Free Mode - Unique Addons', 'unique-elementor-addons' );
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
		return [ 'unique-addons-elementor', 'swiper', 'tm-vertical-image-slider' ];
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
			'featured_image_size', [
				'label' => esc_html__( "Featured Image Size", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_get_available_image_sizes(),
				'default' => 'medium_large',
			]
		);
		$this->add_responsive_control(
			'slider_height',
			[
				'label' => esc_html__( "Slider Height", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 2000,
						'step' => 10,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => 'vh',
					'size' => 80,
				],
				'selectors' => [
					'{{WRAPPER}} .tm-vertical-image-slider-wrapper' => 'height: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'slider_direction' => 'vertical'
				]
			]
		);
		$this->add_responsive_control(
			'slider_width',
			[
				'label' => esc_html__( "Slider Width", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => 200,
						'max' => 2000,
						'step' => 10,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .tm-vertical-image-slider-wrapper' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'slider_direction' => 'horizontal'
				]
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'slider_options',
			[
				'label' => esc_html__( 'Slider Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'slider_direction',
			[
				'label' => esc_html__( "Slider Direction", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'vertical' => esc_html__( 'Vertical', 'unique-elementor-addons' ),
					'horizontal' => esc_html__( 'Horizontal', 'unique-elementor-addons' ),
				],
				'default' => 'vertical',
				'description' => esc_html__( 'Choose the sliding direction', 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'reverse_direction',
			[
				'label' => esc_html__( "Reverse Direction", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unique-elementor-addons' ),
				'label_off' => esc_html__( 'No', 'unique-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
				'description' => esc_html__( 'Slide in the opposite direction', 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'free_mode',
			[
				'label' => esc_html__( "Enable Free Mode", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unique-elementor-addons' ),
				'label_off' => esc_html__( 'No', 'unique-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__( 'Enable free mode for smooth scrolling', 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label' => esc_html__( "Autoplay", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unique-elementor-addons' ),
				'label_off' => esc_html__( 'No', 'unique-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'autoplay_delay',
			[
				'label' => esc_html__( "Autoplay Delay (ms)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 0,
				'description' => esc_html__( 'Delay between transitions in milliseconds. Set to 0 for continuous movement.', 'unique-elementor-addons' ),
				'condition' => [
					'autoplay' => 'yes'
				]
			]
		);
		$this->add_control(
			'speed',
			[
				'label' => esc_html__( "Animation Speed (ms)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3000,
				'description' => esc_html__( 'Duration of transition between slides in milliseconds', 'unique-elementor-addons' ),
			]
		);
		$this->add_responsive_control(
			'slides_per_view',
			[
				'label' => esc_html__( "Slides Per View", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'1' => '1',
					'1.5' => '1.5',
					'2' => '2',
					'2.5' => '2.5',
					'3' => '3',
					'3.5' => '3.5',
					'4' => '4',
					'4.5' => '4.5',
					'5' => '5',
					'5.5' => '5.5',
					'6' => '6',
					'6.5' => '6.5',
					'7' => '7',
					'7.5' => '7.5',
					'8' => '8',
					'8.5' => '8.5',
					'9' => '9',
					'9.5' => '9.5',
					'10' => '10',
					'auto' => 'Auto',
				],
				'default' => '2.5',
				'tablet_default' => '2',
				'mobile_default' => '1.5',
			]
		);
		$this->add_control(
			'space_between',
			[
				'label' => esc_html__( "Space Between Slides", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 20,
			]
		);
		$this->add_control(
			'loop',
			[
				'label' => esc_html__( "Loop", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unique-elementor-addons' ),
				'label_off' => esc_html__( 'No', 'unique-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'mousewheel',
			[
				'label' => esc_html__( "Mouse Wheel Control", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unique-elementor-addons' ),
				'label_off' => esc_html__( 'No', 'unique-elementor-addons' ),
				'return_value' => 'yes',
				'default' => '',
				'description' => esc_html__( 'Enable navigation with mouse wheel', 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'allow_drag',
			[
				'label' => esc_html__( "Allow Mouse Drag", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unique-elementor-addons' ),
				'label_off' => esc_html__( 'No', 'unique-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__( 'Enable dragging the slider with mouse click and drag', 'unique-elementor-addons' ),
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'image_collection',
			[
				'label' => esc_html__( 'Image Collection', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'image', [
				'label' => esc_html__( "Image", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'image_size', [
				'label' => esc_html__( "Image Size", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_get_available_image_sizes(),
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( "Link", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'slider_images_array',
			[
				'label' => esc_html__( "Slider Images", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'image' => Utils::get_placeholder_image_src(),
						'title' => esc_html__( 'Image 1', 'unique-elementor-addons' ),
					],
					[
						'image' => Utils::get_placeholder_image_src(),
						'title' => esc_html__( 'Image 2', 'unique-elementor-addons' ),
					],
					[
						'image' => Utils::get_placeholder_image_src(),
						'title' => esc_html__( 'Image 3', 'unique-elementor-addons' ),
					],
					[
						'image' => Utils::get_placeholder_image_src(),
						'title' => esc_html__( 'Image 4', 'unique-elementor-addons' ),
					],
					[
						'image' => Utils::get_placeholder_image_src(),
						'title' => esc_html__( 'Image 5', 'unique-elementor-addons' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'overlay_gradients',
			[
				'label' => esc_html__( 'Overlay Gradients', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater_gradient = new \Elementor\Repeater();
		$repeater_gradient->add_control(
			'gradient_side',
			[
				'label' => esc_html__( "Gradient Side", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'left' => esc_html__( 'Left', 'unique-elementor-addons' ),
					'right' => esc_html__( 'Right', 'unique-elementor-addons' ),
					'top' => esc_html__( 'Top', 'unique-elementor-addons' ),
					'bottom' => esc_html__( 'Bottom', 'unique-elementor-addons' ),
				],
				'default' => 'left',
			]
		);
		$repeater_gradient->add_control(
			'gradient_color',
			[
				'label' => esc_html__( "Gradient Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000000',
			]
		);
		$repeater_gradient->add_control(
			'gradient_opacity',
			[
				'label' => esc_html__( "Gradient Opacity", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'default' => [
					'size' => 0.8,
				],
			]
		);
		$repeater_gradient->add_control(
			'gradient_size',
			[
				'label' => esc_html__( "Gradient Size", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'px' => [
						'min' => 0,
						'max' => 500,
						'step' => 10,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 30,
				],
				'description' => esc_html__( 'How far the gradient extends from the edge', 'unique-elementor-addons' ),
			]
		);
		$repeater_gradient->add_control(
			'gradient_blur',
			[
				'label' => esc_html__( "Gradient Blur/Softness", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'size' => 0,
				],
				'description' => esc_html__( 'Add blur effect to the gradient overlay', 'unique-elementor-addons' ),
			]
		);
		$repeater_gradient->add_control(
			'gradient_zindex',
			[
				'label' => esc_html__( "Z-Index", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -100,
				'max' => 999,
				'step' => 1,
				'default' => 100,
				'description' => esc_html__( 'Control the stacking order of this gradient overlay', 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'gradient_overlays_array',
			[
				'label' => esc_html__( "Gradient Overlays", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater_gradient->get_controls(),
				'default' => [],
				'title_field' => '{{{ gradient_side }}} - Gradient Overlay',
			]
		);
		$this->end_controls_section();

		// Styling Section
		$this->start_controls_section(
			'image_styling',
			[
				'label' => esc_html__( 'Image Styling', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => esc_html__( "Image Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-vertical-image-slider .slider-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tm-vertical-image-slider .slider-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-vertical-image-slider .slider-image img',
			]
		);
		$this->add_control(
			'image_hover_effect',
			[
				'label' => esc_html__( "Hover Effect", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'unique-elementor-addons' ),
					'zoom' => esc_html__( 'Zoom In', 'unique-elementor-addons' ),
					'zoom-out' => esc_html__( 'Zoom Out', 'unique-elementor-addons' ),
					'grayscale' => esc_html__( 'Grayscale to Color', 'unique-elementor-addons' ),
				],
				'default' => 'zoom',
			]
		);
		$this->end_controls_section();

		// Odd/Even Items Styling
		$this->start_controls_section(
			'odd_even_items_styling',
			[
				'label' => esc_html__( 'Odd/Even Items Styling', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// Odd Items
		$this->add_control(
			'odd_items_heading',
			[
				'label' => esc_html__( 'Odd Items (1st, 3rd, 5th...)', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);

		$this->add_responsive_control(
			'odd_items_margin_top',
			[
				'label' => esc_html__( "Margin Top (Odd)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => -20,
						'max' => 20,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-wrapper .swiper-slide:nth-child(odd) .slider-image' => 'margin-top: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'odd_items_padding_top',
			[
				'label' => esc_html__( "Padding Top (Odd)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 20,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-wrapper .swiper-slide:nth-child(odd) .slider-image' => 'padding-top: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'odd_items_image_height',
			[
				'label' => esc_html__( "Image Height (Odd)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vh' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-wrapper .swiper-slide:nth-child(odd) .tm-vertical-image-slider-item .slider-image' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .swiper-wrapper .swiper-slide:nth-child(odd) .tm-vertical-image-slider-item .slider-image img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;'
				]
			]
		);

		// Even Items
		$this->add_control(
			'even_items_heading',
			[
				'label' => esc_html__( 'Even Items (2nd, 4th, 6th...)', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'even_items_margin_top',
			[
				'label' => esc_html__( "Margin Top (Even)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => -100,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => -20,
						'max' => 20,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-wrapper .swiper-slide:nth-child(even) .slider-image' => 'margin-top: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'even_items_padding_top',
			[
				'label' => esc_html__( "Padding Top (Even)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'em' => [
						'min' => 0,
						'max' => 20,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-wrapper .swiper-slide:nth-child(even) .slider-image' => 'padding-top: {{SIZE}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'even_items_image_height',
			[
				'label' => esc_html__( "Image Height (Even)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'vh' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-wrapper .swiper-slide:nth-child(even) .tm-vertical-image-slider-item .slider-image' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .swiper-wrapper .swiper-slide:nth-child(even) .tm-vertical-image-slider-item .slider-image img' => 'height: {{SIZE}}{{UNIT}}; object-fit: cover;'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_styling',
			[
				'label' => esc_html__( 'Title Styling', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'show_title',
			[
				'label' => esc_html__( "Show Title", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'unique-elementor-addons' ),
				'label_off' => esc_html__( 'No', 'unique-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( "Title Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-vertical-image-slider .slider-title' => 'color: {{VALUE}};'
				],
				'condition' => [
					'show_title' => 'yes'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-vertical-image-slider .slider-title',
				'condition' => [
					'show_title' => 'yes'
				]
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
		wp_enqueue_style( 'tm-vertical-image-slider-default', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/vertical-image-slider/vertical-image-slider-default' . $direction_suffix . '.css' );

		$settings['holder_id'] = unique_addons_get_isotope_holder_ID('vertical-image-slider');

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_shortcode_template_part( 'slider', 'vertical', 'vertical-image-slider/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}


