<?php
/**
 * Enqueue front-end & editor assets.
 *
 * @package WWH_Services_Carousel
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WWH_SC_Assets {

	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend' ] );
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'enqueue_editor' ] );
	}

	/**
	 * Front-end assets.
	 */
	public function enqueue_frontend() {
		// Google Fonts: Manrope + Inter
		wp_enqueue_style(
			'wwh-sc-google-fonts',
			'https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap',
			[],
			null
		);

		// Swiper CSS
		wp_enqueue_style(
			'swiper',
			'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
			[],
			'11.0.0'
		);

		// Plugin stylesheet
		wp_enqueue_style(
			'wwh-sc-style',
			WWH_SC_ASSETS_URL . 'style.css',
			[ 'swiper' ],
			WWH_SC_VERSION
		);

		// Swiper JS
		wp_enqueue_script(
			'swiper',
			'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
			[],
			'11.0.0',
			true
		);

		// Plugin JS
		wp_enqueue_script(
			'wwh-sc-script',
			WWH_SC_ASSETS_URL . 'script.js',
			[ 'swiper' ],
			WWH_SC_VERSION,
			true
		);
	}

	/**
	 * Editor assets (Elementor editor preview).
	 */
	public function enqueue_editor() {
		wp_enqueue_style(
			'wwh-sc-editor',
			WWH_SC_ASSETS_URL . 'style.css',
			[],
			WWH_SC_VERSION
		);
	}
}
