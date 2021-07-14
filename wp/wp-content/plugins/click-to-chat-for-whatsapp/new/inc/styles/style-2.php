<?php
/**
 * Style - 2
 * 
 * Andriod like - WhatsApp icon
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$s2_options = get_option( 'ht_ctc_s2' );

$s2_img_size = esc_attr( $s2_options['s2_img_size'] );
$img_size = esc_attr( $s2_options['s2_img_size'] );
if ( '' == $img_size ) {
    $img_size = "50px";
}

$ht_ctc_svg_css = "pointer-events:none; display:block; height:$img_size; width:$img_size;";

include_once HT_CTC_PLUGIN_DIR .'new/inc/assets/img/svg-style-2.php';

echo style_2_svg( $img_size, $type, $ht_ctc_svg_css );