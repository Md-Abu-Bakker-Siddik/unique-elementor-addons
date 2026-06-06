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
class TM_Elementor_Paroller_Animation extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_script( 'jquery-paroller', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/jquery.paroller.min.js', array('jquery'), false, true );
		wp_register_style( 'tm-paroller-style', UNIQUE_ADDONS_ASSETS_URI . '/css/widgets-core/paroller' . $direction_suffix . '.css' );
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
		return 'uae-paroller-animation';
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
		return esc_html__( 'Paroller Animation', 'unique-elementor-addons' );
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
		return [ 'unique-addons-elementor', 'jquery-paroller' ];
	}

	public function get_style_depends() {
		return [ 'tm-paroller-style' ];
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
			'paroller_bg',
			[
				'label' => esc_html__( 'Paroller BG Image & Text Animation', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'paroller_bg_animation',
			[
				'label' => esc_html__( "Enable Paroller Background Animation", 'unique-elementor-addons' ),
				'type'  => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'no'  => esc_html__( 'No', 'unique-elementor-addons' ),
					'yes' => esc_html__( 'Yes', 'unique-elementor-addons' )
				],
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'display_type', [
				'label' => esc_html__( "Animation Type", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'layer-text'  =>  esc_html__( 'Text Layer', 'unique-elementor-addons' ),
					'layer-image' =>  esc_html__( 'Image Layer', 'unique-elementor-addons' ),
					'layer-both'  =>  esc_html__( 'Both Text & Image Layers', 'unique-elementor-addons' ),
				],
				'default' => 'layer-text',
				'condition' => [
					'paroller_bg_animation' => array('yes')
				]
			]
		);
		$this->add_control(
			'paroller_text',
			[
				'label' => esc_html__( "Paroller Parallax Text", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'condition' => [
					'paroller_bg_animation' => array('yes'),
					'display_type' => array('layer-text', 'layer-both'),
				]
			]
		);
		$this->add_control(
			'paroller_image',
			[
				'label' => esc_html__( "Paroller Parallax Image", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'condition' => [
					'paroller_bg_animation' => array('yes'),
					'display_type' => array('layer-image', 'layer-both'),
				]
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'textillate_animation',
			[
				'label' => esc_html__( 'Enable Textillate Text Animation', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'paroller_bg_animation' => array('yes'),
					'display_type' => array('layer-text', 'layer-both'),
				]
			]
		);
		$this->add_control(
			'text_textillate_animation',
			[
				'label' => esc_html__( "Enable Textillate Animation", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'paroller_bg_animation' => array('yes'),
					'display_type' => array('layer-text', 'layer-both'),
				]
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'paroller_styling',
			[
				'label' => esc_html__( 'Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'pos_top',
			[
				'label' => esc_html__( "Top (px or %)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'paroller_bg_animation' => array('yes'),
				],
				'selectors' => [
					'{{WRAPPER}} .tm-paroller-object' => 'top: {{VALUE}};bottom:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'pos_right',
			[
				'label' => esc_html__( "Right (px or %)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'paroller_bg_animation' => array('yes'),
				],
				'selectors' => [
					'{{WRAPPER}} .tm-paroller-object' => 'right: {{VALUE}};left:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'pos_bottom',
			[
				'label' => esc_html__( "Bottom (px or %)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'paroller_bg_animation' => array('yes'),
				],
				'selectors' => [
					'{{WRAPPER}} .tm-paroller-object' => 'bottom: {{VALUE}};top:auto;'
				]
			]
		);
		$this->add_responsive_control(
			'pos_left',
			[
				'label' => esc_html__( "Left (px or %)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'paroller_bg_animation' => array('yes'),
				],
				'selectors' => [
					'{{WRAPPER}} .tm-paroller-object' => 'left: {{VALUE}};right:auto;'
				]
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'paroller_bg_animation' => array('yes'),
					'display_type' => array('layer-text', 'layer-both'),
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'condition' => [
					'paroller_bg_animation' => array('yes'),
					'display_type' => array('layer-text', 'layer-both'),
				],
				'selector' => '{{WRAPPER}} .tm-paroller-text',
			]
		);



		$this->add_control(
			'z_index',
			[
				'label' => esc_html__( "Z Index", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'width',
			[
				'label' => esc_html__( "Container Width", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'height',
			[
				'label' => esc_html__( "Container Height", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$this->add_control(
			'opacity',
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
				'condition' => [
					'paroller_bg_animation' => array('yes'),
				],
				'selectors' => [
					'{{WRAPPER}} .tm-paroller-object' => 'opacity: {{SIZE}};'
				],
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'paroller_conf',
			[
				'label' => esc_html__( 'Paroller Configuration', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'paroller_factor',
			[
				'label' => esc_html__( "Paroller Factor", 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				"description" => esc_html__( "Multiplier for scrolling speed and offset. Example: 0.3", 'unique-elementor-addons' ),
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => -1,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0.3,
				],
				'condition' => [
					'paroller_bg_animation' => array('yes')
				]
			]
		);
		$this->add_control(
			'paroller_type',
			[
				'label'        => esc_html__( 'Paroller Type', 'unique-elementor-addons'),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options' => [
					'foreground'    =>  esc_html__( 'Foreground', 'unique-elementor-addons'),
					'background'    =>  esc_html__( 'Background', 'unique-elementor-addons')
				],
				'default'      => 'foreground',
				'condition' => [
					'paroller_bg_animation' => array('yes')
				]
			]
		);
		$this->add_control(
			'paroller_direction',
			[
				'label'        => esc_html__( 'Paroller Direction', 'unique-elementor-addons'),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options' => [
					'horizontal'   =>  esc_html__( 'Horizontal', 'unique-elementor-addons'),
					'vertical'     =>  esc_html__( 'Vertical', 'unique-elementor-addons')
				],
				'default'      => 'horizontal',
				'condition' => [
					'paroller_bg_animation' => array('yes')
				]
			]
		);
		$this->add_control(
			'paroller_transition',
			[
				'label' => esc_html__( "Paroller Transition", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "CSS transition. Example: transform .3s ease-out", 'unique-elementor-addons' ),
				'condition' => [
					'paroller_bg_animation' => array('yes')
				]
			]
		);
		$this->add_control(
			'paroller_text_custom_css_class',
			[
				'label' => esc_html__( "Parallax Text/Image Custom CSS class", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'paroller_bg_animation' => array('yes')
				]
			]
		);
		$this->add_control(
			'paroller_text_style',
			[
				'label' => esc_html__( "Parallax Text/Image Custom Inline CSS", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Example: color: #f1f1f1; font-size: 120px; line-height: 1; top: 12px; left: 100px", 'unique-elementor-addons' ),
				'condition' => [
					'paroller_bg_animation' => array('yes')
				]
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'stroke_text_style',
			[
				'label' => esc_html__( 'Text Stroke Style', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_stroke_text',
			[
				'label' => esc_html__( "Show Stroke in Text?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);
		$this->add_control(
			'text_stroke_size',
			[
				'label' => esc_html__( 'Text Stroke Size', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 30,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 2,
				],
				'condition' => [
					'show_stroke_text' => array('yes'),
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

		if ( isset( $settings['paroller_bg_animation'] ) ) {
			$output= '';
			if( ! empty( $settings['paroller_text'] ) || ! empty( $settings['paroller_image'] ) ) {
				if( empty($settings['paroller_factor']) ) {
					$settings['paroller_factor'] = 0.3;
				}
				if( empty($settings['paroller_type']) ) {
					$settings['paroller_type'] = 'foreground';
				}
				if( empty($settings['paroller_direction']) ) {
					$settings['paroller_direction'] = 'horizontal';
				}
				if( empty($settings['paroller_transition']) ) {
					$settings['paroller_transition'] = 'transform .3s ease-out';
				}
				if( empty($settings['paroller_text_style']) ) {
					$settings['paroller_text_style'] = '';
				}
				if( empty($settings['paroller_text_custom_css_class']) ) {
					$settings['paroller_text_custom_css_class'] = '';
				}

				$css_array = $this->inline_css( $settings );
				if( $settings['paroller_text_style'] != '' ) {
					$css_array .= $settings['paroller_text_style'];
				}

				$paroller_factor = $settings['paroller_factor']['size'];

				$output .= '<div class="tm-paroller-object '.esc_attr($settings['paroller_text_custom_css_class']).'"
							style="'.esc_attr($css_array).'"
							data-paroller-type="'.$settings['paroller_type'].'"
							data-paroller-factor="'.$paroller_factor.'"
							data-paroller-direction="'.$settings['paroller_direction'].'"
							data-paroller-transition="'.$settings['paroller_transition'].'">';
				$output .= '<div class="tm-paroller-object-wrapper">';

				if( ! empty( $settings['paroller_text'] ) ) {

					if( $settings['text_textillate_animation'] == 'yes' ) {
						wp_enqueue_script( 'jquery-lettering' );
						wp_enqueue_script( 'jquery-textillate' );
						$output .= '<div class="tm-paroller-text tm-textillate-animation">';
					} else {
						$output .= '<div class="tm-paroller-text">';
					}
					$output .= esc_html( $settings['paroller_text'] );
					$output .= '</div>';
				}
				if( ! empty( $settings['paroller_image'] ) ) {
					$image = wp_get_attachment_image_src( $settings['paroller_image']['id'], 'large');
					if( !empty($image[0]) ) {
						$output .= '<div class="tm-paroller-image">';
						$output .= '<img src="'.esc_url( $image[0] ).'" alt="'.esc_attr__( 'Image', 'unique-elementor-addons' ).'">';
						$output .= '</div>';
					}
				}

				$output .= '</div>';
				$output .= '</div>';
			}
			unique_addons_print_template_html( $output );
		}
	}

	/**
	 * Get Wrapper Styles
	 */
	protected function inline_css( $params ) {
		$css_array = array();

		if( !empty($params['paroller_text']) ) {
			if( $params['show_stroke_text'] != 'yes' && $params['title_text_color'] != '' ) {
				$css_array[] = 'color: '.$params['title_text_color'];
			}
		}

		if( $params['z_index'] != '' ) {
			$css_array[] = 'z-index: '.$params['z_index'];
		}
		if( $params['width'] != '' ) {
			$css_array[] = 'width: '.$params['width'];
		}
		if( $params['height'] != '' ) {
			$css_array[] = 'height: '.$params['height'];
		}

		if( $params['show_stroke_text'] == 'yes' && isset($params['title_text_color'])  && $params['title_text_color'] != '' ) {
			$css_array[] = 'color: transparent';
			$css_array[] = '-webkit-text-stroke: '.$params['text_stroke_size']['size'].'px '.$params['title_text_color'];
		}

		$css_array = implode( '; ', $css_array ).';';

		return $css_array;
	}
}
