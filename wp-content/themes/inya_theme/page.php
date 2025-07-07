<?php get_header(); ?>

<section class="inner-page__default">
    <div class="default-container">
        <div class="default__body <?php if (is_page('privacy-policy')) { echo 'privacy__body'; } ?>">
            <h1 class="body__title"><?php the_title(); ?></h1>
            <div class="body__contents"><?php the_content(); ?></div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
