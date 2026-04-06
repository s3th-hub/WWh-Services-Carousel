/**
 * WWH Services Carousel — Frontend Script
 * Initialises one Swiper instance per carousel widget on the page.
 */

( function () {
	'use strict';

	/**
	 * Initialise all .wwh-sc-swiper elements found on the page.
	 */
	function initCarousels() {
		var carousels = document.querySelectorAll( '.wwh-sc-swiper' );

		if ( ! carousels.length ) {
			return;
		}

		carousels.forEach( function ( el ) {
			// Config is stored as a JSON string in data-wwh-swiper.
			var rawConfig = el.getAttribute( 'data-wwh-swiper' );
			var config    = {};

			if ( rawConfig ) {
				try {
					config = JSON.parse( rawConfig );
				} catch ( e ) {
					console.warn( 'WWH Services Carousel: invalid swiper config.', e );
				}
			}

			// Locate the wrapper element to bind navigation buttons.
			var wrapper = el.closest( '.wwh-sc-wrapper' );
			var prevBtn = wrapper ? wrapper.querySelector( '.wwh-sc-prev' ) : null;
			var nextBtn = wrapper ? wrapper.querySelector( '.wwh-sc-next' ) : null;
			var pagEl   = el.querySelector( '.wwh-sc-pagination' );

			// Navigation config.
			if ( config.navigation && prevBtn && nextBtn ) {
				config.navigation = {
					prevEl: prevBtn,
					nextEl: nextBtn,
				};
			} else {
				config.navigation = false;
			}

			// Pagination config.
			if ( config.pagination && pagEl ) {
				config.pagination = {
					el:        pagEl,
					clickable: true,
					renderBullet: function ( index, className ) {
						return (
							'<span class="' + className + '" role="tab" aria-label="Slide ' + ( index + 1 ) + '" tabindex="0"></span>'
						);
					},
				};
			} else {
				config.pagination = false;
			}

			// Keyboard control.
			config.keyboard = {
				enabled: true,
				onlyInViewport: true,
			};

			// A11y.
			config.a11y = {
				prevSlideMessage: 'Previous slide',
				nextSlideMessage: 'Next slide',
			};

			// Initialise Swiper.
			try {
				new Swiper( el, config ); // eslint-disable-line no-undef
			} catch ( e ) {
				console.error( 'WWH Services Carousel: Swiper init failed.', e );
			}
		} );
	}

	/**
	 * Re-initialise when Elementor editor refreshes a widget in the preview.
	 * This fires on every widget re-render in the live preview iframe.
	 */
	function bindElementorFrontend() {
		if ( typeof window.elementorFrontend === 'undefined' ) {
			return;
		}

		window.elementorFrontend.hooks.addAction(
			'frontend/element_ready/wwh-services-carousel.default',
			function ( $scope ) {
				var el = $scope[0].querySelector( '.wwh-sc-swiper' );
				if ( ! el ) return;

				// If an instance already exists on this element, destroy it first.
				if ( el.swiper ) {
					el.swiper.destroy( true, true );
				}

				// Re-run initialisation for the specific widget.
				var rawConfig = el.getAttribute( 'data-wwh-swiper' );
				var config    = {};

				if ( rawConfig ) {
					try {
						config = JSON.parse( rawConfig );
					} catch ( e ) {}
				}

				var wrapper = el.closest( '.wwh-sc-wrapper' );
				var prevBtn = wrapper ? wrapper.querySelector( '.wwh-sc-prev' ) : null;
				var nextBtn = wrapper ? wrapper.querySelector( '.wwh-sc-next' ) : null;
				var pagEl   = el.querySelector( '.wwh-sc-pagination' );

				config.navigation = ( config.navigation && prevBtn && nextBtn )
					? { prevEl: prevBtn, nextEl: nextBtn }
					: false;

				config.pagination = ( config.pagination && pagEl )
					? { el: pagEl, clickable: true }
					: false;

				config.keyboard = { enabled: true, onlyInViewport: true };
				config.a11y     = { prevSlideMessage: 'Previous slide', nextSlideMessage: 'Next slide' };

				try {
					new Swiper( el, config ); // eslint-disable-line no-undef
				} catch ( e ) {
					console.error( 'WWH Services Carousel (Elementor): Swiper init failed.', e );
				}
			}
		);
	}

	// ── Boot ──────────────────────────────────────────────────────────────────

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', function () {
			initCarousels();
			bindElementorFrontend();
		} );
	} else {
		// DOM already ready (e.g. script loaded with defer).
		initCarousels();
		bindElementorFrontend();
	}
} )();
