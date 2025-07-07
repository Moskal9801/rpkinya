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

<div class="products__item checkout-card">
    <div class="item__image">
        <img src="<?php echo $image_url; ?>">
    </div>
    <div class="item__more">
        <div class="more__info">
            <p class="info__name"><?php echo $name; ?></p>
            <?php if ($weight) { ?>
                <p class="info__weight"><?php echo $weight; ?> г</p>
            <?php } ?>
        </div>
        <p class="more__quantity"><?php echo $quantity; ?> шт.</p>
        <div class="more__all-price <?php if ($salePrice) { echo 'sale-price'; } else { echo 'regular-price'; } ?>">
            <?php if ($salePrice) { ?>
                <p class="all-price__regular"><?php echo $regularPrice; ?></p>
                <p class="all-price__sale"><?php echo $salePrice; ?> ₽</p>
            <?php } else { ?>
                <p class="all-price__regular"><?php echo $regularPrice; ?> ₽</p>
            <?php } ?>
        </div>
    </div>
</div>