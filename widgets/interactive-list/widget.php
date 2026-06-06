<?php
namespace UniqueAddons\Widgets\InteractiveList;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_InteractiveList extends Widget_Base {
    public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style( 'tm-interactive-list', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/interactive-list/interactive-list-loader' . $direction_suffix . '.css' );
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
		return 'uae-interactive-list';
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
		return esc_html__( 'Interactive List - Unique Addons', 'unique-elementor-addons' );
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
		return [ 'tm-interactive-list' ];
	}


	/**
	 * Skins
	 */
	protected function register_skins() {
		$this->add_skin( new Skins\Skin_Style1( $this ) );
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
        $repeater = new Repeater();
        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'unique-elementor-addons'),
                'type'        => Controls_Manager::TEXT,
            ]
        );
		$repeater->add_control(
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
		$repeater->add_control(
			'feature_image',
			[
				'label' => esc_html__( "Thumbnail Image", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
        $this->add_control(
            'list_items',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title' => esc_html__('Creative', 'unique-elementor-addons'),
                    ],
                    [
                        'title' => esc_html__('Agency', 'unique-elementor-addons'),
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );
		$this->end_controls_section();






		$this->start_controls_section(
			'image_options',
			[
				'label' => esc_html__( 'Image Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'image_size',
			[
				'label' => esc_html__( "Choose Image Size", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_get_available_image_sizes(),
				'default' => 'full',
			]
		);
		$this->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__( "Image Custom Width", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'separator' => 'before',
				'size_units' => [ 'px', '%' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 400,
						'step' => 1,
					],
					'%' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-list .each-item img' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();




		$this->start_controls_section(
			'title_section',
			[
				'label' => esc_html__( 'Text Styling Options', 'unique-elementor-addons' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-list .list .each-item' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'title_text_color_hover',
			[
				'label' => esc_html__( "Text Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-interactive-list .list .each-item:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-interactive-list .list',
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

		//classes
		$classes = array();
		$settings['classes'] = $classes;

		$settings['settings'] = $settings;

		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_shortcode_template_part( 'interactive-list-skin-style1', null, 'interactive-list/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}
