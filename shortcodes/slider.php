<?php
/**
 * Theme Kidimat
 *
 * Shortcode for slider theme Kidimat
 *
 * @package WordPress
 * @subpackage Kidimat Themes
 * @author WAP <contact@webagenceparis.com>
 *
 */


function shortcode_slider($atts){
    extract(shortcode_atts(
        array(
            'img1' => '',
            'img2' => '',
            'img3' => ''
    ), $atts));

    $slider = '<div class="homepage-slider">' . 
                '<div class="card-img"><img src="' . $img1 . '" alt="" class="img-slider mx-auto"></div>' . 
                '<div class="card-img"><img src="' . $img2 . '" alt="" class="img-slider mx-auto"></div>' . 
                '<div class="card-img"><img src="' . $img3 . '" alt="" class="img-slider mx-auto"></div>' . 
            '</div>';
    return $slider;
}
add_shortcode('slider', 'shortcode_slider');
   

?>