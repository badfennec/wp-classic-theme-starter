export class BadFennecForms {
    
    init = ( items ) => {

        if ( items && items.length > 0) {
            items.forEach(el => {
                this.set_form_list_items(el);
            });
        }
    }

    set_form_list_items = ( el ) => {
        const checkbox = el.querySelector('input[type="checkbox"]');
        const radio = el.querySelector('input[type="radio"]');

		if( checkbox ){
			this.set_form_checkbox( checkbox );
		}

        if( radio ){        
            this.set_form_radio( radio );
        }
    }

    set_parent = ( args ) => {
        const { element, parent, parentClass, iconClass } = args;
        parent.classList.add( parentClass );

        const icon = document.createElement('span');
		icon.classList.add( iconClass );
		parent.prepend( icon );

        setInterval( () => {

			if( element.checked )
				icon.classList.add('is-checked');
			else
				icon.classList.remove('is-checked');
		}, 100 );
    }

    set_form_checkbox = ( checkbox ) =>{
        this.set_parent( {
            element: checkbox,
            parent: checkbox.parentNode,
            parentClass: 'badfennec-checkbox-element',
            iconClass : 'badfennec-checkbox-icon',
        } );
    }

    set_form_radio = ( radio ) => {
        this.set_parent( {
            element: radio,
            parent: radio.parentNode,
            parentClass: 'badfennec-radio-element',
            iconClass : 'badfennec-radio-icon',
        } );
    }
}