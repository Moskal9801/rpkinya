<?php $productId = $args['productId']; $productItem = $args['productItem']; $quantityItem = $args['quantityItem'];

if (wp_get_attachment_image_src(get_post_thumbnail_id($productId), 'full')[0]) {
    $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($productId), 'full')[0];
} else {
    $image_url = '/wp-content/themes/inya_theme/assets/images/no-image.png';
}

$name = $productItem->get_name($productId);
$salePrice = $productItem->get_sale_price($productId);
$regularPrice = $productItem->get_regular_price($productId);
$weight = $productItem->get_weight($productId);
$quantity = $quantityItem; ?>

<div class="products__item cart-card">
    <div class="item__image">
        <img src="<?php echo $image_url; ?>">
    </div>
    <div class="item__info">
        <p class="info__name"><?php echo $name; ?></p>
        <?php if ($weight) { ?>
            <p class="info__weight"><?php echo $weight; ?> г</p>
        <?php } ?>
    </div>
    <div class="item__quantity cart-controlling" data-id="<?php echo $productId; ?>" data-quantity="<?php echo $quantity; ?>" data-regular="<?php echo $regularPrice; ?>" data-sale="<?php if ($salePrice) { echo $salePrice; } else { echo $regularPrice; }; ?>" data-discount="<?php if ($salePrice) { echo ($regularPrice - $salePrice); } else { echo '0'; } ?>">
        <svg class="quantity__minus" width="9" height="2" viewBox="0 0 9 2" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.269531 0.280029H8.99953V1.72003H0.269531V0.280029Z" fill="#2D2D2C"/>
        </svg>

        <input class="quantity__input" type="text" value="<?php echo $quantity; ?>">

        <svg class="quantity__plus" width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 4.28009H3.6V0.590088H5.13V4.28009H8.73V5.72009H5.13V9.41009H3.6V5.72009H0V4.28009Z" fill="#2D2D2C"/>
        </svg>
    </div>
    <div class="item__more">
        <svg class="more__remove" width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M17 18L2 3.00003M2 18L17 3" stroke="#6E5D65" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        <div class="more__all-price <?php if ($salePrice) { echo 'sale-price'; } else { echo 'regular-price'; } ?>">
            <?php if ( get_field( 'product-price-type', $productId ) == 1 ) {
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
    </div>
</div>