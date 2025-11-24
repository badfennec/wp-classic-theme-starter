<?php

get_header();

?>

<div class="container">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php woocommerce_content(); ?>
        </main></div><?php get_sidebar(); ?>
    </div>
</div>

<?php

get_footer();