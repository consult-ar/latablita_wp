<?php
/**
 * position to place
 * @included from - class-ht-ctc-chat/group/share.php
 */


// later fixed / absolute
$position_type = 'fixed';
$position_type_mobile = 'fixed';

// Dekstop position
$side_1 = esc_attr( $options['side_1'] );
$side_1_value = esc_attr( $options['side_1_value'] );
$side_2 = esc_attr( $options['side_2'] );
$side_2_value = esc_attr( $options['side_2_value'] );

$position = "position: $position_type; $side_1: $side_1_value; $side_2: $side_2_value;";

// Mobile position
$mobile_side_1 = ( isset( $options['mobile_side_1']) ) ? esc_attr( $options['mobile_side_1'] ) : '';
$mobile_side_1_value = ( isset( $options['mobile_side_1_value'])) ? esc_attr( $options['mobile_side_1_value'] ) : '';
$mobile_side_2 = ( isset( $options['mobile_side_2']) ) ? esc_attr( $options['mobile_side_2'] ) : '';
$mobile_side_2_value = ( isset( $options['mobile_side_2_value'])) ? esc_attr( $options['mobile_side_2_value'] ) : '';

$position_mobile = "position: $position_type_mobile; $mobile_side_1: $mobile_side_1_value; $mobile_side_2: $mobile_side_2_value;";

// incase mobile position is null; - safeside can remove this later as db is handling the updates
if ( '' == $mobile_side_1_value && '' == $mobile_side_2_value ) {
    $position_mobile = $position;
}