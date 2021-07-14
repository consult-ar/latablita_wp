<?php
/**
 * Share feature - main page
 * 
 * @subpackage share
 * @since 2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Share' ) ) :

class HT_CTC_Share {

    public function __construct() {
        // $this->share();
    }

    public function share() {
        
        $options = get_option('ht_ctc_share');

        // share text
        $share_text = esc_attr( $options['share_text'] );
        $share_text = apply_filters( 'wpml_translate_single_string', $share_text, 'Click to Chat for WhatsApp', 'share_text__share' );

        // return if share text is blank
        if ( '' == $share_text ) {
            return;
        }

        // show/hide
        include HT_CTC_PLUGIN_DIR .'new/inc/commons/show-hide.php';

        if ( 'no' == $display ) {
            return;
        }

        // position
        include HT_CTC_PLUGIN_DIR .'new/inc/commons/position-to-place.php';
        
        // is mobile to select styles
        $is_mobile = ht_ctc()->device_type->is_mobile();

        // style
        $style_d = esc_attr( $options['style_desktop'] );
        $style_m = esc_attr( $options['style_mobile'] );
        if ( 'yes' == $is_mobile ) {
            $style = $style_m;
        } else {
            $style = $style_d;
        }

        $type = "share";

        // call to action
        $call_to_action = esc_html( $options['call_to_action'] );
        $call_to_action = apply_filters( 'wpml_translate_single_string', $call_to_action, 'Click to Chat for WhatsApp', 'call_to_action__share' );

        // class names
        $class_names = "ht-ctc ht-ctc-share style-$style";

        $page_url = get_permalink();
        $post_title = esc_html( get_the_title() );

        // if ( is_home() || is_front_page() ) {
        if ( is_home() ) {
            $page_url = get_bloginfo('url');
            $post_title = HT_CTC_BLOG_NAME;
        }

        $share_text = str_replace( array('{{url}}', '{url}', '{{title}}', '{title}', '{{site}}', '{site}' ),  array( $page_url, $page_url, $post_title, $post_title, HT_CTC_BLOG_NAME, HT_CTC_BLOG_NAME ), $share_text );

        // analytics
        $is_ga_enable = apply_filters( 'ht_ctc_fh_is_ga_enable', 'no' );
        $is_fb_pixel = apply_filters( 'ht_ctc_fh_is_fb_pixel', 'no' );
        $is_fb_an_enable = apply_filters( 'ht_ctc_fh_is_fb_an_enable', 'no' );


        // webapi: web/api.whatsapp,  api: api.whatsapp
        $webandapi = 'api';
        if ( isset( $options['webandapi'] ) ) {
            $webandapi = 'webapi';
        }

        $display_mobile = (isset($options['hideon_mobile'])) ? 'hide' : 'show';
        $display_desktop = (isset($options['hideon_desktop'])) ? 'hide' : 'show';

        $title = '';
        if ( '2' == $style || '3' == $style ) {
            $title = "title = '$call_to_action'";
        }

        $css = "display: none; cursor: pointer; z-index: 99999999;";

        // call style
        $path = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/inc/styles/style-' . $style. '.php';

        $path_d = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/inc/styles/style-' . $style_d. '.php';
        $path_m = plugin_dir_path( HT_CTC_PLUGIN_FILE ) . 'new/inc/styles/style-' . $style_m. '.php';

        $othersettings = get_option('ht_ctc_othersettings');

        if ( is_file( $path ) ) {
            do_action('ht_ctc_ah_before_fixed_position');
            ?>
            <div <?php echo $title ?> onclick="ht_ctc_click(this);" class="<?php echo $class_names ?>" 
                style="display: none;"
                data-return_type="share" 
                data-share_text="<?php echo $share_text ?>" 
                data-is_ga_enable="<?php echo $is_ga_enable ?>" 
                data-is_fb_pixel="<?php echo $is_fb_pixel ?>" 
                data-is_fb_an_enable="<?php echo $is_fb_an_enable ?>" 
                data-webandapi="<?php echo $webandapi ?>" 
                data-display_mobile="<?php echo $display_mobile ?>" 
                data-display_desktop="<?php echo $display_desktop ?>" 
                data-css="<?php echo $css ?>" 
                data-position="<?php echo $position ?>" 
                data-position_mobile="<?php echo $position_mobile ?>" 
                >
                <?php 
                if ( isset( $othersettings['select_styles_issue'] ) ) {
                    ?>
                    <div class="ht_ctc_desktop_share"><?php include $path_d; ?></div>
                    <div class="ht_ctc_mobile_share"><?php include $path_m; ?></div>
                    <?php
                } else {
                    include $path;
                }
                ?>
            </div>
            <?php
            do_action('ht_ctc_ah_after_fixed_position');
        }

        
    }

}

// new HT_CTC_Share();

$ht_ctc_share = new HT_CTC_Share();
add_action( 'wp_footer', array( $ht_ctc_share, 'share' ) );


endif; // END class_exists check