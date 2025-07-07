<?php
require_once 'parts/blocks/slider/init.php';

//ВКЛЮЧЕНИЕ WOOCOMMERCE
add_theme_support('woocommerce');
add_filter('woocommerce_enqueue_styles', '__return_false');

add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style( 'main-style', get_stylesheet_uri(), [], filemtime( get_stylesheet_directory() . '/style.css' ) );
    wp_enqueue_script( 'main-script', get_template_directory_uri() . '/main.js', [ 'jquery' ], filemtime( get_stylesheet_directory() . '/main.js' ) );
} );
add_action( 'wp_head', function () {
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
} );


add_action( 'admin_head', function () {
    wp_enqueue_script( 'cat-script', get_template_directory_uri() . '/cat.js' );
} );
add_action( 'login_header', function () { ?>
    <style>
        #login h1 a {
            background: url("logo.png") center top no-repeat !important;
            width:      111px !important;
            height:     180px !important;
        }
    </style>
<?php } );


add_filter( 'login_headerurl', function () {
    return 'https://01cat.ru';
} );
add_filter( 'admin_footer_text', function () {
    return '<b>Сделано:</b>
			    <a href="https://01cat.ru/" target="_blank">Двоичный кот</a>
			    <br>
			    <b>Техническая поддержка:</b> тел. <a href="tel:+79145416354">+7 (914) 541-63-54</a>, email: <a href="mailto:hello@01cat.ru">hello@01cat.ru</a>';
} );


add_filter('site_transient_update_plugins', 'my_remove_update_nag'); #УДАЛЕНИЕ НАПОМИНАНИЯ ОБНОВЛЕНИЯ У ACF
function my_remove_update_nag($value) {
    unset($value->response[ 'advanced-custom-fields-pro/acf.php' ]);
    return $value;
}


add_theme_support( 'post-thumbnails' );
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' ); #ОТКЛЮЧАЕМ СОЗДАНИЕ КОПИЙ КАРТИНОК
function delete_intermediate_image_sizes( $sizes ){
    return array_diff( $sizes, [
        'large',
        'medium_large',
        'medium',
        'post-thumbnail',
        '1536x1536',
        '2048x2048',
    ] );
}


add_action('admin_bar_init', function() { #УДАЛЕНИЕ ОТСТУПА У АДМИН ПАНЕЛИ
    remove_action('wp_head', '_admin_bar_bump_cb');
});
add_action("admin_menu", "remove_menus"); #УДАЛЕНИЕ ПУНКТОВ МЕНЮ В АДМИНКЕ
function remove_menus() {
    remove_menu_page("edit-comments.php"); #КОММЕНТАРИИ
    remove_menu_page("edit.php"); #ЗАПИСИ
}


if ( function_exists( 'acf_add_options_page' ) ) {
    acf_add_options_page( [
        'page_title' => 'Контактные данные',
        'menu_title' => 'Настройки сайта',
        'menu_slug'  => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect'   => false
    ] );
}


function clearPhone( $phone ) { #ФУНКЦИЯ ДЛЯ ОЧИЩЕНИЯ НОМЕРА ТЕЛЕФОНА ОТ НЕНУЖНЫХ ЗНАКОВ
    $to_replace = [ ' ', '-', '(', ')' ];

    return str_replace( $to_replace, '', $phone );
}


//ПОКАЗАТЬ ЕЩЕ НОВОСТИ
add_action( "wp_ajax_load_more-news", "load_news" );
add_action( "wp_ajax_nopriv_load_more-news", "load_news" );
function load_news() {

    if ( wp_is_mobile() ) {
        $maxPosts = 5;
    } else {
        $maxPosts = 8;
    }

    $args = json_decode( stripslashes( $_POST[ "query" ] ), true );

    $args[ "paged" ]          = $_POST[ "page" ] + 1;
    $args[ "posts_per_page" ] = $maxPosts;
    $args[ "order" ]          = 'DESC';

    $posts = new WP_Query( $args );
    $html  = '';

    if ( $posts->have_posts() ) {
        while ( $posts->have_posts() ) {
            $posts->the_post();

            $params = [
                'id' => get_the_ID(),
            ];

            $html .= get_template_part('parts/items/items', 'news', $params);
        }
    } else {
        echo 'На данный момент новости отсутствуют';
    }

    wp_reset_postdata();
    die( $html );
}

