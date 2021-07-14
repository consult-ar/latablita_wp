<?php
/**
 * Default Values
 * 
 *  set the default values
 *  which stores in database options table
 *
 * @package ctc
 * @since 2.0
 * @from ht-ccw-register.php
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'HT_CTC_DB' ) ) :

class HT_CTC_DB {


    public function __construct() {
        $this->db();
    }
    
    
    /**
     * based on condition.. update the db .. 
     *
     */
    public function db() {
        
        $this->ht_ctc_othersettings();
        
        $this->ht_ctc_main_options();
        $this->ht_ctc_chat_options();
        $this->ht_ctc_plugin_details();
        $this->ht_ctc_group();
        $this->ht_ctc_share();
        $this->ht_ctc_one_time();

        $this->ht_ctc_switch();

        // $this->ht_ctc_s1();
        $this->ht_ctc_s2();
        $this->ht_ctc_s3();
        $this->ht_ctc_s4();
        $this->ht_ctc_s5();
        $this->ht_ctc_s6();
        $this->ht_ctc_s7();
        $this->ht_ctc_s8();

        $this->ht_ctc_s99();

    }


    
    /**
     * table name: "ht_ctc_othersettings"
     * 
     * other settings 
     * 
     * checkboxes .. 
     *  enable_group  enable_group chat
     *  enable_share  enable_share
     *  fb_analytics   facebook analytics using js sdk
     * 
     */
    public function ht_ctc_othersettings() {
        
        $values = array(
            'hello' => 'world',
        );

        $ht_ctc_main_options = get_option('ht_ctc_main_options');
        if ( isset ( $ht_ctc_main_options['fb_analytics'] ) ) {
            $values['fb_analytics'] = '1';
        }

        if ( isset ( $ht_ctc_main_options['enable_group'] ) ) {
            $values['enable_group'] = '1';
        }
        if ( isset ( $ht_ctc_main_options['enable_share'] ) ) {
            $values['enable_share'] = '1';
        }

        $db_values = get_option( 'ht_ctc_othersettings', array() );
        $update_values = array_merge($values, $db_values);
        update_option('ht_ctc_othersettings', $update_values);

    }

    


    /**
     * table name: "ht_ctc_main_options"
     * 
     * enable options .. 
     * 
     * checkboxes .. 
     *  
     * 
     *  google_analytics  enable Google analytics
     *  fb_pixel  enable Facebook Pixel
     * 
     */
    public function ht_ctc_main_options() {
        
        $values = array(
            'hello' => 'world',
        );

        $db_values = get_option( 'ht_ctc_main_options', array() );
        $update_values = array_merge($values, $db_values);
        update_option('ht_ctc_main_options', $update_values);

    }




    /**
     * table name: "ht_ctc_chat_options"
     * 
     * Chat options, main page .. some feature enable options .. 
     * 
     * checkboxes .. 
     *  hide/show options .. 
     *  
     *  webandapi  if checked ? web/api.whatsapp(mobile,desktop) : wa.me
     * 
     */
    public function ht_ctc_chat_options() {
        
        $values = array(
            'number' => '',
            'pre_filled' => '',
            'call_to_action' => 'WhatsApp us',
            'style_desktop' => '2',
            'style_mobile' => '2',

            'side_1' => 'bottom',
            'side_1_value' => '10px',
            'side_2' => 'right',
            'side_2_value' => '10px',

            'show_or_hide' => 'hide',
            'list_hideon_pages' => '',
            'list_hideon_cat' => '',
            'list_showon_pages' => '',
            'list_showon_cat' => '',

        );

        $options = get_option('ht_ctc_chat_options');
        // mobile position if not set
        if ( !isset($options['mobile_side_1_value']) && !isset($options['mobile_side_2_value'])  ) {
            $mobile_values = array(
                'mobile_side_1' => ( isset( $options['side_1']) ) ? esc_attr( $options['side_1'] ) : 'bottom',
                'mobile_side_1_value' => ( isset( $options['side_1_value'])) ? esc_attr( $options['side_1_value'] ) : '10px',
                'mobile_side_2' => ( isset( $options['side_2']) ) ? esc_attr( $options['side_2'] ) : 'right',
                'mobile_side_2_value' => ( isset( $options['side_2_value'])) ? esc_attr( $options['side_2_value'] ) : '10px',
            );
            $values = array_merge($values, $mobile_values);
        }
        

        $db_values = get_option( 'ht_ctc_chat_options', array() );
        $update_values = array_merge($values, $db_values);
        update_option('ht_ctc_chat_options', $update_values);

    }

    


    /**
     * table name: "ht_ctc_group"
     * 
     * Group chat
     */
    public function ht_ctc_group() {

        $values = array(

            'group_id' => '',
            'call_to_action' => 'WhatsApp Group',
            
            'style_desktop' => '4',
            'style_mobile' => '2',

            'side_1' => 'bottom',
            'side_1_value' => '10px',
            'side_2' => 'left',
            'side_2_value' => '10px',

            'show_or_hide' => 'hide',
            'list_hideon_pages' => '',
            'list_hideon_cat' => '',
            'list_showon_pages' => '',
            'list_showon_cat' => '',

        );

        $options = get_option('ht_ctc_group');
        // mobile position if not set
        if ( !isset($options['mobile_side_1_value']) && !isset($options['mobile_side_2_value'])  ) {
            $mobile_values = array(
                'mobile_side_1' => ( isset( $options['side_1']) ) ? esc_attr( $options['side_1'] ) : 'bottom',
                'mobile_side_1_value' => ( isset( $options['side_1_value'])) ? esc_attr( $options['side_1_value'] ) : '10px',
                'mobile_side_2' => ( isset( $options['side_2']) ) ? esc_attr( $options['side_2'] ) : 'left',
                'mobile_side_2_value' => ( isset( $options['side_2_value'])) ? esc_attr( $options['side_2_value'] ) : '10px',
            );
            $values = array_merge($values, $mobile_values);
        }


        $db_values = get_option( 'ht_ctc_group', array() );
        $update_values = array_merge($values, $db_values);
        update_option('ht_ctc_group', $update_values);
    }


    
    /**
     * table name: "ht_ctc_share"
     * 
     * share chat
     * 
     * checkboxes
     *  webandapi
     *  show/hide ..
     */
    public function ht_ctc_share() {

        $values = array(

            'share_text' => 'Checkout this Awesome page {{url}}',
            'call_to_action' => 'WhatsApp Share',
            
            'style_desktop' => '1',
            'style_mobile' => '2',

            'side_1' => 'top',
            'side_1_value' => '10px',
            'side_2' => 'right',
            'side_2_value' => '10px',

            'show_or_hide' => 'hide',
            'list_hideon_pages' => '',
            'list_hideon_cat' => '',
            'list_showon_pages' => '',
            'list_showon_cat' => '',
        );

        $options = get_option('ht_ctc_share');
        // mobile position if not set
        if ( !isset($options['mobile_side_1_value']) && !isset($options['mobile_side_2_value'])  ) {
            $mobile_values = array(
                'mobile_side_1' => ( isset( $options['side_1']) ) ? esc_attr( $options['side_1'] ) : 'top',
                'mobile_side_1_value' => ( isset( $options['side_1_value'])) ? esc_attr( $options['side_1_value'] ) : '10px',
                'mobile_side_2' => ( isset( $options['side_2']) ) ? esc_attr( $options['side_2'] ) : 'right',
                'mobile_side_2_value' => ( isset( $options['side_2_value'])) ? esc_attr( $options['side_2_value'] ) : '10px',
            );
            $values = array_merge($values, $mobile_values);
        }

        $db_values = get_option( 'ht_ctc_share', array() );
        $update_values = array_merge($values, $db_values);
        update_option('ht_ctc_share', $update_values);
    }



    /**
     * name: ht_ctc_plugin_details
     * 
     * don't preseve already existing values
     *  Always use update_option - override new values .. 
     * 
     * Add plugin Details to db 
     * Add plugin version to db - useful while updating plugin
     */
    public function ht_ctc_plugin_details() {

        // plugin details 
        $values = array(
            'version' => HT_CTC_VERSION,
        );

        // Always use update_option - override new values .. don't preseve already existing values
        update_option( 'ht_ctc_plugin_details', $values );
    }


    /**
     * name: ht_ctc_one_time 
     * 
     * ***** caution ***** 
     * when using this values always check if exists.. 
     *  as some new values may add in other versions.. 
     *  and thoose values may not exists if this option is added before 
     *  ( it add_option not update_option )
     * 
     * dont update values. .. one time values .. 
     * 
     * first_version - first version installed
     * 
     * Add plugin Details to db 
     * Add plugin version to db - useful while updating plugin
     */
    public function ht_ctc_one_time() {

        // plugin details 
        $values = array(
            'first_version' => HT_CTC_VERSION,
        );

        // dont update values. .. one time values .. 
        add_option( 'ht_ctc_one_time', $values );
    }


    /**
     * name: ht_ctc_switch 
     * 
     * interface - option - 1 new interface, 2 previous interface
     *                      'yes'           'no'
     * 
     */
    public function ht_ctc_switch() {

        $interface = 'yes';

        $values = array(
            'interface' => $interface,
        );


        $db_values = get_option( 'ht_ctc_switch', array() );
        $update_values = array_merge($values, $db_values);
        update_option('ht_ctc_switch', $update_values);

    }







