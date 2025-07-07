<?php get_header(); ?>

<section class="single-page__news-info">
    <div class="container">
        <div class="news-info__body">
            <div class="body__image">
                <?php echo get_the_post_thumbnail(); ?>
            </div>
            <div class="body__info">
                <p class="info__date"><?php echo get_the_time('d.m.Y'); ?></p>
                <h4 class="info__title"><?php echo get_the_title(); ?></h4>
                <p class="info__description"><?php the_field( 'description' ); ?></p>
            </div>
        </div>
    </div>
</section>

<?php $news_item = get_field( 'news-item', 'option' ); ?>

<?php if ( $news_item ) : ?>
    <section class="single-page__news-all">
        <div class="container">
            <div class="news-all__body">
                <div class="body__title">
                    <h2>Новости и акции</h2>
                    <a class="title__button default-button brown-mint" href="/news/">Все новости и акции</a>
                </div>
                <div class="body__items swiper swiper-news">
                    <div class="swiper-wrapper">
                        <?php foreach ( $news_item as $post_ids ) : ?>

                            <?php $params = [
                                'id' => $post_ids,
                            ] ?>

                            <?php if ( $post_ids != get_the_ID() ) { ?>
                                <?php get_template_part('parts/items/items', 'news', $params); ?>
                            <?php } ?>
                        <?php endforeach; ?>
                    </div>
                </div>

                <a class="body__mobile-button default-button brown-mint" href="/news/">Все новости и акции</a>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>