//ПОКАЗАТЬ ЕЩЕ РЕЦЕПТЫ
add_action( "wp_ajax_load_more-recipes", "load_recipes" );
add_action( "wp_ajax_nopriv_load_more-recipes", "load_recipes" );
function load_recipes() {

    if ( wp_is_mobile() ) {
        $maxPosts = 5;
    } else {
        $maxPosts = 8;
    }

    $args = json_decode( stripslashes( $_POST[ "query" ] ), true );

    $args[ "paged" ]          = $_POST[ "page" ] + 1;
    $args[ "posts_per_page" ] = $maxPosts;
    $args[ "order" ]          = 'DESC';

    $posts = new WP_Query( $args );
    $html  = '';

    if ( $posts->have_posts() ) {
        while ( $posts->have_posts() ) {
            $posts->the_post();

            $params = [
                'id' => get_the_ID(),
            ];

            $html .= get_template_part('parts/items/items', 'mainRecipes', $params);
        }
    } else {
        echo 'На данный момент рецепты отсутствуют';
    }

    wp_reset_postdata();
    die( $html );
}

//ПОКАЗАТЬ ЕЩЕ ВАКАНСИИ
add_action( "wp_ajax_load_more-vacancy", "load_vacancy" );
add_action( "wp_ajax_nopriv_load_more-vacancy", "load_vacancy" );
function load_vacancy() {

    if ( wp_is_mobile() ) {
        $maxPosts = 4;
    } else {
        $maxPosts = 6;
    }

    $args = json_decode( stripslashes( $_POST[ "query" ] ), true );

    $args[ "paged" ]          = $_POST[ "page" ] + 1;
    $args[ "posts_per_page" ] = $maxPosts;
    $args[ "order" ]          = 'DESC';

    $posts = new WP_Query( $args );
    $html  = '';

    if ( $posts->have_posts() ) {
        while ( $posts->have_posts() ) {
            $posts->the_post();

            $params = [
                'id' => get_the_ID(),
            ];

            $html .= get_template_part('parts/items/items', 'vacancy', $params);
        }
    } else {
        echo 'На данный момент вакансии отсутствуют';
    }

    wp_reset_postdata();
    die( $html );
}

#ПОЛУЧЕНИЕ ИНФОРМАЦИИ ДЛЯ ПОПАПА ВАКАНСИИ
add_action( "wp_ajax_openVacancy", "openVacancy" );
add_action( "wp_ajax_nopriv_openVacancy", "openVacancy" );

function openVacancy () {
    $id = $_POST['id'];

    $args = [
        'post_type' => 'vacancy',
        'p' => $id,
    ];

    $posts = new WP_Query( $args );
    $html  = '';

    if ( $posts->have_posts() ) {
        $posts->the_post();

        $params = [
            'id' => get_the_ID(),
        ];

        $html = get_template_part( "parts/items/popup", 'vacancy', $params );
    }

    wp_reset_postdata();

    die($html);
};

#ДЕЛАЕМ РОССИЯ СТАНДАРТНОЙ СТРАНОЙ ПРИ ОФОРМЛЕНИИ ЗАКАЗА
add_filter('default_checkout_billing_country', 'set_default_country');
function set_default_country() {
    return 'RU';
}

#УБИРАЕМ НЕНУЖНЫЕ ПОЛЯ WOOCOMMERCE
add_filter( 'woocommerce_checkout_fields', 'irlin_woocommerce_checkout_fields', 9999 );
function irlin_woocommerce_checkout_fields( $fields ) {
    unset( $fields[ 'billing' ][ 'billing_last_name' ] );
    unset( $fields[ 'billing' ][ 'billing_company' ] );
    unset( $fields[ 'billing' ][ 'billing_city' ] );
    unset( $fields[ 'billing' ][ 'billing_state' ] );
    unset( $fields[ 'billing' ][ 'billing_postcode' ] );

    return $fields;
}

