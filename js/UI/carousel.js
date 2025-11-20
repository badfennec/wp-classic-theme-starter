import Splide from '@splidejs/splide'
import Reactive from '../utils/reactive.js';

import '@splidejs/splide/css';

export default class Carousel {

	carousel = null;
	splide = null;
	currentSlide = 0;

	carouselReactive = null;
	reactiveSuscribe = null;

	splideArgs = {
        speed: 1000,
        direction: 'slide',
        type: 'slide',
        perPage: 1,
        arrows: false,
		pagination: true,
        keyboard: false,
        gap: 0,		
        autoplay: false,
        interval: 7000,
        lazyLoad: false,
    };

	nextClass = ['.next'];
	prevClass = ['.prev'];

	constructor( el ){
		this.el = el;

		this.#init();
	}

	#init(){

		if( !this.el )
			return;

		this.splide = this.el.querySelector( '.splide' );

		if( !this.splide )
			return;

		let init = JSON.parse( this.el.dataset.init );
		delete this.el.dataset.init;

		if( !init.slidesLength || init.slidesLength < 1 ){
			return;
		}

		if( init.splideArgs )
			this.splideArgs = { ...this.splideArgs, ...init.splideArgs };

		if( init.nextClass )
			this.nextClass.push( init.nextClass );

		if( init.prevClass )
			this.prevClass.push( init.prevClass );

		this.#addSubscribe();
		this.#addCarousel();
		this.#addButtons();
		
	}

	#addSubscribe(){
		this.carouselReactive = new Reactive({
			currentSlide: 0,
		});

		this.reactiveSuscribe = ( value ) => {
			this.currentSlide = value.currentSlide;
		}

		this.carouselReactive.suscribe( this.reactiveSuscribe );
	}

	#addCarousel(){
		this.carousel = new Splide( this.splide, this.splideArgs ).mount();

		this.carousel.on('move', ( newIndex ) => {
			this.carouselReactive.next({
				currentSlide: newIndex,
			});
		});		
	}

	#addButtons(){
		if( this.nextClass.length > 0 ){
			this.el.querySelectorAll( this.nextClass.join(',') ).forEach( ( btn ) => {
				btn.addEventListener( 'click', ( e ) => {
					e.preventDefault();
					this.carousel.go( '+' );
				});
			});
		}

		if( this.prevClass.length > 0 ){
			this.el.querySelectorAll( this.prevClass.join(',') ).forEach( ( btn ) => {
				btn.addEventListener( 'click', ( e ) => {
					e.preventDefault();
					this.carousel.go( '-' );
				});
			});
		}
	}
}