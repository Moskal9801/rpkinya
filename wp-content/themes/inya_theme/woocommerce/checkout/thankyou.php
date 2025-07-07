<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined('ABSPATH') || exit;

$order_id = $order->get_id(); ?>

<div class="checkout-page__thankyou">
    <div class="small-container">
        <div class="thankyou__body">
            <h3 class="body__title">Спасибо за заказ!</h3>
            <p class="body__description">Наш менеджер скоро свяжется с Вами для уточнения деталей</p>
            <div class="body__info">
                <div class="info__item">
                    <p class="item__title">Номер заказа</p>
                    <p class="item__description mint">№&nbsp<?php echo $order->get_order_number(); ?></p>
                </div>
                <div class="info__item">
                    <p class="item__title">Имя получателя</p>
                    <p class="item__description"><?php echo $order->get_billing_first_name(); ?></p>
                </div>
                <div class="info__item">
                    <p class="item__title">Способ получения</p>
                    <p class="item__description"><?php echo $order->get_shipping_method(); ?></p>
                </div>
                <div class="info__item">
                    <p class="item__title">Адрес выдачи</p>
                    <p class="item__description"><?php echo $order->get_billing_address_1(); ?><?php if ($order->get_billing_address_2()) { ?>(<?php echo $order->get_billing_address_2(); ?>)<?php } ?></p>
                </div>
                <div class="info__item">
                    <p class="item__title">Сумма заказа</p>
                    <p class="item__description"><?php echo intval($order->get_total()); ?>&nbsp₽</p>
                </div>
                <div class="info__item">
                    <p class="item__title">Дата получения</p>
                    <p class="item__description"><?php echo get_post_meta($order_id, 'billing_date', true); ?></p>
                </div>
            </div>
            <a class="body__back default-button mint-brown" href="/">На главную</a>
        </div>
    </div>
</div>