#ДОБАВЛЯЕМ НОВЫЕ ПОЛЯ ДЛЯ ОФОРМЛЕНИЯ ЗАКАЗА
add_filter('woocommerce_billing_fields', 'true_add_custom_billing_field', 25);

function true_add_custom_billing_field($fields)
{
    $new_field = [
        'billing_date' => [
            'type' => 'text',
            'class' => [
                'true-field',
                'form-row-wide'
            ],
            'label' => 'Дата получения',
            'label_class' => 'true-label',
        ],
        'billing_time' => [
            'type' => 'text',
            'class' => [
                'true-field',
                'form-row-wide'
            ],
            'label' => 'Время получения',
            'label_class' => 'true-label',
        ],
        'billing_change' => [
            'type' => 'text',
            'class' => [
                'true-field',
                'form-row-wide'
            ],
            'label' => 'Сдача с',
            'label_class' => 'true-label',
        ],
    ];

    $fields = array_slice($fields, 0, 2, true) + $new_field + array_slice($fields, 2, null, true);

    return $fields;
}

#СОХРАНЯЕМ ПОЛЯ
add_action( 'woocommerce_checkout_update_order_meta', 'wpbl_save_fields' );

function wpbl_save_fields( $order_id ) {

    if ( !empty( $_POST[ 'billing_date' ] ) ) {
        update_post_meta( $order_id, 'billing_date', sanitize_text_field( $_POST[ 'billing_date' ] ) );
    }

    if ( !empty( $_POST[ 'billing_time' ] ) ) {
        update_post_meta( $order_id, 'billing_time', sanitize_text_field( $_POST[ 'billing_time' ] ) );
    }

    if ( !empty( $_POST[ 'billing_change' ] ) ) {
        update_post_meta( $order_id, 'billing_change', sanitize_text_field( $_POST[ 'billing_change' ] ) );
    }
}

#ОТОБРАЖЕНИЕ CUSTOM ПОЛЕЙ В АДМИНКЕ
add_action( 'woocommerce_admin_order_data_after_billing_address', 'true_print_field_value', 25 );

function true_print_field_value( $order ) {

    if ( $method = get_post_meta( $order->get_id(), 'billing_date', true ) ) {
        echo '<p><strong>Дата доставки:</strong><br>' . esc_html( $method ) . '</p>';
    }

    if ( $method = get_post_meta( $order->get_id(), 'billing_time', true ) ) {
        echo '<p><strong>Время доставки:</strong><br>' . esc_html( $method ) . '</p>';
    }

    if ( $method = get_post_meta( $order->get_id(), 'billing_change', true ) ) {
        echo '<p><strong>Сдача с:</strong><br>' . esc_html( $method ) . '</p>';
    }
}

#ДОБАВЛЕНИЕ CUSTOM ПОЛЕЙ В ПИСЬМО
add_filter( 'woocommerce_get_order_item_totals', 'field_in_email', 25, 2 );

function field_in_email( $rows, $order ) {

    if ( get_post_meta( $order->get_id(), 'billing_date', true ) ) {
        $rows[ 'billing_date' ] = [
            'label' => 'Дата доставки:',
            'value' => get_post_meta( $order->get_id(), 'billing_date', true )
        ];
    }

    if ( get_post_meta( $order->get_id(), 'billing_time', true ) ) {
        $rows[ 'billing_time' ] = [
            'label' => 'Время доставки',
            'value' => get_post_meta( $order->get_id(), 'billing_time', true )
        ];
    }

    if ( get_post_meta( $order->get_id(), 'billing_change', true ) ) {
        $rows[ 'billing_change' ] = [
            'label' => 'Сдача с',
            'value' => get_post_meta( $order->get_id(), 'billing_change', true )
        ];
    }

    return $rows;

}

#ДОБАВЛЕНИЕ ВЕРСТКИ ТОВАРА В КОРЗИНУ ПРИ ДОБАВЛЕНИИ
add_action('wp_ajax_addCart', 'addCart');
add_action('wp_ajax_nopriv_addCart', 'addCart');

function addCart () {
    $product = wc_get_product(intval($_POST['productId']));
    $product_id = intval($_POST['productId']);

    $params = [
        'productId' => $product_id,
        'productItem' => $product,
        'quantityItem' => 1,
    ];

    $html = get_template_part('parts/items/items', 'moreProduct', $params);

    die($html);
}

