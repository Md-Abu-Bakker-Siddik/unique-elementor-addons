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
class TM_Elementor_Projects_Pre_Next extends Widget_Base {
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        $direction_suffix = is_rtl() ? '.rtl' : '';

        wp_register_style( 'tm-projects-pre-next', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/projects-pre-next' . $direction_suffix . '.css' );
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
		return 'uae-projects-pre-next';
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
		return esc_html__( 'TM - Projects Pre Next', 'unique-elementor-addons' );
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
		return [ 'tm-projects-pre-next' ];
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
			'subtitle',
			[
				'label' => esc_html__( "Subtitle", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "Download on the", 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label' => esc_html__( "Title", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( "App Store", 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'link',
			[
				'label' => esc_html__( "Link URL", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'show_external' => true,
				'default' => [
					'url' => '',
				]
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => __('Icon', 'unique-elementor-addons'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fab fa-google-play',
					'library' => 'font-awesome',
				],
			]
		);
		$this->end_controls_section();












		$this->start_controls_section(
			'title_section',
			[
				'label' => esc_html__( 'Title Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('title_options_tabs');
		$this->start_controls_tab(
			'title_options_tab_default',
			[
				'label' => esc_html__('Default', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .title',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'title_options_tab_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .title' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography_hover',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}}:hover .title',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();













		$this->start_controls_section(
			'subtitle_section',
			[
				'label' => esc_html__( 'Sub Title Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('subtitle_options_tabs');
		$this->start_controls_tab(
			'subtitle_options_tab_default',
			[
				'label' => esc_html__('Default', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'subtitle_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .subtitle',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'subtitle_options_tab_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'subtitle_text_color_hover',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'subtitle_theme_colored_hover',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .subtitle' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography_hover',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}}:hover .subtitle',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
















		$this->start_controls_section(
			'icon_section',
			[
				'label' => esc_html__( 'Icon Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('icon_options_tabs');
		$this->start_controls_tab(
			'icon_options_tab_default',
			[
				'label' => esc_html__('Default', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'icon_text_color',
			[
				'label' => esc_html__( "Icon Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon i' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'icon_theme_colored',
			[
				'label' => esc_html__( "Icon Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .icon i' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .icon i',
			]
		);
		$this->add_control(
			'icon_border_color',
			[
				'label' => esc_html__( "Right Border Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-app-btn .content' => 'border-left-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'icon_options_tab_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'icon_text_color_hover',
			[
				'label' => esc_html__( "Icon Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .icon i' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'icon_theme_colored_hover',
			[
				'label' => esc_html__( "Icon Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .icon i' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography_hover',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}}:hover .icon i',
			]
		);
		$this->add_control(
			'icon_border_color_hover',
			[
				'label' => esc_html__( "Right Border Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-app-btn .content' => 'border-left-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();














		$this->start_controls_section(
			'bg_btn_options',
			[
				'label' => esc_html__( 'Background Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('bg_wrapper_option_tabs');
		$this->start_controls_tab(
			'btn_option_tab_default',
			[
				'label' => esc_html__('Default', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'btn_bg_color',
			[
				'label' => esc_html__( "Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-app-btn' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'btn_bg_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-app-btn' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'btn_border',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .tm-app-btn',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .tm-app-btn',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'btn_option_tab_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'btn_bg_color_hover',
			[
				'label' => esc_html__( "Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .tm-app-btn' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'btn_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-app-btn' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'btn_border_hover',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'separator' => 'before',
				'selector' => '{{WRAPPER}}:hover .tm-app-btn',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'unique-elementor-addons' ),
				'separator' => 'before',
				'selector' => '{{WRAPPER}}:hover .tm-app-btn',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'btn_padding',
			[
				'label' => esc_html__( 'Button Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-app-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-app-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
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
		//link url
		$settings['target'] = ( $settings['link'] && $settings['link']['is_external'] ) ? ' target="_blank"' : '';
		$settings['url'] = ( $settings['link'] && $settings['link']['url'] ) ? $settings['link']['url'] : '';



		$html = unique_addons_get_shortcode_template_part( 'projects-pre-next', null, 'projects-pre-next/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}
