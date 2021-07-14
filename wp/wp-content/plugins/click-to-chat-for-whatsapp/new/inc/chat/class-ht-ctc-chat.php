<?php
/**
 * WhatsApp Chat  - main page .. 
 * 
 * @subpackage chat
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Chat' ) ) :

class HT_CTC_Chat {

    public function chat() {
        
        $options = get_option('ht_ctc_chat_options');
        
        $ht_ctc_chat = array();

        // show/hide
        include HT_CTC_PLUGIN_DIR .'new/inc/commons/show-hide.php';

        if ( 'no' == $display ) {
            return;
        }
        
        // position
        include HT_CTC_PLUGIN_DIR .'new/inc/commons/position-to-place.php';
        
        // is mobile
        $is_mobile = ht_ctc()->device_type->is_mobile();

        $wp_device = '';

        // style
        $style_d = esc_attr( $options['style_desktop'] );
        $style_m = esc_attr( $options['style_mobile'] );
        if ( 'yes' == $is_mobile ) {
            $style = $style_m;
            $wp_device = 'mobile';
        } else {
            $style = $style_d;
            $wp_device = 'desktop';
        }

        $type = "chat";

        $page_id = get_the_ID();
        $page_url = get_permalink();
        $post_title = esc_html( get_the_title() );

		do_action('ht_ctc_ah_previous_metabox');	

        // page level
        $ht_ctc_pagelevel = get_post_meta( $page_id, 'ht_ctc_pagelevel', true );

        // Number
        $ht_ctc_chat['number'] = (isset($ht_ctc_pagelevel['number'])) ? esc_attr($ht_ctc_pagelevel['number']) : esc_attr( $options['number'] );
        $ht_ctc_chat['number'] = apply_filters( 'wpml_translate_single_string', $ht_ctc_chat['number'], 'Click to Chat for WhatsApp', 'number' );

        // call to action
        $ht_ctc_chat['call_to_action'] = (isset($ht_ctc_pagelevel['call_to_action'])) ? esc_attr($ht_ctc_pagelevel['call_to_action']) : __( esc_attr( $options['call_to_action'] ) , 'click-to-chat-for-whatsapp' );
        $ht_ctc_chat['call_to_action'] = apply_filters( 'wpml_translate_single_string', $ht_ctc_chat['call_to_action'], 'Click to Chat for WhatsApp', 'call_to_action' );

        // prefilled text
        $ht_ctc_chat['pre_filled'] = esc_attr( $options['pre_filled'] );
        $ht_ctc_chat['pre_filled'] = apply_filters( 'wpml_translate_single_string', $ht_ctc_chat['pre_filled'], 'Click to Chat for WhatsApp', 'pre_filled' );

        // analytics
        $is_ga_enable = apply_filters( 'ht_ctc_fh_is_ga_enable', 'no' );
        $is_fb_pixel = apply_filters( 'ht_ctc_fh_is_fb_pixel', 'no' );
        $is_fb_an_enable = apply_filters( 'ht_ctc_fh_is_fb_an_enable', 'no' );
        
        // webapi: web/api.whatsapp,  wa: wa.me
        $webandapi = 'wa';
        if ( isset( $options['webandapi'] ) ) {
            $webandapi = 'webapi';
        }

        $display_mobile = (isset($options['hideon_mobile'])) ? 'hide' : 'show';
        $display_desktop = (isset($options['hideon_desktop'])) ? 'hide' : 'show';

        // number not added and is administrator
        $is_admin = "";
        if ( '' == $ht_ctc_chat['number'] && current_user_can('administrator') ) {
            $is_admin = "admin";
        }

        // class names
        $class_names = "ht-ctc ht-ctc-chat style-$style $wp_device ctc-analytics $is_admin";

        // hook
        $ht_ctc_chat = apply_filters( 'ht_ctc_fh_chat', $ht_ctc_chat );
        
        $ht_ctc_chat['pre_filled'] = str_replace( array('{{url}}', '{url}', '{{title}}', '{title}', '{{site}}', '{site}' ),  array( $page_url, $page_url, $post_title, $post_title, HT_CTC_BLOG_NAME, HT_CTC_BLOG_NAME ), $ht_ctc_chat['pre_filled'] );

        // @uses at styles
        $call_to_action = $ht_ctc_chat['call_to_action'];
        
        if ( '' == $call_to_action ) {
            if ( '1' == $style || '4' == $style || '6' == $style || '8' == $style ) {
                $call_to_action = "WhatsApp us";
            }
        }

        $title = '';
        if ( '2' == $style || '3' == $style ) {
            $title = "title = '$call_to_action'";
        }

        // backend position - todo - remove this after some time... as may not need.
        // Fallback support - as some cache plugins are not updated the js code
        // js will replace this code.
        $backend_position = $position;

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
                style="display: none; <?php echo $backend_position ?>"
                data-return_type="chat" 
                data-style="<?php echo $style ?>" 
                data-number="<?php echo $ht_ctc_chat['number'] ?>" 
                data-pre_filled="<?php echo $ht_ctc_chat['pre_filled'] ?>" 
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
                    <div class="ht_ctc_desktop_chat"><?php include $path_d; ?></div>
                    <div class="ht_ctc_mobile_chat"><?php include $path_m; ?></div>
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

// new HT_CTC_Chat();

$ht_ctc_chat = new HT_CTC_Chat();

// wp_footer / wp_head / get_footer
$ht_ctc_chat_load_position = apply_filters( 'ht_ctc_chat_load_position', 'wp_footer' );

add_action( "$ht_ctc_chat_load_position", array( $ht_ctc_chat, 'chat' ) );

endif; // END class_exists check