// styles



/**
 * name: ht_ctc_s1
 * 
 * Style-1  
 * style-1 is default button, nothing to modify.. 
 */
// public function ht_ctc_s1() {
    
//     $style_1 = array(

//         's1_img' => '',
        
//     );

//     $db_values = get_option( 'ht_ctc_s1', array() );
//     $update_values = array_merge($style_1, $db_values);
//     update_option('ht_ctc_s1', $update_values);

// }






/**
 * name: ht_ctc_s2
 * 
 * Style-2
 * green square icon
 */
public function ht_ctc_s2() {
    
    $style_2 = array(
        
        's2_img_size' => '50px',
        
    );

    $db_values = get_option( 'ht_ctc_s2', array() );
    $update_values = array_merge($style_2, $db_values);
    update_option('ht_ctc_s2', $update_values);

}


/**
 * name: ht_ctc_s3
 * 
 * s3_type - simple / extend
 *  simple - only image size setting.
 * 
 * Style-3
 * icon
 */
public function ht_ctc_s3() {
    
    $style_3 = array(

        's3_bg_color' => '#25D366',
        's3_bg_color_hover' => '#25D366',
        
    );

    // =v2.11+ -> s3_type - extend, img size 40px else 50px
    $options = get_option('ht_ctc_s3');
    if ( isset ( $options['s3_img_size'] ) &&  !isset ( $options['s3_type'] ) ) {
        $style_3['s3_img_size'] = '50px';
        $style_3['s3_type'] = 'simple';
        $style_3['s3_padding'] = '20px';
    } else {
        $style_3['s3_img_size'] = '40px';
        $style_3['s3_type'] = 'extend';
        $style_3['s3_padding'] = '16px';
    }

    $db_values = get_option( 'ht_ctc_s3', array() );
    $update_values = array_merge($style_3, $db_values);
    update_option('ht_ctc_s3', $update_values);

}



