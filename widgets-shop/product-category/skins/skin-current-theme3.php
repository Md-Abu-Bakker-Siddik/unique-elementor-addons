<?php
namespace UniqueAddons\Widgets\Products_Category\Skins;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Current_Theme3 extends Elementor_Skin_Base {

	protected function _register_controls_actions() {
		add_action( 'elementor/element/uae-product-category/paragraph_opt/after_section_end', [ $this, 'register_layout_controls1' ] );
	}

	public function get_id() {
		return 'skin-current-theme3';
	}


	public function get_title() {
		return __( 'Skin - Current Theme3', 'unique-elementor-addons' );
	}


	public function register_layout_controls1( Widget_Base $widget ) {
		$this->parent = $widget;
		$this->start_controls_section(
			'bg_img_color_style',
			[
				'label' => esc_html__('Background Image/Color', 'unique-elementor-addons'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->start_controls_tabs('tab_bg');
		$this->start_controls_tab(
			'tab_bg_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_before_background',
				'label' => esc_html__( 'Background', 'unique-elementor-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .tm-product-category-current-theme1:before',
			]
		);
		$this->add_responsive_control(
			'wrapper_before_width',
			[
				'label'      => esc_html__('Background Width', 'unique-elementor-addons'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tm-product-category-current-theme1:before' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'wrapper_before_height',
			[
				'label'      => esc_html__('Background Height', 'unique-elementor-addons'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .tm-product-category-current-theme1:before' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'wrapper_before_color',
			[
				'label'     => esc_html__('Background Color', 'unique-elementor-addons'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .tm-product-category-current-theme1:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'wrapper_before_theme_colored',
			[
				'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .tm-product-category-current-theme1:before' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'wrapper_before_border_radius',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .tm-product-category-current-theme1:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_bg_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'wrapper_before_background_hover',
				'label' => esc_html__( 'Background', 'unique-elementor-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}}:hover .tm-product-category-current-theme1:before',
			]
		);
		$this->add_responsive_control(
			'wrapper_before_width_hover',
			[
				'label'      => esc_html__('Background Width', 'unique-elementor-addons'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}}:hover .tm-product-category-current-theme1:before' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'wrapper_before_height_hover',
			[
				'label'      => esc_html__('Background Height', 'unique-elementor-addons'),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1200,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}}:hover .tm-product-category-current-theme1:before' => 'height: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_control(
			'wrapper_before_color_hover',
			[
				'label'     => esc_html__('Background Color', 'unique-elementor-addons'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-product-category-current-theme1:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'wrapper_before_theme_colored_hover',
			[
				'label' => esc_html__( "Background Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .tm-product-category-current-theme1:before' => 'background-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->add_responsive_control(
			'wrapper_before_border_radius_hover',
			[
				'label' => esc_html__( "Border Radius", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}}:hover .tm-product-category-current-theme1:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();






		$this->start_controls_section(
			'current_theme2_bg_style',
			[
				'label' => esc_html__('Background Option (Current Theme Skin3)', 'unique-elementor-addons'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs('current_theme2_bg_tab');
		$this->start_controls_tab(
			'current_theme2_bg_tab_normal',
			[
				'label' => esc_html__('Normal', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'current_theme2_wrapper_border_color',
			[
				'label'     => esc_html__('Wrapper Border Color', 'unique-elementor-addons'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .content-wrapper .content-inner .cat-image:after' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'current_theme2_wrapper_border_theme_colored',
			[
				'label' => esc_html__( "Wrapper Border Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .content-wrapper .content-inner .cat-image:after' => 'border-color: var(--theme-color{{VALUE}});'
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'current_theme2_bg_tab_hover',
			[
				'label' => esc_html__('Hover', 'unique-elementor-addons'),
			]
		);
		$this->add_control(
			'current_theme2_wrapper_border_color_hover',
			[
				'label'     => esc_html__('Wrapper Border Color', 'unique-elementor-addons'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}:hover .content-wrapper .content-inner .cat-image:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}}:hover .content-wrapper .content-inner .cat-image:before' => 'filter: drop-shadow(0 1px 0 {{VALUE}});',
				],
			]
		);
		$this->add_responsive_control(
			'current_theme2_wrapper_border_theme_colored_hover',
			[
				'label' => esc_html__( "Wrapper Border Theme Colored", 'unique-elementor-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => unique_addons_theme_color_list(),
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}:hover .content-wrapper .content-inner .cat-image:after' => 'border-color: var(--theme-color{{VALUE}});',
					'{{WRAPPER}}:hover .content-wrapper .content-inner .cat-image:before' => 'filter: drop-shadow(0 1px 0 var(--theme-color{{VALUE}}));',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	public function render() {
		$html = '';
		$settings = $this->parent->get_settings_for_display();

		if (empty($settings['categories'])) {
			echo esc_html__('Choose Category', 'unique-elementor-addons');
			return;
		}

		$category = get_term_by('slug', $settings['categories'], 'product_cat');
		if (!is_wp_error($category) && !empty($category)) {

			if (!empty($settings['category_image']['id'])) {
				$image = Group_Control_Image_Size::get_attachment_image_src($settings['category_image']['id'], 'image', $settings);
			} else {
				$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
				if (!empty($thumbnail_id)) {
					$image = wp_get_attachment_url($thumbnail_id);
				} else {
					$image = wc_placeholder_img_src();
				}
			}
			?>

			<div class="tm-product-category-current-theme3">
				<div class="content-wrapper">
					<div class="content-inner" data-text="<?php echo empty($settings['categories_name']) ? esc_html($category->name) : $settings['categories_name']; ?>">
						<div class="cat-image">
							<a class="link_category_product" href="<?php echo esc_url(get_term_link($category)); ?>"
								title="<?php echo esc_attr($category->name); ?>">
								<?php if( $settings['icon_type'] == 'image' ) { ?>
									<img src="<?php echo esc_url_raw($image); ?>" alt="<?php echo esc_attr($category->name); ?>">
								<?php } else if( $settings['icon_type'] == 'flat-icon' ) { ?>
									<span class="flat-icon"><?php \Elementor\Icons_Manager::render_icon( $settings['category_flaticon'], [ 'aria-hidden' => 'true' ] ); ?></span>
								<?php } ?>
							</a>
						</div>

						<div class="cat-details">
							<<?php echo esc_attr( $settings['title_tag'] );?> class="cat-title">
								<a href="<?php echo esc_url(get_term_link($category)); ?>"
									title="<?php echo esc_attr($category->name); ?>">
									<span class="cats-title-text"><?php echo empty($settings['categories_name']) ? esc_html($category->name) : $settings['categories_name']; ?></span>
								</a>
							</<?php echo esc_attr( $settings['title_tag'] );?>>
							<?php if ( $settings['show_count'] == 'yes' ) { ?>
							<div class="count"><?php echo esc_html($category->count) . ' ' . esc_html__('products', 'unique-elementor-addons'); ?> </div>
							<?php } ?>
							<?php if ( $settings['show_paragraph'] == 'yes' ) { ?>
								<div class="paragraph"><?php echo wp_kses_post( $settings['content'] ); ?></div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<?php
		}
	}
}
