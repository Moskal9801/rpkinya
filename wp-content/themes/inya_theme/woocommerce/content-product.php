<?php /**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

if (empty($product) || !$product->is_visible()) {
    return;
} ?>

<li class="product product-card product-card-style">

    <?php

    if (wp_get_attachment_image_src(get_post_thumbnail_id(), '600x300')[0]) {
        $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), '600x300')[0];
    } else {
        $image_url = '/wp-content/themes/inya_theme/assets/images/no-image.png';
    }

    $name = $product->get_name();
    $stock = $product->get_stock_status();
    $salePrice = $product->get_sale_price();
    $regularPrice = $product->get_regular_price();
    $weight = $product->get_weight(); ?>

    <a class="product-card__main-info" href="<?php echo get_permalink() ?>">
        <div class="main-info__tag">
            <?php if ($salePrice) { ?>
                <p class="red">Скидка</p>
            <?php } ?>

            <?php if (has_term( '19', 'product_cat', get_the_ID() )) { ?>
                <p class="mint">Новинка</p>
            <?php } ?>

            <?php if ($stock === 'outofstock') { ?>
                <p class="gray">Нет в наличии</p>
            <?php } ?>
        </div>
        <div class="main-info__image">
            <img src="<?php echo $image_url; ?>">
        </div>
        <p class="main-info__title"><?php echo $name; ?></p>
    </a>

    <div class="product-card__more-info">
        <div class="more-info__all-price <?php if ($salePrice) { echo 'sale-price'; } else { echo 'regular-price'; } ?>">
            <?php if ( get_field( 'product-price-type' ) == 1 ) {
                $priceAfter = '<span>/за шт</span>';
            } else {
                $priceAfter = '<span>/за кг</span>';
            } ?>
            <?php if ($salePrice) { ?>
                <p class="all-price__regular"><?php echo $regularPrice; ?></p>
                <p class="all-price__sale"><?php echo $salePrice; ?> ₽<?= $priceAfter; ?></p>
            <?php } else { ?>
                <p class="all-price__regular"><?php echo $regularPrice; ?> ₽<?= $priceAfter; ?></p>
            <?php } ?>
        </div>
        <?php if ($weight) { ?>
            <p class="more-info__weight"><?php echo $weight; ?> г</p>
        <?php } ?>
    </div>

    <div class="product-card__add buy-controlling" data-id="<?php echo get_the_ID(); ?>" data-quantity="<?php if ( matched_cart_items(get_the_ID()) > 0 ) { echo matched_cart_items(get_the_ID()); } else { echo '0'; } ?>">
        <a class="add__cart border-button brown-mint <?php if ($stock === 'outofstock') { echo 'outofstock'; }?> <?php if ( matched_cart_items(get_the_ID()) > 0 ) { echo 'added'; } ?>"
           href="<?php if ( matched_cart_items(get_the_ID()) > 0 ) { echo '/cart/'; } else { echo '#'; } ?>"
        >
            <?php if ($stock === 'outofstock') { echo 'Нет в наличии'; } elseif ( matched_cart_items(get_the_ID()) > 0 ) { echo 'В корзине'; } else { echo '+ Купить'; } ?>
        </a>

        <div class="add__quantity" style="<?php if ( matched_cart_items(get_the_ID()) === 0 ) { echo 'display: none'; } ?>">
            <svg class="quantity__minus" width="9" height="2" viewBox="0 0 9 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.269531 0.280029H8.99953V1.72003H0.269531V0.280029Z" fill="#6E5D65"/>
            </svg>

            <input class="quantity__input" type="text" data-old="<?php if ( matched_cart_items(get_the_ID()) > 0 ) { echo matched_cart_items(get_the_ID()); } else { echo '0'; } ?>" value="<?php if ( matched_cart_items(get_the_ID()) > 0 ) { echo matched_cart_items(get_the_ID()); } else { echo '0'; } ?>">

            <svg class="quantity__plus" width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 4.28009H3.6V0.590088H5.13V4.28009H8.73V5.72009H5.13V9.41009H3.6V5.72009H0V4.28009Z" fill="#6E5D65"/>
            </svg>
        </div>
    </div>


    <?php /**
     * Hook: woocommerce_before_shop_loop_item_title.
     *
     * @hooked woocommerce_show_product_loop_sale_flash - 10
     * @hooked woocommerce_template_loop_product_thumbnail - 10
     */
    //do_action('woocommerce_before_shop_loop_item_title'); ?>

    <?php /**
     * Hook: woocommerce_shop_loop_item_title.
     *
     * @hooked woocommerce_template_loop_product_title - 10
     */
    //do_action('woocommerce_shop_loop_item_title');?>

    <?php /**
     * Hook: woocommerce_after_shop_loop_item_title.
     *
     * @hooked woocommerce_template_loop_rating - 5
     * @hooked woocommerce_template_loop_price - 10
     */
    //do_action('woocommerce_after_shop_loop_item_title'); ?>

    <?php /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10
     */
    //do_action( 'woocommerce_before_shop_loop_item' ); ?>

    <?php /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked woocommerce_template_loop_product_link_close - 5
     * @hooked woocommerce_template_loop_add_to_cart - 10
     */
    //do_action('woocommerce_after_shop_loop_item'); ?>
</li>

