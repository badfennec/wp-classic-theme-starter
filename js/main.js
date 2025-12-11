//import * as Vue from 'vue/dist/vue.esm-browser.prod.js';
import Navbar from './ui/navbar.js';
import addLenis from './ui/lenis.js';
import DynamicImport from './utils/dynamicImport.js';
import { wpFetchData, fetchData, fetchRest } from './utils/fetch.js';

import '../css/main.css';

document.addEventListener("DOMContentLoaded", function () {
	const BODY = document.body;
	const carouselElementsClasses = '.badfennec-carousel-standard';
	const lightGalleryElementsClasses = '.wp-block-gallery, .wp-block-gallery, .woocommerce-product-gallery__wrapper'; //'.wp-block-gallery, .woocommerce-product-gallery__wrapper';
	const sidebarElementsClasses = '.badfennec-sidebar-container';

	Navbar({
		withScroll: true,
	});

	new DynamicImport({ items: document.querySelectorAll( carouselElementsClasses ), callback: ( items ) => {
		import('./ui/carousel.js').then( ({ default: Carousel }) => {
			items.forEach( ( el ) => {
				new Carousel( el );
			} );
		});
	} });

	new DynamicImport({ items: document.querySelectorAll( '.badfennec-accordion' ), callback: ( items ) => {
		import('./ui/accordion.js').then( ({ default: Accordion }) => {
			items.forEach( ( el ) => {
				new Accordion( el );
			} );
		});
	} });

	new DynamicImport({ items: document.querySelectorAll( '.badfennec-tabs' ), callback: ( items ) => {
		import('./ui/tabs.js').then( ({ default: Tabs }) => {
			items.forEach( ( el ) => {
				new Tabs( el );
			} );
		});
	} });

	new DynamicImport({ items: document.querySelectorAll( lightGalleryElementsClasses ), callback: ( items ) => {
		import('./ui/lightgallery.js').then( q => {
			q.lightgallery_init({
				elementsClasses: lightGalleryElementsClasses,
			});
		});
	} });

	new DynamicImport({ items: document.querySelectorAll(sidebarElementsClasses), callback: ( items ) => {
		import('./ui/sidebar.js').then( ({ default: Sidebar }) => {
			items.forEach( el => {
				new Sidebar( el );
			})
		});
	} });

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

	addLenis();

	const fetchTest = async ( action ) => {

		const FD = new FormData();
		FD.append( 'action', action );

		const response = await wpFetchData({ 
			url: `${vctheme.ajax_url}`, 
			fetchOptions: {
				method: 'POST',
				body: FD,
			} 
		});
		console.log( response?.message );
	}

	fetchTest('badfennec_test_action');
	//fetchTest('badfennec_private_action');

	(async () => {
		try {
			const response2 = await fetchRest({ 
				endpoint: `badfennecapi/v1/user`,
			});

			console.log( response2 );
		} catch ( error ) {
			console.error( error );
		}
	})();
});