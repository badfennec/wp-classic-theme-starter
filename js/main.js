//import * as Vue from 'vue/dist/vue.esm-browser.prod.js';
import Navbar from './UI/navbar.js';

import '../css/main.css';

document.addEventListener("DOMContentLoaded", function () {

    console.log( 'welcome from new boot 2025/01 with webpack');

	const BODY = document.body;
	const carouselElementsClasses = '.badfennec-carousel-standard';
	const lightGalleryElementsClasses = '.wp-block-gallery, .wp-block-gallery, .woocommerce-product-gallery__wrapper'; //'.wp-block-gallery, .woocommerce-product-gallery__wrapper';
	const sidebarElementsClasses = '.badfennec-sidebar-container';

	Navbar();

	if( document.querySelectorAll( carouselElementsClasses ).length > 0 ){
		import('./UI/carousel.js').then( ({ default: Carousel }) => {
			document.querySelectorAll( carouselElementsClasses ).forEach( ( el ) => {
				new Carousel( el );
			} );
		});
	}

	if( document.querySelectorAll( '.badfennec-accordion' ).length > 0 ){
		import('./UI/accordion.js').then( ({ default: Accordion }) => {
			document.querySelectorAll( '.badfennec-accordion' ).forEach( ( el ) => {
				new Accordion( el );
			} );
		});
	}

	if( document.querySelectorAll( '.badfennec-tabs' ).length > 0 ){
		import('./UI/tabs.js').then( ({ default: Tabs }) => {
			document.querySelectorAll( '.badfennec-tabs' ).forEach( ( el ) => {
				new Tabs( el );
			} );
		});
	}

	if( document.querySelectorAll( lightGalleryElementsClasses ).length > 0 ){
		
		import('./UI/lightgallery.js').then( q => {
			q.lightgallery_init({
				elementsClasses: lightGalleryElementsClasses,
			});
		});
	}

	if( vctheme.is_woocommerce_active ){

		import('./woocommerce/init.js').then( q => {
			q.woocommerceInit({
				BODY: BODY,
				$body: jQuery( BODY ),
			});
		});

	}

	document.addEventListener("click", function (event) {
		if ( event.target.closest( '.social-share' ) !== null) {
			event.preventDefault();
			window.open( event.target.closest( '.social-share' ).href, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=0, left=10%, width=400, height=400");
		}

		if( event.target.closest( '.blank' ) !== null ){
			event.preventDefault();
			window.open( event.target.closest( 'a.blank' ).href );
		}
	});

	const fetchTest = async () => {

		const FD = new FormData();
		FD.append( 'action', 'badfennec_test_action' );
		FD.append( 'nonce', vctheme.ajax_nonce );

		try {
			const responseRequest = await fetch( vctheme.ajax_url, {
				method: 'POST',
				body: FD
			});

			const response =  await responseRequest.json();

			if (response.success) {
				console.log(response.data);
			} else {
				throw new Error( response?.data?.message || 'Fetch request failed' );
			}

		} catch ( error ) {
			console.error( error );
		}
	}

	fetchTest();
});

function in_window(el, callback, repeat, callbackOut){

	if ("IntersectionObserver" in window) {

		var imageObserver = new IntersectionObserver(function(entries, observer) {

			entries.forEach(function(entry) {

				if (entry.isIntersecting) {
					if(callback)
						callback(el);

					if(!repeat)
						imageObserver.unobserve(el);

				} else {
					if(callbackOut)
						callbackOut(el);
				}
			});
		});

		imageObserver.observe(el);

	} else {  

		var timeout;

		function in_window_old() {
			if(timeout) {
				clearTimeout(timeout);
			} 

			timeout = setTimeout(function() {
				var scrollTop = $document.scrollTop();
				if($(el).offset().top < (window.innerHeight + scrollTop)) {
				  if(callback)
						callback(el);

					if(!repeat) {
						clearTimeout(timeout);
						document.removeEventListener("scroll", in_window_old);
						window.removeEventListener("resize", in_window_old);
						window.removeEventListener("orientationChange", in_window_old);
					}
				}
			}, 20);
		}

		in_window_old();
		document.addEventListener("scroll", in_window_old);
		window.addEventListener("resize", in_window_old);
		window.addEventListener("orientationChange", in_window_old);
	}
}