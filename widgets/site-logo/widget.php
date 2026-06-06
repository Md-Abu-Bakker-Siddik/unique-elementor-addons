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
class TM_Elementor_Site_Logo extends Widget_Base {
	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
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
		return 'uae-site-logo';
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
		return esc_html__( 'Site Logo', 'unique-elementor-addons' );
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
			'logo_type',
			[
				'label' => esc_html__( "Logo Type", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'logo-default' => esc_html__( 'Logo (Default)', 'unique-elementor-addons' ),
					'logo-white' => esc_html__( 'Logo (White) For Dark Background', 'unique-elementor-addons' ),
				],
				'default' => 'logo-default'
			]
		);
		$this->add_control(
			'display_mode',
			[
				'label'   => esc_html__( 'Display Mode', 'unique-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'image' => esc_html__( 'Image Logo', 'unique-elementor-addons' ),
					'text'  => esc_html__( 'Site Title Text', 'unique-elementor-addons' ),
				],
				'default' => 'image',
			]
		);
		$this->add_control(
			'site_title',
			[
				'label'       => esc_html__( 'Site Title', 'unique-elementor-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => get_bloginfo( 'name' ),
				'condition'   => [
					'display_mode' => 'text',
				],
			]
		);
		$this->add_control(
			'logo_image',
			[
				'label'     => esc_html__( 'Logo Image', 'unique-elementor-addons' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => '',
				],
				'condition' => [
					'display_mode' => 'image',
				],
			]
		);
		$this->add_control(
			'logo_image_sticky',
			[
				'label'     => esc_html__( 'Alternate Logo (Sticky/Dark)', 'unique-elementor-addons' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
					'url' => '',
				],
				'condition' => [
					'display_mode' => 'image',
				],
			]
		);
		$this->add_control(
			'use_switchable_logo',
			[
				'label'        => esc_html__( 'Enable Alternate Logo', 'unique-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition'    => [
					'display_mode' => 'image',
				],
			]
		);
		$this->add_responsive_control(
			'site_logo_alignment',
			[
				'label' => esc_html__( "Logo Alignment", 'unique-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => unique_addons_text_align_choose(),
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				]
			]
		);
		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label' => esc_html__( 'Max Width', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height',
			[
				'label' => esc_html__( 'Height', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'custom' ],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 500,
					],
					'vh' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'logo_margin',
			[
				'label' => esc_html__( 'Logo Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'header#header {{WRAPPER}} .menuzord-brand' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'logo_filter_options',
			[
				'label' => esc_html__( 'Logo Filter Options', 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->start_controls_tabs('tabs_current_theme_styling');
		$this->start_controls_tab(
			'tabs_current_theme_styling_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);


		$this->add_control(
			'logo_filter_white',
			[
				'label' => esc_html__( 'Filter Logo to White', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} img.logo-default' => 'filter:brightness(0) invert(1);',
				],
			]
		);
		$this->add_control(
			'logo_filter_black',
			[
				'label' => esc_html__( 'Filter Logo to Black', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} img.logo-default' => 'filter:brightness(0) invert(0);',
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_current_theme_styling_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);


		$this->add_control(
			'logo_filter_white_hover',
			[
				'label' => esc_html__( 'Filter Logo to White (Hover)', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} img.logo-default:hover' => 'filter:brightness(0) invert(1);',
				],
			]
		);


		$this->add_control(
			'logo_filter_black_hover',
			[
				'label' => esc_html__( 'Filter Logo to Black (Hover)', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} img.logo-default:hover' => 'filter:brightness(0) invert(0);',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

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

		$site_name   = ! empty( $settings['site_title'] ) ? $settings['site_title'] : get_bloginfo( 'name' );
		$logo_default = array();
		$logo_light   = '';
		$logo_dark    = '';

		if ( 'image' === $settings['display_mode'] ) {
			if ( ! empty( $settings['logo_image']['url'] ) ) {
				$logo_default = $settings['logo_image'];
			} else {
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				if ( $custom_logo_id ) {
					$logo_src = wp_get_attachment_image_src( $custom_logo_id, 'full' );
					if ( $logo_src ) {
						$logo_default = array(
							'url'    => $logo_src[0],
							'width'  => $logo_src[1],
							'height' => $logo_src[2],
						);
					}
				}
			}

			if ( ! empty( $settings['logo_image_sticky']['url'] ) ) {
				$logo_light = esc_url( $settings['logo_image']['url'] ?? '' );
				$logo_dark  = esc_url( $settings['logo_image_sticky']['url'] );
			}
		}

		$use_switchable_logo = ( 'yes' === ( $settings['use_switchable_logo'] ?? '' ) ) && $logo_light && $logo_dark;
		$use_logo            = ( 'image' === $settings['display_mode'] ) && ! empty( $logo_default['url'] );

		?>
		<a class="menuzord-brand site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php if ( 'text' === $settings['display_mode'] || ! $use_logo ) : ?>
				<?php echo esc_html( $site_name ); ?>
			<?php elseif ( isset( $logo_default['url'] ) ) : ?>
				<?php if ( ! $use_switchable_logo ) : ?>
				<img class="logo-default" src="<?php echo esc_url( $logo_default['url'] ); ?>" <?php if ( isset( $logo_default['width'] ) ) { ?> width="<?php echo esc_attr( $logo_default['width'] ); ?>" height="<?php echo esc_attr( $logo_default['height'] ); ?>" <?php } ?> alt="<?php echo esc_attr( $site_name ); ?>">
				<?php else : ?>
				<img class="logo-primary" src="<?php echo esc_url( $logo_light ); ?>" alt="<?php echo esc_attr( $site_name ); ?>">
				<img class="logo-on-sticky" src="<?php echo esc_url( $logo_dark ); ?>" alt="<?php echo esc_attr( $site_name ); ?>">
				<?php endif; ?>
			<?php endif; ?>
		</a>
		<?php
	}
}
