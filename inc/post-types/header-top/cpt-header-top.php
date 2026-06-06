<?php
/**
 * Header top template part CPT.
 *
 * @package UniqueElementorAddons
 */

namespace UniqueAddons\CPT\HeaderTop;

use UniqueAddons\CPT\Abstract_UAE_Template_Part_CPT;
use UniqueAddons\CPT\CPT_Constants;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Header top template part.
 */
final class CPT_HeaderTop extends Abstract_UAE_Template_Part_CPT {

	/** @var CPT_HeaderTop|null */
	private static $instance = null;

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		$this->pt_key        = CPT_Constants::HEADER_TOP;
		$this->rewrite_slug  = 'uae-header-top-template';
		$this->singular_name = esc_html__( 'Header Top Template', 'unique-elementor-addons' );
		$this->plural_name   = esc_html__( 'Header Top Templates', 'unique-elementor-addons' );
		$this->menu_icon     = 'dashicons-arrow-up-alt';
		$this->shortcode_tag = 'uae_header_top';
		$this->register_admin_columns();
	}

	protected function get_description() {
		return esc_html__( 'Reusable header top bar templates edited with Elementor. Display via shortcode or Elementor Theme Builder.', 'unique-elementor-addons' );
	}
}
