<?php
/**
 * Style - 3
 * 
 * IOS like - WhatsApp icon
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$s3_options = get_option( 'ht_ctc_s3' );
$s3_type = ( isset( $s3_options['s3_type']) ) ? esc_attr( $s3_options['s3_type'] ) : 'simple';

$s3_img_size = esc_attr( $s3_options['s3_img_size'] );
$img_size = esc_attr( $s3_options['s3_img_size'] );
if ( '' == $img_size ) {
    $img_size = "50px";
}

$ht_ctc_svg_css = "pointer-events:none; display:block; height:$img_size; width:$img_size;";

include_once HT_CTC_PLUGIN_DIR .'new/inc/assets/img/svg-style-3.php';



if ( 'simple' == $s3_type ) {
    // simple
    echo style_3_svg( $img_size, $type, $ht_ctc_svg_css );
} else {
    // extend
    $s3_padding = ( isset( $s3_options['s3_padding']) ) ? esc_attr( $s3_options['s3_padding'] ) : '';
    $s3_bg_color = ( isset( $s3_options['s3_bg_color']) ) ? esc_attr( $s3_options['s3_bg_color'] ) : '#25D366';
    $s3_bg_color_hover = ( isset( $s3_options['s3_bg_color_hover']) ) ? esc_attr( $s3_options['s3_bg_color_hover'] ) : '#25D366';

    $s3_box_shadow = "";
    if ( isset( $s3_options['s3_box_shadow'])) {
        $s3_box_shadow = "box-shadow: 0px 0px 11px rgba(0,0,0,.5);";
    }
    $s3_extend_css = "background-color: $s3_bg_color; padding: $s3_padding; border-radius: 50%; $s3_box_shadow";

    $s3_box_shadow_hover = "";
    if ( isset( $s3_options['s3_box_shadow_hover'])) {
        $s3_box_shadow_hover = "box-shadow:0px 0px 11px rgba(0,0,0,.5);";
    }
    // hover css
    $s3_hover_css = "background-color:$s3_bg_color_hover !important;$s3_box_shadow_hover";
    
    $others = array(
        'bg_color' => "$s3_bg_color",
    );

    ?>
    <style>
    .ht-ctc:hover svg stop{stop-color:<?php echo $s3_bg_color_hover ?>;}
    .ht-ctc:hover .ht_ctc_padding{<?php echo $s3_hover_css ?>}
    </style>


    <div class="ht_ctc_padding" style="<?php echo $s3_extend_css ?>">
        <?php echo style_3_extend_svg( $img_size, $type, $ht_ctc_svg_css, $others ); ?>
    </div>
    <?php
}