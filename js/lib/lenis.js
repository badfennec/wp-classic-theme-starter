import Lenis from 'lenis';
import 'lenis/dist/lenis.css';

export function initLenis() {

    const lenis = new Lenis({
		lerp: 0.1,
		autoResize: true,
		smoothWheel: true
	});

	function lenis_setup(){
	
		const raf = (time) => {
			lenis.raf(time);
			requestAnimationFrame(raf);
		}
	
		requestAnimationFrame(raf);

		window.addEventListener( 'resize', () => {
			lenis.start();
		});

		return lenis;

	}

	lenis_setup();
}