#ПРОВЕРКА НАЛИЧИЯ В КОРЗИНЕ И ВЫВОД КОЛИЧЕСТВА В КАТАЛОГЕ
add_action('wp_ajax_matched_cart_items', 'matched_cart_items');
add_action('wp_ajax_nopriv_matched_cart_items', 'matched_cart_items');

function matched_cart_items( $search_products ) {
    $count = 0;

    if ( ! WC()->cart->is_empty() ) {
        // Loop though cart items
        foreach( WC()->cart->get_cart() as $cart_item ) {
            // Handling also variable products and their products variations
            $cart_item_ids = array( $cart_item['product_id'], $cart_item['variation_id'] );

            // Handle a simple product Id (int or string) or an array of product Ids
            if ( ( is_array($search_products) && array_intersect($search_products, $cart_item_ids) ) || ( !is_array($search_products) && in_array($search_products, $cart_item_ids) ) ) {
                $count = $cart_item["quantity"]; // incrementing items count
            }
        }
    }

    return $count; // returning matched items count
}

#ДОБАВЛЕНИЕ ПРОДУКТА В КОРЗИНУ
add_action('wp_ajax_nopriv_addProduct', 'addProduct');
add_action('wp_ajax_addProduct', 'addProduct');

function addProduct() {
    $product_id = intval($_POST['productId']);
    $quantity = intval($_POST['quantity']);

    $added = WC()->cart->add_to_cart($product_id, $quantity);

    if ($added) {
        $count = WC()->cart->get_cart_contents_count();

        wp_send_json_success($count);
    } else {
        wp_send_json_error();
    }
}


#ОБНОВЛЕНИЕ ПРОДУКТА В КОРЗИНЕ
add_action('wp_ajax_nopriv_updateProduct', 'updateProduct');
add_action('wp_ajax_updateProduct', 'updateProduct');

function updateProduct() {
    $product_id = intval($_POST['productId']);
    $quantity = intval($_POST['quantity']);

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        if ($cart_item['product_id'] == $product_id) {
            WC()->cart->set_quantity($cart_item_key, $quantity);

            $count = WC()->cart->get_cart_contents_count();

            wp_send_json_success($count);
        }
    }

    wp_send_json_error();
}


#УДАЛЕНИЕ ПРОДУКТА ИЗ КОРЗИНЫ
add_action('wp_ajax_nopriv_removeProduct', 'removeProduct');
add_action('wp_ajax_removeProduct', 'removeProduct');

