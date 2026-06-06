<?php
/**
 * Portfolio CPT — public content type with theme-independent templates.
 *
 * @package UniqueElementorAddons
 */

namespace UniqueAddons\CPT\Portfolio;

use UniqueAddons\CPT\Abstract_UAE_CPT;
use UniqueAddons\CPT\CPT_Constants;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Portfolio CPT.
 */
final class CPT_Portfolio extends Abstract_UAE_CPT {

	/**
	 * Singleton instance.
	 *
	 * @var CPT_Portfolio|null
	 */
	private static $instance = null;

	/**
	 * Masonry image size options.
	 *
	 * @var array
	 */
	private $masonry_mode_image_size = array();

	/**
	 * Get singleton.
	 *
	 * @return CPT_Portfolio
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		$this->pt_key        = CPT_Constants::PORTFOLIO;
		$this->rewrite_slug  = 'uae-portfolio';
		$this->singular_name = esc_html__( 'Portfolio Item', 'unique-elementor-addons' );
		$this->plural_name   = esc_html__( 'Portfolio', 'unique-elementor-addons' );
		$this->menu_icon     = 'dashicons-portfolio';

		if ( function_exists( 'unique_addons_masonry_image_sizes' ) ) {
			$this->masonry_mode_image_size = unique_addons_masonry_image_sizes();
		}

		add_filter( 'manage_edit-' . $this->pt_key . '_columns', array( $this, 'admin_columns' ) );
		add_filter( 'manage_' . $this->pt_key . '_posts_custom_column', array( $this, 'admin_column_content' ), 10, 2 );

		if ( defined( 'RWMB_VER' ) ) {
			add_filter( 'rwmb_meta_boxes', array( $this, 'register_meta_boxes' ) );
		}
	}

	/**
	 * {@inheritdoc}
	 */
	public function register() {
		register_post_type(
			$this->pt_key,
			array_merge(
				$this->get_base_args(),
				array(
					'labels'              => $this->get_labels(),
					'description'           => esc_html__( 'Portfolio items for use with Unique Elementor Addons widgets.', 'unique-elementor-addons' ),
					'supports'              => array( 'title', 'thumbnail', 'editor', 'excerpt', 'comments', 'page-attributes', 'revisions' ),
					'taxonomies'            => array( CPT_Constants::PORTFOLIO_CAT, CPT_Constants::PORTFOLIO_TAG ),
					'hierarchical'          => false,
					'public'                => true,
					'show_ui'               => true,
					'show_in_menu'          => 'uae-templates',
					'menu_icon'             => $this->menu_icon,
					'show_in_admin_bar'     => true,
					'show_in_nav_menus'     => true,
					'can_export'            => true,
					'has_archive'           => true,
					'exclude_from_search'   => false,
					'publicly_queryable'    => true,
					'rewrite'               => array(
						'slug'       => $this->rewrite_slug,
						'with_front' => false,
					),
				)
			)
		);

		$this->register_category_taxonomy();
		$this->register_tag_taxonomy();
		$this->enable_elementor_support();
	}

	/**
	 * Register portfolio category taxonomy.
	 *
	 * @return void
	 */
	private function register_category_taxonomy() {
		$this->register_taxonomy(
			CPT_Constants::PORTFOLIO_CAT,
			true,
			array(
				'name'          => esc_html__( 'Portfolio Categories', 'unique-elementor-addons' ),
				'singular_name' => esc_html__( 'Portfolio Category', 'unique-elementor-addons' ),
				'menu_name'     => esc_html__( 'Categories', 'unique-elementor-addons' ),
				'all_items'     => esc_html__( 'All Categories', 'unique-elementor-addons' ),
				'edit_item'     => esc_html__( 'Edit Category', 'unique-elementor-addons' ),
				'view_item'     => esc_html__( 'View Category', 'unique-elementor-addons' ),
				'update_item'   => esc_html__( 'Update Category', 'unique-elementor-addons' ),
				'add_new_item'  => esc_html__( 'Add New Category', 'unique-elementor-addons' ),
				'new_item_name' => esc_html__( 'New Category Name', 'unique-elementor-addons' ),
				'search_items'  => esc_html__( 'Search Categories', 'unique-elementor-addons' ),
				'not_found'     => esc_html__( 'No categories found.', 'unique-elementor-addons' ),
			),
			'uae-portfolio-category'
		);
	}

