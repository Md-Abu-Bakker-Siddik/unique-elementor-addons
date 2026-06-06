<?php
namespace UniqueAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class TM_Elementor_Newsletter extends Widget_Base {
    public function __construct($data = [], $args = null) {
        parent::__construct($data, $args);
        $direction_suffix = is_rtl() ? '.rtl' : '';

        wp_register_style( 'tm-newsletter-style', UNIQUE_ADDONS_ASSETS_URI . '/css/widgets-core/newsletter' . $direction_suffix . '.css' );
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
        return 'uae-newsletter';
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
        return esc_html__( 'TM Mailchimp Newsletter', 'unique-elementor-addons' );
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
		return [ 'tm-newsletter-style' ];
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
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'mailchimp_form_id',
            [
                'label'       => esc_html__( 'Type Mailchimp Form ID', 'unique-elementor-addons' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => '419',
                'description' => sprintf(__('To collect your Mailchimp Form ID <a href="%s" target="_blank">Click here</a>', 'unique-elementor-addons'), admin_url('admin.php?page=mailchimp-for-wp-forms')),
                'label_block' => true,
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'design_style',
            [
                'label' => esc_html__( "Design Style", 'unique-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'flat' => esc_html__( 'Flat', 'unique-elementor-addons' ),
                    'classic' => esc_html__( 'Classic', 'unique-elementor-addons' ),
                    'default' => esc_html__( 'Default', 'unique-elementor-addons' ),
                    'round' => esc_html__( 'Round', 'unique-elementor-addons' ),
                    'btn-absolute' => esc_html__( 'Absolute Button', 'unique-elementor-addons' ),
                ],
                'default' => 'flat',
                'separator'   => 'before',
            ]
        );


        $this->add_control(
            'form_style',
            [
                'label'        => esc_html__( 'Form Style Block', 'unique-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_off' => esc_html__( 'Off', 'unique-elementor-addons' ),
                'label_on'  => esc_html__( 'On', 'unique-elementor-addons' ),
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter .mc4wp-form-fields' => 'display: flex; flex-direction: column;',
                ],
            ]
        );

        $this->add_control(
            'heading_input',
            [
                'label' => esc_html__( 'Input', 'unique-elementor-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_responsive_control(
            'width_input',
            [
                'label'      => esc_html__( 'Input Width', 'unique-elementor-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter input[name="EMAIL"]' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'text_hide',
            [
                'label'        => esc_html__( 'Hide Text', 'unique-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_off'    => esc_html__( 'Off', 'unique-elementor-addons' ),
                'label_on'     => esc_html__( 'On', 'unique-elementor-addons' ),
                'default'      => '',
                'return_value' => 'none',
                'selectors'    => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter span' => 'display: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'heading_button',
            [
                'label' => esc_html__( 'Button', 'unique-elementor-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'icon_hide',
            [
                'label'        => esc_html__( 'Hide Icon', 'unique-elementor-addons' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_off'    => esc_html__( 'Off', 'unique-elementor-addons' ),
                'label_on'     => esc_html__( 'On', 'unique-elementor-addons' ),
                'default'      => '',
                'return_value' => 'none',
                'selectors'    => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter i' => 'display: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => esc_html__( 'Margin Icon', 'unique-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'setting_align',
            [
                'label'     => esc_html__( 'Alignment', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'unique-elementor-addons' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__( 'Center', 'unique-elementor-addons' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end'   => [
                        'title' => esc_html__( 'Right', 'unique-elementor-addons' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => '',
                'condition' => [
                    'form_style' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter .mc4wp-form-fields' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'width_button',
            [
                'label'      => esc_html__( 'Button width', 'unique-elementor-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();










        //INPUT
        $this->start_controls_section(
            'mailchip_style_input',
            [
                'label' => esc_html__( 'Input Field Style', 'unique-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'input_background',
            [
                'label'     => esc_html__( 'Background Color', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter input[name="EMAIL"]' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'input_background_theme_color',
            [
                'label' => esc_html__('Background Theme Color', 'unique-elementor-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter input[name="EMAIL"]' => 'background-color: var(--theme-color{{VALUE}})',
                ],
            ]
        );

        $this->add_control(
            'input_color',
            [
                'label'     => esc_html__( 'Text Color', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter input[name="EMAIL"]' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'input_text_theme_color',
            [
                'label' => esc_html__('Text Theme Color', 'unique-elementor-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter input[name="EMAIL"]' => 'color: var(--theme-color{{VALUE}})',
                ],
            ]
        );

        $this->add_control(
            'placeholder_color',
            [
                'label'     => esc_html__( 'Placeholder Color', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter ::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tm-mc4wp-newsletter ::-moz-placeholder'          => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tm-mc4wp-newsletter ::-ms-input-placeholder'     => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'align_input',
            [
                'label'     => esc_html__( 'Alignment', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__( 'Left', 'unique-elementor-addons' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'unique-elementor-addons' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'unique-elementor-addons' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter input[name="EMAIL"]' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(

            Group_Control_Border::get_type(),
            [
                'name'        => 'border_input',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .tm-mc4wp-newsletter input[name="EMAIL"]',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'input_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'unique-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter input[name="EMAIL"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_padding',
            [
                'label'      => esc_html__( 'Padding', 'unique-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter input[name="EMAIL"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'input_margin',
            [
                'label'      => esc_html__( 'Margin', 'unique-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter input[name="EMAIL"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();








        //Button
        $this->start_controls_section(
            'mailchip_style_button',
            [
                'label' => esc_html__( 'Button Style', 'unique-elementor-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]',
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__( 'Normal', 'unique-elementor-addons' ),
            ]
        );
        $this->add_control(
            'button_bacground',
            [
                'label'     => esc_html__( 'Background Color', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_bacground_theme_color',
            [
                'label' => esc_html__('Background Theme Color', 'unique-elementor-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]' => 'background-color: var(--theme-color{{VALUE}})',
                ],
            ]
        );
        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__( 'Text Color', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_text_theme_color',
            [
                'label' => esc_html__('Text Theme Color', 'unique-elementor-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]' => 'color: var(--theme-color{{VALUE}})',
                ],
            ]
        );
        $this->end_controls_tab();



        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__( 'Hover', 'unique-elementor-addons' ),
            ]
        );
        $this->add_control(
            'button_bacground_hover',
            [
                'label'     => esc_html__( 'Background Color', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_bacground_theme_color_hover',
            [
                'label' => esc_html__('Background Theme Color', 'unique-elementor-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]:hover' => 'background-color: var(--theme-color{{VALUE}})',
                ],
            ]
        );
        $this->add_control(
            'button_color_hover',
            [
                'label'     => esc_html__( 'Text Color', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_text_theme_color_hover',
            [
                'label' => esc_html__('Text Theme Color', 'unique-elementor-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]:hover' => 'color: var(--theme-color{{VALUE}})',
                ],
            ]
        );
        $this->add_control(
            'button_border_hover',
            [
                'label'     => esc_html__( 'Border Color', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();




        $this->start_controls_tab(
            'tab_button_focus',
            [
                'label' => esc_html__( 'Focus', 'unique-elementor-addons' ),
            ]
        );
        $this->add_control(
            'button_bacground_focus',
            [
                'label'     => esc_html__( 'Background Color', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]:forcus' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_bacground_theme_color_focus',
            [
                'label' => esc_html__('Background Theme Color', 'unique-elementor-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]:forcus' => 'background-color: var(--theme-color{{VALUE}})',
                ],
            ]
        );
        $this->add_control(
            'button_color_focus',
            [
                'label'     => esc_html__( 'Text Color', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]:focus' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_text_theme_color_focus',
            [
                'label' => esc_html__('Text Theme Color', 'unique-elementor-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]:forcus' => 'color: var(--theme-color{{VALUE}})',
                ],
            ]
        );
        $this->add_control(
            'button_border_focus',
            [
                'label'     => esc_html__( 'Border Color', 'unique-elementor-addons' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_border_theme_color_focus',
            [
                'label' => esc_html__('Border Theme Color', 'unique-elementor-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => unique_addons_theme_color_list(),
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]:forcus' => 'border-color: var(--theme-color{{VALUE}})',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();



        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_button',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'unique-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => esc_html__( 'Padding', 'unique-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_margin',
            [
                'label'      => esc_html__( 'Margin', 'unique-elementor-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tm-mc4wp-newsletter [type="submit"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
        if( $settings['design_style'] ) {
            $classes[] = 'form-style-' . $settings['design_style'];
        }
        $settings['classes'] = $classes;

        ?>
        <div class="tm-mc4wp-newsletter <?php if( !empty($classes) ) echo esc_attr(implode(' ', $classes)); ?>">
            <?php
                if (function_exists('mc4wp_show_form')) {
                    try {
                        $mailchimp_form_id = $settings['mailchimp_form_id'];
                        if( isset($mailchimp_form_id) && $mailchimp_form_id != 0 ) {
                          echo do_shortcode('[mc4wp_form id="'. $mailchimp_form_id .'"]');
                        } else {
                            esc_html_e('Please create a newsletter form from Mailchip plugin and collect your Mailchip Form ID', 'unique-elementor-addons');
                        }
                    } catch (Exception $e) {
                        esc_html_e('Please create a newsletter form from Mailchip plugins', 'unique-elementor-addons');
                    }
                }
            ?>
        </div>
        <?php
    }
}