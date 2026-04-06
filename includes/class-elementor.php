<?php
/**
 * Elementor integration: registers widget category & widget.
 *
 * @package WWH_Services_Carousel
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WWH_SC_Elementor_Manager {

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	public function init() {
		// Bail if Elementor is not active.
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'missing_elementor_notice' ] );
			return;
		}

		add_action( 'elementor/widgets/register', [ $this, 'register_widget' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_category' ] );
	}

	/**
	 * Register custom widget category.
	 *
	 * @param \Elementor\Elements_Manager $elements_manager
	 */
	public function register_category( $elements_manager ) {
		$elements_manager->add_category(
			'wwh-widgets',
			[
				'title' => __( 'WWH Widgets', 'wwh-services-carousel' ),
				'icon'  => 'fa fa-plug',
			]
		);
	}

	/**
	 * Register the carousel widget.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager
	 */
	public function register_widget( $widgets_manager ) {
		require_once WWH_SC_PATH . 'includes/class-widget.php';
		$widgets_manager->register( new WWH_SC_Widget() );
	}

	/**
	 * Admin notice when Elementor is not installed/active.
	 */
	public function missing_elementor_notice() {
		$message = sprintf(
			// translators: %1$s = plugin name, %2$s = opening link, %3$s = closing link.
			esc_html__( '"%1$s" requires %2$sElementor%3$s to be installed and activated.', 'wwh-services-carousel' ),
			'<strong>' . esc_html__( 'WWH Services Carousel', 'wwh-services-carousel' ) . '</strong>',
			'<strong>',
			'</strong>'
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%s</p></div>', $message );
	}
}
