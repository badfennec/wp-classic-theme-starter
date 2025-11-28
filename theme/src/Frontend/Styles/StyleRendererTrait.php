<?php

namespace BadFennec\Frontend\Styles;

if ( ! defined( 'ABSPATH' ) )
    die();

trait StyleRendererTrait {

    /**
     * Render preload links for given style sources
     * 
     * @param array $sources List of style source URLs
     * @return void
     */
    protected function render_preload_links( array $sources ): void
    {
		if( count($sources) === 0 ){
			return;
		}

		foreach( $sources as $src ){
			?>
			<link rel="preload" href="<?php echo esc_url( $src ); ?>" as="style">
			<link rel="stylesheet" href="<?php echo esc_url( $src ); ?>" media="print" onload="this.media='all'">
			<noscript><link rel="stylesheet" href="<?php echo esc_url( $src ); ?>"></noscript>
			<?php
		}	
	}
}