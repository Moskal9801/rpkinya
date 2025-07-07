<?php get_header(); ?>

<section class="single-page__recipes-info">
    <div class="container">
        <div class="recipes-info__body">
            <div class="body__background">
                <?php get_template_part( 'parts/icons/recipes', 'sheet' ); ?>
            </div>

            <?php $iframe = get_field('recipe-video'); preg_match('/src="(.+?)"/', $iframe, $matches); $srcVideo = $matches[1]; ?>

            <div class="body__gallery">
                <div class="gallery__main swiper swiper-galleryMain">
                    <div class="swiper-wrapper">
                        <a class="swiper-slide image" data-fancybox="gallery" href="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>">
                            <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>">
                        </a>

                        <?php $recipe_gallery_urls = get_field( 'recipe-gallery' ); ?>
                        <?php if ( $recipe_gallery_urls ) :  ?>
                            <?php foreach ( $recipe_gallery_urls as $recipe_gallery_url ): ?>
                                <a class="swiper-slide image" data-fancybox="gallery" href="<?php echo esc_url( $recipe_gallery_url ); ?>">
                                    <img src="<?php echo esc_url( $recipe_gallery_url ); ?>">
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if (get_field( 'recipe-video' ) && get_field( 'recipe-poster' )) { ?>
                            <a class="swiper-slide video" data-fancybox="gallery" href="<?php echo $srcVideo; ?>">
                                <img src="<?php the_field( 'recipe-poster' ); ?>">
                            </a>
                        <?php } ?>
                    </div>
                    <div class="swiper-pagination pagination-gallery"></div>
                </div>

                <div class="gallery__more swiper swiper-galleryMore">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>">
                        </div>

                        <?php $recipe_gallery_urls = get_field( 'recipe-gallery' ); ?>
                        <?php if ( $recipe_gallery_urls ) :  ?>
                            <?php foreach ( $recipe_gallery_urls as $recipe_gallery_url ): ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo esc_url( $recipe_gallery_url ); ?>">
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if (get_field( 'recipe-video' ) && get_field( 'recipe-poster' )) { ?>
                            <a class="swiper-slide" href="<?php echo $srcVideo; ?>">
                                <img src="<?php the_field( 'recipe-poster' ); ?>">
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="body__info">
                <h4><?php echo get_the_title(); ?></h4>
                <div class="info__time">
                    <?php if (get_field( 'recipe-time' )) { ?>
                        <div class="time__item">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="#FFFFFC" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9 4.19995V8.99995L11.4 11.4" stroke="#FFFFFC" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <p><?php the_field( 'recipe-time' ); ?></p>
                        </div>
                    <?php } ?>
                    <?php if (get_field( 'recipe-portions' )) { ?>
                        <div class="time__item">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.3327 14V12.6667C11.3327 11.1939 10.1388 10 8.66602 10H3.33268C1.85992 10 0.666016 11.1939 0.666016 12.6667V14" stroke="#FFFFFC" stroke-linecap="round" stroke-linejoin="round"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.00065 7.33333C7.47341 7.33333 8.66732 6.13943 8.66732 4.66667C8.66732 3.19391 7.47341 2 6.00065 2C4.52789 2 3.33398 3.19391 3.33398 4.66667C3.33398 6.13943 4.52789 7.33333 6.00065 7.33333Z" stroke="#FFFFFC" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15.334 14V12.6667C15.3331 11.4514 14.5107 10.3905 13.334 10.0867" stroke="#FFFFFC" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M10.666 2.08667C11.846 2.38878 12.6712 3.452 12.6712 4.67C12.6712 5.88801 11.846 6.95122 10.666 7.25334" stroke="#FFFFFC" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <p><?php the_field( 'recipe-portions' ); ?></p>
                        </div>
                    <?php } ?>
                </div>

                <?php if (get_field( 'recipe-description' )) { ?>
                    <p class="info__description"><?php the_field( 'recipe-description' ); ?></p>
                <?php } ?>

                <?php if ( have_rows( 'recipe-detail' ) ) : ?>
                    <?php while ( have_rows( 'recipe-detail' ) ) : the_row(); ?>
                        <div class="info__detail">
                            <p class="detail__title"><?php the_sub_field( 'detail-title' ); ?></p>
                            <div class="detail__items">
                                <?php while ( have_rows( 'detail-items' ) ) : the_row(); ?>
                                    <div class="items__item">
                                        <p class="item__name"><?php the_sub_field( 'items-name' ); ?></p>
                                        <p class="item__value"><?php the_sub_field( 'items-value' ); ?></p>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>

                <?php if (get_field( 'recipe-step' )) { ?>
                    <div class="info__step">
                        <h5>Пошаговый рецепт</h5>
                        <p class="step__value"><?php the_field( 'recipe-step' ); ?></p>
                        <a class="step__button border-button mint-brown" href="#">
                            <p>Развернуть</p>
                            <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 7L7 1L13 7" stroke="#72BDBE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                <?php } ?>

                <?php $recipe_recommended = get_field( 'recipe-recommended' ); ?>
                <?php if ( $recipe_recommended ) : ?>
                    <div class="info__recommended">
                        <h5>Рекомендуемые рецепты</h5>
                        <div class="recommended__items">
                            <?php foreach ( $recipe_recommended as $post_ids ) : ?>
                                <?php $params = [
                                    'id' => $post_ids,
                                ];

                                get_template_part('parts/items/items', 'moreRecipes', $params); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
