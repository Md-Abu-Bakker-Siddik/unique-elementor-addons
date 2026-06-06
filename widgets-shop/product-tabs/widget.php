<?php
namespace UniqueAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Product_Tabs extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

        wp_register_style( 'tm-product-tabs', UNIQUE_ADDONS_ASSETS_URI . '/css/woo/product-tabs' . $direction_suffix . '.css' );
		wp_register_script( 'tm-product-tabs', UNIQUE_ADDONS_ASSETS_URI . '/js/woo/product-tabs' . $direction_suffix . '.js' );
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
		return 'uae-product-tabs';
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
		return esc_html__( 'TM Product Tabs', 'unique-elementor-addons' );
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
		return [ 'unique-addons-elementor', 'tm-product-tabs', 'slick' ];
	}
	public function get_style_depends() {
		return [ 'tm-product-tabs', 'slick', 'slick-theme' ];
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

        //Section Query
        $this->start_controls_section(
            'section_setting',
            [
                'label' => esc_html__('Settings', 'unique-elementor-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'style_list',
            [
                'label'     => esc_html__('List Style', 'unique-elementor-addons'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 1,
                'options'   => [
                    1 => esc_html__('Style 1', 'unique-elementor-addons'),
                    2 => esc_html__('Style 2', 'unique-elementor-addons'),
                ],
            ]
        );
        $this->add_responsive_control(
            'column',
            [
                'label'          => esc_html__('columns', 'unique-elementor-addons'),
                'type'           => \Elementor\Controls_Manager::SELECT,
                'default'        => 3,
                'options'        => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
            ]
        );
        $this->add_control(
            'image_size',
            [
                'label' => esc_html__( "Choose Image Size", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_get_available_image_sizes(),
                'default' => 'medium',
            ]
        );

        $options_product_type = [
            'recent_products'      => esc_html__( 'Recent products', 'unique-elementor-addons' ),
            'featured_products'    => esc_html__( 'Featured Products', 'unique-elementor-addons' ),
            'top_rated_products'   => esc_html__( 'Top Rated Products', 'unique-elementor-addons' ),
            'sale_products'        => esc_html__( 'Products on Sale', 'unique-elementor-addons' ),
            'best_selling_products'=> esc_html__( 'Best Selling Products', 'unique-elementor-addons' )
        ];

        if (unique_addons_is_elementor_pro_activated()) {
            $options_product_type['ids'] = esc_html__('Product Ids', 'unique-elementor-addons');
        }

        $repeater = new Repeater();
        $repeater->add_control(
            'tab_title',
            [
                'label'       => esc_html__('Tab Title', 'unique-elementor-addons'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('#Product Tab', 'unique-elementor-addons'),
                'placeholder' => esc_html__('Product Tab Title', 'unique-elementor-addons'),
            ]
        );
        $repeater->add_control(
            'product_type',
            [
                'label'   => esc_html__('Product Type', 'unique-elementor-addons'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'recent_products',
                'options' => $options_product_type,
            ]
        );

        if (unique_addons_is_elementor_pro_activated()) {
            $repeater->add_control(
                'product_ids',
                [
                    'label'        => esc_html__('Product ids', 'unique-elementor-addons'),
                    'type'         => \ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
                    'label_block'  => true,
                    'autocomplete' => [
                        'object' => \ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_POST,
                        'query'  => [
                            'post_type' => 'product',
                        ],
                    ],
                    'multiple'     => true,
                    'condition'    => [
                        'product_type' => 'ids'
                    ]
                ]
            );
        }

        $repeater->add_control(
            'limit',
            [
                'label'   => esc_html__('Posts Per Page', 'unique-elementor-addons'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $repeater->add_control(
            'advanced',
            [
                'label'     => esc_html__('Advanced', 'unique-elementor-addons'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    'product_type!' => 'ids'
                ]
            ]
        );

        $repeater->add_control(
            'orderby',
            [
                'label'     => esc_html__('Order By', 'unique-elementor-addons'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'date',
                'options'   => [
                    'date'       => esc_html__('Date', 'unique-elementor-addons'),
                    'id'         => esc_html__('Post ID', 'unique-elementor-addons'),
                    'menu_order' => esc_html__('Menu Order', 'unique-elementor-addons'),
                    'popularity' => esc_html__('Number of purchases', 'unique-elementor-addons'),
                    'rating'     => esc_html__('Average Product Rating', 'unique-elementor-addons'),
                    'title'      => esc_html__('Product Title', 'unique-elementor-addons'),
                    'rand'       => esc_html__('Random', 'unique-elementor-addons'),
                ],
                'condition' => [
                    'product_type!' => 'ids'
                ]
            ]
        );

        $repeater->add_control(
            'order',
            [
                'label'     => esc_html__('Order', 'unique-elementor-addons'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'desc',
                'options'   => [
                    'asc'  => esc_html__('ASC', 'unique-elementor-addons'),
                    'desc' => esc_html__('DESC', 'unique-elementor-addons'),
                ],
                'condition' => [
                    'product_type!' => 'ids'
                ]
            ]
        );

        $repeater->add_control(
            'categories',
            [
                'label'       => esc_html__('Categories', 'unique-elementor-addons'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'options'     => $this->get_product_categories(),
                'label_block' => true,
                'multiple'    => true,
                'condition'   => [
                    'product_type!' => 'ids'
                ]
            ]
        );

        $repeater->add_control(
            'cat_operator',
            [
                'label'     => esc_html__('Category Operator', 'unique-elementor-addons'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'IN',
                'options'   => [
                    'AND'    => esc_html__('AND', 'unique-elementor-addons'),
                    'IN'     => esc_html__('IN', 'unique-elementor-addons'),
                    'NOT IN' => esc_html__('NOT IN', 'unique-elementor-addons'),
                ],
                'condition' => [
                    'categories!' => ''
                ],
            ]
        );

        $repeater->add_control(
            'tag',
            [
                'label'       => esc_html__('Tags', 'unique-elementor-addons'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'options'     => $this->get_product_tags(),
                'multiple'    => true,
                'condition'   => [
                    'product_type!' => 'ids'
                ]
            ]
        );

        $repeater->add_control(
            'tag_operator',
            [
                'label'     => esc_html__('Tag Operator', 'unique-elementor-addons'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'IN',
                'options'   => [
                    'AND'    => esc_html__('AND', 'unique-elementor-addons'),
                    'IN'     => esc_html__('IN', 'unique-elementor-addons'),
                    'NOT IN' => esc_html__('NOT IN', 'unique-elementor-addons'),
                ],
                'condition' => [
                    'tag!' => ''
                ],
            ]
        );
        $this->add_control(
            'tabs',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'tab_title' => esc_html__('Tab 1', 'unique-elementor-addons'),
                    ],
                    [
                        'tab_title' => esc_html__('Tab 2', 'unique-elementor-addons'),
                    ]
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );
        $this->end_controls_section();
        // End Section Query


        $this->add_control_carousel();




        $this->start_controls_section(
            'section_tab_header_style',
            [
                'label' => esc_html__('Tab Wrapper', 'unique-elementor-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'tab_header_padding',
            [
                'label'      => esc_html__('Wrapper Padding', 'unique-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tabs-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'background_tab_header',
            [
                'label'     => esc_html__('Wrapper Background Color', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tabs-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'background_tab_header_theme_colored',
            [
                'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tabs-wrapper' => 'background-color: var(--theme-color{{VALUE}});'
                ],
            ]
        );
        $this->add_control(
            'background_tab_header_theme_colored_hover',
            [
                'label' => esc_html__( "Background Theme Colored (Hover)", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-tabs-wrapper' => 'background-color: var(--theme-color{{VALUE}});'
                ],
            ]
        );

        $this->add_responsive_control(
            'align_items',
            [
                'label'        => esc_html__('Tab Align', 'unique-elementor-addons'),
                'type'         => Controls_Manager::CHOOSE,
                'label_block'  => false,
                'options'      => [
                    'left'   => [
                        'title' => esc_html__('Left', 'unique-elementor-addons'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'unique-elementor-addons'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'unique-elementor-addons'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'      => '',
                'prefix_class' => 'elementor-tabs-h-align-',
                'selectors'    => [
                    '{{WRAPPER}} .elementor-tabs-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'header_margin',
            [
                'label'      => esc_html__('Tab Margin', 'unique-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Each Tab Styling', 'unique-elementor-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tab_typography',
                'selector' => '{{WRAPPER}} .elementor-tab-title',
            ]
        );
        $this->add_responsive_control(
            'tab_title_spacing',
            [
                'label'      => esc_html__('Horizontal Padding', 'unique-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-title' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
                ],
            ]
        );
        $this->add_responsive_control(
            'tab_title_vertical_padding',
            [
                'label'      => esc_html__('Vertical Padding', 'unique-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-title' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_title_style');

        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => esc_html__('Normal', 'unique-elementor-addons'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_color_theme_colored',
            [
                'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title' => 'color: var(--theme-color{{VALUE}});'
                ],
            ]
        );

        $this->add_control(
            'title_background_color',
            [
                'label'     => esc_html__('Background Color', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title' => 'background-color: {{VALUE}};'
                ],
            ]
        );
        $this->add_control(
            'title_background_color_theme_colored',
            [
                'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title' => 'background-color: var(--theme-color{{VALUE}});'
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => esc_html__('Hover', 'unique-elementor-addons'),
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__('Color', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_hover_color_theme_colored',
            [
                'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title:hover' => 'color: var(--theme-color{{VALUE}});'
                ],
            ]
        );
        $this->add_control(
            'title_background_hover_color',
            [
                'label'     => esc_html__('Background Color', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title:hover' => 'background-color: {{VALUE}}'
                ],
            ]
        );
        $this->add_control(
            'title_background_hover_color_theme_colored',
            [
                'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title:hover' => 'background-color: var(--theme-color{{VALUE}});'
                ],
            ]
        );
        $this->add_control(
            'title_hover_border_color',
            [
                'label'     => esc_html__('Border Color', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title:hover' => 'border-color: {{VALUE}}'
                ],
            ]
        );
        $this->add_control(
            'title_hover_border_color_theme_colored',
            [
                'label' => esc_html__( "Border Theme Colored", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title:hover' => 'border-color: var(--theme-color{{VALUE}});'
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_active',
            [
                'label' => esc_html__('Active', 'unique-elementor-addons'),
            ]
        );

        $this->add_control(
            'title_active_color',
            [
                'label'     => esc_html__('Color', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title_active_color_theme_colored',
            [
                'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active' => 'color: var(--theme-color{{VALUE}});'
                ],
            ]
        );
        $this->add_control(
            'title_background_active_color',
            [
                'label'     => esc_html__('Background Color', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'title_background_active_color_theme_colored',
            [
                'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active' => 'background-color: var(--theme-color{{VALUE}});'
                ],
            ]
        );
        $this->add_control(
            'title_active_border_color',
            [
                'label'     => esc_html__('Border Color', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active' => 'border-color: {{VALUE}}!important;'
                ],
            ]
        );
        $this->add_control(
            'title_active_border_color_theme_colored',
            [
                'label' => esc_html__( "Border Theme Colored", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active' => 'border-color: var(--theme-color{{VALUE}});'
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_tabs_title',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-tab-title',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'border_tabs_title_radius',
            [
                'label'      => esc_html__('Border radius', 'unique-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function get_product_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
            )
        );
        $results = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }

        return $results;
    }

    protected function get_product_brands() {
        $brands = get_terms(array(
                'taxonomy'   => 'product_brand',
                'hide_empty' => false,
            )
        );
        $results = array();
        if (!is_wp_error($brands)) {
            foreach ($brands as $brand) {
                $results[$brand->slug] = $brand->name;
            }
        }

        return $results;
    }

    protected function get_product_tags() {
        $tags = get_terms(array(
                'taxonomy'   => 'product_tag',
                'hide_empty' => false,
            )
        );
        $results = array();
        if (!is_wp_error($tags)) {
            foreach ($tags as $tag) {
                $results[$tag->slug] = $tag->name;
            }
        }

        return $results;
    }

    protected function get_carousel_settings($settings) {
        return array(
            'navigation'         => $settings['navigation'],
            'autoplayHoverPause' => $settings['pause_on_hover'] === 'yes' ? true : false,
            'autoplay'           => $settings['autoplay'] === 'yes' ? true : false,
            'autoplayTimeout'    => $settings['autoplay_speed'],
            'items'              => $settings['column'],
            'items_tablet'       => $settings['column_tablet'] ? $settings['column_tablet'] : $settings['column'],
            'items_mobile'       => $settings['column_mobile'] ? $settings['column_mobile'] : 1,
            'loop'               => $settings['infinite'] === 'yes' ? true : false,
        );
    }

    protected function add_control_carousel($condition = array()) {
        $this->start_controls_section(
            'section_carousel_options',
            [
                'label'     => esc_html__('Swiper Slider Options', 'unique-elementor-addons'),
                'type'      => Controls_Manager::SECTION,
                'condition' => $condition,
            ]
        );

        $this->add_control(
            'enable_carousel',
            [
                'label' => esc_html__('Enable', 'unique-elementor-addons'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );


        $this->add_control(
            'navigation',
            [
                'label'     => esc_html__('Navigation', 'unique-elementor-addons'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'dots',
                'options'   => [
                    'both'   => esc_html__('Arrows and Dots', 'unique-elementor-addons'),
                    'arrows' => esc_html__('Arrows', 'unique-elementor-addons'),
                    'dots'   => esc_html__('Dots', 'unique-elementor-addons'),
                    'none'   => esc_html__('None', 'unique-elementor-addons'),
                ],
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label'     => esc_html__('Pause on Hover', 'unique-elementor-addons'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'     => esc_html__('Autoplay', 'unique-elementor-addons'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'     => esc_html__('Autoplay Speed', 'unique-elementor-addons'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5000,
                'condition' => [
                    'autoplay'        => 'yes',
                    'enable_carousel' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
                ],
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label'     => esc_html__('Infinite Loop', 'unique-elementor-addons'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_arrows',
            [
                'label'      => esc_html__('Carousel Arrows', 'unique-elementor-addons'),
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'enable_carousel',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'none',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'dots',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'next_heading',
            [
                'label' => esc_html__('Next button', 'unique-elementor-addons'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'next_vertical',
            [
                'label'       => esc_html__('Next Vertical', 'unique-elementor-addons'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'top'    => [
                        'title' => esc_html__('Top', 'unique-elementor-addons'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'unique-elementor-addons'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ]
            ]
        );

        $this->add_responsive_control(
            'next_vertical_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-next' => 'top: unset; bottom: unset; {{next_vertical.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'next_horizontal',
            [
                'label'       => esc_html__('Next Horizontal', 'unique-elementor-addons'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'  => [
                        'title' => esc_html__('Left', 'unique-elementor-addons'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'unique-elementor-addons'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'defautl'     => 'right'
            ]
        );
        $this->add_responsive_control(
            'next_horizontal_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => -45,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-next' => 'left: unset; right: unset;{{next_horizontal.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'prev_heading',
            [
                'label'     => esc_html__('Prev button', 'unique-elementor-addons'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'prev_vertical',
            [
                'label'       => esc_html__('Prev Vertical', 'unique-elementor-addons'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'top'    => [
                        'title' => esc_html__('Top', 'unique-elementor-addons'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'unique-elementor-addons'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ]
            ]
        );

        $this->add_responsive_control(
            'prev_vertical_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-prev' => 'top: unset; bottom: unset; {{prev_vertical.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'prev_horizontal',
            [
                'label'       => esc_html__('Prev Horizontal', 'unique-elementor-addons'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'  => [
                        'title' => esc_html__('Left', 'unique-elementor-addons'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'unique-elementor-addons'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'defautl'     => 'left'
            ]
        );
        $this->add_responsive_control(
            'prev_horizontal_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => -45,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-prev' => 'left: unset; right: unset; {{prev_horizontal.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $tabs = $this->get_settings_for_display('tabs');

        $id_int = substr($this->get_id_int(), 0, 3);
        $this->add_render_attribute('data-carousel', 'class', 'elementor-tabs-content-wrapper');

        if ($settings['enable_carousel']) {

            $carousel_settings = $this->get_carousel_settings($settings);
            $this->add_render_attribute('data-carousel', 'data-settings', wp_json_encode($carousel_settings));
        }
        ?>
        <div class="elementor-tabs" role="tablist">
            <div class="elementor-tabs-wrapper">
                <?php
                foreach ($tabs as $index => $item) :
                    $tab_count = $index + 1;
                    $class_item = 'elementor-repeater-item-' . $item['_id'];
                    $class = ($index == 0) ? 'elementor-active' : '';

                    $tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);

                    $this->add_render_attribute($tab_title_setting_key, [
                        'id'            => 'elementor-tab-title-' . $id_int . $tab_count,
                        'class'         => [
                            'elementor-tab-title',
                            $class,
                            $class_item
                        ],
                        'data-tab'      => $tab_count,
                        'tabindex'      => $id_int . $tab_count,
                        'role'          => 'tab',
                        'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
                    ]);
                    ?>
                    <div <?php echo $this->get_render_attribute_string($tab_title_setting_key); ?>><?php echo esc_html($item['tab_title']); ?></div>
                <?php endforeach; ?>
            </div>
            <div <?php echo $this->get_render_attribute_string('data-carousel'); ?>>
                <?php
                foreach ($tabs as $index => $item) :
                    $tab_count = $index + 1;
                    $class_item = 'elementor-repeater-item-' . $item['_id'];
                    $class_content = ($index == 0) ? 'elementor-active' : '';

                    $tab_content_setting_key = $this->get_repeater_setting_key('tab_content', 'tabs', $index);

                    $this->add_render_attribute($tab_content_setting_key, [
                        'id'              => 'elementor-tab-content-' . $id_int . $tab_count,
                        'class'           => [
                            'elementor-tab-content',
                            $class_content,
                            $class_item
                        ],
                        'data-tab'        => $tab_count,
                        'role'            => 'tabpanel',
                        'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
                    ]);

                    $this->add_inline_editing_attributes($tab_content_setting_key, 'advanced');
                    ?>
                    <div <?php echo $this->get_render_attribute_string($tab_content_setting_key); // WPCS: XSS ok.
                    ?>>
                        <?php $this->woocommerce_default($item, $settings); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php

        //$this->woocommerce_default($settings);
    }

    private function woocommerce_default($settings, $global_setting) {
        global $woocommerce;
        $meta_query = '';
        $tax_query = array();
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

        if ( 'recent_products' == $settings['product_type'] ) {
            $meta_query = WC()->query->get_meta_query();
        }

        if ( 'featured_products' == $settings['product_type'] ) {
            $tax_query[] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN', // or 'NOT IN' to exclude feature products
            );
        }

        $args = array(
            'post_type'           => 'product',
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1,
            'posts_per_page'      => $settings['limit'],
            'orderby'             => $settings['orderby'],
            'order'               => $settings['order'],
            'paged'               => $paged,
            'meta_query'          => $meta_query,
            'tax_query'          => $tax_query,
        );

        if ( 'sale_products' == $settings['product_type'] ) {
            $product_ids_on_sale = wc_get_product_ids_on_sale();
            $args['post__in'] = $product_ids_on_sale;
        }

        if ( 'best_selling_products' == $settings['product_type'] ) {
            $args['meta_key']   = 'total_sales';
            $args['orderby']    = 'meta_value_num';
        }

        if ( 'top_rated_products' == $settings['product_type'] ) {
            $args['meta_key']   = '_wc_average_rating';
            $args['orderby']    = 'meta_value_num';
        }

        //if category selected
        if( ! empty( $settings['categories'] ) ) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => implode(',', $settings['categories']),
                )
            );
        }

        $the_query = new \WP_Query( $args );
        $settings['the_query'] = $the_query;

        $settings['image_size'] = $global_setting['image_size'];
        $settings['settings'] = $settings;

        $class = $global_setting['column'];
        if ($global_setting['enable_carousel']) {

            $settings['product_layout'] = 'carousel';
            $class .= ' product-carousel';

        } else {
            $settings['product_layout'] = 'grid';

            if (!empty($global_setting['column_tablet'])) {
                $class .= ' columns-tablet-' . $global_setting['column_tablet'];
            }

            if (!empty($global_setting['column_mobile'])) {
                $class .= ' columns-mobile-' . $global_setting['column_mobile'];
            }
        }

        $settings['class'] = $class;


        //Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
        $html = unique_addons_get_shortcode_shop_template_part( 'product-tabs', null, 'product-tabs/tpl', $settings, true );

        unique_addons_print_template_html( $html );
    }
}