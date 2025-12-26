<?php if ( !defined( 'ABSPATH' ) ) exit();

// Get product id
$product_id = tripgo_get_meta_data( 'id', $args, get_the_id() );

// Get product
$product = wc_get_product( $product_id );
if ( !$product || !$product->is_type( 'ovabrw_car_rental' ) ) return;

// Carousel options
$carousel_options = tripgo_get_meta_data( 'data_options', $args );
if ( !tripgo_array_exists( $carousel_options ) ) {
    $carousel_options = apply_filters( 'tripgo_related_carousel_options', [
        'items'                 => 4,
        'slideBy'               => 1,
        'margin'                => 24,
        'autoplayHoverPause'    => true,
        'loop'                  => false,
        'autoplay'              => true,
        'autoplayTimeout'       => 3000,
        'smartSpeed'            => 500,
        'autoWidth'             => false,
        'center'                => false,
        'lazyLoad'              => true,
        'dots'                  => true,
        'nav'                   => true,
        'rtl'                   => is_rtl() ? true: false,
        'nav_left'              => 'icomoon icomoon-angle-left',
        'nav_right'             => 'icomoon icomoon-angle-right'
    ]);
}

// Query arguments
$args = [
    'posts_per_page'    => 5,
    'orderby'           => 'ID',
    'order'             => 'DESC'
];

// Get visible related products then sort them at random.
$args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );

// Get related products
$related_products = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] );

if ( tripgo_array_exists( $related_products ) ): ?>
    <div class="elementor-ralated-slide">
        <h3 class="related-title">
            <?php echo esc_html__( 'You May Like', 'tripgo' ); ?>
        </h3>
        <div class="ova-product-slider elementor-ralated owl-carousel owl-theme" data-options="<?php echo esc_attr( json_encode( $carousel_options ) ); ?>">
            <?php foreach ( $related_products as $related_product ) {
                    $post_object = get_post( $related_product->get_id() );
                    setup_postdata( $GLOBALS['post'] =& $post_object );
                    wc_get_template_part( 'content', 'product' );
                }
                
                // Get post
                $post_object = get_post( $product->get_id() );
                setup_postdata( $GLOBALS['post'] =& $post_object );
            ?>
        </div>
    </div>  
<?php endif; ?>