<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

do_action( 'woocommerce_before_main_content' );

do_action( 'woocommerce_shop_loop_header' );

$term_id = get_queried_object_id();
$seo_text = get_field('seo_text', 'term_' . $term_id);

$is_crosspieces_category = is_product_category('crosspieces');
$is_accessories_category = is_product_category('accessories');

?>

<div class="container">
    <?php if((!$is_crosspieces_category) && (!$is_accessories_category)):?>
    <div class="row">
        <div class="col-md-3 col-sm-0">
            <?php
            if ( function_exists( 'add_product_category_sidebar' ) ) {
                add_product_category_sidebar();
            }
            ?>
        </div>
        <div class="col-md-9 col-sm-12">
            <?php
            if ( woocommerce_product_loop() ) {
                do_action( 'woocommerce_before_shop_loop' );

                woocommerce_product_loop_start();

                if ( wc_get_loop_prop( 'total' ) ) {
                    while ( have_posts() ) {
                        the_post();
                        do_action( 'woocommerce_shop_loop' );
                        wc_get_template_part( 'content', 'product' );
                    }
                }

                woocommerce_product_loop_end();

                do_action( 'woocommerce_after_shop_loop' );
            } else {
                do_action('woocommerce_no_products_found');
            }
            ?>
        </div>
    </div>
    <?php else:?>
        <?php
        if ( woocommerce_product_loop() ) {
            do_action( 'woocommerce_before_shop_loop' );

            woocommerce_product_loop_start();

            if ( wc_get_loop_prop( 'total' ) ) {
                while ( have_posts() ) {
                    the_post();
                    do_action( 'woocommerce_shop_loop' );
                    wc_get_template_part( 'content', 'product' );
                }
            }

            woocommerce_product_loop_end();

            do_action( 'woocommerce_after_shop_loop' );
        } else {
            do_action('woocommerce_no_products_found');
        }
        ?>
    <?php endif; ?>
</div>

<div class="block-search full-width-block">
    <?php echo do_shortcode('[search_block_custom]'); ?>
</div>

<?php

if( $seo_text ) {
    echo '<div class="seo-text txt-s">';
    echo $seo_text;
    echo '</div>';
}

do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
