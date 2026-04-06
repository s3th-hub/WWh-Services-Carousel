<?php
/**
 * Plugin Name:       WWH Services Carousel
 * Plugin URI:        https://yourwebsite.com/wwh-services-carousel
 * Description:       A responsive, animated Services Carousel widget for Elementor with a custom Services CPT.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            s3thhub
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wwh-services-carousel
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ─── Constants ────────────────────────────────────────────────────────────────
define( 'WWH_SC_VERSION',     '1.0.0' );
define( 'WWH_SC_FILE',        __FILE__ );
define( 'WWH_SC_PATH',        plugin_dir_path( __FILE__ ) );
define( 'WWH_SC_URL',         plugin_dir_url( __FILE__ ) );
define( 'WWH_SC_ASSETS_URL',  WWH_SC_URL  . 'assets/' );
define( 'WWH_SC_ASSETS_PATH', WWH_SC_PATH . 'assets/' );

// ─── Autoload ─────────────────────────────────────────────────────────────────
require_once WWH_SC_PATH . 'includes/class-cpt.php';
require_once WWH_SC_PATH . 'includes/class-assets.php';
require_once WWH_SC_PATH . 'includes/class-elementor.php';

// ─── Bootstrap ────────────────────────────────────────────────────────────────
new WWH_SC_CPT();
new WWH_SC_Assets();
new WWH_SC_Elementor_Manager();

// ─── Activation ───────────────────────────────────────────────────────────────
register_activation_hook( __FILE__, 'wwh_sc_activate' );
function wwh_sc_activate() {
	( new WWH_SC_CPT() )->register();
	flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'wwh_sc_deactivate' );
function wwh_sc_deactivate() {
	flush_rewrite_rules();
}
