<?php
namespace UniqueAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Floating_Objects extends Widget_Base {
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
		return 'uae-floating-objects';
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
		return esc_html__( 'Floating Objects', 'unique-elementor-addons' );
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
		$this->add_control(
			'visible_mobile',
			[
				'label' => esc_html__( "Visible on Mobile Devices?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);





		$repeater = new \Elementor\Repeater();
		//image
		$repeater->add_control(
			'image', [
				'label' => esc_html__( "Floating Image", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);




		$repeater->add_control(
			'logo_filter_options',
			[
				'label' => esc_html__( 'Filter Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$repeater->add_control(
			'logo_filter_white',
			[
				'label' => esc_html__( 'Filter Logo to White', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'filter:brightness(0) invert(1);',
				],
			]
		);
		$repeater->add_control(
			'logo_filter_black',
			[
				'label' => esc_html__( 'Filter Logo to Black', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'filter:brightness(0) invert(0);',
				],
			]
		);

		$repeater->add_control(
			'gsap_scrolling_effect',
			[
				'label' => esc_html__( "GSAP Scrolling Effect", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' => esc_html__('None', 'unique-elementor-addons'),
					'parallax' => esc_html__('GSAP Parallax', 'unique-elementor-addons'),
				],
				'default' => ''
			]
		);
		$repeater->add_control(
			'gsap_motion_animation_popover_toggle',
			[
				'label' => esc_html__( 'GSAP Motion Animation', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
				'label_off' => esc_html__( 'Default', 'unique-elementor-addons' ),
				'label_on' => esc_html__( 'Custom', 'unique-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'gsap_scrolling_effect' => array('parallax')
				]
			]
		);
		$repeater->start_popover();
		$repeater->add_responsive_control(
			'gsap_motion_x',
			[
				'label' => esc_html__( "X", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => ''
			]
		);
		$repeater->add_responsive_control(
			'gsap_motion_y',
			[
				'label' => esc_html__( "Y", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => ''
			]
		);
		$repeater->add_responsive_control(
			'gsap_motion_rotate',
			[
				'label' => esc_html__( "Rotate", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => ''
			]
		);
		$repeater->add_responsive_control(
			'gsap_motion_scale',
			[
				'label' => esc_html__( "Scale", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => ''
			]
		);
		$repeater->add_responsive_control(
			'gsap_motion_opacity',
			[
				'label' => esc_html__( 'Opacity', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0,
						'step' => 0.01,
					],
				]
			]
		);
		$repeater->end_popover();



		$repeater->add_control(
			'image_clip_path_animation',
			[
				'label' => esc_html__( "Clip Path Appear Animation", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' =>  esc_html__( 'No Animation', 'unique-elementor-addons' ),
					'tm-item-appear-clip-path'  =>  esc_html__( 'Clip Path Animation', 'unique-elementor-addons' ),
					'tm-item-appear-clip-path-right'  =>  esc_html__( 'Clip Path Animation Right to Left', 'unique-elementor-addons' ),
					'tm-appear-block-holder'  =>  esc_html__( 'Block Clip Path Animation', 'unique-elementor-addons' ),
				],
			]
		);
		$repeater->add_control(
			'animation_type', [
				'label' => esc_html__( "Floating Animation Type", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_get_animation_type(),
				'default' => 'tm-animation-floating'
			]
		);
		$repeater->add_control(
			'pos_orientation_options',
			[
				'label' => esc_html__( 'Orientation', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$repeater->add_responsive_control(
			'pos_orientation_vertical',
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
		$repeater->add_responsive_control(
			'pos_orientation_offset_y',
			[
				'label' => __( 'Offset', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -700,
						'max' => 700,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' =>
							'{{pos_orientation_vertical.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_responsive_control(
			'pos_orientation_horizontal',
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
		$repeater->add_responsive_control(
			'pos_orientation_offset_x',
			[
				'label' => __( 'Offset', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -700,
						'max' => 700,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' =>
							'{{pos_orientation_horizontal.VALUE}}: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$repeater->add_control(
			'dimension_options',
			[
				'label' => esc_html__( 'Dimension Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$repeater->add_responsive_control(
			'custom_image_size',
			[
				'label' => esc_html__( "Image Custom Size", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 800,
						'step' => 1,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-size: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$repeater->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Container Width', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 800,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Container Height', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px', '%', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 130,
					],
					'px' => [
						'min' => 1,
						'max' => 800,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater->add_responsive_control(
			'z_index',
			[
				'label' => esc_html__( "Z Index", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'separator' => 'before',
			]
		);
		$repeater->add_responsive_control(
			'image_opacity',
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
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'opacity: {{SIZE}};',
				],
			]
		);
		$repeater->add_control(
			'image_custom_css_class',
			[
				'label' => esc_html__( "Image Custom CSS class", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'image_inline_style',
			[
				'label' => esc_html__( "Image Custom Inline CSS", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Example: top: 12px; left: 100px;", 'unique-elementor-addons' ),
			]
		);


		$this->add_control(
			'floating_objects_array',
			[
				'label' => esc_html__( "Floating Objects", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
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
		$html = '';
		//classes
		$classes = array();
		$classes[] = 'uae-floating-objects';
		$classes[] = $settings['custom_css_class'];
		if ( $settings['visible_mobile'] != 'yes' ) {
			$classes[] = 'd-none d-lg-block';
		}
		$settings['classes'] = $classes;
	?>
		<div class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<?php
		if ( $settings['floating_objects_array'] ) {
			$settings['iter'] = 1;
			foreach (  $settings['floating_objects_array'] as $item ) {
				$item['wrapper_inline_css'] = $this->inline_css( $item );
				$iter = $settings['iter']++;

				$img_classes = array();
				$img_classes[] = 'each-object elementor-repeater-item-' . $item['_id'];
				$img_classes[] = $item['image_clip_path_animation'];
				$img_classes[] = $item['animation_type'];
				$img_classes[] = $item['image_custom_css_class'];
				$item['img_classes'] = $img_classes;


				if($item['gsap_scrolling_effect'] === 'parallax') {
					wp_enqueue_script( 'gsap' );
					wp_enqueue_script( 'gsap-scrolltrigger' );
					wp_enqueue_script( 'tm-gsap-parallax' );
					$parallax_params = [
							'x' => $item['gsap_motion_x'],
							'y' => $item['gsap_motion_y'],
							'scale' => $item['gsap_motion_scale'],
							'rotate' => $item['gsap_motion_rotate'],
							'opacity' => $item['gsap_motion_opacity']['size'],
					];
					$item['parallax_params'] = json_encode($parallax_params);
				}
				//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
				$html .= unique_addons_get_widgetcore_template_part( 'floating-objects', null, 'floating-objects/tpl', $item, true );
			}
		}
		unique_addons_print_template_html( $html );
	?>
		</div>
	<?php
	}

	/**
	 * Get Wrapper Styles
	 */
	protected function inline_css( $params ) {
		$css_array = array();

		if( $params['image'] != '' ) {
			$image = wp_get_attachment_image_src( $params['image']['id'], 'full');
			if( $image !== false ) {
				$css_array[] = 'background-image: url('.$image[0].')';
			}
		}
		if( !empty($params['z_index']) ) {
			$css_array[] = 'z-index: '.$params['z_index'];
		}

		$css_array = implode( '; ', $css_array ).';';

		if( $params['image_inline_style'] != '' ) {
			$css_array .= $params['image_inline_style'];
		}
		return $css_array;
	}
}
