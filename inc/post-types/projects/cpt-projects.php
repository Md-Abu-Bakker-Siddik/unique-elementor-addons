<?php
/**
 * Projects public content CPT.
 *
 * @package UniqueElementorAddons
 */

namespace UniqueAddons\CPT\Projects;

use UniqueAddons\CPT\Abstract_UAE_CPT;
use UniqueAddons\CPT\CPT_Constants;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Projects CPT.
 */
final class CPT_Projects extends Abstract_UAE_CPT {

	/** @var CPT_Projects|null */
	private static $instance = null;

	/** @var string Legacy property used by Elementor widgets. */
	public $ptKey;

	/** @var string Legacy taxonomy property. */
	public $ptTaxKey;

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		$this->pt_key        = CPT_Constants::PROJECT;
		$this->rewrite_slug  = 'uae-project';
		$this->singular_name = esc_html__( 'Project', 'unique-elementor-addons' );
		$this->plural_name   = esc_html__( 'Projects', 'unique-elementor-addons' );
		$this->menu_icon     = 'dashicons-portfolio';
		$this->ptKey         = $this->pt_key;
		$this->ptTaxKey      = CPT_Constants::PROJECT_CAT;

		add_filter( 'manage_edit-' . $this->pt_key . '_columns', array( $this, 'admin_columns' ) );
		add_filter( 'manage_' . $this->pt_key . '_posts_custom_column', array( $this, 'admin_column_content' ), 10, 2 );

		if ( defined( 'RWMB_VER' ) ) {
			add_filter( 'rwmb_meta_boxes', array( $this, 'register_meta_boxes' ) );
		}
	}

	public function getPTTaxKey() {
		return CPT_Constants::PROJECT_CAT;
	}

	public function register() {
		register_post_type(
			$this->pt_key,
			array_merge(
				$this->get_base_args(),
				array(
					'labels'              => $this->get_labels(),
					'description'         => esc_html__( 'Project items for use with Unique Elementor Addons widgets.', 'unique-elementor-addons' ),
					'supports'            => array( 'title', 'thumbnail', 'editor', 'excerpt', 'page-attributes', 'revisions' ),
					'taxonomies'          => array( CPT_Constants::PROJECT_CAT ),
					'hierarchical'        => false,
					'public'              => true,
					'show_ui'             => true,
					'show_in_menu'        => 'uae-templates',
					'menu_icon'           => $this->menu_icon,
					'show_in_admin_bar'   => true,
					'show_in_nav_menus'   => true,
					'can_export'          => true,
					'has_archive'         => true,
					'exclude_from_search' => false,
					'publicly_queryable'  => true,
					'rewrite'             => array(
						'slug'       => $this->rewrite_slug,
						'with_front' => false,
					),
				)
			)
		);

		$this->register_taxonomy(
			CPT_Constants::PROJECT_CAT,
			true,
			array(
				'name'          => esc_html__( 'Project Categories', 'unique-elementor-addons' ),
				'singular_name' => esc_html__( 'Project Category', 'unique-elementor-addons' ),
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
			'uae-project-category'
		);

		$this->enable_elementor_support();
	}

	public function admin_columns( $columns ) {
		return array(
			'cb'        => $columns['cb'],
			'title'     => esc_html__( 'Title', 'unique-elementor-addons' ),
			'thumbnail' => esc_html__( 'Thumbnail', 'unique-elementor-addons' ),
			'category'  => esc_html__( 'Category', 'unique-elementor-addons' ),
			'date'      => esc_html__( 'Date', 'unique-elementor-addons' ),
		);
	}

	public function admin_column_content( $column, $post_id ) {
		switch ( $column ) {
			case 'category':
				echo wp_kses_post( get_the_term_list( $post_id, CPT_Constants::PROJECT_CAT, '', ', ', '' ) ?: '<span aria-hidden="true">—</span>' );
				break;
			case 'thumbnail':
				echo get_the_post_thumbnail( $post_id, array( 64, 64 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				break;
		}
	}

	public function register_meta_boxes( $meta_boxes ) {
		$meta_boxes[] = array(
			'title'      => esc_html__( 'Project Settings', 'unique-elementor-addons' ),
			'post_types' => $this->pt_key,
			'fields'     => array(
				array(
					'name' => esc_html__( 'Project Subtitle', 'unique-elementor-addons' ),
					'id'   => 'uae_project_subtitle',
					'type' => 'text',
				),
			),
		);
		return $meta_boxes;
	}
}
