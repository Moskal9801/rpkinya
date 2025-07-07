<?php /**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header( 'shop' );

$product = new WC_Product();
$productID = get_the_ID();
?>

    <section class="product-page__product">
        <div class="container">
            <div class="product__body product-card" data-id="<?php the_ID(); ?>">
                <?php while ( have_posts() ) : ?>

                    <?php the_post(); ?>

                    <?php wc_get_template_part( 'content', 'single-product' ); ?>

                <?php endwhile; ?>
            </div>
        </div>
    </section>

<?php $popular_product = get_field( 'popular-product', 'option' ); ?>

<?php if ( $popular_product ) : ?>
    <section class="product-page__popular">
        <div class="container">
            <div class="popular__body">
                <div class="body__title">
                    <h2>Популярная продукция</h2>
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

                            <?php if ($post->ID !== $productID) { ?>
                                <?php get_template_part('parts/items/items', 'mainProduct'); ?>
                            <?php } ?>

                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>



<?php /**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
/*do_action( 'woocommerce_before_main_content' );*/?>

<?php /**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
/*do_action( 'woocommerce_after_main_content' );*/ ?>

<?php /**
 * woocommerce_sidebar hook.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
//do_action( 'woocommerce_sidebar' ); ?>

<?php get_footer( 'shop' ); ?>