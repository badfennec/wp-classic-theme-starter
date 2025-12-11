export default class DynamicImport {

    items = [];
    observer = null;
    callback = null;

    constructor({ items, callback}){

        this.items = items;
        this.callback = callback;
        this.start();
        

    }

    start() {

        if( this.items.length === 0 ){
            return;
        }

        this.addObserver();
        this.subscribeItems();
    }

    addObserver(){
        this.observer = new IntersectionObserver( ( entries, observerInstance ) => {
            entries.forEach( entry => {
                if( entry.isIntersecting ){
                    observerInstance.unobserve( entry.target );
                    this.callback( this.items );
                }
            });
        },{
            rootMargin: '200px 0px',
        });
    }

    subscribeItems(){
        this.items.forEach( item => {
            this.observer.observe( item );
        }); 
    }

}