<?php
/**
 * Page title template part CPT.
 *
 * @package UniqueElementorAddons
 */

namespace UniqueAddons\CPT\PageTitle;

use UniqueAddons\CPT\Abstract_UAE_Template_Part_CPT;
use UniqueAddons\CPT\CPT_Constants;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Page title template part.
 */
final class CPT_PageTitle extends Abstract_UAE_Template_Part_CPT {

	/** @var CPT_PageTitle|null */
	private static $instance = null;

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		$this->pt_key        = CPT_Constants::PAGE_TITLE;
		$this->rewrite_slug  = 'uae-page-title-template';
		$this->singular_name = esc_html__( 'Page Title Template', 'unique-elementor-addons' );
		$this->plural_name   = esc_html__( 'Page Title Templates', 'unique-elementor-addons' );
		$this->menu_icon     = 'dashicons-heading';
		$this->shortcode_tag = 'uae_page_title';
		$this->register_admin_columns();
	}

	protected function get_description() {
		return esc_html__( 'Reusable page title / breadcrumb templates edited with Elementor. Display via shortcode or Elementor Theme Builder.', 'unique-elementor-addons' );
	}
}
