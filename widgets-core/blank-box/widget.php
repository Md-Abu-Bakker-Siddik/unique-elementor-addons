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
class TM_Elementor_Blank_Box extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-blank-box-style', UNIQUE_ADDONS_ASSETS_URI . '/css/widgets-core/blank-box' . $direction_suffix . '.css' );
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
		return 'uae-blank-box';
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
		return esc_html__( 'TM - Blank Box', 'unique-elementor-addons' );
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
		return [ 'tm-blank-box-style' ];
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
		$repeater->add_control(
			'animation_type', [
				'label' => esc_html__( "Floating Animation Type", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_get_animation_type(),
				'default' => ''
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
						'max' => 1900,
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
						'max' => 1200,
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
		$repeater->add_control(
			'pos_orientation_options',
			[
				'label' => esc_html__( 'Shape Orientation', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_responsive_control(
			'pos_orientation_top',
			[
				'label' => __( 'Top', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -1700,
						'max' => 1700,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:after' =>
							'top: {{SIZE}}{{UNIT}};',
				],
				'default' => [
					'unit' => 'px',
					'size' => '0',
				],
			]
		);
		$repeater->add_responsive_control(
			'pos_orientation_bottom',
			[
				'label' => __( 'Bottom', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -1700,
						'max' => 1700,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:after' =>
							'bottom: {{SIZE}}{{UNIT}};',
				],
				'default' => [
					'unit' => 'px',
					'size' => '0',
				],
			]
		);
		$repeater->add_responsive_control(
			'pos_orientation_Left',
			[
				'label' => __( 'Left', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -1700,
						'max' => 1700,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:after' =>
							'Left: {{SIZE}}{{UNIT}};',
				],
				'default' => [
					'unit' => 'px',
					'size' => '0',
				],
			]
		);
		$repeater->add_responsive_control(
			'pos_orientation_right',
			[
				'label' => __( 'Right', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'min' => -1700,
						'max' => 1700,
						'step' => 1,
					],
					'%' => [
						'min' => -150,
						'max' => 150,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:after' =>
							'right: {{SIZE}}{{UNIT}};',
				],
				'default' => [
					'unit' => 'px',
					'size' => '0',
				],
			]
		);
		$repeater->add_control(
			'box_rotate',
			[
				'label' => esc_html__( 'Rotate Shape', 'unique-elementor-addons' ),
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
					'{{WRAPPER}} {{CURRENT_ITEM}}:after' => 'transform: rotate({{SIZE}}deg);',
					'{{WRAPPER}} {{CURRENT_ITEM}}:after' => '-ms-transform: rotate({{SIZE}}deg);',
					'{{WRAPPER}} {{CURRENT_ITEM}}:after' => '-webkit-transform: rotate({{SIZE}}deg);',
				],
			]
		);


		$repeater->add_responsive_control(
			'z_index',
			[
				'label' => esc_html__( "Z Index", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:after' => 'z-index: {{VALUE}};',
				],
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
					'{{WRAPPER}} {{CURRENT_ITEM}}:after' => 'opacity: {{SIZE}};',
				],
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_background',
				'label' => esc_html__( 'Background', 'unique-elementor-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}:after',
				'separator' => 'before',
			]
		);
		$repeater->add_control(
			'box_bg_theme_colored',
			[
				'label' => esc_html__( "BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:after' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$repeater->add_control(
			'box_wrapper_border_options',
			[
				'label' => esc_html__( 'Border Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$repeater->add_responsive_control(
			'box_wrapper_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_wrapper_boxshadow',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}:after',
			]
		);
		$repeater->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}:after',
			]
		);
		$repeater->add_control(
			'box_wrapper_border_theme_colored',
			[
				'label' => esc_html__( "Border Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}:after' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);


		$this->add_control(
			'blank_box_array',
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
		$classes[] = 'uae-blank-box';
		$classes[] = $settings['custom_css_class'];
		if ( $settings['visible_mobile'] != 'yes' ) {
			$classes[] = 'd-none d-lg-block';
		}
		$settings['classes'] = $classes;
	?>
		<div class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
	<?php
		if ( $settings['blank_box_array'] ) {
			$settings['iter'] = 1;
			foreach (  $settings['blank_box_array'] as $item ) {
				$iter = $settings['iter']++;

				$img_classes = array();
				$img_classes[] = 'each-object elementor-repeater-item-' . $item['_id'];
				$img_classes[] = $item['animation_type'];
				$item['img_classes'] = $img_classes;
				//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
				$html .= unique_addons_get_widgetcore_template_part( 'blank-box', null, 'blank-box/tpl', $item, true );
			}
		}
		unique_addons_print_template_html( $html );
	?>
		</div>
	<?php
	}
}
