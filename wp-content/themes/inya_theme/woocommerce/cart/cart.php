<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit; ?>

<section class="cart-page__cart">
    <div class="container">
        <div class="cart__body">
            <h1 class="title-s">Корзина</h1>
            <div class="body__items-cart" style="<?php if (WC()->cart->is_empty()) { echo 'display: none;'; } else { echo 'display: grid;'; } ?>">
                <div class="items-cart__products">
                    <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) { ?>
                        <?php $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

                        $params = [
                            'productId' => $_product->get_id(),
                            'productItem' => $_product,
                            'quantityItem' => $cart_item['quantity'],
                        ];

                        get_template_part('parts/items/items', 'moreProduct', $params);

                    } ?>
                </div>

                <div class="items-cart__ordering">
                    <?php $cart = WC()->cart;
                    $cart_count = $cart->get_cart_contents_count();
                    $cart_total = $cart->get_total();
                    $total_regular_price = 0;
                    $total_sale_price = 0;

                    foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
                        $_product = $cart_item['data'];
                        $quantity = $cart_item['quantity'];

                        $regular_price = $_product->get_regular_price();
                        $sale_price = $_product->get_sale_price();

                        if (!$sale_price) {
                            $sale_price = $regular_price;
                        }

                        $total_regular_price += $regular_price * $quantity;
                        $total_sale_price += $sale_price * $quantity;
                    }

                    $total_discount = $total_regular_price - $total_sale_price; ?>

                    <div class="ordering__item more quantity">
                        <p>Товаров в корзине:</p>
                        <p><span><?php echo $cart_count; ?></span> шт.</p>
                    </div>
                    <div class="ordering__item more regular">
                        <p>Сумма заказа:</p>
                        <p><span><?php echo $total_regular_price; ?></span> ₽</p>
                    </div>
                    <div class="ordering__item more discount">
                        <p>Скидка:</p>
                        <p><span>-<?php echo $total_discount; ?></span> ₽</p>
                    </div>
                    <div class="ordering__item main sale">
                        <p>Итого к оплате:</p>
                        <p><span><?php echo $total_sale_price; ?></span> ₽</p>
                    </div>
                    <p class="ordering__info">Стоимость без учета доставки</p>
                    <a class="ordering__button default-button mint-brown" href="/checkout/">Оформить заказ</a>
                </div>
            </div>

            <div class="body__items-not" style="<?php if (WC()->cart->is_empty()) { echo 'display: flex;'; } else { echo 'display: none;'; } ?>">
                <p class="items-not__info">Ваша корзина пуста. Перейдите в каталог, чтобы добавить товары</p>
                <a class="items-not__button default-button mint-brown" href="/products/">Перейти в каталог</a>
            </div>
        </div>
    </div>
</section>

<?php $popular_product = get_field( 'popular-product', 'option' ); ?>

<?php if ( $popular_product ) : ?>
    <section class="cart-page__popular">
        <div class="container">
            <div class="popular__body">
                <div class="body__title">
                    <h2>Вас заинтересует</h2>
                    <div class="title__navigation">
                        <div class="navigation-popular navigation__prev">
                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="21" cy="21" r="20" transform="matrix(-1 0 0 1 42 0)" stroke="#6E5D65" stroke-width="2"/>
                                <path d="M24 12L14.5401 21L24 30" stroke="#6E5D65" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="navigation-popular navigation__next">
                            <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="21" cy="21" r="20" stroke="#6E5D65" stroke-width="2"/>
                                <path d="M18 12L27.4599 21L18 30" stroke="#6E5D65" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="body__products swiper swiper-popular">
                    <div class="swiper-wrapper">
                        <?php foreach ( $popular_product as $post ) : ?>
                            <?php setup_postdata( $post ); ?>

                            <?php get_template_part('parts/items/items', 'mainProduct'); ?>

                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
