<?php

// Porto Price Boxes
add_shortcode('porto_price_boxes', 'porto_shortcode_price_boxes');
add_action('vc_after_init', 'porto_load_price_boxes_shortcode');

function porto_shortcode_price_boxes($atts, $content = null) {
    ob_start();
    if ($template = porto_shortcode_template('porto_price_boxes'))
        include $template;
    return ob_get_clean();
}

function porto_load_price_boxes_shortcode() {
    $animation_type = porto_vc_animation_type();
    $animation_duration = porto_vc_animation_duration();
    $animation_delay = porto_vc_animation_delay();
    $custom_class = porto_vc_custom_class();

    vc_map( array(
        "name" => "Porto " . __("Price Boxes", 'porto-shortcodes'),
        "base" => "porto_price_boxes",
        "category" => __("Porto", 'porto-shortcodes'),
        "icon" => "porto_vc_price_boxes",
        'is_container' => true,
        'weight' => - 50,
        'js_view' => 'VcColumnView',
        "as_parent" => array('only' => 'porto_price_box'),
        "params" => array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'Style', 'porto-shortcodes' ),
                'param_name' => 'style',
                'value' => porto_vc_commons('price_boxes_style')
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Size', 'porto-shortcodes' ),
                'param_name' => 'size',
                'value' => porto_vc_commons('price_boxes_size')
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Counts of Price Box on Desktop', 'porto-shortcodes' ),
                'param_name' => 'count_md',
                'std' => '4',
                'value' => porto_vc_commons('bootstrap_columns')
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Counts of Price Box on Tablet', 'porto-shortcodes' ),
                'param_name' => 'count_sm',
                'std' => '2',
                'value' => porto_vc_commons('bootstrap_columns')
            ),
            array(
                'type' => 'checkbox',
                'heading' => __("Show Border in Price Boxes", 'porto-shortcodes'),
                'param_name' => 'border',
                'std' => 'yes',
                'value' => array( __( 'Yes', 'js_composer' ) => 'yes' )
            ),
            array(
                'type' => 'checkbox',
                'heading' => __("Show Space between Price Boxes", 'porto-shortcodes'),
                'param_name' => 'space',
                'std' => '',
                'value' => array( __( 'Yes', 'js_composer' ) => 'yes' )
            ),
            $animation_type,
            $animation_duration,
            $animation_delay,
            $custom_class
        )
    ) );

    if (!class_exists('WPBakeryShortCode_Porto_Price_Boxes')) {
        class WPBakeryShortCode_Porto_Price_Boxes extends WPBakeryShortCodesContainer {
        }
    }
}