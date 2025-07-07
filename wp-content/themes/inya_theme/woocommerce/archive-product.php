<?php /**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header( 'shop' );

$current_category = 0;
$current_category_ID = 0;

if ( is_a(get_queried_object(), 'WP_Term')) {
    $current_category = get_queried_object();
    $current_category_ID = $current_category->term_id;
} ?>


<section class="products-page__title">
    <div class="container">
        <div class="title__body">
            <h1 class="title-s">Каталог продукции</h1>
            <div class="body__category desktop">
                <?php $args = [
                    'post_type' => 'product',
                    'taxonomy' => 'product_cat',
                    'hide_empty' => 0,
                ];

                $cats = get_categories( $args );

                foreach ( $cats as $cat ) { ?>
                    <?php if ( $current_category_ID === $cat->term_id ) { ?>
                        <div class="category__item active">
                            <p><?php echo $cat->name; ?></p>
                            <a href="/products/">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="10" cy="10" r="10" fill="#FFFFFC"/>
                                    <path d="M14 14L6 6.00002M6 14L14 6" stroke="#2D2D2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                    <?php } else { ?>
                        <a class="category__item" href="<?php echo get_category_link( $cat->term_id ); ?>">
                            <p><?php echo $cat->name; ?></p>
                        </a>
                    <?php } ?>
                <?php } ?>
            </div>

            <div class="body__category mobile">
                <a class="category__open-button" href="#">
                    <svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.66797 7.33301H18.668" stroke="#6E5D65" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M4.66797 14.5H11.668" stroke="#6E5D65" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M16.332 14.5H23.332" stroke="#6E5D65" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M9.33203 21.667H23.332" stroke="#6E5D65" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M21.0013 9.66667C22.29 9.66667 23.3346 8.622 23.3346 7.33333C23.3346 6.04467 22.29 5 21.0013 5C19.7126 5 18.668 6.04467 18.668 7.33333C18.668 8.622 19.7126 9.66667 21.0013 9.66667Z" stroke="#6E5D65" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M14.0013 16.8337C15.29 16.8337 16.3346 15.789 16.3346 14.5003C16.3346 13.2117 15.29 12.167 14.0013 12.167C12.7126 12.167 11.668 13.2117 11.668 14.5003C11.668 15.789 12.7126 16.8337 14.0013 16.8337Z" stroke="#6E5D65" stroke-width="1.8" stroke-linecap="round"/>
                        <path d="M7.0013 23.9997C8.28997 23.9997 9.33464 22.955 9.33464 21.6663C9.33464 20.3777 8.28997 19.333 7.0013 19.333C5.71264 19.333 4.66797 20.3777 4.66797 21.6663C4.66797 22.955 5.71264 23.9997 7.0013 23.9997Z" stroke="#6E5D65" stroke-width="1.8" stroke-linecap="round"/>
                    </svg>
                </a>
                <div class="category__active-category <?php if (is_a(get_queried_object(), 'WP_Term')) { echo 'active'; } ?>">
                    <?php if (is_a(get_queried_object(), 'WP_Term')) { ?>
                        <p><?php echo $current_category->name; ?></p>
                        <a href="/products/">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="10" cy="10" r="10" fill="#FFFFFC"/>
                                <path d="M14 14L6 6.00002M6 14L14 6" stroke="#2D2D2C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    <?php } else { ?>
                        <p>Все товары</p>
                    <?php } ?>
                </div>

                <div class="category__all-categories">
                    <?php $args = [
                        'post_type' => 'product',
                        'taxonomy' => 'product_cat',
                        'hide_empty' => 0,
                    ];

                    $cats = get_categories( $args );

                    foreach ( $cats as $cat ) { ?>
                        <a href="<?php echo get_category_link( $cat->term_id ); ?>" class="all-categories__category <?php if ( $current_category_ID === $cat->term_id ) { echo 'active'; } ?>"><?php echo $cat->name; ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="products-page__products">
    <div class="container">
        <div class="products__body">
            <h4><?php if ($current_category) { echo $current_category->name; } else { echo 'Все'; } ?></h4>

            <?php if ( woocommerce_product_loop() ) :

                woocommerce_product_loop_start();

                if ( wc_get_loop_prop( 'total' ) ) {
                    while ( have_posts() ) {
                        the_post();

                        /**
                         * Hook: woocommerce_shop_loop.
                         */
                        do_action( 'woocommerce_shop_loop' );

                        wc_get_template_part( 'content', 'product' );
                    }
                }

                woocommerce_product_loop_end();
            endif; ?>
        </div>
    </div>
</section>

<?php /**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
/*do_action( 'woocommerce_before_main_content' );*/ ?>

<?php get_footer( 'shop' ); ?>


