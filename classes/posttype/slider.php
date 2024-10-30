<?php 
add_action('init', 'mp_profit_slider_register');  
   
function mp_profit_slider_register() {  
    $args = array(  
        'label' => __('Slider', 'mp-profit'),  
        'singular_label' => __('Slider', 'mp-profit'),  
        'public' => true,  
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => true,  
        'supports' => array('title', 'thumbnail')  
       );  
   
    register_post_type( 'slider' , $args );  
}