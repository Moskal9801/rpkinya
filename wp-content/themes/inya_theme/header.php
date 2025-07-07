<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta content='true' name='HandheldFriendly'/>
        <meta content='width' name='MobileOptimized'/>
        <meta content='yes' name='apple-mobile-web-app-capable'/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php wp_head(); ?>
    </head>

    <body>
        <?php if ( is_front_page() ) { ?>
            <div class="home-page section-page">
        <?php } elseif (is_shop() || is_product_taxonomy()) { ?>
            <div class="products-page section-page">
        <?php } elseif (is_product()) { ?>
            <div class="product-page section-page">
        <?php } elseif (is_cart()) { ?>
            <div class="cart-page section-page">
        <?php } elseif (is_checkout()) { ?>
            <div class="checkout-page section-page">
        <?php } else if (is_page('about')) { ?>
            <div class="about-page section-page">
        <?php } else if (is_page('delivery')) { ?>
            <div class="delivery-page section-page">
        <?php } else if (is_page('shops')) { ?>
            <div class="shops-page section-page">
        <?php } elseif ( is_page('documents') ) { ?>
            <div class="documents-page section-page">
        <?php } elseif ( is_archive() ) { ?>
            <div class="archive-page section-page">
        <?php } elseif ( is_single() ) { ?>
            <div class="single-page section-page">
        <?php } elseif ( is_404() ) { ?>
            <div class="error-page section-page">
        <?php } else { ?>
            <div class="inner-page section-page">
        <?php } ?>

        <?php $currentPath = $_SERVER['REQUEST_URI']; ?>

        <header class="main-header <?php if ( is_front_page() ) { echo 'white-background'; }; ?>">
            <div class="container">
                <div class="main-header__header-body">
                    <a class="header-body__logo" href="/">
                        <?php get_template_part( 'parts/icons/header', 'logo' ); ?>
                    </a>
                    <div class="header-body__controlling">
                        <a class="controlling__phone" href="tel: <?php echo clearPhone(get_field( 'contacts-firstPhone', 220 )); ?>"><?php the_field( 'contacts-firstPhone', 220 ); ?></a>
                        <a class="controlling__catalog border-button brown-mint <?php if (strpos($currentPath, '/products/') !== false || strpos($currentPath, '/product/') !== false || strpos($currentPath, '/product-category/') !== false) { echo 'active'; } ?>" href="/products/">
                            <p>Каталог</p>
                            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1L7 7L1 13" stroke="#2D2D2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a class="controlling__cart" href="/cart/">
                            <?php get_template_part( 'parts/icons/header', 'cart' ); ?>

                            <span style="<?php if (WC()->cart->get_cart_contents_count() < 1) { echo 'display: none'; } ?>"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                        </a>
                        <div class="controlling__hamburger">
                            <div id="hamburger-icon" class="hamburger__icon">
                                <span class="line line-1"></span>
                                <span class="line line-2"></span>
                                <span class="line line-3"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="main-background"></div>

        <div class="main-menu">
            <div class="main-menu__menu-body">
                <div class="menu-body__header">
                    <a class="header__logo" href="/">
                        <?php get_template_part( 'parts/icons/header', 'logo' ); ?>
                    </a>
                    <div class="header__controlling">
                        <a class="controlling__phone" href="tel: <?php echo clearPhone(get_field( 'contacts-firstPhone', 220 )); ?>"><?php the_field( 'contacts-firstPhone', 220 ); ?></a>
                        <a class="controlling__catalog border-button brown-mint" href="/products/">
                            <p>Каталог</p>
                            <svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1L7 7L1 13" stroke="#2D2D2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                        <a class="controlling__cart" href="/cart/">
                            <?php get_template_part( 'parts/icons/header', 'cart' ); ?>

                            <span style="<?php if (WC()->cart->get_cart_contents_count() < 1) { echo 'display: none'; } ?>"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                        </a>
                        <div class="controlling__hamburger">
                            <div id="hamburger-icon" class="hamburger__icon">
                                <span class="line line-1"></span>
                                <span class="line line-2"></span>
                                <span class="line line-3"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu-body__menu">
                    <div class="menu__left">
                        <a class="left__item <?php if (strpos($currentPath, '/products/') !== false || strpos($currentPath, '/product/') !== false || strpos($currentPath, '/product-category/') !== false) { echo 'active'; } ?>" href="/products/">Каталог продукции</a>
                        <a class="left__item <?php if (strpos($currentPath, '/news/') !== false) { echo 'active'; } ?>" href="/news/">Новости и акции</a>
                        <a class="left__item <?php if (strpos($currentPath, '/about/') !== false) { echo 'active'; } ?>" href="/about/">О компании</a>
                        <a class="left__item <?php if (strpos($currentPath, '/recipes/') !== false) { echo 'active'; } ?>" href="/recipes/">Рецепты</a>
                    </div>
                    <div class="menu__right">
                        <a class="right__request default-button mint-brown" href="#popup-request">Свяжитесь с нами</a>
                        <div class="right__menu-more">
                            <a class="menu-more__item <?php if (strpos($currentPath, '/delivery/') !== false) { echo 'active'; } ?>" href="/delivery/">Оплата и доставка</a>
                            <a class="menu-more__item <?php if (strpos($currentPath, '/shops/') !== false) { echo 'active'; } ?>" href="/shops/">Наши магазины</a>
                            <a class="menu-more__item <?php if (strpos($currentPath, '/documents/') !== false) { echo 'active'; } ?>" href="/documents/">Документация</a>
                            <a class="menu-more__item <?php if (strpos($currentPath, '/vacancy/') !== false) { echo 'active'; } ?>" href="/vacancy/">Работа у нас</a>
                        </div>
                    </div>
                    <div class="menu__background">
                        <?php get_template_part( 'parts/icons/menu', 'icons' ); ?>
                    </div>
                </div>
            </div>
        </div>

        <main <?php body_class(); ?>>