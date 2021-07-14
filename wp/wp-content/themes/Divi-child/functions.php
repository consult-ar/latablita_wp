<?php 
/*Este código muestra los estilos que aplicamos en el archivo custom-login-styles.css dentro de la carpeta login*/
function custom_login() {
  wp_enqueue_style( 'custom-login-css', get_stylesheet_directory_uri() . '/login/custom-login-styles.css', array(), '1.0' );
}
add_action( 'login_head', 'custom_login' );
function custom_url_login() {
	return 'https://liebre.online/'; // Ponemos la web que queramos.
}
add_filter( 'login_headerurl', 'custom_url_login' );

//

function my_theme_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri().'/style.css');
}
add_action('wp_enqueue_scripts','my_theme_enqueue_styles');

/* 
Nuevo numero de posts en woocoomerce
 
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 18;
  return $cols;
}
*/

/**
 * Does not filter related products by tag
 */
// Obtener productos relacionados de la misma subcategoria

//Only show products in the front-end search results
function lw_search_filter_pages($query) {
    if ($query->is_search) {
        $query->set('post_type', 'product');
        $query->set( 'wc_query', 'product_query' );
    }
    return $query;
}
 
add_filter('pre_get_posts','lw_search_filter_pages');

/* cart agotado */
add_action( 'woocommerce_before_shop_loop_item_title', function() {
   global $product;
   if ( !$product->is_in_stock() ) {
       echo '<span class="now_sold">Agotado</span>';
   }
});
/* cart agotado */
add_filter('woocommerce_states', 'lista_provincias');

function lista_provincias( $provincias ) {

$provincias ['AR'] = array(

'D' => 'Belgrano',
'E' => 'Recoleta',
'F' => 'Villa Puerreydon',
'G' => 'Villa del Parque',
'Y' => 'Villa Crespo',
'H' => 'Caballito',
'I' => 'Chacarita',
'J' => 'Colegiales',
'K' => 'Villa Ortuzar',
'L' => 'Parque Chas',
'M' => 'Villa Urquiza',
'N' => 'Coghlan',
'O' => 'Palermo',
'P' => 'Nuñez',
'Q' => 'Saveedra',
'R' => 'Vicente Lopez(BARRIO)',
'S' => 'Florida Este(BARRIO)',
'T' => 'Olivos',
'U' => 'Almagro',
'W' => 'Paternal',

); //CODIGO Y NOMBRES DE PROVINCIAS DISPONIBLES

return $provincias;

}
//
add_filter( 'woocommerce_default_address_fields' , 'rename_state_province', 9999 );
 
function rename_state_province( $fields ) {
    $fields['state']['label'] = 'Selecciona tu Barrio de Envío';
    return $fields;
}

//deselect checkout billing/shipping state
/* 

add_filter( 'default_checkout_billing_state', 'change_default_checkout_state' );
add_filter( 'default_checkout_shipping_state', 'change_default_checkout_state' );
function change_default_checkout_state() {
    return ''; //set state code if you want to set it otherwise leave it blank.
}
*/

function md_custom_woocommerce_checkout_fields( $fields ) 
{
    $fields['order']['order_comments']['placeholder'] = 'Detalles de mi pedido';
    $fields['order']['order_comments']['label'] = 'Agregá tus propios Comentarios para Tu pedido<br>Por ejemplo si el pedido es un Regalo Aclaralo y si querés dejale una nota al agasajado.';


    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'md_custom_woocommerce_checkout_fields' );

/**

 * Cambiar el número de columnas

 */

add_filter('loop_shop_columns', 'loop_columns', 999);

if (!function_exists('loop_columns')) {

 function loop_columns() {

 return 3; // 3 productos por columna

 }

}
add_filter( 'woocommerce_variable_sale_price_html', 'wc_custom_variation_price_format', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'wc_custom_variation_price_format', 10, 2 );

