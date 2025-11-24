import Reactive from '../utils/reactive.js';

export default function Navbar( args = {} ){

    const getScrollTop = () => {
        return window.pageYOffset || document.documentElement.scrollTop || window.scrollY;
    }

    const navbar = document.querySelector('#navbar');
    let navbarHeight = navbar.offsetHeight;
    const hamb = navbar.querySelector('#hamb');
    let scrollTop = getScrollTop();

    const { withScroll = false } = args;

    const hambReactive = new Reactive({
        isActive: false,
    });

    const subscribe = ( value ) => {
        navbar.classList.toggle( 'badfennec-navbar--active', value.isActive );
    }

    hambReactive.subscribe( subscribe );

    hamb.addEventListener( 'click', ( e ) => {
        e.preventDefault();
        hambReactive.next({
            isActive: !hambReactive.value.isActive,
        });
    });

    document.addEventListener( 'click', ( e ) => {
        if( hambReactive.value.isActive && !e.target.closest('#navbar') ){
            hambReactive.next({
                isActive: false,
            });
        }
    });    

    if( withScroll ){
        let ticking = false;

        const onScroll = () => {

            if (!ticking) {
                window.requestAnimationFrame(() => {
                    handleScroll( getScrollTop() );
                    ticking = false;
                });

                ticking = true;
            }
        };

        window.addEventListener('scroll', onScroll, { passive: true } );

        const scrollReactive = new Reactive({
            scrollTop: scrollTop,
        });

        scrollReactive.subscribe( ( value ) => {

            if( value.scrollTop !== scrollTop ){
                navbar.classList.toggle( 'badfennec-navbar--scroll-down', scrollTop < value.scrollTop );
                scrollTop = value.scrollTop;                
            }
            
        } );

        const handleScroll = (scrollPos) => {
            scrollReactive.next({
                scrollTop: scrollPos,
            });
        };
    }
}