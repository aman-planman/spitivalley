<?php if ( !defined( 'ABSPATH' ) ) exit();

// Get product id
$product_id = tripgo_get_meta_data( 'id', $args, get_the_id() );

// Get product
$product = wc_get_product( $product_id );
if ( !$product || !$product->is_type( 'ovabrw_car_rental' ) ) return;

// Show gallery
$show_gallery = tripgo_get_meta_data( 'show_gallery', $args, 'yes' );

// Get gallery ids
$gallery_ids = tripgo_get_gallery_ids( $product_id );

// Data gallery
$data_gallery = [];

// Carousel options
$carousel_options = tripgo_get_meta_data( 'data_options', $args );
if ( !tripgo_array_exists( $carousel_options ) ) {
    $carousel_options = apply_filters( 'tripgo_gallery_carousel_options', [
        'items'                 => 3,
        'slideBy'               => 1,
        'margin'                => 24,
        'autoplayHoverPause'    => true,
        'loop'                  => true,
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
} // END

// Thumbnail size
$thumbnail_size = tripgo_get_meta_data( 'thumbnail_size', $args, 'tripgo_product_slider' );

// Gallery size
$gallery_size = apply_filters( 'tripgo_product_gallery_size', $thumbnail_size );

if ( 'yes' === $show_gallery && tripgo_array_exists( $gallery_ids ) ): ?>
    <div class="ova-gallery-popup">
        <div class="ova-gallery-slideshow owl-carousel owl-theme" data-options="<?php echo esc_attr( json_encode( $carousel_options ) ); ?>">
            <?php foreach ( $gallery_ids as $i => $img_id ):
                // Get image URL
                $img_url = wp_get_attachment_url( $img_id );

                // Get image alt
                $img_alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true );
                if ( !$img_alt ) $img_alt = get_the_title( $img_id );

                // Add data gallery
                array_push( $data_gallery, [
                    'src'       => $img_url,
                    'caption'   => $img_alt,
                    'thumb'     => $img_url
                ]);
            ?>
                <div class="item">
                    <a class="gallery-fancybox" data-index="<?php echo esc_attr( $i ); ?>" href="javascript:void(0)">
                        <?php echo wp_get_attachment_image( $img_id, $gallery_size ); ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <?php tripgo_text_input([
            'type'  => 'hidden',
            'class' => 'ova-data-gallery',
            'attrs' => [
                'data-gallery' => json_encode( $data_gallery )
            ]
        ]); ?>
    </div>
<?php endif; ?>