function wc_custom_variation_price_format( $price, $product ) {

  // Main Price
  $prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
  $price = $prices[0] !== $prices[1] ? sprintf( __( 'Desde: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

  // Sale Price
  $prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
  sort( $prices );
  $saleprice = $prices[0] !== $prices[1] ? sprintf( __( 'Desde: %1$s', 'woocommerce' ), wc_price( $prices[0] ) ) : wc_price( $prices[0] );

  if ( $price !== $saleprice ) {
    $price = '<del>' . $saleprice . $product->get_price_suffix() . '</del> <ins>' . $price . 
    $product->get_price_suffix() . '</ins>';
  }
  return $price;
}

/**
 * @snippet       Sort Products By Stock Status - WooCommerce Shop
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.9
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
/*
add_filter( 'woocommerce_get_catalog_ordering_args', 'bbloomer_first_sort_by_stock_amount', 9999 );
 
function bbloomer_first_sort_by_stock_amount( $args ) {
   $args['orderby'] = 'meta_value';
   $args['order'] = 'ASC';
   $args['meta_key'] = '_stock_status';
   return $args;
}*/
// datos envios en carro y checkout
/* agregar formulario de productos */
//add_action( 'woocommerce_after_single_product_summary', 'formulario_productos', 16 );
function avisotienda(){
    echo get_template_part( './woocommerce/avisotienda' );
}
add_action( 'woocommerce_before_cart_totals', 'avisotienda' );
add_action('woocommerce_checkout_before_order_review', 'avisotienda');

//local pickup descuento
function df_add_ticket_surcharge( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) )
        return;

    $chosen_shipping_method_id = WC()->session->get( 'chosen_shipping_methods' )[0];
    $chosen_shipping_method    = explode(':', $chosen_shipping_method_id)[0];

    /* SETTINGS */

    $special_fee_cat = 227; // category id for the special fee
    $fee_per_prod = 10; //special fee per product
	$percentage = 10;
    /* END SETTINGS */      

    // Total
    $total = 0;

    // Only for Local pickup chosen shipping method
    if ( strpos( $chosen_shipping_method_id, 'local_pickup' ) !== false ) {
        // Loop though each cart items and set prices in an array
        foreach ( $cart->get_cart() as $cart_item ) {
			
            // Get product id
            $product_id = $cart_item['product_id'];
			

            // Quantity
            $product_quantity = $cart_item['quantity'];

            // Check for category
            if ( has_term( $special_fee_cat, 'product_cat', $product_id ) ) {
				//print_r($cart_item);
				//$discount = $cart->get_subtotal() * $percentage / 100;
                $total -= $fee_per_prod * $cart_item['line_subtotal'] / 100;
				//$total += $fee_per_prod * $product_quantity;
				$cart->add_fee( __('Descuento por retiro Take Away'). ' (' . $percentage . '%)', $total );
            }
        }

        // Add the discount
        
    }
}
add_action( 'woocommerce_cart_calculate_fees', 'df_add_ticket_surcharge', 10, 1 );
//
// Cambia el título de Mercado Pago en el checkout
add_filter( 'gettext', 'cambia_titulo_mercadopago', 999, 3 );
  
function cambia_titulo_mercadopago( $translated, $untranslated, $domain ) {
 
   if ( !is_admin() && 'woocommerce-mercadopago' === $domain ) {
 
      switch ( $translated ) {
 
         case 'Paga con el medio de pago que prefieras':
 
            $translated = 'PAGO CON TARJETA DE CRÉDITO O DÉBITO'; // Poné aquí lo que quieras que aparezca en el checkout
            break;
      }

   }   
 
   return $translated;
 
}
//ocultar direccion

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
 
function custom_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_city']);
    return $fields;
}

