<?php

class Unique_Addons_Column_Handler {
	private static $instance;
	public $sections = array();

	public function __construct() {
		add_action( 'elementor/element/column/layout/after_section_end', array( $this, 'tm_elementor_column_options' ), 10, 2 );
		add_action( 'elementor/element/column/layout/after_section_end', array( $this, 'render_parallax_options' ), 10, 2 );
		add_action( 'elementor/frontend/column/before_render', array( $this, 'section_before_render' ) );
		add_action( 'elementor/frontend/element/before_render', array( $this, 'section_before_render' ) );
	}

	public static function get_instance() {
		if ( self::$instance === null ) {
			return new self();
		}

		return self::$instance;
	}

	public function tm_elementor_column_options( $element ){

		$element->start_controls_section(
			'tm_element_section_title',
			[
				'label' => TM_ELEMENTOR_WIDGET_BADGE . __('TM BG Stretched Options', 'unique-elementor-addons'),
				'tab' => Elementor\Controls_Manager::TAB_LAYOUT,
			]
		);

		$element->add_control(
			'tm_bg_color',
			[
				'label'			=> esc_html__( 'Column Background Color', 'unique-elementor-addons' ),
				'description'	=> esc_html__( 'Pre-defined Background Color for this Column', 'unique-elementor-addons' ),
				'type'			=> Elementor\Controls_Manager::SELECT,
				'default'		=> '',
				'prefix_class'	=> 'tm-bg-color-yes tm-elementor-bg-color-',
				'options' => [
					'' 			=> esc_attr__( 'Transparent', 'unique-elementor-addons' ),
					'white'		=> esc_attr__( 'White', 'unique-elementor-addons' ),
					'light'		=> esc_attr__( 'Light', 'unique-elementor-addons' ),
					'blackish'	=> esc_attr__( 'Blackish', 'unique-elementor-addons' ),
					'globalcolor'	=> esc_attr__( 'Global Color', 'unique-elementor-addons' ),
					'secondary'	=> esc_attr__( 'Secondary Color', 'unique-elementor-addons' ),
					'gradient'	=> esc_attr__( 'Gradient Color', 'unique-elementor-addons' ),
				],
			]
		);

		$element->add_control(
			'tm_text_color',
			[
				'label'			=> esc_html__( 'Column Text Color', 'unique-elementor-addons' ),
				'description'	=> esc_html__( 'Pre-defined Text Color in this Column', 'unique-elementor-addons' ),
				'type'			=> Elementor\Controls_Manager::SELECT,
				'default'		=> '',
				'prefix_class'	=> 'tm-text-color-',
				'options' => [
					'' 			=> __( 'Default', 'unique-elementor-addons' ),
					'white'		=> __( 'White', 'unique-elementor-addons' ),
					'blackish'	=> __( 'Blackish', 'unique-elementor-addons' ),
				],
			]
		);

		$element->add_control(
			'tm-bg-image-color-order',
			[
				'label'			=> esc_attr__( 'BG Image - BG Color Order', 'unique-elementor-addons' ),
				'description'	=> esc_attr__( 'You can show BG image over BG Color or reverse too.', 'unique-elementor-addons' ),
				'type'			=> 'tm_imgselect',
				'label_block'	=> true,
				'thumb_width'	=> '110px',
				'default'		=> 'none',
				'prefix_class'	=> 'tm-bg-',
				'default'		=> 'color-over-image',
				'options'		=> [
                    'image-over-color'  => UNIQUE_ADDONS_ASSETS_URI . '/section-col-stretch/elementor/img-over-color.png',
                    'color-over-image'  => UNIQUE_ADDONS_ASSETS_URI . '/section-col-stretch/elementor/color-over-img.png',
				],
			]
		);

		$element->end_controls_section();
	}


