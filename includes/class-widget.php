<?php
/**
 * Elementor Widget: WWH Services Carousel
 *
 * @package WWH_Services_Carousel
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;

class WWH_SC_Widget extends Widget_Base {

	// ── Identity ──────────────────────────────────────────────────────────────

	public function get_name() {
		return 'wwh-services-carousel';
	}

	public function get_title() {
		return esc_html__( 'WWH Services Carousel', 'wwh-services-carousel' );
	}

	public function get_icon() {
		return 'eicon-carousel';
	}

	public function get_categories() {
		return [ 'wwh-widgets' ];
	}

	public function get_keywords() {
		return [ 'services', 'carousel', 'slider', 'wwh' ];
	}

	public function get_style_depends() {
		return [ 'swiper', 'wwh-sc-style' ];
	}

	public function get_script_depends() {
		return [ 'swiper', 'wwh-sc-script' ];
	}

	// ── Controls ──────────────────────────────────────────────────────────────

	protected function register_controls() {

		/* ── Section: Query ── */
		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Query', 'wwh-services-carousel' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'   => __( 'Number of Services', 'wwh-services-carousel' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 50,
				'step'    => 1,
				'default' => 6,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Order By', 'wwh-services-carousel' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'date'       => __( 'Date', 'wwh-services-carousel' ),
					'title'      => __( 'Title', 'wwh-services-carousel' ),
					'menu_order' => __( 'Menu Order', 'wwh-services-carousel' ),
					'rand'       => __( 'Random', 'wwh-services-carousel' ),
				],
				'default' => 'date',
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Order', 'wwh-services-carousel' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'DESC' => __( 'Descending', 'wwh-services-carousel' ),
					'ASC'  => __( 'Ascending', 'wwh-services-carousel' ),
				],
				'default' => 'DESC',
			]
		);

		$this->end_controls_section();

		/* ── Section: Carousel Settings ── */
		$this->start_controls_section(
			'section_carousel',
			[
				'label' => __( 'Carousel Settings', 'wwh-services-carousel' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => __( 'Autoplay', 'wwh-services-carousel' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'wwh-services-carousel' ),
				'label_off'    => __( 'No', 'wwh-services-carousel' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => __( 'Autoplay Speed (ms)', 'wwh-services-carousel' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1000,
				'max'       => 10000,
				'step'      => 500,
				'default'   => 4000,
				'condition' => [ 'autoplay' => 'yes' ],
			]
		);

		$this->add_control(
			'transition_speed',
			[
				'label'   => __( 'Transition Speed (ms)', 'wwh-services-carousel' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 100,
				'max'     => 2000,
				'step'    => 100,
				'default' => 600,
			]
		);

		$this->add_control(
			'loop',
			[
				'label'        => __( 'Infinite Loop', 'wwh-services-carousel' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'wwh-services-carousel' ),
				'label_off'    => __( 'No', 'wwh-services-carousel' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_navigation',
			[
				'label'        => __( 'Show Navigation Arrows', 'wwh-services-carousel' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'wwh-services-carousel' ),
				'label_off'    => __( 'Hide', 'wwh-services-carousel' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'show_pagination',
			[
				'label'        => __( 'Show Pagination Dots', 'wwh-services-carousel' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'wwh-services-carousel' ),
				'label_off'    => __( 'Hide', 'wwh-services-carousel' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'slides_desktop',
			[
				'label'   => __( 'Slides per View (Desktop)', 'wwh-services-carousel' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 5,
				'step'    => 1,
				'default' => 3,
			]
		);

		$this->add_control(
			'slides_tablet',
			[
				'label'   => __( 'Slides per View (Tablet)', 'wwh-services-carousel' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 4,
				'step'    => 1,
				'default' => 2,
			]
		);

		$this->add_control(
			'space_between',
			[
				'label'   => __( 'Space Between Slides (px)', 'wwh-services-carousel' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 80,
				'step'    => 4,
				'default' => 28,
			]
		);

		$this->end_controls_section();

		/* ── Section: Card Content ── */
		$this->start_controls_section(
			'section_card_content',
			[
				'label' => __( 'Card Content', 'wwh-services-carousel' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'read_more_text',
			[
				'label'   => __( 'Button Text', 'wwh-services-carousel' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Read More', 'wwh-services-carousel' ),
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label'   => __( 'Excerpt Length (words)', 'wwh-services-carousel' ),
				'type'    => Controls_Manager::NUMBER,
				'min'     => 5,
				'max'     => 50,
				'step'    => 1,
				'default' => 20,
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'thumbnail',
				'default' => 'large',
			]
		);

		$this->end_controls_section();

		/* ── Section: Style – Card ── */
		$this->start_controls_section(
			'section_style_card',
			[
				'label' => __( 'Card Style', 'wwh-services-carousel' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'card_bg_color',
			[
				'label'     => __( 'Card Background', 'wwh-services-carousel' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .wwh-sc-card' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'card_border_radius',
			[
				'label'      => __( 'Border Radius', 'wwh-services-carousel' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => 16,
					'right'  => 16,
					'bottom' => 16,
					'left'   => 16,
					'unit'   => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .wwh-sc-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'card_shadow',
				'selector' => '{{WRAPPER}} .wwh-sc-card',
			]
		);

		$this->end_controls_section();

		/* ── Section: Style – Colors ── */
		$this->start_controls_section(
			'section_style_colors',
			[
				'label' => __( 'Colors & Typography', 'wwh-services-carousel' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label'     => __( 'Primary Color', 'wwh-services-carousel' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#304792',
				'selectors' => [
					'{{WRAPPER}} .wwh-sc-btn'              => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wwh-sc-nav-btn'          => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .wwh-sc-image-overlay'   => 'background: linear-gradient(180deg, transparent 40%, {{VALUE}}cc 100%);',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'wwh-services-carousel' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#1a1a2e',
				'selectors' => [
					'{{WRAPPER}} .wwh-sc-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'     => __( 'Excerpt Color', 'wwh-services-carousel' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#5a5a72',
				'selectors' => [
					'{{WRAPPER}} .wwh-sc-excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'wwh-services-carousel' ),
				'selector' => '{{WRAPPER}} .wwh-sc-title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'excerpt_typography',
				'label'    => __( 'Excerpt Typography', 'wwh-services-carousel' ),
				'selector' => '{{WRAPPER}} .wwh-sc-excerpt',
			]
		);

		$this->end_controls_section();
	}

	// ── Render ────────────────────────────────────────────────────────────────

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Build query.
		$args = [
			'post_type'      => 'wwh_service',
			'posts_per_page' => absint( $settings['posts_per_page'] ),
			'post_status'    => 'publish',
			'orderby'        => sanitize_key( $settings['orderby'] ),
			'order'          => in_array( $settings['order'], [ 'ASC', 'DESC' ], true ) ? $settings['order'] : 'DESC',
		];

		$query = new WP_Query( $args );

		if ( ! $query->have_posts() ) {
			echo '<p class="wwh-sc-no-services">' . esc_html__( 'No services found. Please add services from the Services CPT.', 'wwh-services-carousel' ) . '</p>';
			return;
		}

		// Build Swiper data attributes.
		$swiper_config = [
			'slidesPerView'  => 1,
			'spaceBetween'   => absint( $settings['space_between'] ),
			'speed'          => absint( $settings['transition_speed'] ),
			'loop'           => ( 'yes' === $settings['loop'] ),
			'grabCursor'     => true,
			'navigation'     => ( 'yes' === $settings['show_navigation'] ),
			'pagination'     => ( 'yes' === $settings['show_pagination'] ),
			'autoplay'       => 'yes' === $settings['autoplay']
				? [ 'delay' => absint( $settings['autoplay_speed'] ), 'pauseOnMouseEnter' => true, 'disableOnInteraction' => false ]
				: false,
			'breakpoints'    => [
				768  => [ 'slidesPerView' => absint( $settings['slides_tablet'] ) ],
				1024 => [ 'slidesPerView' => absint( $settings['slides_desktop'] ) ],
			],
		];

		$show_nav   = ( 'yes' === $settings['show_navigation'] );
		$show_pag   = ( 'yes' === $settings['show_pagination'] );
		$btn_text   = ! empty( $settings['read_more_text'] ) ? $settings['read_more_text'] : __( 'Read More', 'wwh-services-carousel' );
		$excerpt_len = absint( $settings['excerpt_length'] );

		$unique_id = 'wwh-sc-' . $this->get_id();
		?>

		<div class="wwh-sc-wrapper" id="<?php echo esc_attr( $unique_id ); ?>" aria-label="<?php esc_attr_e( 'Services Carousel', 'wwh-services-carousel' ); ?>">

			<div class="swiper wwh-sc-swiper" data-wwh-swiper='<?php echo wp_json_encode( $swiper_config ); ?>'>
				<div class="swiper-wrapper">

					<?php while ( $query->have_posts() ) : $query->the_post(); ?>

						<?php
						$post_id     = get_the_ID();
						$title       = get_the_title();
						$permalink   = get_permalink();
						$has_thumb   = has_post_thumbnail();
						$thumb_url   = $has_thumb ? get_the_post_thumbnail_url( $post_id, 'large' ) : '';
						$thumb_alt   = $has_thumb ? get_post_meta( get_post_thumbnail_id( $post_id ), '_wp_attachment_image_alt', true ) : '';
						$thumb_alt   = $thumb_alt ?: $title;

						// Excerpt.
						if ( has_excerpt() ) {
							$excerpt = wp_trim_words( get_the_excerpt(), $excerpt_len, '&hellip;' );
						} else {
							$excerpt = wp_trim_words( get_the_content(), $excerpt_len, '&hellip;' );
						}
						?>

						<div class="swiper-slide">
							<article class="wwh-sc-card" role="article" aria-label="<?php echo esc_attr( $title ); ?>">

								<?php if ( $has_thumb ) : ?>
								<a href="<?php echo esc_url( $permalink ); ?>" class="wwh-sc-image-wrap" tabindex="-1" aria-hidden="true">
									<img
										src="<?php echo esc_url( $thumb_url ); ?>"
										alt="<?php echo esc_attr( $thumb_alt ); ?>"
										class="wwh-sc-image"
										loading="lazy"
									/>
									<div class="wwh-sc-image-overlay" aria-hidden="true"></div>
								</a>
								<?php endif; ?>

								<div class="wwh-sc-body">
									<h3 class="wwh-sc-title">
										<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
									</h3>

									<?php if ( $excerpt ) : ?>
									<p class="wwh-sc-excerpt"><?php echo esc_html( $excerpt ); ?></p>
									<?php endif; ?>

									<a
										href="<?php echo esc_url( $permalink ); ?>"
										class="wwh-sc-btn"
										aria-label="<?php
											/* translators: %s: Service title */
											printf( esc_attr__( 'Read more about %s', 'wwh-services-carousel' ), esc_html( $title ) );
										?>"
									>
										<span class="wwh-sc-btn-text"><?php echo esc_html( $btn_text ); ?></span>
										<span class="wwh-sc-btn-arrow" aria-hidden="true">
											<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path d="M3 8H13M13 8L8.5 3.5M13 8L8.5 12.5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/>
											</svg>
										</span>
									</a>
								</div><!-- /.wwh-sc-body -->

							</article><!-- /.wwh-sc-card -->
						</div><!-- /.swiper-slide -->

					<?php endwhile; wp_reset_postdata(); ?>

				</div><!-- /.swiper-wrapper -->

				<?php if ( $show_pag ) : ?>
				<div class="swiper-pagination wwh-sc-pagination" role="tablist" aria-label="<?php esc_attr_e( 'Carousel pagination', 'wwh-services-carousel' ); ?>"></div>
				<?php endif; ?>

			</div><!-- /.swiper -->

			<?php if ( $show_nav ) : ?>
			<button class="wwh-sc-nav-btn wwh-sc-prev" aria-label="<?php esc_attr_e( 'Previous slide', 'wwh-services-carousel' ); ?>">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
					<path d="M12.5 4L7 10L12.5 16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>
			<button class="wwh-sc-nav-btn wwh-sc-next" aria-label="<?php esc_attr_e( 'Next slide', 'wwh-services-carousel' ); ?>">
				<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
					<path d="M7.5 4L13 10L7.5 16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>
			<?php endif; ?>

		</div><!-- /.wwh-sc-wrapper -->

		<?php
	}

	/**
	 * Render plain text for Elementor editor content.
	 */
	protected function content_template() {}
}