	/**
	 * Register portfolio tag taxonomy.
	 *
	 * @return void
	 */
	private function register_tag_taxonomy() {
		$this->register_taxonomy(
			CPT_Constants::PORTFOLIO_TAG,
			false,
			array(
				'name'          => esc_html__( 'Portfolio Tags', 'unique-elementor-addons' ),
				'singular_name' => esc_html__( 'Portfolio Tag', 'unique-elementor-addons' ),
				'menu_name'     => esc_html__( 'Tags', 'unique-elementor-addons' ),
				'all_items'     => esc_html__( 'All Tags', 'unique-elementor-addons' ),
				'edit_item'     => esc_html__( 'Edit Tag', 'unique-elementor-addons' ),
				'view_item'     => esc_html__( 'View Tag', 'unique-elementor-addons' ),
				'update_item'   => esc_html__( 'Update Tag', 'unique-elementor-addons' ),
				'add_new_item'  => esc_html__( 'Add New Tag', 'unique-elementor-addons' ),
				'new_item_name' => esc_html__( 'New Tag Name', 'unique-elementor-addons' ),
				'search_items'  => esc_html__( 'Search Tags', 'unique-elementor-addons' ),
				'not_found'     => esc_html__( 'No tags found.', 'unique-elementor-addons' ),
			),
			'uae-portfolio-tag'
		);
	}

	/**
	 * Admin list table columns.
	 *
	 * @param array $columns Existing columns.
	 * @return array
	 */
	public function admin_columns( $columns ) {
		return array(
			'cb'        => $columns['cb'],
			'title'     => esc_html__( 'Title', 'unique-elementor-addons' ),
			'thumbnail' => esc_html__( 'Thumbnail', 'unique-elementor-addons' ),
			'category'  => esc_html__( 'Category', 'unique-elementor-addons' ),
			'tag'       => esc_html__( 'Tags', 'unique-elementor-addons' ),
			'date'      => esc_html__( 'Date', 'unique-elementor-addons' ),
		);
	}

	/**
	 * Admin list table column content.
	 *
	 * @param string $column Column key.
	 * @param int    $post_id Post ID.
	 * @return void
	 */
	public function admin_column_content( $column, $post_id ) {
		switch ( $column ) {
			case 'category':
				echo wp_kses_post( get_the_term_list( $post_id, CPT_Constants::PORTFOLIO_CAT, '', ', ', '' ) ?: '<span aria-hidden="true">—</span>' );
				break;

			case 'tag':
				echo wp_kses_post( get_the_term_list( $post_id, CPT_Constants::PORTFOLIO_TAG, '', ', ', '' ) ?: '<span aria-hidden="true">—</span>' );
				break;

			case 'thumbnail':
				echo get_the_post_thumbnail( $post_id, array( 64, 64 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				break;
		}
	}

	/**
	 * Optional Meta Box fields when Meta Box plugin is active.
	 *
	 * @param array $meta_boxes Existing meta boxes.
	 * @return array
	 */
	public function register_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Portfolio Settings', 'unique-elementor-addons' ),
			'post_types' => $this->pt_key,
			'fields'     => array(
				array(
					'name' => esc_html__( 'Project URL', 'unique-elementor-addons' ),
					'id'   => 'uae_portfolio_project_url',
					'type' => 'url',
				),
				array(
					'name' => esc_html__( 'Project Link Label', 'unique-elementor-addons' ),
					'id'   => 'uae_portfolio_project_link_label',
					'type' => 'text',
				),
				array(
					'name'             => esc_html__( 'Gallery Images', 'unique-elementor-addons' ),
					'id'               => 'uae_portfolio_gallery',
					'type'             => 'image_advanced',
					'max_file_uploads' => 20,
				),
			),
		);

		if ( ! empty( $this->masonry_mode_image_size ) ) {
			$meta_boxes[ count( $meta_boxes ) - 1 ]['fields'][] = array(
				'name'    => esc_html__( 'Masonry Image Size', 'unique-elementor-addons' ),
				'id'      => 'uae_portfolio_masonry_size',
				'type'    => 'select',
				'options' => $this->masonry_mode_image_size,
			);
		}

		return $meta_boxes;
	}

	/**
	 * Taxonomy key accessor for widgets.
	 *
	 * @return string
	 */
	public function get_taxonomy_key() {
		return CPT_Constants::PORTFOLIO_CAT;
	}
}
