<?php
/* Template name: Главная страница */
get_header();
?>

<section class="home-page__banner">
    <div class="container">
        <div class="banner__body">
            <div class="body__title">
                <?php if ( have_rows( 'banner-tag' ) ) : ?>
                    <?php while ( have_rows( 'banner-tag' ) ) : the_row(); ?>
                        <div class="title__tag">
                            <?php if (get_sub_field( 'tag-left' )) { ?>
                                <div class="tag__item left">
                                    <?php get_template_part( 'parts/icons/home', 'banner_heart' ); ?>
                                    <p><?php the_sub_field( 'tag-left' ); ?></p>
                                </div>
                            <?php } ?>

                            <?php if (get_sub_field( 'tag-middle' )) { ?>
                                <div class="tag__item middle">
                                    <?php get_template_part( 'parts/icons/home', 'banner_heart' ); ?>
                                    <p><?php the_sub_field( 'tag-middle' ); ?></p>
                                </div>
                            <?php } ?>

                            <?php if (get_sub_field( 'tag-right' )) { ?>
                                <div class="tag__item right">
                                    <?php get_template_part( 'parts/icons/home', 'banner_heart' ); ?>
                                    <p><?php the_sub_field( 'tag-right' ); ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>

                <h1><?php the_field( 'banner-title' ); ?></h1>
            </div>

            <?php if ( have_rows( 'banner-cards' ) ) : ?>
                <div class="body__cards">
                    <?php while ( have_rows( 'banner-cards' ) ) : the_row(); ?>
                        <div class="cards__item">
                            <div class="item__image">
                                <img src="<?php the_sub_field( 'cards-image' ); ?>" />
                            </div>
                            <?php if (get_sub_field( 'cards-info' )) { ?>
                                <div class="item__info">
                                    <p class="info__description"><?php the_sub_field( 'cards-info' ); ?></p>

                                    <?php if ( have_rows( 'cards-button' ) ) : ?>
                                        <?php while ( have_rows( 'cards-button' ) ) : the_row(); ?>
                                            <a class="info__button border-button white-brown" href="<?php the_sub_field( 'button-link' ); ?>">
                                                <p><?php the_sub_field( 'button-text' ); ?></p>
                                                <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 1L7 7L1 13" stroke="#FFFFFC" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </a>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="home-page__about">
    <div class="container">
        <div class="about__body">
            <div class="body__title">
                <h2>Откройте для себя <span>удивительный мир вкуса</span> с рыбной продукцией <br>от РПК артели «Иня»!</h2>
                <div class="title__onion">
                    <?php get_template_part( 'parts/icons/home', 'about_onion' ); ?>
                </div>
                <div class="title__branch">
                    <?php get_template_part( 'parts/icons/home', 'about_branch' ); ?>
                </div>
            </div>
            <div class="body__more">
                <p class="more__description">На своей производственной базе <br class="mobile">мы занимаемся переработкой <br class="desktop">и упаковкой <br class="mobile">морепродуктов <br class="desktop">и рыбы, выловленной <br class="desktop"><br class="mobile">в экологически чистых районах <br class="mobile">Охотского моря.</p>
                <a class="more__button default-button mint-brown" href="/about/">О компании</a>
            </div>
        </div>
    </div>
</section>

<?php $popular_item = get_field( 'popular-product', 'option' ); ?>

<?php if ( $popular_item ) : ?>
    <section class="home-page__popular">
        <div class="popular__background"></div>
        <div class="container">
            <div class="popular__body">
                <div class="body__title">
                    <h2>Популярная продукция</h2>
                    <a class="title__button default-button brown-mint" href="/products/">Перейти в каталог</a>
                </div>
                <div class="body__popular">
                    <div class="popular__items swiper swiper-popular">
                        <div class="swiper-wrapper">
                            <?php foreach ( $popular_item as $post ) : ?>
                                <?php setup_postdata( $post ); ?>

                                <?php get_template_part('parts/items/items', 'mainProduct'); ?>

                            <?php endforeach; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <div class="popular__more">
                        <a class="more__button default-button brown-mint" href="/products/">Перейти в каталог</a>
                        <p class="more__description">В нашем ассортименте разнообразная продукция: от знаменитой тихоокеанской сельди до изысканной красной икры лососёвых. Также мы предлагаем широкий выбор морепродуктов, таких как крабы, креветки и кальмары.</p>
                        <div class="more__navigation">
                            <svg class="navigation__prev navigation-popular" width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="21" cy="21" r="20" transform="matrix(-1 0 0 1 42 0)" stroke="#6E5D65" stroke-width="2"/>
                                <path d="M24 12L14.5401 21L24 30" stroke="#6E5D65" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <svg class="navigation__next navigation-popular" width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="21" cy="21" r="20" stroke="#6E5D65" stroke-width="2"/>
                                <path d="M18 12L27.4599 21L18 30" stroke="#6E5D65" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="body__slogan">
                    <h2>Не упустите возможность порадовать <br>себя и своих близких <span>вкусными <br>и здоровыми</span> морепродуктами</h2>
                    <?php get_template_part( 'parts/icons/home', 'popular_fish' ); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php $news_item = get_field( 'news-item', 'option' ); ?>

<?php

//<?php if ( $news_item ) : ?>
<!--    <section class="home-page__news">-->
<!--        <div class="container">-->
<!--            <div class="news__body">-->
<!--                <div class="body__title">-->
<!--                    <h2>Новости и акции</h2>-->
<!--                    <a class="title__button default-button brown-mint" href="/news/">Все новости и акции</a>-->
<!--                </div>-->
<!--                <div class="body__news">-->
<!--                    <div class="news__items swiper swiper-news">-->
<!--                        <div class="swiper-wrapper">-->
<!--                            --><?php //foreach ( $news_item as $post_ids ) : ?>
<!---->
<!--                                --><?php //$params = [
//                                    'id' => $post_ids,
//                                ] ?>
<!---->
<!--                                --><?php //get_template_part('parts/items/items', 'news', $params); ?>
<!--                            --><?php //endforeach; ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="news__more">-->
<!--                        <a class="more__button default-button brown-mint" href="/news/">Все новости и акции</a>-->
<!--                        <p class="more__description">Следите за нашими новостями и узнавайте первыми о всех новых поступлениях, акциях и скидках!</p>-->
<!--                        <div class="more__navigation">-->
<!--                            <svg class="navigation__prev navigation-news" width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                <circle cx="21" cy="21" r="20" transform="matrix(-1 0 0 1 42 0)" stroke="#6E5D65" stroke-width="2"/>-->
<!--                                <path d="M24 12L14.5401 21L24 30" stroke="#6E5D65" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            </svg>-->
<!--                            <svg class="navigation__next navigation-news" width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                                <circle cx="21" cy="21" r="20" stroke="#6E5D65" stroke-width="2"/>-->
<!--                                <path d="M18 12L27.4599 21L18 30" stroke="#6E5D65" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>-->
<!--                            </svg>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<?php //endif; ?>


<section class="home-page__maps">
    <div class="container">
        <div class="maps__body">
            <h2>ГДЕ КУПИТЬ?</h2>
            <div class="body__maps" id="api-map">
                <?php get_template_part( 'parts/items/map' ); ?>
            </div>
            <div class="body__background">
                <?php get_template_part( 'parts/icons/home', 'maps_pepper' ); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
