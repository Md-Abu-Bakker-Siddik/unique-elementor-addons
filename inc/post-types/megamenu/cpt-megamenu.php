<?php
/**
 * Mega menu template part CPT.
 *
 * @package UniqueElementorAddons
 */

namespace UniqueAddons\CPT\MegaMenu;

use UniqueAddons\CPT\Abstract_UAE_Template_Part_CPT;
use UniqueAddons\CPT\CPT_Constants;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class CPT_MegaMenu extends Abstract_UAE_Template_Part_CPT {

	private static $instance = null;

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		$this->pt_key        = CPT_Constants::MEGAMENU;
		$this->rewrite_slug  = 'uae-megamenu-template';
		$this->singular_name = esc_html__( 'Mega Menu Template', 'unique-elementor-addons' );
		$this->plural_name   = esc_html__( 'Mega Menu Templates', 'unique-elementor-addons' );
		$this->menu_icon     = 'dashicons-menu-alt3';
		$this->shortcode_tag = 'uae_megamenu';
		$this->register_admin_columns();
	}

	protected function get_description() {
		return esc_html__( 'Reusable mega menu layouts edited with Elementor. Display via shortcode or Elementor Theme Builder.', 'unique-elementor-addons' );
	}
}