//
add_filter( 'woocommerce_default_address_fields' , 'custom_override_default_address_fields' );
function custom_override_default_address_fields($address_fields) {
    $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
    $chosen_shipping = $chosen_methods[0];
    if ( 0 === strpos( $chosen_shipping, 'local_pickup' ) ) {
        $address_fields['address_1']['required'] = false;
        $address_fields['address_1']['placeholder'] = '';
        $address_fields['address_2']['required'] = false;
        $address_fields['address_2']['placeholder'] = '';
        $address_fields['city']['required'] = false;
        $address_fields['postcode']['required'] = false;
    }

return $address_fields;
}
/**
 * @snippet       Hide Shipping Fields for Local Pickup
 * @how-to        Get CustomizeWoo.com FREE
 * @sourcecode    https://businessbloomer.com/?p=72660
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.5.7
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
   
add_action( 'woocommerce_after_checkout_form', 'bbloomer_disable_shipping_local_pickup' );
  
function bbloomer_disable_shipping_local_pickup( $available_gateways ) {
    
   // Part 1: Hide shipping based on the static choice @ Cart
   // Note: "#customer_details .col-2" strictly depends on your theme
 
   $chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
   $chosen_shipping = $chosen_methods[0];
   if ( 0 === strpos( $chosen_shipping, 'local_pickup' ) ) {
   ?>
      <script type="text/javascript">
         jQuery('#billing_country_field,#billing_address_2,#billing_address_1_field, #billing_city_field, #billing_state_field, #billing_postcode_field').fadeOut();
      </script>
   <?php  
   } 
 
   // Part 2: Hide shipping based on the dynamic choice @ Checkout
   // Note: "#customer_details .col-2" strictly depends on your theme
 
   ?>
      <script type="text/javascript">
         jQuery('form.checkout').on('change','input[name^="shipping_method"]',function() {
            var val = jQuery( this ).val();
            if (val.match("^local_pickup")) {
                     jQuery('#billing_country_field,#billing_address_2,#billing_address_1_field, #billing_city_field, #billing_state_field, #billing_postcode_field').fadeOut();
               } else {
               jQuery('#billing_country_field,#billing_address_1_field,#billing_address_2, #billing_city_field, #billing_state_field, #billing_postcode_field').fadeIn();
            }
         });
      </script>
   <?php
  
}
function remove_image_zoom_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'wp', 'remove_image_zoom_support', 100 );

/*function reset_default_shipping_method( $method, $available_methods ) {
    $default_method = 'local_pickup'; //provide here the service name which will selected default
    if( array_key_exists($method, $available_methods ) )
    	return $default_method;
    else
    	return $method;
}
add_filter('woocommerce_shipping_chosen_method', 'reset_default_shipping_method', 10, 2);*/

//compra minima
/**
 * Set a minimum order amount for checkout
 */
add_action( 'woocommerce_checkout_process', 'wc_minimum_order_amount' );
add_action( 'woocommerce_before_cart' , 'wc_minimum_order_amount' );
 
function wc_minimum_order_amount() {
    // Set this variable to specify a minimum order value
    $minimum = 1000;

    if ( WC()->cart->total < $minimum ) {

        if( is_cart() ) {

            wc_print_notice( 
                sprintf( 'El valor de tu compra es de %s — Pero la compra minima para web debe ser de %s para que puedas realizar el pedido' , 
                    wc_price( WC()->cart->total ), 
                    wc_price( $minimum )
                ), 'error' 
            );

        } else {

            wc_add_notice( 
                sprintf( 'El valor de tu compra es de %s — Pero la compra minima para web debe ser de %s para que puedas realizar el pedido' , 
                    wc_price( WC()->cart->total ), 
                    wc_price( $minimum )
                ), 'error' 
            );

        }
    }
}



//coupon texto
add_filter( 'gettext', 'woocommerce_rename_coupon_field_on_cart', 10, 3 );
add_filter( 'gettext', 'woocommerce_rename_coupon_field_on_cart', 10, 3 );
add_filter('woocommerce_coupon_error', 'rename_coupon_label', 10, 3);
add_filter('woocommerce_coupon_message', 'rename_coupon_label', 10, 3);
add_filter('woocommerce_cart_totals_coupon_label', 'rename_coupon_label',10, 1);
add_filter( 'woocommerce_checkout_coupon_message', 'woocommerce_rename_coupon_message_on_checkout' );