/**
 * name: ht_ctc_s4
 * 
 * Style-4
 * chip
 */
public function ht_ctc_s4() {

    $style_4 = array(

        's4_text_color' => '#7f7d7d',
        's4_bg_color' => '#e4e4e4',
        's4_img_url' => '',
        's4_img_position' => 'left',
        's4_img_size' => '32px',
    );

    $db_values = get_option( 'ht_ctc_s4', array() );
    $update_values = array_merge($style_4, $db_values);
    update_option('ht_ctc_s4', $update_values);

}



/**
 * name: ht_ctc_s5
 * 
 * Style-5
 * chip
 */
public function ht_ctc_s5() {
    
    $style_5 = array(

        's5_line_1' => '',
        's5_line_2' => 'We will respond as soon as possible',
        's5_line_1_color' => '#000000',
        's5_line_2_color' => '#000000',
        's5_background_color' => '#ffffff',
        's5_border_color' => '#dddddd',
        's5_img' => '',
        's5_img_height' => '70px',
        's5_img_width' => '70px',
        's5_content_height' => '70px',
        's5_content_width' => '270px',
        's5_img_position' => 'right',  // left means nothing - right means - order: 1
        
    );

    $db_values = get_option( 'ht_ctc_s5', array() );
    $update_values = array_merge($style_5, $db_values);
    update_option('ht_ctc_s5', $update_values);

}


