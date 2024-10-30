<?php 
add_action('init', 'mp_profit_services_register');  
   
function mp_profit_services_register() {  
    $args = array(  
        'label' => __('Services','mp-profit'),  
        'singular_label' => __('Services','mp-profit'),  
        'public' => true,  
        'show_ui' => true,  
        'capability_type' => 'post',  
        'hierarchical' => false,  
        'rewrite' => true,  
        'supports' => array('title', 'editor', 'thumbnail')  
       );  
   
    register_post_type( 'services' , $args );  
}