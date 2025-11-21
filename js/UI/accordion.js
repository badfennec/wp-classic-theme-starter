import Reactive from '../utils/reactive.js';

/**
 * Accordion UI component
 */
export default class Accordion {

	currentItem = 0;
	accordionReactive = null;

	constructor( el ){
		this.el = el;
		this.items = [];
		this.#init();
	}

	/**
	 * Instantiate the Accordion component
	 * @returns 
	 */
	#init(){
		if( !this.el )
			return;

		// Add subscribe
		this.#addSubscribe();

		// Set items
		this.el.querySelectorAll( '.badfennec-accordion__item' ).forEach( ( item, index ) => {
			this.items.push(this.#setItem( { item: item, index: index } ));
		});

		// Add ResizeObserver
		this.#addResizeObserver();		
	}

	/**
	 * Add subscribe to Reactive instance
	 * @return {void}
	 */
	#addSubscribe(){
		this.accordionReactive = new Reactive({
			currentItem: 0,
		});

		// Add subscribe callback
		const subscibeCallback = ( value ) => {
			this.#changeCallback( value );
		}

		// Subscribe to Reactive instance
		this.accordionReactive.subscribe( subscibeCallback );
	}

	/**
	 * Set item object and add click event
	 * @param {Object} args 
	 * @returns {Object} itemObject
	 */
	#setItem( args ){
		const { item, index } = args;
		const button = item.querySelector( '.badfennec-accordion__button' );

		button.addEventListener( 'click', ( e ) => {
			e.preventDefault();			
			this.accordionReactive.next({
				currentItem: this.currentItem === index ? -1 : index,
			});
		} );

		return {
			item: item,
			button: button,
			index: index,
			box: item.querySelector( '.badfennec-accordion__box' ),
			content: item.querySelector( '.badfennec-accordion__content' ),
		};
	}

	/**
	 * Add ResizeObserver to adjust item height on resize
	 * @return {void}
	 */
	#addResizeObserver(){
        this.resizeObserver = new ResizeObserver(() => {
            this.items.forEach( ( item ) => {
				this.#setItemHeight( item );
			});
        });
        
        this.resizeObserver.observe(document.body); 
    }

	/**
	 * Set item box height based on content height
	 * @param {Object} itemObject 
	 * @return {void}
	 */
	#setItemHeight( itemObject ){
		itemObject.box.style.height = itemObject.content.clientHeight + 'px';
	}

	/**
	 * Change callback when currentItem change
	 * @param {Object} value 
	 * @return {void}
	 */
	#changeCallback(value){

        if( this.currentItem === value.currentItem ){
            return;
        }

		this.items[this.currentItem]?.item.classList.remove( 'badfennec-accordion__item--current' );
		this.currentItem = value.currentItem;
		this.items[this.currentItem]?.item.classList.add( 'badfennec-accordion__item--current' );
		this.#setItemHeight( this.items[this.currentItem] );
    }
}