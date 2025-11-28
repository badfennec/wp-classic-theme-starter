<?php

/**
 * Accordion Standard Component
 * keep this structure for all components that implements accordion
 * badfennec-accordion is the main class
 * badfennec-accordion__item is the item class, add modifier badfennec-accordion__item--current for the current item
 * badfennec-accordion__button is the button class
 * badfennec-accordion__box is the box class that contains the content, its height is animated
 * badfennec-accordion__content is the content class
 * Feel free to extend this component as needed but kep the class above and is logical structure
 */

if ( ! defined( 'ABSPATH' ) )
	die();

$loop = @$args['loop'];

if( !$loop || count( $loop ) == 0 )
    return;

?>

<div class="badfennec-accordion">

    <div class="badfennec-accordion__items">

        <?php

        foreach( $loop as $k => $item ){

            ?>

            <div class="badfennec-accordion__item border-b first:border-t border-separator py-[15px] xl:py-2 <?php echo $k === 0 ? 'badfennec-accordion__item--current' : '' ?>">

                <div class="badfennec-accordion__button flex justify-between" role = "button">
                
                    <div><?php echo esc_attr( @$item['title'] ) ?></div>

                    <div>

                        <div class="badfennec-accordion__icon">

                            <span class="block"><?php \BadFennec\Utils\SVG::print('arrow-up') ?></span>

                        </div>

                    </div>

                </div>

                <div class="badfennec-accordion__box">

                    <div class="badfennec-accordion__content pt-2">

                        <div class=""><?php echo apply_filters('the_content', @$item['text']) ?></div>

                    </div>

                </div>

            </div><!-- .badfennec-accordion__item -->

            <?php

        }

        ?>

    </div><!-- .badfennec-accordion__items -->

</div><!-- .badfennec-accordion -->