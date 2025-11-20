export default class Reactive {
    value = null;
    suscribers = [];

    constructor( initialValue) {
        this.value = initialValue;
        this.notyfy();
    }

    suscribe( fn ){
        this.suscribers.push( fn );
        fn( this.value );
    }

    next( newValue ){
        this.value = newValue;
        this.notyfy();
    }

    notyfy(){
        this.suscribers.forEach( fn => fn( this.value ) );
    }
}