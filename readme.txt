=== Unique Elementor Addons ===
Contributors: mdabubakkersiddik1
Tags: elementor, page builder, widgets, addons, woocommerce
Requires at least: 6.0
Tested up to: 6.8
Requires PHP: 7.4
Requires Plugins: elementor
Stable tag: 2.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A collection of custom Elementor widgets and extensions for building modern WordPress sites.

== Description ==

Unique Elementor Addons extends Elementor with a library of custom widgets, layout helpers, and content modules for blogs, portfolios, WooCommerce stores, and marketing pages.

**Disclaimer:** This plugin is an independent third-party add-on. It is not affiliated with, endorsed by, or officially connected to Elementor or Elementor Ltd.

= Highlights =

* 70+ Elementor widgets across content, layout, and shop categories
* Blog and project archive widgets with grid, masonry, and carousel layouts
* WooCommerce product list, tabs, category, cart, and wishlist widgets
* Section, column, and container enhancements for Elementor
* Translation-ready with the `unique-elementor-addons` text domain

= Requirements =

* WordPress 6.0 or higher
* PHP 7.4 or higher
* Elementor 3.0 or higher

= Third-Party Resources =

This plugin bundles the following GPL-compatible libraries and assets:

* [WordPress Post Like System](https://github.com/JonMasterson/WordPress-Post-Like-System) by Jon Masterson (GPLv3)
* [Matthew Ruddy Image Resizer](http://easinglider.com) by Matthew Ruddy (GPLv2+)
* [Font Awesome Free](https://fontawesome.com) (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT)
* [Swiper](https://swiperjs.com) (MIT)
* [Slick Carousel](https://kenwheeler.github.io/slick/) (MIT)
* [Isotope](https://isotope.metafizzy.co) (GPLv3 for Metafizzy commercial license / GPLv3 compatible bundled build)
* [Bootstrap SCSS](https://getbootstrap.com) (MIT) — source files excluded from release package
* [LightGallery](https://www.lightgalleryjs.com) (GPLv3)
* [Magnific Popup](https://github.com/dimsemenov/Magnific-Popup) (MIT)

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/unique-elementor-addons` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the **Plugins** screen in WordPress.
3. Make sure Elementor is installed and activated.
4. Open any page with Elementor and look for widgets under the **Unique Addons** category.

== Frequently Asked Questions ==

= Does this plugin work without Elementor? =

No. Elementor must be installed and activated.

= Does this plugin work with any theme? =

Yes. The plugin is designed to work with any WordPress theme that supports Elementor.

= Is WooCommerce required? =

No. WooCommerce is only required if you use the shop-related widgets.

= Is this an official Elementor plugin? =

No. Unique Elementor Addons is developed independently and is not affiliated with Elementor.

== Screenshots ==

1. Elementor widgets under the Unique Addons category in the editor panel.
2. Blog and portfolio grid widgets on the frontend.
3. WooCommerce product widgets for shop pages.
4. Section and column layout enhancements in Elementor.

== Changelog ==

= 2.0.0 =
* Initial WordPress.org release as Unique Elementor Addons
* Renamed plugin bootstrap, text domain, prefixes, and Elementor widget category
* Refactored all custom post types with the `uae_` prefix for WordPress.org compliance
* Template parts (header, footer, mega menu, page title, side panel) use shortcodes — no theme auto-injection
* Added theme-independent single/archive fallback templates for portfolio and project CPTs
* Added template escaping helpers and sanitization across widget templates
* Secured post-like AJAX handler with nonce verification and input validation
* Removed bundled Redux Framework, ScssPhp, and legacy maintenance mode loader
* Removed unused development dependencies from the release package
* Hardened image resizer to use WordPress attachment APIs instead of server paths
* Added translation template at `languages/unique-elementor-addons.pot`
* Added WordPress.org release packaging via `.distignore`

== Upgrade Notice ==

= 2.0.0 =
Initial public release. Activate Elementor before upgrading or installing.
