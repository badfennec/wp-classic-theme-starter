<?php

get_header();

if( have_posts() ) :
     the_post();

    ?>

    <div class="container">
    
        <div class="xl:grid xl:grid-cols-5 xl:gap-cols">

            <div class="xl:col-span-3">
                <?php the_content(); ?>

                <div class="h-screen 2xl:h-[200vh] bg-orange-200"></div>
            </div>

            <div class="xl:col-span-2 badfennec-sidebar-container">
            
                <div class="badfennec-sidebar-container__sidebar">
                    <div class="badfennec-sidebar-container__content">
                        <div class="bg-green-200 aspect-square w-full">sidebar area</div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <?php

endif;

get_footer();