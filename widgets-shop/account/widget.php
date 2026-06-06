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
class TM_Elementor_Wishlist extends Widget_Base {
    protected $nav_menu_index = 1;

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-woo-wishlist', UNIQUE_ADDONS_ASSETS_URI . '/css/woo/wishlist' . $direction_suffix . '.css' );
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
		return 'uae-woo-wishlist';
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
		return esc_html__( 'TM Wishlist', 'unique-elementor-addons' );
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
		return [ 'tm-woo-wishlist' ];
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
        $this->start_controls_section(
            'wishlist-icon-style',
            [
                'label' => esc_html__('Icon', 'unique-elementor-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_account_size',
            [
                'label'     => esc_html__('Size Icon', 'unique-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist .header-wishlist i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Icon Color', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist .header-wishlist:not(:hover) i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label'     => esc_html__('Icon Color Hover', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist .header-wishlist:hover i' => 'color: {{VALUE}};',
                ],
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
                    '{{WRAPPER}} .site-header-wishlist' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'wishlist-count-style',
            [
                'label' => esc_html__('Count', 'unique-elementor-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'count_color',
            [
                'label'     => esc_html__('Color', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist .header-wishlist .count' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'count_background_color',
            [
                'label'     => esc_html__('Background', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .site-header-wishlist .header-wishlist .count' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'show_count',
            [
                'label'        => esc_html__('Hide Count', 'unique-elementor-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'hide-count-wishlist-'
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
        $this->add_render_attribute('wrapper', 'class', 'elementor-wishlist-wrapper');
        ?>
        <div >
            <?php
            if (function_exists('woosw_init')) {
                add_action('wp_footer', 'organey_wishlist_canvas', 1);
                $key = \WPCleverWoosw::get_key();

                ?>
                <div class="site-header-wishlist woosw-check">
                    <a class="header-wishlist" data-toggle="button-side" data-target=".tm-wishlist-side" href="<?php echo esc_url(\WPCleverWoosw::get_url($key, true)); ?>">
                        <i class="lnr lnr-icon-heart"></i>
                        <span class="count"><?php echo esc_html(\WPCleverWoosw::get_count($key)); ?></span>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
}