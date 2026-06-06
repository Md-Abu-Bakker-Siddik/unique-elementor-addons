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
class TM_Elementor_Language_Switcher extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style( 'tm-language-switcher-style', UNIQUE_ADDONS_ASSETS_URI . '/css/widgets-core/language-switcher' . $direction_suffix . '.css' );
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
		return 'uae-language-switcher';
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
		return esc_html__( 'TM - Language Switcher', 'unique-elementor-addons' );
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
		return [ 'tm-language-switcher-style' ];
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
            'section_language_switcher',
            [
                'label' => esc_html__('Layout', 'unique-elementor-addons'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .uae-language-switcher span',
            ]
        );

        $this->start_controls_tabs('style_color');

        $this->start_controls_tab('typo_normal',
            [
                'label' => esc_html__('Normal', 'unique-elementor-addons'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Title Color', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .item > div span.title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .item > div.language-switcher-head i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('typo_hover',
            [
                'label' => esc_html__('Hover', 'unique-elementor-addons'),
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Title Color', 'unique-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .item > div:hover span.title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .item > div.language-switcher-head:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'hover_right',
            [
                'label' => esc_html__( 'Hover Right', 'unique-elementor-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'language-switcher-style-hover-right-',
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
        $languages = apply_filters('wpml_active_languages', []);
        if (!class_exists('SitePress') || count($languages) <= 0) {
            ?>
            <div class="uae-language-switcher">
                <ul class="menu">
                    <li class="item">
                        <div class="language-switcher-head">
                            <img src="<?php echo esc_url(UNIQUE_ADDONS_ASSETS_URI . '/images/language-switcher/en.png'); ?>" alt="WPML">
                            <span class="title"><?php echo esc_html__('English', 'unique-elementor-addons'); ?></span>
                            <i class="lnr lnr-icon-chevron-down"></i>
                        </div>
                        <ul class="sub-item">
                            <li>
                                <a href="#">
                                    <img width="18" height="12" src="<?php echo esc_url(UNIQUE_ADDONS_ASSETS_URI . '/images/language-switcher/es.png'); ?>" alt="WPML">
                                    <span><?php echo esc_html__('Spanish', 'unique-elementor-addons'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img width="18" height="12" src="<?php echo esc_url(UNIQUE_ADDONS_ASSETS_URI . '/images/language-switcher/it.png'); ?>" alt="WPML">
                                    <span><?php echo esc_html__('Italy', 'unique-elementor-addons'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img width="18" height="12" src="<?php echo esc_url(UNIQUE_ADDONS_ASSETS_URI . '/images/language-switcher/de.png'); ?>" alt="WPML">
                                    <span><?php echo esc_html__('German', 'unique-elementor-addons'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span><?php echo esc_html__('Requires WPML', 'unique-elementor-addons'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php
        } else {
            ?>
            <div class="uae-language-switcher">
                <ul class="menu">
                    <li class="item">
                        <div class="language-switcher-head">
                            <img src="<?php echo esc_url($languages[ICL_LANGUAGE_CODE]['country_flag_url']) ?>" alt="<?php esc_attr($languages[ICL_LANGUAGE_CODE]['default_locale']) ?>">
                            <span class="label">
                                    <?php echo esc_html__('Language:', 'unique-elementor-addons'); ?>
                                </span>
                            <span class="title">
                                    <?php echo esc_html($languages[ICL_LANGUAGE_CODE]['translated_name']); ?>
                                </span>
                        </div>
                        <ul class="sub-item">
                            <?php
                            foreach ($languages as $key => $language) {
                                if (ICL_LANGUAGE_CODE === $key) {
                                    continue;
                                }
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($language['url']) ?>">
                                        <img width="18" height="12" src="<?php echo esc_url($language['country_flag_url']) ?>" alt="<?php esc_attr($language['default_locale']) ?>">
                                        <span><?php echo esc_html($language['translated_name']); ?></span>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php
        }
	}
}