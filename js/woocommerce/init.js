export function woocommerceInit( args ){

    const { BODY, $body } = args;

	const formCarts = document.querySelectorAll( 'form.cart' );
	const singleProductVariationSelector = document.querySelector('.badfennec-woo-single-product-variation');
	const quantityInput = document.querySelectorAll( '.badfennec-product-quantity input[type="number"]' );

	if( formCarts.length > 0 ){
		import('./ajax-add-to-cart.js').then( ({ default: AjaxAddToCart }) => {
			formCarts.forEach( ( form ) => {
				new AjaxAddToCart( form );
			} );
		});
	}

	if( document.querySelector(singleProductVariationSelector) ){
		import('./single-product-variations.js').then( ({ default: SingleProductVariations }) => {
			new SingleProductVariations( singleProductVariationSelector );
		});
	}

	if( quantityInput.length > 0 ){
		import('./quantity-input.js').then( ({ default: setQuantityInput }) => {
			setQuantityInput();
		});
	}

}