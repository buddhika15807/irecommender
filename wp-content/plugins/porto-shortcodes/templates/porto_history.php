<?php
$output = $image_url = $image = $year = $history = $animation_type = $animation_duration = $animation_delay = $el_class = '';
extract(shortcode_atts(array(
    'image_url' => '',
    'image' => '',
    'year' => '',
    'history' => '',
    'animation_type' => '',
    'animation_duration' => '',
    'animation_delay' => '',
    'el_class' => ''
), $atts));

$el_class = porto_shortcode_extract_class( $el_class );

if ($animation_type)
    $el_class .= ' appear-animation';

$output = '<div class="porto-history wpb_content_element '. $el_class . '"';
if ($animation_type)
    $output .= ' data-appear-animation="'.$animation_type.'"';
if ($animation_delay)
    $output .= ' data-appear-animation-delay="'.$animation_delay.'"';
if ($animation_duration && $animation_duration != 1000)
    $output .= ' data-appear-animation-duration="'.$animation_duration.'"';
$output .= '>';

if (!$image_url && $image) {
    $img_id = preg_replace('/[^\d]/', '', $image);
    $img = porto_shortcode_get_image_by_size(array( 'attach_id' => $img_id, 'thumb_size' => '145x145' ));
    if ($img) {
        $output .= '<div class="thumb">' . $img['thumbnail'] . '</div>';
    }
} else if ($image_url) {
    $image_url = str_replace(array('http:', 'https:'), '', $image_url);
    $output .= '<div class="thumb"><img alt="' . $year . '" src="' . esc_url($image_url) . '"></div>';
}

$output .= '<div class="featured-box"><div class="box-content">';
if ($year) {
    $output .= '<h4 class="heading-primary"><strong>' . $year . '</strong></h4>';
}
$output .= porto_shortcode_js_remove_wpautop($content != '' ? $content : $history, true);
$output .= '</div></div>';
$output .= '</div>' . porto_shortcode_end_block_comment( 'porto_history' );

echo $output;