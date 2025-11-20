<?php

if ( ! defined( 'ABSPATH' ) )
	die();

$loop = @$args['loop'];

if( !$loop || count( $loop ) == 0 )
    return;

?>

<div class = "badfennec-accordion-standard">

    <div class = "badfennec-accordion-standard__grid">

        <div>

            <div class = "badfennec-accordion-standard__items">

                <?php

                foreach( $loop as $k => $item ){

                    ?>

                    <div class = "badfennec-accordion-standard__item border-b first:border-t border-separator py-[15px] xl:py-2 <?php echo $k === 0 ? 'badfennec-accordion-standard__item--current' : '' ?>">

                        <div class = "badfennec-accordion-standard__item__button flex justify-between" role = "button">
                        
                            <div><?php echo esc_attr( @$item['title'] ) ?></div>

                            <div>

                                <div class = "badfennec-accordion-standard__item__button__icon">

                                    <span class="block"><?php \Badfennec\Utils\SVG::print('arrow-up') ?></span>

                                </div>

                            </div>

                        </div>

                        <div class = "badfennec-accordion-standard__item__box">

                            <div class = "badfennec-accordion-standard__item__box__content pt-2">

                                <div class = ""><?php echo apply_filters('the_content', @$item['text']) ?></div>

                            </div>

                        </div>

                    </div><!-- .badfennec-accordion-standard__item -->

                    <?php

                }

                ?>

            </div><!-- .badfennec-accordion-standard__items -->

        </div>

    </div><!-- .badfennec-accordion-standard__grid -->

</div><!-- .badfennec-accordion-standard -->