<?php get_header(); ?>

    <section class="error-page__error">
        <div class="error__image">
            <?php echo get_template_part('parts/icons/error-404'); ?>
        </div>
        <div class="error__info">
            <p class="info__message">Страница не найдена</p>
            <a class="info__back default-button mint-brown" href="/">На главную</a>
        </div>
    </section>

<?php get_footer(); ?>