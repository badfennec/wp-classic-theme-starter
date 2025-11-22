export default class AjaxAddToCart {

    submitButton = null;
    $submitButton = null;
    quantityButton = null;
    $body = jQuery('body');

    constructor( form ){
        this.form = form;

        this.#init();
    }

    #init(){

        this.submitButton = this.form.querySelector('button[type="submit"].single_add_to_cart_button');

        if( !this.submitButton )
            return;

        this.$submitButton = jQuery( this.submitButton );
        this.quantityButton = this.form.querySelector('input[type="number"][name="quantity"]');

        this.#addSubmitListener();
    }

    #addSubmitListener(){
        this.form.addEventListener('submit', ( e ) => {
            e.preventDefault();

            let data = [];
            let fields = [];

            const FD = new FormData( this.form );

            for (let pair of FD.entries())
                fields.push( pair[0] );

            if( !fields.includes('product_id') ){
                FD.append( 'product_id', this.submitButton.getAttribute( 'value' ) );
            } else {
                FD.delete( 'add-to-cart' );

                if( fields.includes('variation_id') )
                    FD.set( 'product_id', FD.get( 'variation_id' ) );
            }

            for (let pair of FD.entries())
                data.push( { name: pair[0], value: pair[1] } );


            this.$body.trigger('adding_to_cart', [ this.$submitButton, data ]);
            this.submitButton.classList.remove('added');
            this.submitButton.classList.add('loading');

            this.#sendData( FD );

        });
    }

    async #sendData( FD ){

        try {

            const responseRequest = await fetch( woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'), {
                method: 'POST',
                body: FD
            });
            
            const response =  await responseRequest.json();

            if (response.error && response.product_url) {
                window.location = response.product_url;
                throw new Error('Redirecting to product URL');
            }

            this.submitButton.classList.add('added');
            this.submitButton.classList.remove('loading');
            this.$body.trigger('added_to_cart', [ response.fragments, response.cart_hash, this.$submitButton ]);
            this.quantityButton.value = this.quantityButton.min;

        } catch ( error ) {
            console.error( error );
            this.$body.trigger('wc_fragment_refresh cart-set-item-quantity');
        }

        /* fetch( woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'), {
            method: 'POST',
            body: FormData
        })
        .then( res => res.json())
        .then( a => {

            if (a.error && a.product_url) {
                window.location = a.product_url;
                return;
            }

            this.submitButton.classList.add('added');
            this.submitButton.classList.remove('loading');
            this.$body.trigger('added_to_cart', [ a.fragments, a.cart_hash, this.$submitButton ]);
            this.quantityButton.value = this.quantityButton.min;
        })
        .catch( () => {
            this.$body.trigger('wc_fragment_refresh cart-set-item-quantity');
        }); */	
    }

}