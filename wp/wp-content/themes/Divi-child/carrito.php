<style>
    /*carrito icon*/
.cart-contents:before {
    font-family:WooCommerce;
    content: "\e01d";
    font-size:22px;
    margin-top:10px;
    font-style:normal;
    font-weight:400;
    padding-right:5px;
    vertical-align: bottom;
    color: #FFFFFF

}
.cart-contents:hover {
    text-decoration: none;
}
.cart-contents-count {
    color: #fff;
    background-color: #7b7b7b;
    font-weight: bold;
    border-radius: 25px;
    padding: 6px 10px;
    line-height: 1;
    font-family: Arial, Helvetica, sans-serif;
    vertical-align: top;
}

</style>
<div class="carrito-compras">
    <?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

        $count = WC()->cart->cart_contents_count;
        ?><a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
        <?php 
        if ( $count > 0 ) {
            ?>
            <span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
            <?php
        }
            ?></a>
    
    <?php } ?>
</div>