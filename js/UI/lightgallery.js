import lightGallery from 'lightgallery';
import 'lightgallery/css/lightgallery-bundle.css';

import lgThumbnail from 'lightgallery/plugins/thumbnail'
import lgZoom from 'lightgallery/plugins/zoom'
import lgVideo from 'lightgallery/plugins/video'
import lgFullScreen from 'lightgallery/plugins/fullscreen'

export function lightgallery_init( args ){

	console.log('lightGallery is active now');

    const {elementsClasses} = args;

	/**
	 * Add gallery to container
	 * @param {*} c 
	 * @returns 
	 */
	const add_gallery = ( c ) => {
		return lightGallery( c, {
			plugins: [lgZoom, lgThumbnail, lgVideo, lgFullScreen],
			licenseKey: '',
			speed: 500,
			selector: 'a',
			thumbnail: false,
			autoplayVideoOnSlide: true,
			gotoNextSlideOnVideoEnd: true,
			mobileSettings: {
				showCloseIcon: true,
				fullScreen: false,
			}
		});
	}

	/**
	 * Set gallery for content container
	 * @param {*} c 
	 */
    const set_content_gallery = ( c ) => {		
		const gallery = add_gallery( c );	
		const isWooGallery = c.classList.contains('woocommerce-product-gallery__wrapper');

		if( isWooGallery ){
			setWooGallery( c, gallery );
		}
	}

	/**
	 * Handle WooCommerce product gallery variations
	 * @param {*} c 
	 * @param {*} gallery 
	 */
	const setWooGallery = ( c, gallery ) => {
		const $variationForm = jQuery(c).closest('.product').find('.variations_form');
		let currentGallery = gallery;
		
		if( $variationForm.length ){
			// Listen for WooCommerce variation change
			$variationForm.on('found_variation.wc-variation-form', function(event, variation) {				
				setTimeout(() => {
					try {
						if( currentGallery && typeof currentGallery.destroy === 'function' ) {
							currentGallery.destroy();
						}
					} catch(e) {
						console.warn('Error destroying gallery:', e);
					}
					// Create new gallery and update reference
					currentGallery = add_gallery( c );
				}, 300);
			});
		}
	}

	document.querySelectorAll( elementsClasses ).forEach( c => {	
		set_content_gallery( c );	
	});

}