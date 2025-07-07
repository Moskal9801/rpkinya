<?php global $product;?>

<?php

if (wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'full')[0]) {
    $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'full')[0];
} else {
    $image_url = '/wp-content/themes/inya_theme/assets/images/no-image.png';
}

$name = $product->get_name($product->get_id());
$stock = $product->get_stock_status($product->get_id());
$salePrice = $product->get_sale_price($product->get_id());
$regularPrice = $product->get_regular_price($product->get_id());
$weight = $product->get_weight($product->get_id()); ?>

<div class="swiper-slide items__item product-card product-card-style">
    <a class="product-card__main-info" href="<?php echo get_permalink($product->get_id()) ?>">
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
            <?php if ( get_field( 'product-price-type', $product->get_id() ) == 1 ) {
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

    <div class="product-card__add buy-controlling" data-id="<?php echo $product->get_id(); ?>" data-quantity="<?php if ( matched_cart_items($product->get_id()) > 0 ) { echo matched_cart_items($product->get_id()); } else { echo '0'; } ?>">
        <a class="add__cart border-button brown-mint <?php if ($stock === 'outofstock') { echo 'outofstock'; }?> <?php if ( matched_cart_items($product->get_id()) > 0 ) { echo 'added'; } ?>"
           href="<?php if ( matched_cart_items($product->get_id()) > 0 ) { echo '/cart/'; } else { echo '#'; } ?>"
        >
            <?php if ($stock === 'outofstock') { echo 'Нет в наличии'; } elseif ( matched_cart_items($product->get_id()) > 0 ) { echo 'В корзине'; } else { echo '+ Купить'; } ?>
        </a>

        <div class="add__quantity" style="<?php if ( matched_cart_items($product->get_id()) === 0 ) { echo 'display: none'; } ?>">
            <svg class="quantity__minus" width="9" height="2" viewBox="0 0 9 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.269531 0.280029H8.99953V1.72003H0.269531V0.280029Z" fill="#6E5D65"/>
            </svg>

            <input class="quantity__input" type="text" data-old="<?php if ( matched_cart_items($product->get_id()) > 0 ) { echo matched_cart_items($product->get_id()); } else { echo '0'; } ?>" value="<?php if ( matched_cart_items($product->get_id()) > 0 ) { echo matched_cart_items($product->get_id()); } else { echo '1'; } ?>">

            <svg class="quantity__plus" width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 4.28009H3.6V0.590088H5.13V4.28009H8.73V5.72009H5.13V9.41009H3.6V5.72009H0V4.28009Z" fill="#6E5D65"/>
            </svg>
        </div>
    </div>
</div>