function woocommerce_rename_coupon_field_on_cart( $translated_text, $text, $text_domain ) {
	// bail if not modifying frontend woocommerce text
	if ( is_admin() || 'woocommerce' !== $text_domain ) {
		return $translated_text;
	}
	if ( 'Coupon:' === $text ) {
		$translated_text = 'Código Gift Card:';
	}

	if ('Coupon has been removed.' === $text){
		$translated_text = 'El Código Gift Card que ingrasaste ya no es valido';
	}

	if ( 'Apply coupon' === $text ) {
		$translated_text = 'Aplicar Código Gift Card';
	}

	if ( 'Coupon code' === $text ) {
		$translated_text = 'Código Gift Card';
	
	} 

	return $translated_text;
}

// rename the "Have a Coupon?" message on the checkout page
function woocommerce_rename_coupon_message_on_checkout() {
	return 'Tenés un Código Gift Card?' . ' ' . __( 'Hacé click acá para ingresar tu ', 'woocommerce' ) . '';
}

function rename_coupon_label($err, $err_code=null, $something=null){

	$err = str_ireplace("Coupon","Offer Code ",$err);

	return $err;
}

//

// formulario dni
//custom form hcdeli


add_filter('woocommerce_checkout_fields', 'condicionIVA');
function condicionIVA( $fields )
{
	/*$fields['billing']['billing_iva'] = array(
		'label'       => __('Condición IVA', 'woocommerce'), // Add custom field label
		'required'    => true, // if field is required or not
		'clear'       => true, // add clear or not
		'type'        => 'select',
		'options'     => array(
		'first' => __('---', 'woocommerce' ),
		'Cons-final' => __('Consumidor final', 'woocommerce' ),
		'IVA-RESP' => __('Responsable Inscripto', 'woocommerce' ),
		'IVA-EX' => __('IVA Exento', 'woocommerce' ),
		), // add field type
		'class'       => array('select2-selection select2-selection--single'),// add class name
		'priority'    => 25, // Priority sorting option
	);*/
	$fields['billing']['billing_piso'] = array(
			'label'       => __('Piso / Depto', 'woocommerce'),
			'placeholder' => _x('Piso / Depto', 'placeholder', 'woocommerce'),
			'required'    => false,
			'clear'       => true,
			'type'        => 'text',
			'priority'    => 60 // Priority sorting option
		);
	return $fields;
}

/**
 * Process the checkout
 */
/*
add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

function my_custom_checkout_field_process() {
    // Check if set, if its not set add an error.
    if ( ! $_POST['billing_piso'] )
        wc_add_notice( __( 'Este campo es Obligatorio' ), 'error' );
}
*/

add_action('woocommerce_checkout_update_order_meta', 'dataimpositiva');

function dataimpositiva( $order_id ) {
		if ( ! empty( $_POST['billing_piso'] ) ) {
				update_post_meta( $order_id, 'billing_piso', sanitize_text_field( $_POST['billing_piso'] ) );
		}
}

// Para insertar en los email de notificación de Pedido el campo personalizado. 
add_filter('woocommerce_email_order_meta_keys', 'my_custom_checkout_field_order_meta_keys');
function my_custom_checkout_field_order_meta_keys( $keys ) {
 
			//$keys[] = 'Condicion IVA';
			$keys['Piso/Depto'] = '_billing_piso';
    return $keys;
}
/**
 * Display field value on the order edit page
 */
add_action( 'woocommerce_admin_order_data_after_billing_address', 'order_custom_fields_admin', 10, 1 );

function order_custom_fields_admin($order){
    echo '<p><strong>'.__('Piso / Depto').':</strong> <br/>' . get_post_meta( $order->get_id(), 'billing_piso', true ) . '</p>';
}