	public function render_parallax_options( $section, $args ) {
		$section->start_controls_section(
			'tm_core_options',
			[
				'label' => TM_ELEMENTOR_WIDGET_BADGE . esc_html__( 'Unique Addons - Core Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_LAYOUT,
			]
		);
		$section->add_responsive_control(
			'tm_section_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} > .elementor-widget-wrap' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$section->add_responsive_control(
			'tm_section_appear_animation',
			[
				'label' => esc_html__( "Appear Animation", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'' =>  esc_html__( 'No Animation', 'unique-elementor-addons' ),
					'tm-item-appear-clip-path'  =>  esc_html__( 'Clip Path Animation', 'unique-elementor-addons' ),
					'tm-appear-block-holder'  =>  esc_html__( 'Block Clip Path Animation', 'unique-elementor-addons' ),
				],
			]
		);
		$section->add_control(
			'tm_section_appear_animationbg_theme_colored1',
			[
				'label' => esc_html__( "Color1", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'tm_section_appear_animation' => array('tm-appear-block-holder')
				],
				'selectors' => [
					'{{WRAPPER}}.tm-appear-block-holder:before' => 'background-color: {{VALUE}};'
				],
			]
		);
		$section->add_control(
			'tm_section_appear_animationbg_theme_colored2',
			[
				'label' => esc_html__( "Color2", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'tm_section_appear_animation' => array('tm-appear-block-holder')
				],
				'selectors' => [
					'{{WRAPPER}}.tm-appear-block-holder:after' => 'background-color: {{VALUE}};'
				],
			]
		);
		$section->end_controls_section();





		//Stretched BG
		$section->start_controls_section(
			'stretched_bg',
			[
				'label' => TM_ELEMENTOR_WIDGET_BADGE . esc_html__( 'Unique Addons - Stretched BG', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_LAYOUT,
			]
		);
		$section->add_control(
			'stretched_bg_direction',
			[
				'label'        => esc_html__( 'Stretched Background Direction', 'unique-elementor-addons'),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options' => [
					'no'    => esc_html__( 'No', 'unique-elementor-addons' ),
					'tm-stretched-bg-both'  => esc_html__( 'Both', 'unique-elementor-addons' ),
					'tm-stretched-bg-left'  => esc_html__( 'Left', 'unique-elementor-addons' ),
					'tm-stretched-bg-right' => esc_html__( 'Right', 'unique-elementor-addons' )
				],
			]
		);
		$section->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'stretched_bg_image_opt',
				'label' => esc_html__('Stretched Background Image', 'unique-elementor-addons'),
				'types' => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .tm-stretched-bg',
				'condition' => [
					'stretched_bg_direction' => array('tm-stretched-bg-both', 'tm-stretched-bg-left', 'tm-stretched-bg-right')
				]
			]
		);
		$section->add_responsive_control(
			'stretched_bg_theme_color',
			[
				'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'condition' => [
					'stretched_bg_direction' => array('tm-stretched-bg-both', 'tm-stretched-bg-left', 'tm-stretched-bg-right')
				],
				'selectors' => [
					'{{WRAPPER}} .tm-stretched-bg' => 'background-color: var(--theme-color{{VALUE}});',
					'[data-col-id="elementor-element-{{ID}}"].tm-stretched-bg' => 'background-color: var(--theme-color{{VALUE}});',
					'.elementor-edit-area-active .elementor-element-{{ID}}' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$section->add_control(
			'stretched_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'stretched_bg_direction' => array('tm-stretched-bg-both', 'tm-stretched-bg-left', 'tm-stretched-bg-right')
				]
			]
		);
		$section->add_control(
			'stretched_bg_custom_css_class',
			[
				'label' => esc_html__( "Stretched Background Custom CSS class", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'stretched_bg_direction' => array('tm-stretched-bg-both', 'tm-stretched-bg-left', 'tm-stretched-bg-right')
				]
			]
		);
		$section->add_control(
			'stretched_bg_style',
			[
				'label' => esc_html__( "Stretched Background Custom Inline CSS", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description" => esc_html__( "Example: background-color: #f1f1f1;", 'unique-elementor-addons' ),
				'condition' => [
					'stretched_bg_direction' => array('tm-stretched-bg-both', 'tm-stretched-bg-left', 'tm-stretched-bg-right')
				]
			]
		);
		$section->end_controls_section();
	}

	public function section_before_render( $widget ) {
		$data     = $widget->get_data();
		$type     = isset( $data['elType'] ) ? $data['elType'] : 'section';
		$settings = $data['settings'];

		if ( 'column' === $type ) {
			if ( isset( $settings['tm_section_appear_animation'] ) && $settings['tm_section_appear_animation'] != '' ) {
				$widget->add_render_attribute( '_wrapper', 'class', $settings['tm_section_appear_animation'] );
			}




			//Stretched BG
			if ( isset( $settings['stretched_bg_direction'] ) ) {
				$output= '';
				if ( $settings['stretched_bg_direction'] != 'no' ) {
					$stretched_bg_classes = array();
					$stretched_bg_classes[] = $settings['stretched_bg_direction'];
					if( empty($settings['stretched_bg_custom_css_class']) ) {
						$settings['stretched_bg_custom_css_class'] = '';
					}
					$stretched_bg_classes[] = $settings['stretched_bg_custom_css_class'];
					//$stretched_bg_classes[] = 'bg-theme-colored' . $settings['stretched_bg_theme_color'];
					$stretched_bg_inline_css = '';
					if( isset( $settings['stretched_bg_color'] ) && !empty( $settings['stretched_bg_color'] ) ) {;
						$stretched_bg_inline_css .= 'background-color: '.$settings['stretched_bg_color'].' !important;';
					}
					if( isset( $settings['stretched_bg_style'] ) && !empty( $settings['stretched_bg_style'] ) ) {;
						$stretched_bg_inline_css .= $settings['stretched_bg_style'];
					}
					$output .= '<div data-col-id="elementor-element-'. esc_attr($data['id']).'" class="tm-stretched-bg '. esc_attr(implode(' ', $stretched_bg_classes)).'" style="'. esc_attr($stretched_bg_inline_css).'"></div>';
				}
				unique_addons_print_template_html( $output );
			}
		}
	}
}

if ( ! function_exists( 'unique_addons_init_column_handler' ) ) {
	function unique_addons_init_column_handler() {
		Unique_Addons_Column_Handler::get_instance();
	}

	// Priority 20 ensures it runs after plugin initialization (priority 5) and theme framework (priority 10)
	add_action( 'init', 'unique_addons_init_column_handler', 20 );
}