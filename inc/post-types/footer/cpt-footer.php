<?php
/**
 * Footer template part CPT.
 *
 * @package UniqueElementorAddons
 */

namespace UniqueAddons\CPT\Footer;

use UniqueAddons\CPT\Abstract_UAE_Template_Part_CPT;
use UniqueAddons\CPT\CPT_Constants;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class CPT_Footer extends Abstract_UAE_Template_Part_CPT {

	private static $instance = null;

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		$this->pt_key        = CPT_Constants::FOOTER;
		$this->rewrite_slug  = 'uae-footer-template';
		$this->singular_name = esc_html__( 'Footer Template', 'unique-elementor-addons' );
		$this->plural_name   = esc_html__( 'Footer Templates', 'unique-elementor-addons' );
		$this->menu_icon     = 'dashicons-editor-kitchensink';
		$this->shortcode_tag = 'uae_footer';
		$this->register_admin_columns();
	}

	protected function get_description() {
		return esc_html__( 'Reusable footer layouts edited with Elementor. Display via shortcode or Elementor Theme Builder.', 'unique-elementor-addons' );
	}
}
