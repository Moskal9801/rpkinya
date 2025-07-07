<?php
	/**
	 * Checkout Form
	 *
	 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
	 *
	 * HOWEVER, on occasion WooCommerce will need to update template files and you
	 * (the theme developer) will need to copy the new files to your theme to
	 * maintain compatibility. We try to do this as little as possible, but it does
	 * happen. When this occurs the version of the template file will be bumped and
	 * the readme will list any important changes.
	 *
	 * @see https://woo.com/document/template-structure/
	 * @package WooCommerce\Templates
	 * @version 3.5.0
	 */

	if ( !defined( 'ABSPATH' ) ) {
		exit;
	} ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout checkout-page__checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>"
      enctype="multipart/form-data">
    <div class="container">
        <div class="checkout__body">
            <div class="body__title">
                <h1 class="title-s">Оформление заказа</h1>
                <p>Ознакомьтесь с подробной информацией по <a href="/delivery/">оплате и доставке</a></p>
            </div>
            <div class="body__checkout">
                <div class="checkout__info contacts">
                    <p class="info__title">Ваши контакты</p>
                    <div class="info__items">
                        <div class="items__item">
                            <p>Имя<span>*</span></p>
                            <input type="text" name="wc__name" data-for-input="billing_first_name" required placeholder="Укажите ваше имя">
                        </div>
                        <div class="items__item">
                            <p>Email<span>*</span></p>
                            <input type="text" name="wc__email" data-for-input="billing_email" required placeholder="Укажите ваш Email">
                        </div>
                        <div class="items__item">
                            <p>Номер телефона<span>*</span></p>
                            <input type="text" name="wc__phone" data-for-input="billing_phone" required placeholder="Укажите ваш телефон">
                        </div>
                        <div class="items__item">
                            <p>Комментарий к заказу</p>
                            <input type="text" name="wc__comment" data-for-input="order_comments" placeholder="Укажите ваш комментарий">
                        </div>
                    </div>
                    <div class="info__privacy">
                        <input id="wc-confirm__checkbox" type="checkbox">
                        <label for="wc-confirm__checkbox">Ознакомлен и согласен с условиями <a href="/privacy-policy/">Политики конфиденциальности</a></label>
                    </div>
                </div>
                <div class="checkout__info delivery">
                    <p class="info__title">Способы получения</p>
                    <div class="info__method">
                        <div class="method__item">
                            <input id="delivery" type="radio" name="shipping" value="delivery">
                            <label for="delivery">Курьером до двери</label>
                        </div>
                        <div class="method__item">
                            <input id="pickup" type="radio" name="shipping" value="pickup">
                            <label for="pickup">Самовывоз</label>
                        </div>
                    </div>
                    <div class="info__items" id="delivery">
                        <div class="items__item">
                            <p>Адрес<span>*</span></p>
                            <input type="text" name="wc__city" data-for-input="billing_address_1" required placeholder="Адрес">
                        </div>
                        <div class="items__items">
                            <div class="items__item">
                                <p>Подъезд</p>
                                <input type="text" name="wc__entrance" data-for-input="billing_address_2" placeholder="Подъезд">
                            </div>
                            <div class="items__item">
                                <p>Домофон</p>
                                <input type="text" name="wc__intercom" data-for-input="billing_address_2" placeholder="Домофон">
                            </div>
                        </div>
                        <div class="items__items">
                            <div class="items__item">
                                <p>Кв./офис</p>
                                <input type="text" name="wc__room" data-for-input="billing_address_2" placeholder="Квартира">
                            </div>
                            <div class="items__item">
                                <p>Этаж</p>
                                <input type="text" name="wc__floor" data-for-input="billing_address_2" placeholder="Этаж">
                            </div>
                        </div>
                        <div class="items__items">
							<?php
								//                                                    <div class="items__item">
								//                                <p>Дата получения</p>
								//                                <input class="date-picker" type="text" name="wc__date" data-for-input="billing_date" placeholder="Дата">
								//                            </div>
								//                            <div class="items__item">
								//                                <p>Время получения</p>
								//                                <input class="time-picker" type="text" name="wc__time" data-for-input="billing_time" placeholder="Время">
								//                            </div>
							?>


                        </div>
                        <div class="items__address">
                            <p class="address__info">
                                <span>Доставка курьером осуществляется на следующий день после дня оформления заявки.</span>
                                <span> С вами свяжется менеджер для согласования деталей</span>

                            </p>
                        </div>
                    </div>
                    <div class="info__items" id="pickup">
                        <div class="items__address">
                            <p class="address__title">Адрес доставки</p>
                            <p class="address__info">
                                <span>Хабаровск, ул. Тихоокеанская, 204, корпус 3</span>
                                <span>+7 (4212) 73-46-61, доп. 1</span>
                                <span>ежедневно 9:00-19:00</span>
                                <span>
                                    <a href="https://yandex.ru/maps/org/rybopererabatyvayushchiy_kompleks_arteli_inya/1062247578/?ll=135.046547,48.554889&source=serp_navig&z=17.02"
                                       target="_blank">Показать на карте</a>
                                </span>
                            </p>
                        </div>
						<?php
							//                        <div class="items__item">
							//                            <p>Дата получения</p>
							//                            <input class="date-picker" type="text" name="wc__date" data-for-input="billing_date" placeholder="Дата">
							//                        </div>
						?>
                        <div class="items__text">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="14" cy="14" r="12" fill="#2D2D2C" fill-opacity="0.3"/>
                                <path d="M15.069 8.16792L14.685 15.6636H13.3794L12.9954 8.16792H15.069ZM12.9493 18.1673C12.9493 17.8703 13.0517 17.6246 13.2565 17.43C13.4716 17.2354 13.7327 17.1382 14.0399 17.1382C14.3471 17.1382 14.6031 17.2354 14.8079 17.43C15.0127 17.6246 15.1151 17.8703 15.1151 18.1673C15.1151 18.454 15.0127 18.6998 14.8079 18.9046C14.6031 19.1094 14.3471 19.2118 14.0399 19.2118C13.7327 19.2118 13.4716 19.1094 13.2565 18.9046C13.0517 18.6998 12.9493 18.454 12.9493 18.1673Z"
                                      fill="#FFFFFC"/>
                            </svg>

                            <p>Пожалуйста, сохраните письмо с номером, которое придет вам на почту. Если заказ оформлен с 09:00 до 16:00, то его можно получить в этот же день.
                                Если заказ оформлен после 16:00, то его можно получить на следующий день после оформления заявки.</p><span></span>
                            <p>При самовывозе вы получите скидку 5% на весь ассортимент</p>
                        </div>
                    </div>
                </div>
                <div class="checkout__info order">
                    <div class="info__ordering">
                        <p class="info__title">Ваш заказ</p>
                        <div class="ordering__products">
							<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) { ?>
								<?php $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item[ 'data' ], $cart_item, $cart_item_key );

								$params = [
									'productId'    => $_product->get_id(),
									'productItem'  => $_product,
									'quantityItem' => $cart_item[ 'quantity' ],
								];

								get_template_part( 'parts/items/items', 'checkoutProduct', $params );

							} ?>
                        </div>
                    </div>
                    <div class="info__amount">
                        <p class="info__title">Способ оплаты</p>
                        <div class="amount__method">
                            <div class="method__item">
                                <input id="card" type="radio" name="payment" value="card">
                                <label for="card">Оплата картой при получении</label>
                            </div>
                            <div class="method__item">
                                <input id="cash" type="radio" name="payment" value="cash">
                                <label for="cash">Наличный расчет</label>
                            </div>
                        </div>
                        <div class="amount__change" id="cash">
                            <p>Сдача с</p>
                            <input type="text" name="wc__change" data-for-input="billing_change" placeholder="Введите сумму">
                        </div>
                        <div class="amount__ordering">
							<?php $cart              = WC()->cart;
								$cart_count          = $cart->get_cart_contents_count();
								$cart_total          = $cart->get_total();
								$total_regular_price = 0;
								$total_sale_price    = 0;

								foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
									$_product = $cart_item[ 'data' ];
									$quantity = $cart_item[ 'quantity' ];

									$regular_price = $_product->get_regular_price();
									$sale_price    = $_product->get_sale_price();

									if ( !$sale_price ) {
										$sale_price = $regular_price;
									}

									$total_regular_price += $regular_price * $quantity;
									$total_sale_price    += $sale_price * $quantity;
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
                        </div>
                        <a class="amount__button default-button mint-brown" href="#">Оформить заказ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--СТАНДАРТНЫЕ ПОЛЯ WOOCOMMERCE-->
    <div style="display: none">
		<?php do_action( 'woocommerce_before_checkout_form', $checkout ); ?>

		<?php if ( !$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in() ) {
			echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );

			return;
		} ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<?php do_action( 'woocommerce_checkout_billing' ); ?>

		<?php do_action( 'woocommerce_checkout_shipping' ); ?>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

		<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

		<?php do_action( 'woocommerce_checkout_order_review' ); ?>

		<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

		<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
    </div>
</form>