function removeProduct() {
    $product_id = intval($_POST['productId']);

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        if ($cart_item['product_id'] == $product_id) {
            WC()->cart->remove_cart_item($cart_item_key);

            $count = WC()->cart->get_cart_contents_count();

            wp_send_json_success($count);
        }
    }

    wp_send_json_error();
}
    
    // Заявки в телеграм
    add_action( "wpcf7_before_send_mail", "wpcf7_to_telegram" );
    function wpcf7_to_telegram( $cf7 ) {
        
        $form    = WPCF7_ContactForm::get_current();
        $form_id = $form->id();
        
        if ( $form_id === 294 ) {
            $data = [
                "name"    => $_POST[ "request-name" ],
                "phone"   => $_POST[ "request-phone" ],
                "email"   => $_POST[ "request-mail" ],
                "comment" => $_POST[ "request-comment" ],
            ];
            
            $token    = "toket";
            $chat_ids = [
                "1",
                "2",
            ];
            
            $txt =
                "На вашем сайте rpkinya.ru оставлена заявка" .
                "%0AИмя: " . $data[ "name" ] .
                "%0AТелефон: " . $data[ "phone" ] .
                "%0AЭлектронная почта: " . $data[ "email" ];
            
            if ( $data[ "message" ] !== '' ) {
                $txt .= "%0A<b>Комментарий:</b> " . $data[ "comment" ];
            }
            foreach ( $chat_ids as $chat_id ) {
                wp_remote_get("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&text={$txt}");
            }
        } else if ( $form_id === 12 ) {
            $data = [
                "name"    => $_POST[ "vacancy-name" ],
                "phone"   => $_POST[ "vacancy-phone" ],
                "email"   => $_POST[ "vacancy-mail" ],
                "item" => $_POST[ "vacancy-item" ],
                "birthday" => $_POST[ "vacancy-birthday" ],
                "education" => $_POST[ "vacancy-education" ],
                "experience" => $_POST[ "vacancy-experience" ],
                "file" => $_POST[ "vacancy-file" ],
            ];
            
            $token    = "token";
            $chat_ids = [
                "1",
                "2",
            ];
            
            $txt =
                "Отклик на должность: " . $data[ "item" ] .
                "%0AИмя: " . $data[ "name" ] .
                "%0AТелефон: " . $data[ "phone" ] .
                "%0AЭлектронная почта: " . $data[ "email" ] .
                "%0AДата рождения: " . $data[ "birthday" ] .
                "%0AОбразование: " . $data[ "education" ] .
                "%0AОпыт работы: " . $data[ "experience" ];
            
            foreach ( $chat_ids as $chat_id ) {
                wp_remote_get("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&text={$txt}");
            }
        }
    }
    
    add_action('woocommerce_checkout_order_created', function ($order) {
        $token    = "token";
        $chat_ids = [
            "1",
            "2",
        ];
        
        $payment = '';
        
        switch ($_POST[ "payment_method" ]) {
            case 'bacs':
                $payment = 'Оплата картой при получении';
                break;
            case 'cod':
                $payment = 'Наличный рассчет';
                break;
            default:
                $payment = 'Наличный рассчет';
        }
        
        $method = '';
        switch ($_POST["shipping_method"][0]) {
            case 'local_pickup:2':
                $method = 'самовывоз';
                break;
            case 'free_shipping:3':
                $method = 'курьером до двери';
                break;
            default:
                $method = 'курьером до двери';
        }
        
        $data = [
            "id"                => $order->id,
            "method"            => $method,
            "date"              => $_POST[ "billing_date" ],
            "time"              => $_POST[ "billing_time" ],
            "change"              => $_POST[ "billing_change" ],
            "name"              => $_POST[ "billing_first_name" ],
            "phone"             => $_POST[ "billing_phone" ],
            "email"             => $_POST[ "billing_email" ],
            "message"           => $_POST[ "order_comments" ],
            "payment"           => $payment,
            "address"            => $_POST["billing_address_1"],
            "address2"            => $_POST["billing_address_2"],
        ];
        
        
        $txt = '';
        if ($method === 'самовывоз') {
            $txt =
                "<b>Новый заказ на </b>" . $data["method"] .
                "%0A<b>ID заказа: </b>" . $data["id"] .
                "%0A<b>Дата:</b> " . $data["date"] .
                "%0A<b>Время: </b>" . $data["time"] .
                "%0A<b>Бронь на имя: </b>" . $data["name"] .
                "%0A<b>Телефон: </b>" . $data["phone"] .
                "%0A<b>Email: </b>" . $data["email"] .
                "%0A<b>Способ оплаты: </b>" . $data["payment"];
        } else if ($method === 'курьером до двери') {
            $txt =
                "<b>Новый заказ на </b>" . $data["method"] .
                "%0A<b>ID заказа: </b>" . $data["id"] .
                "%0A<b>Дата:</b> " . $data["date"] .
                "%0A<b>Время: </b>" . $data["time"] .
                "%0A<b>Бронь на имя: </b>" . $data["name"] .
                "%0A<b>Телефон: </b>" . $data["phone"] .
                "%0A<b>Email: </b>" . $data["email"] .
                "%0A<b>Способ оплаты: </b>" . $data["payment"] .
                "%0A<b>Адрес: </b>" . $data["address"] . ", " . $data["address2"];
        }
        
        if ($data["change"] !== '') {
            $txt .= "%0A<b>Нужна сдача с: </b>" . $data["change"];
        }
        
        if ($data["message"] !== '') {
            $txt .= "%0A<b>Дополнительные пожелания: </b>" . $data["message"];
        }
        
        foreach ( $chat_ids as $chat_id ) {
            $fp = file_get_contents( "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}", "r" );
        }
    });