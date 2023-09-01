<?php 

// Let WordPress manage the document title

add_theme_support('title-tag');



// Enable support for Post Thumbnails on posts and pages

add_theme_support('post-thumbnails');



// remove emojis

function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
}
add_action( 'init', 'disable_emojis' );



// remove child theme's style.css file which is used to register the theme

add_action( 'wp_enqueue_scripts', 'remove_parent_style', 999999 );
function remove_parent_style() {
    wp_dequeue_style( 'stylesheet' );
    wp_deregister_style( 'stylesheet' );
}



// remove css

function remove_css(){
    // remove wp-block-library css file
	wp_dequeue_style( 'wp-block-library' );
    // remove classic-theme-styles css file
	wp_dequeue_style( 'classic-theme-styles' );
    // remove global styles inline css
	wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'remove_css', 100 );   



// remove generator meta tag

function remove_wp_version() {
    return '';
}
add_filter('the_generator', 'remove_wp_version');



// remove comment-reply js

function comment_dequeue_script() {
	wp_dequeue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'comment_dequeue_script', 100 );   



// remove https://api.w.org Link http header

remove_action( 'wp_head', 'rest_output_link_wp_head', 10);    
remove_action( 'template_redirect', 'rest_output_link_header', 11);



// remove loads of link tags such as wlwmanifest, oembed, canonical, shortlink, xml feed

function remove_api () {
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10 );
	remove_action( 'template_redirect', 'wp_shortlink_header', 11);

    remove_action( 'wp_head', 'feed_links_extra', 3 );
    remove_action( 'wp_head', 'feed_links');
}
add_action( 'after_setup_theme', 'remove_api' );



// remove max-image-preview:large

remove_filter('wp_robots', 'wp_robots_max_image_preview_large');



// remove canonical tag

remove_action('wp_head', 'rel_canonical');