import Reactive from '../utils/reactive.js';

export default class Accordion {

	currentItem = 0;
	accordionReactive = null;

	constructor( el ){
		this.el = el;
		this.items = [];
		this.#init();
	}

	#init(){
		if( !this.el )
			return;

		this.#addSubscribe();

		this.el.querySelectorAll( '.badfennec-accordion-standard__item' ).forEach( ( item, index ) => {
			this.items.push(this.#setItem( { item: item, index: index } ));
		});

		this.#addResizeObserver();

		
	}

	#addSubscribe(){
		this.accordionReactive = new Reactive({
			currentItem: 0,
		});
	}

	#setItem( args ){
		const { item, index } = args;
		const button = item.querySelector( '.badfennec-accordion-standard__item__button' );

		button.addEventListener( 'click', ( e ) => {
			e.preventDefault();			
			this.accordionReactive.next({
				currentItem: this.currentItem === index ? -1 : index,
			});
		} );

		const itemObject = {
			item: item,
			button: button,
			index: index,
			content: item.querySelector( '.badfennec-accordion-standard__item__box__content' ),
		};

		const itemCallback = ( value ) => {
			this.currentItem = value.currentItem;
			const isCurrent = value.currentItem === index;
			if( isCurrent ){
				this.#setItemHeight( itemObject );
			}
			item.classList.toggle( 'badfennec-accordion-standard__item--current', isCurrent );
		}
		
		this.accordionReactive.suscribe( itemCallback );

		return itemObject;

	}

	#addResizeObserver(){
        this.resizeObserver = new ResizeObserver(() => {
            this.items.forEach( ( item ) => {
				this.#setItemHeight( item );
			});
        });
        
        this.resizeObserver.observe(document.body); 
    }

	#setItemHeight( itemObject ){
		itemObject.content.parentNode.style.height = itemObject.content.clientHeight + 'px';
	}
}