/**
 * name: ht_ctc_s6
 * 
 * Style-6
 * 
 * #006ccc
 * #0073aa
 * #005177
 */
public function ht_ctc_s6() {
    
    $style_6 = array(

        's6_txt_color' => '',
        's6_txt_color_on_hover' => '',
        's6_txt_decoration' => '',
        's6_txt_decoration_on_hover' => '',
        
    );

    $db_values = get_option( 'ht_ctc_s6', array() );
    $update_values = array_merge($style_6, $db_values);
    update_option('ht_ctc_s6', $update_values);

}


/**
 * name: ht_ctc_s7
 * 
 * Style-7
 * 
 * border is padding
 * 's7_icon_color_hover' => '#6b6b6b', #262626, #455a64
 */
public function ht_ctc_s7() {
    
    $style_7 = array(

        's7_icon_size' => '28px',
        's7_icon_color' => '#ffffff',
        's7_icon_color_hover' => '#455a64',
        's7_border_size' => '12px',
        's7_border_color' => '#25D366',
        's7_border_color_hover' => '#25D366',
        's7_border_radius' => '50%',
        
    );

    $db_values = get_option( 'ht_ctc_s7', array() );
    $update_values = array_merge($style_7, $db_values);
    update_option('ht_ctc_s7', $update_values);

}



/**
 * name: ht_ctc_s8
 * 
 * Style-8
 */
public function ht_ctc_s8() {
    
    $style_8 = array(

        's8_txt_color' => '#ffffff',
        's8_txt_color_on_hover' => '#ffffff',
        's8_bg_color' => '#26a69a',
        's8_bg_color_on_hover' => '#26a69a',
        's8_icon_color' => '#ffffff',
        's8_icon_color_on_hover' => '#ffffff',
        's8_icon_position' => 'left',
        's8_text_size' => '',
        's8_icon_size' => '',
        's8_btn_size' => 'btn',
        
    );

    $db_values = get_option( 'ht_ctc_s8', array() );
    $update_values = array_merge($style_8, $db_values);
    update_option('ht_ctc_s8', $update_values);

}


/**
 * name: ht_ctc_s99
 * 
 * Style-99
 */
public function ht_ctc_s99() {
    
    $style_99 = array(

        's99_dekstop_img_url' => '',
        's99_mobile_img_url' => '',
        's99_desktop_img_height' => '50px',
        's99_desktop_img_width' => '',
        's99_mobile_img_height' => '50px',
        's99_mobile_img_width' => '',
        
    );

    $db_values = get_option( 'ht_ctc_s99', array() );
    $update_values = array_merge($style_99, $db_values);
    update_option('ht_ctc_s99', $update_values);

}








}

new HT_CTC_DB();

endif; // END class_exists check