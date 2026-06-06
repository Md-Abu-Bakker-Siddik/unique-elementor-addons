<?php

if ( ! class_exists( 'UniqueAddonsScriptsHandler' ) ) {
	/**
	 * Main theme class with configuration
	 */
	class UniqueAddonsScriptsHandler {
		private static $instance;

		public function __construct() {

			// Include theme's script and localize theme's main js script
			add_action( 'wp_enqueue_scripts', array( $this, 'include_js_scripts' ) );

			// Include theme's 3rd party plugins styles
			add_action( 'unique_addons_action_before_main_css', array( $this, 'include_plugins_styles' ) );

			// Include theme's 3rd party plugins scripts
			add_action( 'unique_addons_action_before_main_js', array( $this, 'include_plugins_scripts' ) );

		}

		public static function get_instance() {
			if ( ! ( self::$instance instanceof self ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function include_js_scripts() {
			// JS dependency variable
			$main_js_dependency  = apply_filters( 'unique_addons_filter_main_js_dependency', array( 'jquery' ) );

			// Hook to include additional scripts before theme's main script
			do_action( 'unique_addons_action_before_main_js', $main_js_dependency );

			// Hook to include additional scripts after theme's main script
			do_action( 'unique_addons_action_after_main_js' );
		}

		function include_plugins_styles() {
		}

		function include_plugins_scripts() {

			// JS dependency variables
			$js_3rd_party_dependency = apply_filters( 'unique_addons_filter_js_3rd_party_dependency', 'jquery' );




			$direction_suffix = is_rtl() ? '.rtl' : '';

			// Enqueue 3rd party plugins script
			wp_register_script( 'swiper', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/swiper/swiper.min.js', $js_3rd_party_dependency, false, true );
			wp_register_style( 'swiper', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/swiper/swiper.min.css', array(), '11.0.5' );

			wp_register_script( 'slick', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/slick/slick.min.js', array( 'jquery' ), '1.8.1', true );
			wp_register_style( 'slick', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/slick/slick.css', array(), '1.8.1' );
			wp_register_style( 'slick-theme', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/slick/slick-theme.css', array( 'slick' ), '1.8.1' );




			//external plugins js & css:
			//used when needed:

			wp_register_script( 'lightgallery', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/lightgallery/js/lightgallery.min.js', array('jquery'), false, true );
			wp_register_style( 'lightgallery', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/lightgallery/css/lightgallery.min.css' );
			wp_register_script( 'jquery-mousewheel', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/jquery.mousewheel.min.js', array('jquery'), false, true );
			wp_register_script( 'mediko-custom-lightgallery', UNIQUE_ADDONS_ASSETS_URI . '/js/custom-lightgallery.js', array('jquery'), false, true );





			wp_register_script( 'jquery-parallax-scroll', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/jquery.parallax-scroll.js', array('jquery'), false, true );


			wp_register_script( 'sticky-sidebar', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/sticky-sidebar.min.js', null, false, true );
			wp_register_script( 'sticky-kit', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/sticky-kit.min.js', array('jquery'), false, true );
			wp_enqueue_script( 'jquery-tilt', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/jquery.tilt.min.js', array('jquery'), false, true );



			wp_register_script( 'matchHeight', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/jquery.matchHeight-min.js', array('jquery'), false, true );

			$plugin_version = defined( 'UNIQUE_ADDONS_VERSION' ) ? UNIQUE_ADDONS_VERSION : '2.0.0';

			wp_register_script( 'imagesloaded', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/imagesloaded.pkgd.min.js', array( 'jquery' ), '5.0.0', true );
			wp_register_script( 'isotope', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/isotope.pkgd.min.js', array( 'jquery' ), '3.0.6', true );
			wp_register_script( 'uae-isotope', UNIQUE_ADDONS_ASSETS_URI . '/js/plugins/isotope.pkgd.min.js', array( 'jquery', 'imagesloaded' ), '3.0.6', true );

			wp_register_script(
				'unique-addons-elementor',
				UNIQUE_ADDONS_ASSETS_URI . '/js/custom-elementor.js',
				array( 'jquery', 'imagesloaded', 'isotope', 'swiper' ),
				$plugin_version,
				true
			);

			wp_register_script(
				'uae-custom-elementor',
				UNIQUE_ADDONS_ASSETS_URI . '/js/custom-elementor.js',
				array( 'jquery', 'imagesloaded', 'isotope', 'swiper' ),
				$plugin_version,
				true
			);

		}
	}

	UniqueAddonsScriptsHandler::get_instance();
}