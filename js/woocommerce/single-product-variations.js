import Reactive from "../utils/reactive";

/**
 * Single Product Variation Form UI component
 * */
export default class SingleProductVariations {

    activesVariations = [];
    availablesVariations = [];
    buttons = [];
    ReactiveVar = null;

    constructor( el ){
        this.el = el;
        this.variations = JSON.parse( el.dataset.product_variations );
        this.#init();
    }

    #init(){
        for( let k in this.variations ){
			this.activesVariations[k] = [];
            this.availablesVariations[k] = [];
		}

        this.#addSubscribe();

        this.el.querySelectorAll( '.badfennec-woo-single-product-variation__button' ).forEach( ( button ) => {
			this.buttons.push( this.#addButton( button ) );
		});

        for( let variationKey in this.variations ){
			const select = document.querySelector('select#' + variationKey );
			const variation = select.value;
			this.#setVariation( variationKey );
			this.activesVariations[variationKey] = variation.trim() != '' ? variation : false;
			this.#getAvailables( variationKey, select );
		}
    }

    #addSubscribe(){
        this.ReactiveVar = new Reactive({
            activeVariations: this.activesVariations,
            availableVariations: this.availablesVariations,
        });

        this.ReactiveVar.subscribe( ( value ) => {
			this.buttons.forEach( ( b ) => {
				const { button, variation, variationKey } = b;
				button.classList.toggle( 'badfennec-woo-single-product-variation__button--disabled', !value.availableVariations[variationKey].includes( variation ) );
				button.classList.toggle( 'badfennec-woo-single-product-variation__button--active', value.activeVariations[variationKey] === variation );
			});
		});
    }

    #updateReactive = () => {
        this.ReactiveVar.next({
            activeVariations: this.activesVariations,
            availableVariations: this.availablesVariations,
        });
    }

    #getAvailables = ( k, select ) => {

        this.availablesVariations[k].splice(0, this.availablesVariations[k].length );

        select.querySelectorAll( 'option' ).forEach( ( option ) => {
            if( option.value )
                this.availablesVariations[k].push( option.value );
        });

        this.#updateReactive();
    }

    #addButton = ( button ) => {
        const variation = button.dataset.variation;
        const variationKey = button.dataset.variationKey;

        button.addEventListener( 'click', ( e ) => {
            e.preventDefault();
            this.#changeVariation( variationKey, variation );
        } );

        return {
            button: button,
            variation: variation,
            variationKey: variationKey,
        }
    };

    /* #getAvailables = ( k, select ) => {

        availablesVariations[k].splice(0, availablesVariations[k].length );

        select.querySelectorAll( 'option' ).forEach( ( option ) => {
            if( option.value )
                availablesVariations[k].push( option.value );
        });

        this.#updateReactive();
    } */

    #changeVariation = ( variationKey, variation ) => {
        if( !this.availablesVariations[variationKey].includes( variation ) )
            return;

        let select = document.querySelector('select#' + variationKey );
        select.value = variation !== select.value ? variation : false;
        jQuery(select).trigger('change');
    }

    #setVariation = ( variationKey ) => {
        jQuery('body').on('change', 'select#' + variationKey, ( e ) => {
            this.activesVariations[variationKey] = e.target.value;

            for( let kk in this.variations ){

                if( kk !== variationKey )
                    this.#getAvailables( kk, document.querySelector('select#' + kk ) );

            }
        });
    }
}