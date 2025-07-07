<?php /**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product; ?>

<div class="body__gallery">

    <?php $product_images = get_post_meta( get_the_ID(), '_product_image_gallery', true );
    $product_images = explode( ',', $product_images );
    $product_images = array_filter($product_images);

    $name = $product->get_name();
    $stock = $product->get_stock_status();
    $salePrice = $product->get_sale_price();
    $regularPrice = $product->get_regular_price();
    $weight = $product->get_weight();
    $description = $product->get_description();?>

    <div class="gallery__main swiper swiper-galleryMain">
        <div class="swiper-wrapper">
            <a class="swiper-slide" data-fancybox="gallery" href="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0]; ?>">
                <?php if (wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0]) { ?>
                    <img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0]; ?>">
                <?php } else { ?>
                    <img src="/wp-content/themes/inya_theme/assets/images/no-image.png">
                <?php } ?>
            </a>

            <?php if ($product_images) { ?>
                <?php foreach ( $product_images as $image_id ) {
                    $image_url = wp_get_attachment_image_src( $image_id, 'full' )[0]; ?>

                    <a class="swiper-slide" data-fancybox="gallery" href="<?php echo $image_url?>">
                        <img src="<?php echo $image_url?>">
                    </a>
                <?php } ?>
            <?php } ?>
        </div>
        <div class="swiper-pagination pagination-gallery"></div>
    </div>

    <div class="gallery__more swiper swiper-galleryMore">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <?php if (wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0]) { ?>
                    <img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'full')[0]; ?>">
                <?php } else { ?>
                    <img src="/wp-content/themes/inya_theme/assets/images/no-image.png">
                <?php } ?>
            </div>

            <?php if ($product_images) { ?>
                <?php foreach ( $product_images as $image_id ) {
                    $image_url = wp_get_attachment_image_src( $image_id, 'full' )[0]; ?>

                    <div class="swiper-slide">
                        <img src="<?php echo $image_url?>">
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>

<div class="body__info">
    <h4><?php echo $name; ?></h4>
    <?php if ($weight) { ?>
        <p class="info__weight"><?php echo $weight; ?> г</p>
    <?php } ?>
    <?php if ($description) { ?>
        <p class="info__description"><?php echo $description; ?></p>
    <?php } ?>

    <?php if ( have_rows( 'product-more' ) ) : ?>
        <div class="info__more">
            <p class="more__title info-title">Подробнее</p>
            <div class="more__items info-items">
                <?php while ( have_rows( 'product-more' ) ) : the_row(); ?>
                    <p class="items__item"><?php the_sub_field( 'more-text' ); ?></p>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (get_field( 'product-structure' )) { ?>
        <div class="info__structure">
            <p class="structure__title info-title">Состав</p>
            <p class="structure__info info-text"><?php the_field( 'product-structure' ); ?></p>
        </div>
    <?php } ?>

    <?php if (get_field( 'product-conditions' )) { ?>
        <div class="info__conditions">
            <p class="conditions__title info-title">Условия хранения</p>
            <p class="conditions__info info-text"><?php the_field( 'product-conditions' ); ?></p>
        </div>
    <?php } ?>

    <div class="info__buy">
        <div class="buy__add buy-controlling" data-id="<?php echo get_the_ID(); ?>" data-quantity="<?php if ( matched_cart_items(get_the_ID()) > 0 ) { echo matched_cart_items(get_the_ID()); } else { echo '0'; } ?>">
            <a class="add__cart border-button brown-mint <?php if ($stock === 'outofstock') { echo 'outofstock'; }?> <?php if ( matched_cart_items(get_the_ID()) > 0 ) { echo 'added'; } ?>"
               href="<?php if ( matched_cart_items(get_the_ID()) > 0 ) { echo '/cart/'; } else { echo '#'; } ?>"
            >
                <?php if ($stock === 'outofstock') { echo 'Нет в наличии'; } elseif ( matched_cart_items(get_the_ID()) > 0 ) { echo 'В корзине'; } else { echo '+ Купить'; } ?>
            </a>

            <div class="add__quantity" style="<?php if ( matched_cart_items(get_the_ID()) === 0 ) { echo 'display: none'; } ?>">
                <svg class="quantity__minus" width="9" height="2" viewBox="0 0 9 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.269531 0.280029H8.99953V1.72003H0.269531V0.280029Z" fill="#6E5D65"/>
                </svg>

                <input class="quantity__input" type="text" value="<?php if ( matched_cart_items(get_the_ID()) > 0 ) { echo matched_cart_items(get_the_ID()); } else { echo '1'; } ?>">

                <svg class="quantity__plus" width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 4.28009H3.6V0.590088H5.13V4.28009H8.73V5.72009H5.13V9.41009H3.6V5.72009H0V4.28009Z" fill="#6E5D65"/>
                </svg>
            </div>
        </div>
        <div class="buy__price <?php if ($salePrice) { echo 'sale-price'; } else { echo 'regular-price'; } ?>">
            <?php if ( get_field( 'product-price-type' ) == 1 ) {
                $priceAfter = '<span>/за шт</span>';
            } else {
                $priceAfter = '<span>/за кг</span>';
            } ?>
            <?php if ($salePrice) { ?>
                <p class="price__regular"><?php echo $regularPrice; ?></p>
                <p class="price__sale"><?php echo $salePrice; ?> ₽<?= $priceAfter; ?></p>
            <?php } else { ?>
                <p class="price__regular"><?php echo $regularPrice; ?> ₽<?= $priceAfter; ?></p>
            <?php } ?>
        </div>
    </div>
    <?php if (get_field( 'product-price-msg' )): ?>
        <div class="price__description">
            <p>* <?php the_field( 'product-price-msg' ); ?></p>
        </div>
    <?php endif; ?>

    <?php if ( have_rows( 'product-recept' ) ) : ?>
        <div class="info__recipe">
            <h5>Рекомендуемые рецепты</h5>
            <div class="recipe__items">
                <?php while ( have_rows( 'product-recept' ) ) : the_row(); ?>
                    <?php $recept_recept = get_sub_field( 'recept-recept' ); ?>

                    <?php $params = [
                        'id' => $recept_recept,
                    ];

                    get_template_part('parts/items/items', 'moreRecipes', $params); ?>
                <?php endwhile; ?>
            </div>
        </div>

    <?php endif; ?>
</div>

<?php /**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
//do_action( 'woocommerce_before_single_product' ); ?>
