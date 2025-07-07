<?php
/* Template name: Наши магазины */
get_header();
?>

<section class="shops-page__shops">
    <div class="container">
        <div class="shops__body">
            <h1 class="title-s">Наши магазины</h1>
            <div class="body__maps" id="api-map">
                <?php get_template_part( 'parts/items/map' ); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
