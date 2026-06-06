<?php
namespace UniqueAddons\Widgets\Projects\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Skin_Base as Elementor_Skin_Base;

use UniqueAddons\Lib;
use UniqueAddons\CPT\Projects\CPT_Projects;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Style_Current_Theme1 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/uae-cpt-projects/tm_general/after_section_end', [ $this, 'register_layout_controls' ] );
	}

	public function get_id() {
		return 'skin-style-current-theme1';
	}


	public function get_title() {
		return __( 'Skin - Style Current Theme1', 'unique-elementor-addons' );
	}


	public function register_layout_controls( Widget_Base $widget ) {
		$this->parent = $widget;

		//Current Background Styling
		$this->start_controls_section(
			'current_background_styling',
			[
				'label' => esc_html__( 'Current Background Styling', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs('tabs_current_style');
		$this->start_controls_tab(
			'tabs_current_style_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);

		$this->add_control(
			'current_skin_icon_bg_color_option',
			[
				'label' => esc_html__( 'Current Background Styling', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color',
			[
				'label' => esc_html__( "Custom Background Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .projects-current-theme1 .content-box' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_icon_theme_colored',
			[
				'label' => esc_html__( "Make BG Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .projects-current-theme1 .content-box' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_control(
			'current_skin_icon_bg_color_option_text',
			[
				'label' => esc_html__( 'Current Icon Styling', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'custom_button_bg_color',
			[
				'label' => esc_html__( "Custom Button BG Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .projects-current-theme1 .btn-box a' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'custom_button_icon_color',
			[
				'label' => esc_html__( "Custom Button Icon Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .projects-current-theme1 .btn-box a' => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();


		$this->start_controls_tab(
			'tabs_current_style_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'current_skin_icon_bg_color_option_hover',
			[
				'label' => esc_html__( 'Current Background Styling ( Hover )', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'content_wrapper_custom_bg_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .projects-current-theme1 .inner-box:hover .content-box' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'content_wrapper_theme_colored_hover',
			[
				'label' => esc_html__( "Make BG Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .projects-current-theme1 .inner-box:hover .content-box' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);

		$this->add_control(
			'current_kin_icon_color_option_hover',
			[
				'label' => esc_html__( 'Current Icon Styling ( Hover )', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'custom_button_icon_color_hover',
			[
				'label' => esc_html__( "Custom Background Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .projects-current-theme1 .btn-box:hover a' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'custom_button_icon_theme_color_hover',
			[
				'label' => esc_html__( "Custom Button Icon Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .projects-current-theme1 .btn-box:hover a' => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();

		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_enqueue_style( 'tm-project-skin-current-theme1', UNIQUE_ADDONS_ASSETS_URI . '/css/cpt/projects/project-skin-current-theme1' . $direction_suffix . '.css' );

		wp_enqueue_script( 'tm-projects-block-script', UNIQUE_ADDONS_ASSETS_URI . '/js/cpt/project-block.js', array('jquery'), false, true );

		//gsap pin spacer added
		wp_enqueue_script( 'gsap' );
		wp_enqueue_script( 'gsap-scrolltrigger' );
		wp_enqueue_script( 'tm-gsap-pin-scroll', UNIQUE_ADDONS_ASSETS_URI . '/js/widgets/gsap-pin-scroll.js', array('jquery'), false, true );


		$new_cpt_class = CPT_Projects::Instance();
		$class_instance =  (array) $new_cpt_class;
		$settings['holder_id'] = unique_addons_get_isotope_holder_ID('projects');

		$project_image_size_array_new = array();
		if ( $settings['project_image_size_array'] ) :
			foreach (  $settings['project_image_size_array'] as $each_item ) {
				$project_image_size_array_new[$each_item['image_for_project']] = $each_item['image_size'];
			}
		endif;
		$settings['project_image_size_array_new'] = $project_image_size_array_new;

		$this->render_output( $class_instance, $settings );
	}

	public function render_output( $class_instance, $settings ) {
		$new_cpt_class = $class_instance;

		$settings['the_query'] = $this->parent->query_posts($new_cpt_class);

		//classes
		$classes = array();
		if( $settings['add_border_radius'] ) {
			$classes[] = 'border-radius-around-box';
		}
		$settings['classes'] = $classes;

		//button classes
		$settings['btn_classes'] = unique_addons_prepare_button_classes_from_params( $settings );

		//ptTaxKey
		$settings['ptTaxKey'] = $new_cpt_class['ptTaxKey'];

		$settings['settings'] = $settings;

		$html = unique_addons_get_cpt_shortcode_template_part( 'projects', $settings['display_type'], 'projects/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}
