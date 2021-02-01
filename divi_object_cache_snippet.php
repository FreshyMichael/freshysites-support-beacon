<?php 
add_action('after_setup_theme','divi_static_css_404_override');

function divi_static_css_404_override (){

global $advanced_post_cache_object;
if ( is_object($advanced_post_cache_object->is_404) ) {
    $advanced_post_cache_object->flush_cache();
}

}
