<?php
/**
 * Side panel template part CPT.
 *
 * @package UniqueElementorAddons
 */

namespace UniqueAddons\CPT\SidePushPanel;

use UniqueAddons\CPT\Abstract_UAE_Template_Part_CPT;
use UniqueAddons\CPT\CPT_Constants;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Side push panel template part.
 */
final class CPT_SidePushPanel extends Abstract_UAE_Template_Part_CPT {

	/** @var CPT_SidePushPanel|null */
	private static $instance = null;

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		$this->pt_key        = CPT_Constants::SIDE_PANEL;
		$this->rewrite_slug  = 'uae-side-panel-template';
		$this->singular_name = esc_html__( 'Side Panel Template', 'unique-elementor-addons' );
		$this->plural_name   = esc_html__( 'Side Panel Templates', 'unique-elementor-addons' );
		$this->menu_icon     = 'dashicons-align-pull-left';
		$this->shortcode_tag = 'uae_side_panel';
		$this->register_admin_columns();
	}

	protected function get_description() {
		return esc_html__( 'Reusable off-canvas / side panel templates edited with Elementor. Display via shortcode or Elementor widget.', 'unique-elementor-addons' );
	}
}
