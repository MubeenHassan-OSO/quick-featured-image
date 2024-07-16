<?php

function qfi_show_thumb_manage_pic_column($column_name, $post_id)
{
    $post_types = array('post', 'page'); // Specify the post types where the column should appear

    // Check if the current post type is not in the allowed list
    if (!in_array(get_post_type($post_id), $post_types)) {
        return $column_name; // Return original column name if not allowed post type
    }

    // Render column content for allowed post types
    if ($column_name == 'img') {
?>
        <div class="qfi-featured-image-box">
            <div class="qfi-featured-image">
                <?php
                if (has_post_thumbnail($post_id)) {
                    echo get_the_post_thumbnail($post_id, 'thumbnail');
                } else {
                    echo '<p>No Featured Image Set</p>';
                }
                ?>
            </div>
            <div class="qfi-featured-image-controls">
                <?php if (has_post_thumbnail($post_id)) { ?>
                    <a href="#" class="change-featured-image-button" data-post-id="<?= $post_id ?>">Change Image</a>
                    <a href="#" class="remove-featured-image-button" data-post-id="<?= $post_id ?>">Remove Image</a>
                <?php } else { ?>
                    <a href="#" class="choose-featured-image-button" data-post-id="<?= $post_id ?>">Choose Image</a>
                <?php } ?>
            </div>
        </div>
<?php
    }

    return $column_name;
}

function qfi_show_thumb_add_pic_column($columns)
{
    $columns['img'] = 'Featured Image';
    return $columns;
}

// Add filters only for specified post types
function qfi_add_custom_columns_filters()
{
    $post_types = array('post', 'page'); // Specify the post types where the column should appear
    foreach ($post_types as $post_type) {
        add_filter("manage_{$post_type}s_columns", 'qfi_show_thumb_add_pic_column');
        add_filter("manage_{$post_type}s_custom_column", 'qfi_show_thumb_manage_pic_column', 10, 2);
    }
}
add_action('admin_init', 'qfi_add_custom_columns_filters');
