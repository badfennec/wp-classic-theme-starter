<?php

if ( ! defined( 'ABSPATH' ) )
    die();

$slidesLength = 10;

$init = array(
    'slidesLength'  =>  $slidesLength,
    'nextClass'     =>  '.next',
    'prevClass'     =>  '.prev',
    'splideArgs'    =>  array(
        'gap'           =>  20,
        'perPage'       =>  5,
        'drag'          =>  $slidesLength > 5,
        'breakpoints'   =>  array(
            '551' => array(
                'perPage'       =>  1,
                'drag'          =>  $slidesLength > 1,
            ),
            '767' => array(
                'perPage'       =>  2,
                'drag'          =>  $slidesLength > 2,
                'gap'           =>  15,
                'pagination'    =>  true,
            ),
            '1279' => array(
                'perPage'       =>  3,
                'drag'          =>  $slidesLength > 3,
                'gap'           =>  30,
                'pagination'    =>  true,
            ),
        )
    )
);

?>

<div class="badfennec-carousel-standard" data-init = "<?php echo htmlentities( json_encode( $init ) ) ?>">

    <div class="splide" ref = "splide">
        
        <div class="splide__track">

            <ul class="splide__list">
                <?php

                foreach( range(1, $slidesLength) as $i ){

                    ?>
                    <li class="splide__slide">
                        <div class="aspect-square w-full bg-green-200 rounded-md"></div>
                    </li>

                    <?php
                }

                ?>
            </ul>
        </div>

        <div class="splide__placeholder w-[20%] aspect-square"></div>

    </div>

    <button class="prev"><?php echo \BadFennec\Utils\SVG::print('arrow-left') ?></button>
    <button class="next"><?php echo \BadFennec\Utils\SVG::print('arrow-right') ?></button>
    
</div>