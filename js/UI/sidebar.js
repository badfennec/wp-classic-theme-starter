import StickySidebar from 'sticky-sidebar'

export function sidebar_init( args ){

    const {elementsClasses} = args;
	const body = document.body;
	const html = document.documentElement;

	function get_document_height(){
		return Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);
	}

    function set_sidebar( c ){

		let sidebar = c.querySelector('.vctheme-sidebar-container__sidebar');

		if( !sidebar )
			return;

		if( !sidebar.id )
			sidebar.setAttribute('id', c.id + '__sidebar' );

		let documentHeight = get_document_height();

		const stickySidebar = new StickySidebar('#' + sidebar.id, {
			containerSelector: '#' + c.id,
			innerWrapperSelector: '.vctheme-sidebar-container__sidebar__inner',
			topSpacing: 30,
			bottomSpacing: 0,
		});

		function check_window_height(){	

			if( documentHeight != get_document_height() ){
				documentHeight = get_document_height();
				stickySidebar.updateSticky();
			}

			requestAnimationFrame( () => {
				check_window_height();
			});
		}

		check_window_height()

	}

	document.querySelectorAll(elementsClasses).forEach( ( c, i ) => {

		if( !c.id )
			c.setAttribute('id', 'vctheme-sidebar-container_' + i );

		set_sidebar( c );

	});

}