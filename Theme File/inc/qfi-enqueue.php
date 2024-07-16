<?php

function qfi_enqueue_media_scripts()
{
    wp_enqueue_media();
    wp_enqueue_script('qfi-media-script', get_stylesheet_directory_uri() . '/assets/js/qfi-media.js', array('jquery'), null, true);

    // Localize script to pass AJAX URL and nonce
    wp_localize_script('qfi-media-script', 'qfi_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('qfi_set_featured_image_nonce'),
    ));
}

add_action('admin_enqueue_scripts', 'qfi_enqueue_media_scripts');
