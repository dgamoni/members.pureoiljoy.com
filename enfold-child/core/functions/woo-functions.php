<?php 

// remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
// add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail_new', 10);


if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail_new' ) ) {
    function woocommerce_template_loop_product_thumbnail_new() {
        echo woocommerce_get_product_thumbnail_new();
    } 
}
if ( ! function_exists( 'woocommerce_get_product_thumbnail_new' ) ) {   
    function woocommerce_get_product_thumbnail_new( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
        global $post, $woocommerce;

        $post_thumbnail_id = get_post_thumbnail_id( $post->ID );
		$image_src  = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
		$params = array( 'width' => 300, 'height' => 300, 'crop' => true );
		//var_dump($fimage_src[0]);

        $output = '<div class="imagewrapper">';

        if ( has_post_thumbnail() ) {               
            //$output .= get_the_post_thumbnail( $post->ID, $size ); 
            //var_dump(bfi_thumb( $image_src, $params ));
            $output  .= "<img src='" . bfi_thumb( $image_src, $params )[0] . "'/>";          
        }                       
        $output .= '</div>';
        return $output;
    }
}