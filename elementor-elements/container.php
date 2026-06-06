<?php

class Unique_Addons_Container_Handler {
    private static $instance;
    public $sections = array();

    public function __construct() {
        add_action('elementor/editor/before_enqueue_scripts', array( $this, 'tm_elementor_enqueue_base_scripts' ));
        add_action( 'wp_enqueue_scripts', array( $this, 'tm_elementor_enqueue_front_scripts' ) );
        add_action( 'elementor/controls/controls_registered', array( $this, 'tm_elementor_init_controls' ));
        add_action( 'elementor/element/container/section_layout/after_section_end', array( $this, 'extend_elementor_section_options' ), 10, 2 );
        add_action( 'elementor/element/container/section_layout/after_section_end', array( $this, 'extend_elementor_gsap_scroll_fixed_options' ), 10, 2 );
        add_action( 'elementor/element/container/section_layout/after_section_end', array( $this, 'render_core_options' ), 10, 2 );
        add_action( 'elementor/element/common/section_layout/after_section_end', array( $this, 'render_core_options' ), 10, 2 );
        //add_action( 'elementor/element/container/section_layout/after_section_end', array( $this, 'register_controls_section_bg_box' ), 10, 2 );
        add_action( 'elementor/element/container/section_layout/after_section_end', array( $this, 'register_controls_custom_width' ), 10, 2 );
        add_action( 'elementor/element/container/section_layout/after_section_end', array( $this, 'register_controls_equal_height' ), 10, 2 );
        add_action( 'elementor/element/container/section_layout/after_section_end', array( $this, 'other_options' ), 10, 2 );
        add_action( 'elementor/element/container/section_layout/after_section_end', array( $this, 'bg_move_effect_options' ), 10, 2 );
        add_action( 'elementor/element/container/section_layout/after_section_end', array( $this, 'render_curve_bg_options' ), 10, 2 );
        add_action( 'elementor/frontend/container/before_render', array( $this, 'section_before_render' ) );
        add_action( 'elementor/frontend/before_render', array( $this, 'section_before_render' ) );
        add_action( 'elementor/frontend/container/before_render', [ $this, 'equal_height_before_render' ] );
        add_action( 'elementor/frontend/container/before_render', [ $this, 'other_options_before_render' ] );
        add_action( 'elementor/frontend/container/before_render', [ $this, 'bg_move_effect_options_before_render' ] );
		add_action('elementor/frontend/before_render', [$this, 'tm_gsap_before_section_render'], 3);
    }

    public static function get_instance() {
        if ( self::$instance === null ) {
            return new self();
        }

        return self::$instance;
    }

    public function tm_elementor_enqueue_base_scripts(){
        wp_enqueue_script( 'tm-elementor-base', UNIQUE_ADDONS_ASSETS_URI . '/section-col-stretch/tm-stretch-base.js' );
    }

    public function tm_elementor_enqueue_front_scripts(){
        wp_enqueue_script( 'tm-elementor-script', UNIQUE_ADDONS_ASSETS_URI . '/section-col-stretch/tm-stretch.js' );
        wp_enqueue_style( 'tm-elementor-style', UNIQUE_ADDONS_ASSETS_URI . '/section-col-stretch/tm-stretch.css' );
        if ( defined('ELEMENTOR_VERSION') && \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
            wp_enqueue_script(  'tm-elementor-frontview', UNIQUE_ADDONS_ASSETS_URI . '/section-col-stretch/elementor-frontview.js' );
        }
    }



    //add new control type
    public function tm_elementor_init_controls() {
        require_once( 'controls/control-tm-imgselect.php' );
        if ( class_exists( 'DSVY_imgselect' ) ) {
            \Elementor\Plugin::$instance->controls_manager->register_control( 'tm_imgselect', new DSVY_imgselect() );
        }
    }

