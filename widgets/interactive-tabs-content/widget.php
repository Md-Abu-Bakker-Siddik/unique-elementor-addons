<?php
namespace UniqueAddons\Widgets\InteractiveTabs;

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
class TM_Elementor_InteractiveTabsContent extends Widget_Base {
    public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style( 'tm-interactive-tabs-content', UNIQUE_ADDONS_ASSETS_URI . '/css/shortcodes/interactive-tabs/interactive-tabs-content' . $direction_suffix . '.css' );
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
		return 'uae-interactive-tabs-content';
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
		return esc_html__( 'Interactive Tabs - Content', 'unique-elementor-addons' );
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
		return [ 'tm-interactive-tabs-content' ];
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
			'tabs_content_type',
			[
				'label' => esc_html__('Content Type', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'content' => esc_html__('Content', 'unique-elementor-addons' ),
					'template' => esc_html__('Elementor Templates', 'unique-elementor-addons' ),
				],
				'default' => 'content',
			]
		);
		$repeater->add_control(
			'tabs_content_templates',
			[
				'label' => esc_html__('Choose Elementor Template', 'unique-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => unique_addons_get_elementor_templates(),
				'condition' => [
					'tabs_content_type' => 'template',
				],
			]
		);
		$repeater->add_control(
			'tabs_content',
			[
				'label' => esc_html__('Tab Content', 'unique-elementor-addons'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.", 'unique-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'condition' => [
					'tabs_content_type' => 'content',
				],
			]
		);
        $this->add_control(
            'list_items',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
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


		//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
		$html = unique_addons_get_shortcode_template_part( 'interactive-tabs-content-style1', null, 'interactive-tabs-content/tpl', $settings, true );

		unique_addons_print_template_html( $html );
	}
}
