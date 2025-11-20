export function woocommerceInit( args ){

    console.log( 'woocommerce is active on your site now');

    const {BODY, $body, Vue} = args;

    function set_product_form_cart( form ){

		form.addEventListener('submit', ( e ) => {
			e.preventDefault();
			let button = form.querySelector('button[type="submit"].single_add_to_cart_button');

			if( !button )
				return;

			let data = [];
			let fields = [];
			let $button = jQuery( button );
			let quantityButton = form.querySelector('input[type="number"][name="quantity"]');

			let fd = new FormData( form );	

			for (let pair of fd.entries())
				fields.push( pair[0] );

			if( !fields.includes('product_id') ){
				fd.append( 'product_id', button.getAttribute( 'value' ) );
			} else {
				fd.delete( 'add-to-cart' );

				if( fields.includes('variation_id') )
					fd.set( 'product_id', fd.get( 'variation_id' ) );
			}

			for (let pair of fd.entries())
				data.push( { name: pair[0], value: pair[1] } );


			$body.trigger('adding_to_cart', [ $button, data ]);
			button.classList.remove('added');
			button.classList.add('loading');

			fetch( woocommerce_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'), {
				method: 'POST',
				body: fd
			})
			.then( res => res.json())
			.then( a => {

				if (a.error && a.product_url) {
					window.location = a.product_url;
					return;
				}

				button.classList.add('added');
				button.classList.remove('loading');
				$body.trigger('added_to_cart', [ a.fragments, a.cart_hash, $button ]);
				quantityButton.value = quantityButton.min;
			})
			.catch( () => {
				$body.trigger('wc_fragment_refresh cart-set-item-quantity');
			});	

		});

	}
	
	document.querySelectorAll( 'form.cart' ).forEach( ( form ) => set_product_form_cart( form ) );
	
	/* function set_sidecart( c ){

		let cart = {

			data(){
				return {
					isActive: false,
				}
			},
			mounted(){
				$body.on('added_to_cart', ( e ) => {		
					
					setTimeout( () => {
						this.visibility_handler( true );
					}, 500 );

				});

				document.addEventListener('click', ( e ) => {					
					if( e.target.closest( '.widget_shopping_cart' ) === null )
						this.visibility_handler( false );
				});

				document.addEventListener('click', ( e ) => {					
					if( e.target.closest( '.vctheme-sidecart-button' ) !== null )
						this.visibility_handler( !this.isActive );
				});

				document.addEventListener('click', ( e ) => {					
					if( e.target.closest( '.woocommerce_widget_cart_item_quantity__button' ) !== null ){

						let action = e.target.dataset.action;
						let input = e.target.parentNode.querySelector('input[type="number"][data-cart_item_key]');

						switch( action ){

							case '-':
								input.value = parseInt( input.value ) - 1;
							break;

							case '+':
								input.value = parseInt( input.value ) + 1;
							break;

						}

						jQuery( input ).trigger('change');

					}
				});

				$body.on('change', '.widget_shopping_cart input[type="number"][data-cart_item_key]', ( e ) => {
					let input = e.target;
					let cartItemKey = input.dataset.cart_item_key;
					let quantity = input.value;
					let li = input.closest( '.woocommerce-mini-cart-item' );
					
					this.update_cart_quantity( cartItemKey, quantity );

					jQuery(li).block({
						message: null,
						overlayCSS: {
							background: '#fff',
							opacity: 0.6
						}
					});
				});
			},
			methods: {
				visibility_handler( v ){
					this.isActive = v;
				},
				update_cart_quantity( cartItemKey, quantity ){

					let fd = new FormData();
					fd.append('cart_item_qty', quantity );
					fd.append('cart_item_key', cartItemKey );
					fd.append('action', 'vctheme_update_cart_product_quantity');

					fetch( vctheme.ajax_url, {
						method: 'POST',
						body: fd
					})
					.then( res => res.json())
					.then( a => {
						$body.trigger('wc_fragment_refresh');
					})
					.catch( () => {
						$body.trigger('wc_fragment_refresh');
					});

				}
			},
			watch: {
				isActive( v ){
					if( v )
						BODY.classList.add('sidecart-active');
					else
						BODY.classList.remove('sidecart-active');
				}
			}

		}

		Vue.createApp( cart ).mount('#' + c.id );

	}

	document.querySelectorAll('.vctheme-sidecart-handler').forEach( (c,i) => {

		if( !c.id )
			c.setAttribute('id', 'vctheme-sidecart-handler_' + i );

		set_sidecart( c )

	}); */

	function set_variations_form_cart( c ){

		let variations = JSON.parse( c.dataset.product_variations );
		let actives = {};
		let availables = {};

		for( let k in variations ){
			actives[k] = [];
			availables[k] = [];
		}

		let section = {

			data(){				
				return {
					variations: variations,
					actives: { ...actives },
					availables: { ...availables }
				}
			},
			mounted(){
				setTimeout( () => {
					for( let k in this.variations ){
						let select = document.querySelector('select#' + k );
						let value = select.value;
						this.set_variation( k );
						this.actives[k] = value.trim() != '' ? value : false;
						this.get_availables( k, select );
					}
				}, 1000 );					
			},
			methods: {
				set_variation( k ){
					$body.on('change', 'select#' + k, ( e ) => {
						this.actives[k] = e.target.value;

						for( let kk in this.variations ){

							if( kk !== k )
								this.get_availables( kk, document.querySelector('select#' + kk ) );

						}
					});
				},
				get_availables( k, select ){

					this.availables[k].splice(0, this.availables[k].length );

					select.querySelectorAll( 'option' ).forEach( ( option ) => {
						if( option.value )
							this.availables[k].push( option.value );
					});

				},
				change_variation( k, value ){

					if( !this.availables[k].includes( value ) )
						return;

					let select = document.querySelector('select#' + k );
					select.value = value !== select.value ? value : false;
					jQuery(select).trigger('change');

				}
			}

		}

		Vue.createApp( section ).mount('#' + c.id );

	}

	document.querySelectorAll('.vctheme-single-product-variations').forEach( ( c, i ) => {

		if( !c.id )
			c.setAttribute('id', 'vctheme-single-product-variations_' + i );

		set_variations_form_cart( c );
	});

	function set_product_quantity_handler( b, n ){

		let inputQuantity = b.parentNode.querySelector( 'input[type="number"]');
		let max = inputQuantity.getAttribute( 'max' );
		let currentValue = parseInt( inputQuantity.value );
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
		let min = parentNode.querySelector('.vctheme-product-quantity__min');
		let plus = parentNode.querySelector('.vctheme-product-quantity__add');

		currentValue > 1 ? min.classList.remove( ...disabledClass ) : min.classList.add( ...disabledClass );

		if( max )
			currentValue < max ? plus.classList.remove( ...disabledClass ) : plus.classList.add( ...disabledClass );

		setTimeout( () => {
			if ( jQuery('button[name=update_cart]').length > 0 )
				jQuery('button[name=update_cart]').eq(0).trigger('click');
		}, 100 );
	}

	$body.on( 'click', '.vctheme-product-quantity .vctheme-product-quantity__min', ( e ) => {
		set_product_quantity_handler( e.target, -1 );
	})
	.on( 'click', '.vctheme-product-quantity .vctheme-product-quantity__add', ( e ) => {
		set_product_quantity_handler( e.target, 1 );
	})
	.on( 'change', '.vctheme-product-quantity input[type="number"]', ( e ) => {
		set_product_quantity_watcher( e.target );
	})
	.on('updated_cart_totals', ( e ) => {
		document.querySelectorAll( '.vctheme-product-quantity input[type="number"]' ).forEach( ( input ) => {
			set_product_quantity_watcher( input );
		})
	});

	$body.on('wc_cart_emptied update_checkout updated_wc_div updated_cart_totals', ( e ) => {
		console.log( e.type );
	});

}