    public function tm_gsap_before_section_render($element)
	{
		$gsap_scroll_fixed = $element->get_settings_for_display('gsap_scroll_fixed');
		$gsap_scroll_fixed_stop_under = $element->get_settings_for_display('gsap_scroll_fixed_stop_under');

		if (
			($gsap_scroll_fixed && !empty($gsap_scroll_fixed)) || ($gsap_scroll_fixed_stop_under && !empty($gsap_scroll_fixed_stop_under))
		) {
			$element->add_render_attribute(
				'_wrapper',
				[
					'class' => [$gsap_scroll_fixed],
                    'data-stop-under' => [$gsap_scroll_fixed_stop_under]
				]
			);
		}
	}

    //for extending elementor sections
    public function extend_elementor_gsap_scroll_fixed_options( $element ){

        $element->start_controls_section(
            'tm_element_gsap_scroll_fixed_section',
            [
                'label' => TM_ELEMENTOR_WIDGET_BADGE . __('TM GSAP Pin Scroll Fixed', 'unique-elementor-addons'),
                'tab' => Elementor\Controls_Manager::TAB_LAYOUT,
            ]
        );
		$element->add_control(
			'gsap_scroll_fixed',
			[
				'label'     => __('Pin Scroll Fixed', 'unique-elementor-addons'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options'   => [
					'' => __('Default', 'unique-elementor-addons'),
					'gsap-pin-fixed-boxed' 	=> __('Enable For Boxed Parent Container', 'unique-elementor-addons'),
					'gsap-pin-fixed-fullwidth' 	=> __('Enable For Fullwidth Parent Container', 'unique-elementor-addons')
				],
				'default'   => '',
			]
		);
		$element->add_control(
			'gsap_scroll_fixed_start_at',
			[
				'label' => esc_html__( 'Start at (e.g. 200)', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => -1000,
				'max' => 1000,
				'step' => 2,
                'prefix_class' => 'start-',
                'condition' => [
                    'gsap_scroll_fixed' => ['gsap-pin-fixed-boxed', 'gsap-pin-fixed-fullwidth']
                ]
			]
		);
        $element->add_control(
			'gsap_scroll_fixed_responsive_condition',
			[
				'label' => esc_html__('Responsive Condition', 'unique-elementor-addons'),
				'type'  => \Elementor\Controls_Manager::HEADING,
				'classes' => 'rs-control-type-heading',
                'condition' => [
                    'gsap_scroll_fixed' => ['gsap-pin-fixed-boxed', 'gsap-pin-fixed-fullwidth']
                ]
			]
		);
        $element->add_control(
			'gsap_scroll_fixed_stop_under',
			[
				'label'     => __('Stop Under Devices', 'unique-elementor-addons'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'label_block' => true,
				'options'   => [
					'' => __('None', 'unique-elementor-addons'),
					'laptop' 	=> __('Laptop', 'unique-elementor-addons'),
					'tablet' 	=> __('Tablet', 'unique-elementor-addons'),
					'mobile' 	=> __('Mobile', 'unique-elementor-addons'),
				],
				'default'   => 'mobile',
                'condition' => [
                    'gsap_scroll_fixed' => ['gsap-pin-fixed-boxed', 'gsap-pin-fixed-fullwidth']
                ]
			]
		);
        $element->end_controls_section();
    }

    //for extending elementor sections
    public function extend_elementor_section_options( $element ){

        $element->start_controls_section(
            'tm_element_section_title',
            [
                'label' => TM_ELEMENTOR_WIDGET_BADGE . __('TM BG Stretched Options', 'unique-elementor-addons'),
                'tab' => Elementor\Controls_Manager::TAB_LAYOUT,
            ]
        );

        $element->add_control(
            'tm-extended-column',
            [
                'label'         => esc_attr__( 'Extend Column for background image', 'unique-elementor-addons' ),
                'description'   => esc_attr__( 'Select which column will be extended with background image.', 'unique-elementor-addons' ),
                'type'          => 'tm_imgselect',
                'label_block'   => true,
                'hide_in_inner' => true,
                'thumb_width'   => '110px',
                'default'       => 'none',
                'prefix_class'  => 'tm-col-stretched-',
                'options' => [
                    'none'          => UNIQUE_ADDONS_ASSETS_URI . '/section-col-stretch/elementor/bg-stretched-none.png',
                    'left'          => UNIQUE_ADDONS_ASSETS_URI . '/section-col-stretch/elementor/bg-stretched-first.png',
                    'right'         => UNIQUE_ADDONS_ASSETS_URI . '/section-col-stretch/elementor/bg-stretched-last.png',
                    'both'          => UNIQUE_ADDONS_ASSETS_URI . '/section-col-stretch/elementor/bg-stretched-both.png',
                ],
            ]
        );

        $element->add_control(
            'tm-strech-content-left',
            [
                'label'         => esc_attr__( 'Also stretch left content too?', 'unique-elementor-addons' ),
                'description'   => esc_attr__( 'Also stretch left content too?', 'unique-elementor-addons' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'prefix_class'  => 'tm-left-col-stretched-content-',
                'hide_in_inner' => true,
                'label_on'      => esc_attr__( 'Yes', 'unique-elementor-addons' ),
                'label_off'     => esc_attr__( 'No', 'unique-elementor-addons' ),
                'return_value'  => 'yes',
                'default'       => '',
                'condition'     => [
                    'tm-extended-column' => array('left', 'both'),
                ]
            ]
        );
        $element->add_control(
            'tm-strech-content-right',
            [
                'label'         => esc_attr__( 'Also stretch right content too?', 'unique-elementor-addons' ),
                'description'   => esc_attr__( 'Also stretch right content too?', 'unique-elementor-addons' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'prefix_class'  => 'tm-right-col-stretched-content-',
                'hide_in_inner' => true,
                'label_on'      => esc_attr__( 'Yes', 'unique-elementor-addons' ),
                'label_off'     => esc_attr__( 'No', 'unique-elementor-addons' ),
                'return_value'  => 'yes',
                'default'       => '',
                'condition'     => [
                    'tm-extended-column' => array('right', 'both'),
                ]
            ]
        );
        $element->add_control(
            'tm-left-margin',
            [
                'label'         => esc_html__( 'Left Content Area Margin', 'unique-elementor-addons' ),
                'description'   => esc_html__( 'This is useful if you like to overlap columns on each other.', 'unique-elementor-addons' ),
                'type'          => Elementor\Controls_Manager::DIMENSIONS,
                'separator'     => 'before',
                'selectors' => [
                    '{{WRAPPER}} .tm-stretched-div.tm-stretched-left' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_control(
            'tm-right-margin',
            [
                'label'         => esc_html__( 'Right Content Area Margin', 'unique-elementor-addons' ),
                'description'   => esc_html__( 'This is useful if you like to overlap columns on each other.', 'unique-elementor-addons' ),
                'type'          => Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tm-stretched-div.tm-stretched-right' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $element->add_control(
            'tm_bg_color',
            [
                'label'         => esc_html__( 'Container Background Color', 'unique-elementor-addons' ),
                'description'   => esc_html__( 'Pre-defined Background Color for this Container (ROW)', 'unique-elementor-addons' ),
                'type'          => Elementor\Controls_Manager::SELECT,
                'default'       => '',
                'separator'     => 'before',
                'prefix_class'  => 'tm-bg-color-yes tm-elementor-bg-color-',
                'options'       => [
                    ''              => esc_attr__( 'Transparent', 'unique-elementor-addons' ),
                    'white'         => esc_attr__( 'White', 'unique-elementor-addons' ),
                    'light'         => esc_attr__( 'Light', 'unique-elementor-addons' ),
                    'blackish'      => esc_attr__( 'Blackish', 'unique-elementor-addons' ),
                    'globalcolor'   => esc_attr__( 'Global Color', 'unique-elementor-addons' ),
                    'secondary'     => esc_attr__( 'Secondary Color', 'unique-elementor-addons' ),
                    'gradient'      => esc_attr__( 'Gradient Color', 'unique-elementor-addons' ),
                ],
            ]
        );

        $element->add_control(
            'tm_text_color',
            [
                'label'         => esc_html__( 'Container Text Color', 'unique-elementor-addons' ),
                'description'   => esc_html__( 'Pre-defined Text Color in this Container (ROW)', 'unique-elementor-addons' ),
                'type'          => Elementor\Controls_Manager::SELECT,
                'default'       => '',
                'prefix_class'  => 'tm-text-color-',
                'options' => [
                    ''          => __( 'Default', 'unique-elementor-addons' ),
                    'white'     => __( 'White', 'unique-elementor-addons' ),
                    'blackish'  => __( 'Blackish', 'unique-elementor-addons' ),
                ],
            ]
        );

        $element->add_control(
            'tm-bg-image-color-order',
            [
                'label'         => esc_attr__( 'BG Image - BG Color Order', 'unique-elementor-addons' ),
                'description'   => esc_attr__( 'You can show BG image over BG Color or reverse too.', 'unique-elementor-addons' ),
                'type'          => 'tm_imgselect',
                'label_block'   => true,
                'thumb_width'   => '110px',
                'default'       => 'none',
                'prefix_class'  => 'tm-bg-',
                'default'       => 'color-over-image',
                'options'       => [
                    'image-over-color'  => UNIQUE_ADDONS_ASSETS_URI . '/section-col-stretch/elementor/img-over-color.png',
                    'color-over-image'  => UNIQUE_ADDONS_ASSETS_URI . '/section-col-stretch/elementor/color-over-img.png',
                ],
            ]
        );

        $element->end_controls_section();
    }

    public function render_core_options( $section, $args ) {
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
                    '{{WRAPPER}}' => 'background-color: var(--theme-color{{VALUE}});'
                ],
            ]
        );
        $section->add_responsive_control(
            'tm_core_content_width',
            [
                'label' => esc_html__( 'Section Custom Width (px)', 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1700,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} > .elementor-container' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} > .elementor-container .elementor-container' => 'max-width: 100% !important;',
                ],
                'condition' => [
                    'layout' => [ 'boxed' ],
                ],
                'separator' => 'before',
            ]
        );
        $section->add_responsive_control(
            'tm_section_bg_overlay_display_type',
            [
                'label' => esc_html__( "BG Overlay Display Type", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'block' =>  esc_html__( "Show", 'unique-elementor-addons' ),
                    'none'  =>  esc_html__( "Hide", 'unique-elementor-addons' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} > .elementor-background-overlay' => 'display: {{VALUE}};'
                ],
            ]
        );

        $section->add_control(
            'tm_section_appear_animation_heading',
            [
                'label' => esc_html__( 'Clip Path Animation', 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $section->add_control(
            'tm_section_appear_animation',
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
        $section->add_control(
            'tm_section_wow_appear_animation_heading',
            [
                'label' => esc_html__( 'Wow Animation', 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $section->add_control(
            'tm_section_wow_appear_animation',
            [
                'label' => esc_html__( "Wow Appear Animation", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_animate_css_animation_list(),
            ]
        );
        $section->add_control(
            'tm_section_wow_animate_delay',
            [
                'label' => esc_html__( "Wow Animate Delay(ms or s)", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '0',
                'description' => 'Enter number. Default 0ms',
                'condition' => [
                    'tm_section_wow_appear_animation!' => ''
                ],
            ]
        );


        $section->add_control(
            'activate_text_gradient_background_fill', [
                'label' => esc_html__( "Activate Gradient BG Fill/Clip?", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
            ]
        );
        $section->add_responsive_control(
            "text_gradient_background_fill", [
                'label' => esc_html__( "Text Gradient Background Fill Effect?", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'block' => [
                        'title' => __( 'Show', 'unique-elementor-addons' ),
                        'icon' => 'eicon-check',
                    ],
                    'none' => [
                        'title' => __( 'Hide', 'unique-elementor-addons' ),
                        'icon' => 'eicon-ban',
                    ],
                ],
                'condition' => [
                    'activate_text_gradient_background_fill' => array('yes')
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' => '-webkit-background-clip: text;-webkit-text-fill-color: transparent;'
                ],
            ]
        );





// Switcher to enable/disable gradient
$section->add_responsive_control(
    'enable_section_area_gradient',
    [
        'label'        => esc_html__( 'Enable Background Gradient', 'unique-elementor-addons' ),
        'type'         => \Elementor\Controls_Manager::SWITCHER,
        'label_on'     => esc_html__( 'On', 'unique-elementor-addons' ),
        'label_off'    => esc_html__( 'Off', 'unique-elementor-addons' ),
        'return_value' => 'yes',
        'default'      => '',
    ]
);

// Gradient dropdown shown only if switch is ON
$section->add_responsive_control(
    'section_area_gradient',
    [
        'label'     => esc_html__( "Background Gradient", 'unique-elementor-addons' ),
        'type'      => \Elementor\Controls_Manager::SELECT,
        'options'   => [
            '' => esc_html__('Default', 'unique-elementor-addons'),
            'linear-gradient(180deg, rgba(17, 17, 17, 0) 9.87%, #6A9337 100%)' => esc_html__('Gradient 1', 'unique-elementor-addons'),
            'linear-gradient(180deg, rgba(38, 149, 117, 0) 0%, rgba(12, 47, 37, 0.9) 45.54%, #0C2F25 75%)' => esc_html__('Gradient 2', 'unique-elementor-addons'),
            'radial-gradient(120.55% 91.44% at 46.38% 0%, rgba(29, 31, 40, 0) 9.54%, #252831 100%)' => esc_html__('Gradient 3', 'unique-elementor-addons'),
            'linear-gradient(90deg, #0C2F25 0%, rgba(12, 47, 37, 0.95) 22.75%, rgba(12, 47, 37, 0.71) 47.92%, rgba(12, 47, 37, 0) 100%)' => esc_html__('Gradient 4', 'unique-elementor-addons'),
            'linear-gradient(180deg, rgba(12, 47, 37, 0) 0%, #0C2F25 100%)' => esc_html__('Gradient 5', 'unique-elementor-addons'),
            'radial-gradient(90.82% 181.47% at 96.65% 24.27%, rgba(29, 31, 40, 0) 25.24%, rgba(29, 31, 40, 0.6) 100%)' => esc_html__('Gradient 6', 'unique-elementor-addons'),

        ],
        'default'   => 'linear-gradient(180deg, rgba(17, 17, 17, 0) 9.87%, #6A9337 100%)',
        'selectors' => [
            '{{WRAPPER}}' => 'background: {{VALUE}};',
        ],
        'condition' => [
            'enable_section_area_gradient' => 'yes',
        ],
    ]
);
$section->add_responsive_control(
    "enable_backdrop_filter", [
        'label' => esc_html__( "Enable Backdrop Filter?", 'unique-elementor-addons' ),
        'type' => \Elementor\Controls_Manager::CHOOSE,
        'options' => [
            'yes' => [
                'title' => __( 'Yes', 'unique-elementor-addons' ),
                'icon' => 'eicon-check',
            ],
            'no' => [
                'title' => __( 'No', 'unique-elementor-addons' ),
                'icon' => 'eicon-ban',
            ],
        ],
        'default' => 'no',
    ]
);
$section->add_responsive_control(
    "backdrop_filter_type",
    [
        'label' => esc_html__( "Backdrop Filter Type", 'unique-elementor-addons' ),
        'type' => \Elementor\Controls_Manager::SELECT,
        'options' => [
            'blur' => esc_html__( 'Blur', 'unique-elementor-addons' ),
            'brightness' => esc_html__( 'Brightness', 'unique-elementor-addons' ),
            'contrast' => esc_html__( 'Contrast', 'unique-elementor-addons' ),
            'grayscale' => esc_html__( 'Grayscale', 'unique-elementor-addons' ),
            'saturate' => esc_html__( 'Saturate', 'unique-elementor-addons' ),
            'none' => esc_html__( 'None', 'unique-elementor-addons' ),
        ],
        'default' => 'blur',
        'condition' => [
            'enable_backdrop_filter' => 'yes',
        ],
    ]
);
$section->add_responsive_control(
    'backdrop_blur_value',
    [
        'label' => esc_html__( 'Blur Amount (px)', 'unique-elementor-addons' ),
        'type' => \Elementor\Controls_Manager::SLIDER,
        'size_units' => ['px'],
        'range' => [
            'px' => [
                'min' => 0,
                'max' => 50,
                'step' => 0.1,
            ],
        ],
        'default' => [
            'unit' => 'px',
            'size' => 5,
        ],
        'condition' => [
            'enable_backdrop_filter' => 'yes',
            'backdrop_filter_type' => 'blur'
        ],
        'selectors' => [
            '{{WRAPPER}}' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
        ],
    ]
);















        $section->end_controls_section();
    }

    public function render_curve_bg_options( $section, $args ) {
        $section->start_controls_section(
            'tm_curve_bg_options',
            [
                'label' => TM_ELEMENTOR_WIDGET_BADGE . esc_html__( 'Unique Addons - Curve BG Options', 'unique-elementor-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_LAYOUT,
            ]
        );
        $section->add_control(
            'tm_curve_bg_enable',
            [
                'label'         => esc_attr__( 'Enable Curve BG?', 'unique-elementor-addons' ),
                'type'          => \Elementor\Controls_Manager::SWITCHER,
                'prefix_class'  => 'tm-curve-cta-',
                'label_on'      => esc_attr__( 'Yes', 'unique-elementor-addons' ),
                'label_off'     => esc_attr__( 'No', 'unique-elementor-addons' ),
                'return_value'  => 'yes',
                'default'       => '',
            ]
        );
        $section->add_control(
            'tm_curve_bg_theme_colored',
            [
                'label' => esc_html__( "Curve BG 1st Theme Colored", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.tm-curve-cta-yes:after' => 'background-color: var(--theme-color{{VALUE}});'
                ],
            ]
        );
        $section->add_control(
            'tm_curve_bg_custom_color',
            [
                'label' => esc_html__( "Curve BG 1st Custom Color", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.tm-curve-cta-yes:after' => 'background-color: {{VALUE}};'
                ],
            ]
        );
        $section->add_responsive_control(
            'tm_curve_bg_custom_width',
            [
                'label' => esc_html__( 'Curve BG 1st Custom Width', 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.tm-curve-cta-yes:after' => 'width: {{SIZE}}%;',
                ],
                'separator' => 'none',
            ]
        );


        $section->add_control(
            'tm_curve_bg_theme_colored2',
            [
                'label' => esc_html__( "Curve BG 2nd Theme Colored", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.tm-curve-cta-yes:before' => 'background-color: var(--theme-color{{VALUE}});'
                ],
            ]
        );
        $section->add_control(
            'tm_curve_bg_custom_color2',
            [
                'label' => esc_html__( "Curve BG 2nd Custom Color", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.tm-curve-cta-yes:before' => 'background-color: {{VALUE}};'
                ],
            ]
        );
        $section->add_responsive_control(
            'tm_curve_bg_custom_width2',
            [
                'label' => esc_html__( 'Curve BG 2nd Custom Width', 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.tm-curve-cta-yes:before' => 'width: {{SIZE}}%;',
                ],
                'separator' => 'none',
            ]
        );
        $section->end_controls_section();
    }

    public function register_controls_custom_width($section, $args) {

        $section->start_controls_section(
            'tm_section_custom_width_controls',
            [
                'label' => TM_ELEMENTOR_WIDGET_BADGE . esc_html__( 'Unique Addons - Container Custom Width', 'unique-elementor-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
            ]
        );
        $section->add_responsive_control(
            'tm_section_custom_width',
            [
                'label' => esc_html__( 'Container Custom Width (px)', 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1600,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
                'separator' => 'none',
            ]
        );
        $section->add_responsive_control(
            'tm_section_custom_margin_auto',
            [
                'label' => esc_html__('Container Left/Right Margin Auto', 'unique-elementor-addons'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'e-auto' => [
                        'title' => esc_html__('Left Auto', 'unique-elementor-addons'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    's-auto' => [
                        'title' => esc_html__('Right Auto', 'unique-elementor-addons'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'm',
            ]
        );
        $section->add_responsive_control(
            'tm_section_content_width',
            [
                'label' => esc_html__( 'Container Inner Custom Width (px)', 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'separator' => 'before',
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1600,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} > .elementor-container' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} > .elementor-container .elementor-container' => 'margin-left: auto !important; margin-right: auto !important;',
                ],
                'separator' => 'none',
            ]
        );
        $section->end_controls_section();

    }

    public function register_controls_equal_height($section, $args) {

        $section->start_controls_section(
            'tm_section_equal_height_controls',
            [
                'label' => TM_ELEMENTOR_WIDGET_BADGE . esc_html__( 'Unique Addons - Equal Height', 'unique-elementor-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
            ]
        );
        $section->add_control(
            'tm_section_equal_height_on',
            [
                'label'        => esc_html__( 'Enable Equal Height', 'unique-elementor-addons' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'description'  => esc_html__( 'You can equal your column/widgets height equal by enable this option.', 'unique-elementor-addons' ),
            ]
        );
        $section->add_control(
            'tm_section_equal_height_selector',
            [
                'label'     => esc_html__( 'Equal Height For', 'unique-elementor-addons' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => [
                    'column'     => 'Columns',
                    'widgets'    => 'Widgets',
                    'widgets_c1' => 'Widgets > Child',
                    'widgets_c2' => 'Widgets > Child > Child',
                    'widgets_c3' => 'Widgets > Child > Child > Child',
                    'custom'     => 'Custom Selector',
                ],
                'default'   => 'widgets',
                'condition' => [
                    'tm_section_equal_height_on' => 'yes',
                ],
            ]
        );
        $section->add_control(
            'tm_section_equal_height_custom_selector',
            [
                'label'       => esc_html__( 'Custom Selector', 'unique-elementor-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => '.class-name',
                'condition'   => [
                    'tm_section_equal_height_on' => 'yes',
                    'tm_section_equal_height_selector' => 'custom',
                ],
            ]
        );
        $section->add_control(
            'tm_section_equal_height_disable_on_tablet',
            [
                'label'        => esc_html__( 'Disable On Tablet', 'unique-elementor-addons' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'no',
                'condition'   => [
                    'tm_section_equal_height_on' => 'yes',
                ],
            ]
        );
        $section->add_control(
            'tm_section_equal_height_disable_on_mobile',
            [
                'label'        => esc_html__( 'Disable On Mobile', 'unique-elementor-addons' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'condition'   => [
                    'tm_section_equal_height_on' => 'yes',
                ],
            ]
        );
        $section->end_controls_section();

    }

    public function other_options( $section, $args ) {
        $section->start_controls_section(
            'tm_other_options',
            [
                'label' => TM_ELEMENTOR_WIDGET_BADGE . esc_html__( 'Unique Addons - Other Options', 'unique-elementor-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_LAYOUT,
            ]
        );
        $section->add_control(
            'tm_four_vertical_line',
            [
                'label' => esc_html__( "Show Four Vertical Lines in Background?", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $section->add_control(
            'tm_small_vertical_line',
            [
                'label' => esc_html__( "Show Smaill Vertical Lines in Background?", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $section->end_controls_section();
    }

    public function bg_move_effect_options( $section, $args ) {
        $section->start_controls_section(
            'tm_bg_move_effect_options',
            [
                'label' => TM_ELEMENTOR_WIDGET_BADGE . esc_html__( 'Unique Addons - BG Gsap Clip Path Effect', 'unique-elementor-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_LAYOUT,
            ]
        );
        $section->add_control(
            'tm_bg_move_effect_enable',
            [
                'label' => esc_html__( "Enable BG Move Effect?", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $section->end_controls_section();
    }

    public function section_before_render( $widget ) {
        $data     = $widget->get_data();
        $type     = isset( $data['elType'] ) ? $data['elType'] : 'container';
        $settings = $data['settings'];

        if ( 'container' === $type || 'widget' === $type ) {
          if ( isset( $settings['tm_section_appear_animation'] ) && $settings['tm_section_appear_animation'] != '' ) {
            $widget->add_render_attribute( '_wrapper', 'class', $settings['tm_section_appear_animation'] );
          }
          if ( isset( $settings['tm_section_wow_appear_animation'] ) && $settings['tm_section_wow_appear_animation'] != '' ) {
            $widget->add_render_attribute( '_wrapper', 'class', 'wow '.$settings['tm_section_wow_appear_animation'] );
            $widget->add_render_attribute( '_wrapper', 'data-wow-delay', $settings['tm_section_wow_animate_delay'] );
          }
        }
    }


    public function equal_height_before_render($section) {
        $settings = $section->get_settings_for_display();
        if( $settings[ 'tm_section_equal_height_on' ] == 'yes' ) {
            wp_enqueue_script( 'matchHeight' );

            $height_option = '';

            if ( 'column' == $settings['tm_section_equal_height_selector']) {
                $height_option = '.e-con-inner';
            }

            if ( 'widgets' == $settings['tm_section_equal_height_selector']) {
                $height_option = '.e-con-inner .elementor-widget > .elementor-widget-container';
            }

            if ( 'widgets_c1' == $settings['tm_section_equal_height_selector']) {
                $height_option = '.e-con-inner .elementor-widget > .elementor-widget-container > div:nth-of-type(1)';
            }

            if ( 'widgets_c2' == $settings['tm_section_equal_height_selector']) {
                $height_option = '.e-con-inner .elementor-widget > .elementor-widget-container > div > div:nth-of-type(1)';
            }

            if ( 'widgets_c3' == $settings['tm_section_equal_height_selector']) {
                $height_option = '.e-con-inner .elementor-widget > .elementor-widget-container > div > div > div:nth-of-type(1)';
            }

            if ( 'custom' == $settings['tm_section_equal_height_selector'] and $settings['tm_section_equal_height_custom_selector']) {
                $height_option = '' . esc_attr($settings['tm_section_equal_height_custom_selector']) ;
            }

            if ($height_option) {
                $section->add_render_attribute( '_wrapper', 'data-tm-equal-height-col', $height_option );

                if (  $settings['tm_section_equal_height_disable_on_tablet'] === 'yes' ) {
                    $section->add_render_attribute( '_wrapper', 'class', 'tm-eqh-disable-on-tablet' );
                }
                if (  $settings['tm_section_equal_height_disable_on_mobile'] === 'yes' ) {
                    $section->add_render_attribute( '_wrapper', 'class', 'tm-eqh-disable-on-mobile' );
                }
            }
        }
    }



    public function other_options_before_render( $section ) {
        $settings = $section->get_settings_for_display();
        if( $settings['tm_four_vertical_line'] == 'yes' ) {
            $section->add_render_attribute( '_wrapper', 'class', 'tm-enable-four-vertical-line' );
        }
        if( $settings['tm_small_vertical_line'] == 'yes' ) {
            $section->add_render_attribute( '_wrapper', 'class', 'tm-one-vertical-line' );
        }
    }
    public function bg_move_effect_options_before_render( $section ) {
        $settings = $section->get_settings_for_display();
        if( $settings['tm_bg_move_effect_enable'] == 'yes' ) {
            $section->add_render_attribute( '_wrapper', 'class', 'tm-enable-bg-move-effect' );
            wp_enqueue_script( 'gsap' );
            wp_enqueue_script( 'gsap-scrolltrigger' );
            wp_enqueue_script( 'tm-gsap-bg-animation' );
        }
    }
}

if ( ! function_exists( 'unique_addons_init_section_handler' ) ) {
    function unique_addons_init_section_handler() {
        Unique_Addons_Container_Handler::get_instance();
    }

    // Priority 20 ensures it runs after plugin initialization (priority 5) and theme framework (priority 10)
    add_action( 'init', 'unique_addons_init_section_handler', 20 );
}