import Reactive from '../utils/reactive.js';

export default function Navbar(){
    
    const navbar = document.querySelector('#navbar');
    const hamb = navbar.querySelector('#hamb');

    const hambReactive = new Reactive({
        isActive: false,
    });

    const suscribe = ( value ) => {
        navbar.classList.toggle( 'navbar--active', value.isActive );
    }

    hambReactive.suscribe( suscribe );

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