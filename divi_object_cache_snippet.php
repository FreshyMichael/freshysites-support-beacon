<?php 

function divi_static_css_404_override (){

global $advanced_post_cache_object;
if ( is_object($advanced_post_cache_object->is_404) ) {
    $advanced_post_cache_object->flush_cache();
}

  if (     )
}
