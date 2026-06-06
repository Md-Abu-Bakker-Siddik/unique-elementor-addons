<?php
namespace UniqueAddons\Widgets\VideoPopup\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Button_Over_Image extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/uae-video-popup/tm_general/before_section_end', [ $this, 'register_layout_controls' ] );
		add_action( 'elementor/element/uae-video-popup/tm_general/after_section_end', [ $this, 'register_layout_controls_wrapper' ] );
		add_action( 'elementor/element/uae-video-popup/tm_general/after_section_end', [ $this, 'register_layout_controls_play_btn' ] );
	}

	public function get_id() {
		return 'button-over-image';
	}


	public function get_title() {
		return __( 'Skin - Play Button Over Image', 'unique-elementor-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;
		$this->add_control(
			'featured_image',
			[
				'label' => esc_html__( "Choose Featured Image", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				"description" => esc_html__( "You can upload & select background featured image", 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'featured_image_size',
			[
				'label' => esc_html__( "Featured Image Size", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_get_available_image_sizes(),
				'default' => 'large',
			]
		);
		$this->add_control(
			'featured_image_overlay',
			[
				'label' => esc_html__( "Overlay Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup.tm-sc-video-popup-button-over-image:before' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'play_btn',
			[
				'label' => esc_html__( "Choose Play Button From Media", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				"description" => esc_html__( "You can upload and choose play button from media", 'unique-elementor-addons' ),
			]
		);
		$this->add_control(
			'pre_packaged_play_btn',
			[
				'label' => esc_html__( "Or Choose Play Button From Here", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'description' => '',
				'options' => [
					'' => esc_html__( 'Default Animated Button', 'unique-elementor-addons' ),
					's1.png' => esc_html__( 'Play Button 1', 'unique-elementor-addons' ),
					's1.png' => esc_html__( 'Play Button 1', 'unique-elementor-addons' ),
					's2.png' => esc_html__( 'Play Button 2', 'unique-elementor-addons' ),
					's3.png' => esc_html__( 'Play Button 3', 'unique-elementor-addons' ),
					's4.png' => esc_html__( 'Play Button 4', 'unique-elementor-addons' ),
					's5.png' => esc_html__( 'Play Button 5', 'unique-elementor-addons' ),
					's6.png' => esc_html__( 'Play Button 6', 'unique-elementor-addons' ),
					's7.png' => esc_html__( 'Play Button 7', 'unique-elementor-addons' ),
					's8.png' => esc_html__( 'Play Button 8', 'unique-elementor-addons' ),
					's9.png' => esc_html__( 'Play Button 9', 'unique-elementor-addons' ),
					's10.png' => esc_html__( 'Play Button 10', 'unique-elementor-addons' ),
					's11.png' => esc_html__( 'Play Button 11', 'unique-elementor-addons' ),
					's12.png' => esc_html__( 'Play Button 12', 'unique-elementor-addons' ),
					's13.png' => esc_html__( 'Play Button 13', 'unique-elementor-addons' ),
					's14.png' => esc_html__( 'Play Button 14', 'unique-elementor-addons' ),
					's15.png' => esc_html__( 'Play Button 15', 'unique-elementor-addons' ),
					's16.png' => esc_html__( 'Play Button 16', 'unique-elementor-addons' ),
					's17.png' => esc_html__( 'Play Button 17', 'unique-elementor-addons' )
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( "Title Text", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .video-button-text',
			]
		);
	}









	public function register_layout_controls_wrapper( Widget_Base $widget ) {
		$this->parent = $widget;

		$this->start_controls_section(
			'wrapper_styling',
			[
				'label' => esc_html__( 'Wrapper Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'button_over_image_window_width',
			[
				'label' => esc_html__( "Window Width", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'button_over_image_window_height',
			[
				'label' => esc_html__( "Window Height", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1500,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup .effect-wrapper' => 'height: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'featured_image_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
	}









	public function register_layout_controls_play_btn( Widget_Base $widget ) {
		$this->parent = $widget;
		$this->start_controls_section(
			'icon_styling',
			[
				'label' => esc_html__( 'Play Button Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_size_options',
			[
				'label' => esc_html__( 'Size Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'icon_area_width',
			[
				'label' => esc_html__( "Dimension (Width and Height)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 240,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .animated-css-play-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .animated-css-play-button .bg-block' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .animated-css-play-button .play-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .animated-css-play-button .play-icon:before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .animated-css-play-button .play-icon:after' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'icon_orientation_options',
			[
				'label' => esc_html__( 'Icon Position', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'icon_orientation_vertical',
			[
				'label' => __( 'Vertical Orientation', 'unique-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'top' => [
						'title' => __( 'Top', 'unique-elementor-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'unique-elementor-addons' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'icon_orientation_offset_y',
			[
				'label' => __( 'Offset', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .animated-css-play-button' =>
							'{{button_over_image_icon_orientation_vertical.VALUE}}: {{SIZE}}%; transform:translate(0%, 0%)',
				],
			]
		);
		$this->add_responsive_control(
			'icon_orientation_horizontal',
			[
				'label' => __( 'Horizontal Orientation', 'unique-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => is_rtl() ? 'right' : 'left',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'unique-elementor-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'unique-elementor-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
			]
		);
		$this->add_responsive_control(
			'icon_orientation_offset_x',
			[
				'label' => __( 'Offset', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .animated-css-play-button' =>
							'{{button_over_image_icon_orientation_horizontal.VALUE}}: {{SIZE}}%; transform:translate(0%, 0%)',
				],
			]
		);


		$this->start_controls_tabs('tabs_icon_style');
		$this->start_controls_tab(
			'icon_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'icon_options',
			[
				'label' => esc_html__( 'Icon Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( "Icon Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .animated-css-play-button .play-icon i' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .animated-css-play-button .play-icon i' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Icon Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .animated-css-play-button .play-icon i',
			]
		);
		$this->add_control(
			'icon_bg_options',
			[
				'label' => esc_html__( 'Background Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'iconb_bg_color',
			[
				'label' => esc_html__( "Icon Custom Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .animated-css-play-button .bg-block' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_bg_theme_colored',
			[
				'label' => esc_html__( "Icon Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .animated-css-play-button .bg-block' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'icon_bg_color_opacity',
			[
				'label' => esc_html__( 'BG Colored Opacity', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .animated-css-play-button .bg-block' => 'opacity: {{SIZE}};',
				]
			]
		);
		$this->add_responsive_control(
			'icon_area_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .animated-css-play-button .bg-block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .animated-css-play-button .play-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .animated-css-play-button .play-icon:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .animated-css-play-button .play-icon:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'icon_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'icon_options_hover',
			[
				'label' => esc_html__( 'Icon Color Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_color_hover',
			[
				'label' => esc_html__( "Icon Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup:hover .animated-css-play-button .play-icon i' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_theme_colored_hover',
			[
				'label' => esc_html__( "Icon Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup:hover .animated-css-play-button .play-icon i' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'icon_bg_options_hover',
			[
				'label' => esc_html__( 'Background Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'icon_bg_color_hover',
			[
				'label' => esc_html__( "Icon Custom Background Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup:hover .animated-css-play-button .bg-block' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'icon_bg_theme_colored_hover',
			[
				'label' => esc_html__( "Icon Background Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup:hover .animated-css-play-button .bg-block' => 'background-color: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_control(
			'icon_bg_color_opacity_hover',
			[
				'label' => esc_html__( 'BG Colored Opacity', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-sc-video-popup:hover .animated-css-play-button .bg-block' => 'opacity: {{SIZE}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		//classes
		$classes = array();
		$classes[] = 'tm-sc-video-popup';

		$settings['classes'] = $classes;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_widgetcore_template_part( 'video-popup', $settings['_skin'], 'video-popup/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}