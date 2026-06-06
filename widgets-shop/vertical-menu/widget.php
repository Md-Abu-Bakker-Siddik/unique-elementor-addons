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
class TM_Elementor_Vertical_Menu extends Widget_Base {
    protected $nav_menu_index = 1;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-vertical-menu', UNIQUE_ADDONS_ASSETS_URI . '/css/woo/vertical-menu' . $direction_suffix . '.css' );
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
		return 'uae-vertical-menu';
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
		return esc_html__( 'TM Vertical Menu', 'unique-elementor-addons' );
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
		return [ 'tm-vertical-menu' ];
	}

    protected function get_nav_menu_index() {
        return $this->nav_menu_index++;
    }

    private function get_available_menus() {
        $menus = wp_get_nav_menus();

        $options = [];

        foreach ($menus as $menu) {
            $options[$menu->slug] = $menu->name;
        }

        return $options;
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
        $this -> start_controls_section(
            'nav_vertiacl_menu_config',
            [
                'label' => esc_html__('Config','unique-elementor-addons'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $menus = $this->get_available_menus();
        if (!empty($menus)) {
            $this->add_control(
                'menu',
                [
                    'label' => esc_html__('Menu', 'unique-elementor-addons'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $menus,
                    'default' => array_keys($menus)[0],
                    'save_default' => true,
                    'separator' => 'after',
                    'description' => sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'unique-elementor-addons'), admin_url('nav-menus.php')),
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<strong>' . esc_html__('There are no menus in your site.', 'unique-elementor-addons') . '</strong><br>' . sprintf(__('Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'unique-elementor-addons'), admin_url('nav-menus.php?action=edit&menu=0')),
                    'separator' => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }

        $this -> add_control(
            'nav_vertiacl_layout',
            [
                'label' => esc_html__('Menu Layout', 'unique-elementor-addons'),
                'type'  => Controls_Manager::SELECT,
                'options'   => [
                    'style-1' => esc_html__('Dropdown', 'unique-elementor-addons'),
                    'style-2' =>  esc_html__('Navbar', 'unique-elementor-addons'),
                ],
                'default'   => 'style-1',
                'prefix_class' => 'nav-vertiacl-menu-layout-content-',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'nav_vertiacl_menu_style',
            [
                'label' => esc_html__('Menu', 'unique-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'icon_menu_size',
            [
                'label' => esc_html__('Size Icon', 'unique-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation .vertical-navigation-header i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typography',
                'selector' => '{{WRAPPER}} .vertical-navigation .vertical-navigation-header',
            ]
        );
        $this->add_control(
            'nav_vertiacl_menur_color',
            [
                'label' => esc_html__('Color', 'unique-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation .vertical-navigation-header' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'nav_vertiacl_menur_color_hover',
            [
                'label' => esc_html__('Color Hover', 'unique-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation:hover .vertical-navigation-header' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'nav_vertiacl_menu_background_color',
                'selector' => '{{WRAPPER}} .vertical-navigation',
            ]
        );
        $this->add_responsive_control(
            'padding_nav_vertiacl_menur',
            [
                'label' => esc_html__('Padding', 'unique-elementor-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation .vertical-navigation-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'border_radius_vertiacl_menu',
            [
                'label'      => esc_html__('Border Radius', 'unique-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .vertical-navigation'    => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'nav-vertiacl-sub-menu-style',
            [
                'label' => esc_html__('Sub Menu', 'unique-elementor-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_menu_typography',
                'selector' => '{{WRAPPER}} .vertical-navigation ul.menu > li > a, .vertical-navigation ul.menu .sub-menu > li > a',
            ]
        );
        $this->add_control(
            'nav_vertiacl_sub_menu_color',
            [
                'label' => esc_html__('Color', 'unique-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation ul.menu > li:not(:hover) > a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .vertical-navigation .vertical-menu .menu > li > a:after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .vertical-navigation ul.menu .sub-menu > li:not(:hover) > a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'nav_vertiacl_sub_menu_color_action',
            [
                'label' => esc_html__('Color Active', 'unique-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation ul.menu > li.current-menu-item:not(:hover) > a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .vertical-navigation ul.menu .sub-menu > li.current-menu-item:not(:hover) > a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'nav_vertiacl_sub_menu_background_color',
            [
                'label' => esc_html__('Background Color', 'unique-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation ul.menu' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .vertical-navigation ul.menu .sub-menu' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'nav_vertiacl_sub_menu_border_color',
            [
                'label' => esc_html__('Border Color', 'unique-elementor-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation .vertical-menu .menu > li' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .vertical-navigation .vertical-menu .menu' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_sub_menu',
            [
                'label' => esc_html__('Icon', 'unique-elementor-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'icon_sub_size',
            [
                'label'     => esc_html__('Font Size', 'unique-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation ul.menu > li > a .menu-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_sub_color',
            [
                'label'     => esc_html__( 'Icon Color', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation ul.menu > li > a:not(:hover) .menu-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_sub_color_hover',
            [
                'label'     => esc_html__( 'Icon Color Hover', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .vertical-navigation ul.menu > li > a:hover .menu-icon' => 'color: {{VALUE}};',
                ],
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

        $args = array(
            'menu' => $settings['menu'],
            'theme_location'    => 'shop-menu',
            'menu_id'           => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'menu_class'        => 'menu',
            'container'         => '',
            'link_before'       => '<span>',
            'link_after'        => '</span>',
            'walker'            => class_exists( 'Unique_Addons_Nav_Walker' ) ? new \Unique_Addons_Nav_Walker : ''
        );
        $menuname= wp_get_nav_menu_object($settings['menu']);

        $this->add_render_attribute('wrapper', 'class', 'elementor-nav-vertiacl-menu-wrapper');
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <?php
            ?>
            <nav class="vertical-navigation" aria-label="<?php esc_attr_e('Vertiacl Navigation', 'unique-elementor-addons'); ?>">
                <div class="vertical-navigation-header">
                    <i class="lnr lnr-icon-menu"></i>
                    <span class="vertical-navigation-title"><?php echo esc_html($menuname->name); ?></span>
                </div>
                <div class="vertical-menu">
                <?php
                    wp_nav_menu($args);
                ?>
                </div>
            </nav>
        </div>
        <?php
    }
}