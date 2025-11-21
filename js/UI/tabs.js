import Reactive from '../utils/reactive.js';

/**
 * Tabs UI component
 */
export default class Tabs {
    currentItem = 0;
    tabsReactive = null;

    constructor( el ){
        this.el = el;
        this.buttons = [];
        this.items = [];
        this.#init();
    }

    /**
     * Initialize the Tabs component
     * @returns 
     */
    #init(){
        // Check element if not exists return
        if( !this.el )
            return;

        // Add subscribe
        this.#addSubscribe();

        // Set buttons
        this.el.querySelectorAll( '.badfennec-tabs__button' ).forEach( ( button, index ) => {
            this.buttons.push( this.#setButton( { button: button, index: index } ) );
        } );

        // Set items
        this.el.querySelectorAll( '.badfennec-tabs__item' ).forEach( ( item, index ) => {
            this.items.push( this.#setItem( { item: item, index: index } ) );
        } );
    }

    /**
     * Add subscribe to Reactive instance
     * @return {void}
     */
    #addSubscribe(){
        this.tabsReactive = new Reactive({
            currentItem: 0,
        });

        const subscibeCallback = ( value ) => {
            this.#changeCallback( value );
        }

        this.tabsReactive.subscribe( subscibeCallback );
    }

    /**
     * Set button object and add click event
     * @param {Object} args 
     * @returns {Object} buttonObject
     */
    #setButton( args ){
        const { button, index } = args;

        button.addEventListener( 'click', ( e ) => {
            e.preventDefault();            
            this.tabsReactive.next({
                currentItem: index,
            });
        } );

        return {
            button: button,
            index: index,
        };
    }

    /**
     * Set item object
     * @param {Object} args 
     * @returns {Object} itemObject
     */
    #setItem( args ){
        const { item, index } = args;

        return {
            item: item,
            index: index,
        };
    }

    /**
     * Change callback when currentItem change
     * @param {Object} value 
     * @returns {void}
     */
    #changeCallback(value){

        if( this.currentItem === value.currentItem ){
            return;
        }

        this.buttons[this.currentItem].button.classList.remove( 'badfennec-tabs__button--active' );
        this.items[this.currentItem].item.classList.remove( 'badfennec-tabs__item--active' );
        this.currentItem = value.currentItem;
        this.buttons[this.currentItem].button.classList.add( 'badfennec-tabs__button--active' );
        this.items[this.currentItem].item.classList.add( 'badfennec-tabs__item--active' );
    }
}