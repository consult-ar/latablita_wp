<?php
/**
 * Group chat/invite feature - main page
 * 
 * @subpackage group
 * @since 2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_Group' ) ) :

class HT_CTC_Group {

    public function __construct() {
        // $this->group();
    }

    public function group() {
        
        $options = get_option('ht_ctc_group');

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

        $type = "group";

        // call to action
        $call_to_action = esc_attr( $options['call_to_action'] );
        $call_to_action = apply_filters( 'wpml_translate_single_string', $call_to_action, 'Click to Chat for WhatsApp', 'call_to_action__group' );

        // class names
        $class_names = "ht-ctc ht-ctc-group style-$style";

        // group id
        $group_id = esc_attr( $options['group_id'] );

        // group_id - at page level
        $page_id = get_the_ID();
        $page_group_id = esc_attr( get_post_meta( $page_id, 'ht_ctc_page_group_id', true ) );

        if ( isset( $page_group_id ) && '' !== $page_group_id ){
            $group_id = $page_group_id;
        }

        $group_id = apply_filters( 'wpml_translate_single_string', $group_id, 'Click to Chat for WhatsApp', 'group_id__group' );

        // analytics
        $is_ga_enable = apply_filters( 'ht_ctc_fh_is_ga_enable', 'no' );
        $is_fb_pixel = apply_filters( 'ht_ctc_fh_is_fb_pixel', 'no' );
        $is_fb_an_enable = apply_filters( 'ht_ctc_fh_is_fb_an_enable', 'no' );

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
                data-return_type="group" 
                data-group_id="<?php echo $group_id ?>" 
                data-is_ga_enable="<?php echo $is_ga_enable ?>" 
                data-is_fb_pixel="<?php echo $is_fb_pixel ?>" 
                data-is_fb_an_enable="<?php echo $is_fb_an_enable ?>" 
                data-display_mobile="<?php echo $display_mobile ?>" 
                data-display_desktop="<?php echo $display_desktop ?>" 
                data-css="<?php echo $css ?>" 
                data-position="<?php echo $position ?>" 
                data-position_mobile="<?php echo $position_mobile ?>" 
                >
                <?php 
                if ( isset( $othersettings['select_styles_issue'] ) ) {
                    ?>
                    <div class="ht_ctc_desktop_group"><?php include $path_d; ?></div>
                    <div class="ht_ctc_mobile_group"><?php include $path_m; ?></div>
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

// new HT_CTC_Group();

$ht_ctc_group = new HT_CTC_Group();
add_action( 'wp_footer', array( $ht_ctc_group, 'group' ) );


endif; // END class_exists check