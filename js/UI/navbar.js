import Reactive from '../utils/reactive.js';

export default function Navbar(){
    
    const navbar = document.querySelector('#navbar');
    const hamb = navbar.querySelector('#hamb');

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
}