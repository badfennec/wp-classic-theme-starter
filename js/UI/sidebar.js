import StickySidebar from 'sticky-sidebar'

export default class Sidebar {

	sidebarEl = null;
	stickySidebar = null;

	constructor( el ){
		this.container = el;	

		this.#init();
	}

	#init(){
		this.sidebarEl = this.container.querySelector('.badfennec-sidebar-container__sidebar');

		if( !this.sidebarEl )
			return;

		const randomID = Math.floor( Math.random() * 1000000 );
		const container_id = 'badfennec-sidebar-container_' + randomID;
		const sidebar_id = 'badfennec-sidebar_' + randomID;

		this.container.setAttribute('id', container_id );
		this.sidebarEl.setAttribute('id', sidebar_id );

		this.#addSiedebar();
		this.#addResizeObserver();
	}

	#addSiedebar(){
		this.stickySidebar = new StickySidebar( '#' + this.sidebarEl.id, {
			containerSelector: '#' + this.container.id,
			innerWrapperSelector: '.badfennec-sidebar-container__content',
			topSpacing: 30,
			bottomSpacing: 0,
		});
	}

	#addResizeObserver(){
        this.resizeObserver = new ResizeObserver(() => {
            this.stickySidebar.updateSticky();
        });
        
        this.resizeObserver.observe(document.body); 
    }
}