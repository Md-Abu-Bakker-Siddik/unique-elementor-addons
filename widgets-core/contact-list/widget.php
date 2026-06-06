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
class TM_Elementor_Contact_List extends Widget_Base {
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        $direction_suffix = is_rtl() ? '.rtl' : '';

        wp_register_style( 'tm-contact-list-style', UNIQUE_ADDONS_ASSETS_URI . '/css/widgets-core/contact-list' . $direction_suffix . '.css' );
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
		return 'uae-contact-list';
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
		return esc_html__( 'Contact List Widget', 'unique-elementor-addons' );
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
		return [ 'tm-contact-list-style' ];
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
			'custom_css_class',
			[
				'label' => esc_html__( "Custom CSS class", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
        $this->add_control(
            'design_style',
            [
                'label' => esc_html__( "Design Style", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'flat' => esc_html__( 'Flat', 'unique-elementor-addons' ),
                    'round' => esc_html__( 'Round Background', 'unique-elementor-addons' ),
                ],
                'default' => 'flat'
            ]
        );
		$this->add_control(
			'label_disply_type',
			[
				'label' => esc_html__('Parent Display Property', 'unique-elementor-addons'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'flex',
				'options' => unique_addons_disply_type_list_elementor(),
				'selectors' => [
						'{{WRAPPER}} .tm-contact-list li' => 'display: {{UNIT}}',
				],
			]
		);
		$this->add_control(
			'label_disply_type_child',
			[
				'label' => esc_html__('Childs Display Property', 'unique-elementor-addons'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'flex',
				'options' => unique_addons_disply_type_list_elementor(),
				'selectors' => [
						'{{WRAPPER}} .tm-contact-list li > *' => 'display: {{UNIT}}',
				],
			]
		);






		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'prefix',
			[
				'label' => esc_html__( "Prefix", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( "Text", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'title_tag',
			[
				'label' => esc_html__( "Text Tag", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_heading_tag_list(),
				'default' => 'div'
			]
		);
		$repeater->add_control(
			'link_url',
			[
				'label' => esc_html__( "Link URL", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::URL,
				'condition' => [
					'title_tag' => 'a'
				]
			]
		);
		$repeater->add_control(
			'icon_type',
			[
				'label' => esc_html__( "Icon Type", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'default' => 'font-icon'
			]
		);
		$repeater->add_control(
			'icon',
			[
				'label' => __('Icon', 'unique-elementor-addons'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-envelope',
					'library' => 'font-awesome',
				],
				'condition' => [
					'icon_type' => array('font-icon')
				]
			]
		);
		$this->add_control(
			'info_items',
			[
				'label' => esc_html__( "Info Items", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => esc_html__( "+1234567789", 'unique-elementor-addons' ),
					],
					[
						'title' => esc_html__( "needhelp@company.com", 'unique-elementor-addons' ),
					],
				]
			]
		);
		$this->end_controls_section();






		$this->start_controls_section(
			'text_options',
			[
				'label' => esc_html__( 'Text Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'label' => esc_html__( 'Text Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-contact-list li > *',
			]
		);
		$this->add_control(
			'text_text_color',
			[
				'label' => esc_html__( "Text Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li > *' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_theme_colored',
			[
				'label' => esc_html__( "Text Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li > *' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'text_margin',
			[
				'label' => esc_html__( 'Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li .text > *' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();










		$this->start_controls_section(
			'icon_options',
			[
				'label' => esc_html__( 'Icon Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_hide',
			[
				'label' => esc_html__( "Hide Icon?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li .icon' => 'display: none;',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'icon_typography',
				'label' => esc_html__( 'Icon Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-contact-list li .icon, {{WRAPPER}} .tm-contact-list li .icon svg',
			]
		);
		$this->add_control(
			'icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_area_width',
			[
				'label' => esc_html__( "Icon Container Width", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li .icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};flex-basis: {{SIZE}}{{UNIT}};',
				]
			]
		);


        $this->start_controls_tabs( 'tabs_icon_style' );
        $this->start_controls_tab(
            'tab_icon_normal',
            [
                'label' => esc_html__( 'Normal', 'unique-elementor-addons' ),
            ]
        );
        $this->add_control(
            'icon_bacground',
            [
                'label'     => esc_html__( 'Background Color', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-contact-list li .icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_bacground_theme_color',
            [
                'label' => esc_html__('Background Theme Color', 'unique-elementor-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tm-contact-list li .icon' => 'background-color: var(--theme-color{{VALUE}})',
                ],
            ]
        );
		$this->add_control(
			'icon_text_color',
			[
				'label' => esc_html__( "Icon Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li .icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-contact-list li .icon svg' => 'fill: {{VALUE}};',
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
					'{{WRAPPER}} .tm-contact-list li .icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-contact-list li .icon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_area_border',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-contact-list li .icon',
			]
		);
		$this->add_responsive_control(
			'icon_area_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
        $this->end_controls_tab();



        $this->start_controls_tab(
            'tab_icon_hover',
            [
                'label' => esc_html__( 'Hover', 'unique-elementor-addons' ),
            ]
        );
        $this->add_control(
            'icon_bacground_hover',
            [
                'label'     => esc_html__( 'Background Color', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-contact-list li:hover .icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_bacground_theme_color_hover',
            [
                'label' => esc_html__('Background Theme Color', 'unique-elementor-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tm-contact-list li:hover .icon' => 'background-color: var(--theme-color{{VALUE}})',
                ],
            ]
        );
		$this->add_control(
			'icon_text_color_hover',
			[
				'label' => esc_html__( "Icon Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li:hover .icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tm-contact-list li:hover .icon svg' => 'fill: {{VALUE}};',
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
					'{{WRAPPER}} .tm-contact-list li:hover .icon' => 'color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}} .tm-contact-list li:hover .icon svg' => 'fill: var(--theme-color{{VALUE}});',
				],
			]
		);
        $this->add_control(
            'icon_border_hover',
            [
                'label'     => esc_html__( 'Border Color', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-contact-list li:hover .icon' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
		$this->end_controls_section();





		$this->start_controls_section(
			'prefix_options',
			[
				'label' => esc_html__( 'Prefix Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'prefix_hide',
			[
				'label' => esc_html__( "Hide Prefix?", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li .prefix' => 'display: none;',
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'prefix_typography',
				'label' => esc_html__( 'Prefix Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-contact-list li .prefix',
			]
		);
		$this->add_control(
			'prefix_color',
			[
				'label' => esc_html__( "Prefix Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li .prefix' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'prefix_theme_colored',
			[
				'label' => esc_html__( "Prefix Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li .prefix' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'prefix_margin',
			[
				'label' => esc_html__( 'Prefix Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li .prefix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();





		$this->start_controls_section(
			'link_options',
			[
				'label' => esc_html__( 'Link Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'link_typography',
				'label' => esc_html__( 'Link Typography', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-contact-list li a',
			]
		);
		$this->add_control(
			'link_text_color',
			[
				'label' => esc_html__( "Link Color", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'link_text_color_hover',
			[
				'label' => esc_html__( "Link Color (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'link_theme_colored',
			[
				'label' => esc_html__( "Link Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li a' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_control(
			'link_theme_colored_hover',
			[
				'label' => esc_html__( "Link Theme Colored (Hover)", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li a:hover' => 'color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_section();


		$this->start_controls_section(
			'list_item_options',
			[
				'label' => esc_html__( 'Item Styling Options', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'alignment',
			[
				'label' => esc_html__( "Alignment", 'unique-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => unique_addons_text_align_choose(),
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'list_item_margin',
			[
				'label' => esc_html__( 'Item Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'list_item_padding',
			[
				'label' => esc_html__( 'Item Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'list_item_border',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-contact-list li',
			]
		);
		$this->end_controls_section();








		$this->start_controls_section(
			'last_item_options',
			[
				'label' => esc_html__( 'Last Child Styling', 'unique-elementor-addons' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'last_item_margin',
			[
				'label' => esc_html__( 'Item Margin', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li:last-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'last_item_padding',
			[
				'label' => esc_html__( 'Item Padding', 'unique-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-contact-list li:last-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'last_item_border',
				'label' => esc_html__( 'Border', 'unique-elementor-addons' ),
				'selector' => '{{WRAPPER}} .tm-contact-list li:last-child',
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
		$html = '';
		//classes
		$classes = array();
		$classes[] = 'tm-contact-list';
		$classes[] = $settings['custom_css_class'];
        if( $settings['design_style'] ) {
            $classes[] = 'contact-list-' . $settings['design_style'];
        }
		$settings['classes'] = $classes;
	?>
		<div class="<?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
			<ul>
	<?php
		if ( $settings['info_items'] ) {
			$settings['iter'] = 1;
			foreach (  $settings['info_items'] as $item ) {

				//Produce HTML version by using the parameters (filename, variation, folder name, parameters, shortcode_ob_start)
				$html .= unique_addons_get_widgetcore_template_part( 'contact-list', null, 'contact-list/tpl', $item, true );
			}
		}
		unique_addons_print_template_html( $html );
	?>    </ul>
		</div>
	<?php
	}
}