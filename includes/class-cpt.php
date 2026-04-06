<?php
/**
 * Custom Post Type: Services
 *
 * @package WWH_Services_Carousel
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WWH_SC_CPT {

	public function __construct() {
		add_action( 'init', [ $this, 'register' ] );
		add_action( 'after_setup_theme', [ $this, 'add_thumbnail_support' ] );
		add_filter( 'post_updated_messages', [ $this, 'updated_messages' ] );
	}

	/**
	 * Register the "wwh_service" Custom Post Type.
	 */
	public function register() {
		$labels = [
			'name'                  => _x( 'Services', 'Post type general name', 'wwh-services-carousel' ),
			'singular_name'         => _x( 'Service', 'Post type singular name', 'wwh-services-carousel' ),
			'menu_name'             => _x( 'Services', 'Admin Menu text', 'wwh-services-carousel' ),
			'name_admin_bar'        => _x( 'Service', 'Add New on Toolbar', 'wwh-services-carousel' ),
			'add_new'               => __( 'Add New', 'wwh-services-carousel' ),
			'add_new_item'          => __( 'Add New Service', 'wwh-services-carousel' ),
			'new_item'              => __( 'New Service', 'wwh-services-carousel' ),
			'edit_item'             => __( 'Edit Service', 'wwh-services-carousel' ),
			'view_item'             => __( 'View Service', 'wwh-services-carousel' ),
			'all_items'             => __( 'All Services', 'wwh-services-carousel' ),
			'search_items'          => __( 'Search Services', 'wwh-services-carousel' ),
			'not_found'             => __( 'No services found.', 'wwh-services-carousel' ),
			'not_found_in_trash'    => __( 'No services found in Trash.', 'wwh-services-carousel' ),
			'featured_image'        => __( 'Service Featured Image', 'wwh-services-carousel' ),
			'set_featured_image'    => __( 'Set featured image', 'wwh-services-carousel' ),
			'remove_featured_image' => __( 'Remove featured image', 'wwh-services-carousel' ),
			'use_featured_image'    => __( 'Use as featured image', 'wwh-services-carousel' ),
			'archives'              => __( 'Service archives', 'wwh-services-carousel' ),
			'insert_into_item'      => __( 'Insert into service', 'wwh-services-carousel' ),
			'uploaded_to_this_item' => __( 'Uploaded to this service', 'wwh-services-carousel' ),
			'items_list'            => __( 'Services list', 'wwh-services-carousel' ),
			'items_list_navigation' => __( 'Services list navigation', 'wwh-services-carousel' ),
			'filter_items_list'     => __( 'Filter services list', 'wwh-services-carousel' ),
		];

		$args = [
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_rest'       => true,          // Gutenberg support
			'query_var'          => true,
			'rewrite'            => [ 'slug' => 'services' ],
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 25,
			'menu_icon'          => 'dashicons-star-filled',
			'supports'           => [ 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'revisions' ],
		];

		register_post_type( 'wwh_service', $args );
	}

	/**
	 * Ensure the theme supports post thumbnails for the CPT.
	 */
	public function add_thumbnail_support() {
		if ( ! current_theme_supports( 'post-thumbnails' ) ) {
			add_theme_support( 'post-thumbnails', [ 'wwh_service' ] );
		}
	}

	/**
	 * Custom admin messages.
	 *
	 * @param array $messages Default messages.
	 * @return array
	 */
	public function updated_messages( $messages ) {
		global $post;

		$messages['wwh_service'] = [
			0  => '',
			1  => __( 'Service updated.', 'wwh-services-carousel' ),
			2  => __( 'Custom field updated.', 'wwh-services-carousel' ),
			3  => __( 'Custom field deleted.', 'wwh-services-carousel' ),
			4  => __( 'Service updated.', 'wwh-services-carousel' ),
			// translators: %s: date and time of the revision.
			5  => isset( $_GET['revision'] )
				? sprintf( __( 'Service restored to revision from %s.', 'wwh-services-carousel' ), wp_post_revision_title( (int) $_GET['revision'], false ) )
				: false,
			6  => __( 'Service published.', 'wwh-services-carousel' ),
			7  => __( 'Service saved.', 'wwh-services-carousel' ),
			8  => __( 'Service submitted.', 'wwh-services-carousel' ),
			9  => sprintf(
				// translators: Scheduled date for the service post.
				__( 'Service scheduled for: <strong>%1$s</strong>.', 'wwh-services-carousel' ),
				date_i18n( __( 'M j, Y @ G:i', 'wwh-services-carousel' ), strtotime( $post->post_date ) )
			),
			10 => __( 'Service draft updated.', 'wwh-services-carousel' ),
		];

		return $messages;
	}
}
