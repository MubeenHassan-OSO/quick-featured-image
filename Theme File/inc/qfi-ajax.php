<?php

// ! Code for AJAX call for Setting Featured Image
add_action('wp_ajax_qfi_set_featured_image', 'qfi_set_featured_image_callback');
function qfi_set_featured_image_callback()
{
    check_ajax_referer('qfi_set_featured_image_nonce', 'security');

    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $attachment_url = isset($_POST['attachment_url']) ? esc_url($_POST['attachment_url']) : '';

    // Set the post thumbnail (featured image)
    $attachment_id = attachment_url_to_postid($attachment_url);
    if ($attachment_id && $post_id) {
        set_post_thumbnail($post_id, $attachment_id);
        echo 'success'; // Echo success on successful update
    } else {
        echo 'error'; // Echo error if something went wrong
    }

    wp_die();
}

// ! Code for AJAX call for Removing Featured Image
add_action('wp_ajax_qfi_remove_featured_image', 'qfi_remove_featured_image_callback');
function qfi_remove_featured_image_callback()
{
    check_ajax_referer('qfi_set_featured_image_nonce', 'security');

    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;

    // Remove the post thumbnail (featured image)
    if ($post_id && delete_post_thumbnail($post_id)) {
        echo 'success'; // Echo success on successful update
    } else {
        echo 'error'; // Echo error if something went wrong
    }

    wp_die();
}
