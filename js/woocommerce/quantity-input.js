export default function setQuantityInput(){

    const $body = jQuery('body');

    function set_product_quantity_handler( b, n ){

		let inputQuantity = b.parentNode.querySelector( 'input[type="number"]');
		let max = inputQuantity.getAttribute( 'max' );
		let currentValue = parseInt( inputQuantity.value ) || 0;
		let newValue = currentValue + n;

		if( newValue < 1 || max && newValue > max )
			return;

		inputQuantity.value = newValue;
		jQuery(inputQuantity).trigger('change');

	}

	function set_product_quantity_watcher( inputQuantity ){
		let currentValue = parseInt( inputQuantity.value );
		let disabledClass = ['cursor-not-allowed', 'opacity-50'];
		let parentNode = inputQuantity.parentNode;
		let max = inputQuantity.getAttribute( 'max' );
		let min = parentNode.querySelector('.badfennec-product-quantity__min');
		let plus = parentNode.querySelector('.badfennec-product-quantity__add');

		currentValue > 1 ? min.classList.remove( ...disabledClass ) : min.classList.add( ...disabledClass );

		if( max )
			currentValue < max ? plus.classList.remove( ...disabledClass ) : plus.classList.add( ...disabledClass );

		setTimeout( () => {
			if ( jQuery('button[name=update_cart]').length > 0 )
				jQuery('button[name=update_cart]').eq(0).trigger('click');
		}, 100 );
	}

	$body.on( 'click', '.badfennec-product-quantity .badfennec-product-quantity__min', ( e ) => {
		set_product_quantity_handler( e.target, -1 );
	})
	.on( 'click', '.badfennec-product-quantity .badfennec-product-quantity__add', ( e ) => {
		set_product_quantity_handler( e.target, 1 );
	})
	.on( 'change', '.badfennec-product-quantity input[type="number"]', ( e ) => {
		set_product_quantity_watcher( e.target );
	})
	.on('updated_cart_totals', ( e ) => {
		document.querySelectorAll( '.badfennec-product-quantity input[type="number"]' ).forEach( ( input ) => {
			set_product_quantity_watcher( input );
		})
	});
}