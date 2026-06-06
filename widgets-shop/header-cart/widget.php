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
class TM_Elementor_Header_Cart extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-header-cart', UNIQUE_ADDONS_ASSETS_URI . '/css/woo/header-cart' . $direction_suffix . '.css', array(), UNIQUE_ADDONS_VERSION );
		wp_enqueue_style( 'tm-header-cart' );
		wp_enqueue_script('tm-header-cart', UNIQUE_ADDONS_ASSETS_URI . '/js/woo/header-cart.js', array('jquery'), UNIQUE_ADDONS_VERSION, true);
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
		return 'uae-header-cart';
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
		return esc_html__( 'Header Cart', 'unique-elementor-addons' );
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
		return 'uae-elementor-widget-icon';
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
		return [ 'unique-addons-elementor', 'tm-header-cart' ];
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
            'cart_count_style',
            [
                'label' => esc_html__('General', 'unique-elementor-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
        	'search_dropdown_content_style',
            [
                'label'   => esc_html__('Dropdown Content Style', 'unique-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style-dropdown',
                'options' => [
                    'style-dropdown' => esc_html__('Dropdown', 'unique-elementor-addons'),
                    'style-no-dropdown' => esc_html__('No Dropdown Content', 'unique-elementor-addons'),
                    'style-side-panel'    => esc_html__('Side Panel', 'unique-elementor-addons'),
                ],
                'prefix_class'	=> 'tm-header-search-content-',
            ]
        );
        $this->add_control(
            'show_price',
            [
                'label' => esc_html__( 'Hide Price', 'unique-elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class'	=> 'hide-cart-price-'
            ]
        );
        $this->add_control(
            'show_count',
            [
                'label' => esc_html__( 'Hide Count Items Label', 'unique-elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class'	=> 'hide-cart-count-',
                'default' => 'yes'
            ]
        );
        $this->add_control(
            'show_mini_count',
            [
                'label' => esc_html__( 'Hide Mini Count', 'unique-elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class'	=> 'hide-cart-mini-count-'
            ]
        );
        $this->add_control(
            'show_dropdown',
            [
                'label' => esc_html__( 'Hide Dropdown', 'unique-elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class'	=> 'hide-cart-dropdown-'
            ]
        );
		$this->add_responsive_control(
			'cart_alignment',
			[
				'label' => esc_html__('Cart Alignment', 'unique-elementor-addons'),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'unique-elementor-addons'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'unique-elementor-addons'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'unique-elementor-addons'),
						'icon' => 'eicon-h-align-right',
					],
				],
                'label_block' => false,
                'selectors'   => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
                ]
			]
		);
        $this->end_controls_section();




		$this->start_controls_section(
			'price_text_options',
			[
				'label' => esc_html__( 'Price Text', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_responsive_control(
            'price_text_font_size',
            [
                'label' => esc_html__('Font Size', 'unique-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mini-cart-icon .cart-quick-info' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'count_color',
            [
                'label' => esc_html__('Count Color', 'unique-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mini-cart-icon .cart-quick-info .count' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'price_color',
            [
                'label' => esc_html__('Price Color', 'unique-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mini-cart-icon .cart-quick-info .amount' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_section();





		$this->start_controls_section(
			'mini_cart_options',
			[
				'label' => esc_html__( 'Cart FlatIcon', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'icon_cart_typography',
                'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
                'selector' => '{{WRAPPER}} .mini-cart-icon',
            ]
        );
        $this->add_responsive_control(
            'icon_cart_size',
            [
                'label' => esc_html__('Icon Size', 'unique-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mini-cart-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'mini_cart_color',
			[
				'label' => esc_html__( "Icon Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mini-cart-icon' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'mini_cart_color_hover',
			[
				'label' => esc_html__( "Icon Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .mini-cart-icon' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'mini_cart_theme_colored',
			[
				'label' => esc_html__( "Icon Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mini-cart-icon' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'mini_cart_theme_colored_hover',
			[
				'label' => esc_html__( "Icon Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .mini-cart-icon' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'mini_cart_count_options',
			[
				'label' => esc_html__( 'Mini Count', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'mini_cart_count_bg_options',
			[
				'label' => esc_html__( 'Background Color', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'mini_cart_count_bg_color',
			[
				'label' => esc_html__( "Count BG Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mini-cart-icon .items-count' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'mini_cart_count_bg_color_hover',
			[
				'label' => esc_html__( "Count BG Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .mini-cart-icon .items-count' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'mini_cart_count_bg_theme_colored',
			[
				'label' => esc_html__( "Count BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mini-cart-icon .items-count' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'mini_cart_count_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Count BG Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .mini-cart-icon .items-count' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'mini_cart_count_text_options',
			[
				'label' => esc_html__( 'Text Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'mini_cart_count_color',
			[
				'label' => esc_html__( "Count Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mini-cart-icon .items-count' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'mini_cart_count_color_hover',
			[
				'label' => esc_html__( "Count Text Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .mini-cart-icon .items-count' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'mini_cart_count_theme_colored',
			[
				'label' => esc_html__( "Count Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .mini-cart-icon .items-count' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'mini_cart_count_theme_colored_hover',
			[
				'label' => esc_html__( "Item Count Text Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .mini-cart-icon .items-count' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();



        $this->start_controls_section(
            'wishlist-bg-style',
            [
                'label' => esc_html__('Background', 'unique-elementor-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'icon_bg_size',
            [
                'label'     => esc_html__('Background Size', 'unique-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 20,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .top-nav-mini-cart-icon-contents' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_background_color',
            [
                'label'     => esc_html__('Background Color', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .top-nav-mini-cart-icon-contents' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_background_theme_colored',
            [
                'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .top-nav-mini-cart-icon-contents' => 'background-color: var(--theme-color{{VALUE}});'
                ],
            ]
        );

        $this->add_control(
            'icon_background_color_hover',
            [
                'label'     => esc_html__('Background Color (Hover)', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .top-nav-mini-cart-icon-contents:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_background_theme_colored_hover',
            [
                'label' => esc_html__( "Background Theme Colored (Hover)", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .top-nav-mini-cart-icon-contents:hover' => 'background-color: var(--theme-color{{VALUE}});'
                ],
            ]
        );
		$this->add_responsive_control(
			'icon_background_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .top-nav-mini-cart-icon-contents' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_shortcode_shop_template_part( 'header-cart', null, 'header-cart/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}
