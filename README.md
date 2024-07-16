#quick featured image
This PHP code adds a custom column to the WordPress admin posts and pages list, allowing users to manage the featured images directly from the list view. It includes functionality for adding, changing, and removing featured images using AJAX.

Key Components
- Function: qfi_show_thumb_manage_pic_column()
-- Renders the content for the custom column (img) in the posts and pages list.
-- Displays the current featured image or a message if no image is set.
-- Provides links to change or remove the featured image.
- Function: qfi_show_thumb_add_pic_column()
-- Adds a new column labeled "Featured Image" to the posts and pages list.
- Function: qfi_add_custom_columns_filters()
-- Adds filters to display the custom column for specified post types (post and page).
-- Hooks the column rendering and column addition functions to the appropriate filters.
- Function: qfi_enqueue_media_scripts()
-- Enqueues necessary media scripts and a custom JavaScript file for handling AJAX requests.
-- Localizes the script to pass the AJAX URL and nonce for security.
- AJAX Call: qfi_set_featured_image_callback()
-- Handles the AJAX request to set the featured image for a post.
-- Checks for valid nonce and retrieves the post ID and attachment URL from the request.
-- Sets the post thumbnail and returns a success or error message.
-AJAX Call: qfi_remove_featured_image_callback()
--Handles the AJAX request to remove the featured image from a post.
--Checks for valid nonce and retrieves the post ID from the request.
--Deletes the post thumbnail and returns a success or error message.

How It Works
- Custom Column Creation:
-- The qfi_show_thumb_add_pic_column() function adds a new column titled "Featured Image" to the posts and pages list view.
-- The qfi_show_thumb_manage_pic_column() function generates the content for this column, displaying the current featured image and providing links for managing the image.
- Admin Filters:
-- The qfi_add_custom_columns_filters() function adds the necessary filters to display and manage the custom column for posts and pages.
- Media Scripts:
-- The qfi_enqueue_media_scripts() function enqueues WordPress media scripts and a custom JavaScript file, which handles the AJAX requests for setting and removing featured images.
- AJAX Handlers:
-- The qfi_set_featured_image_callback() and qfi_remove_featured_image_callback() functions handle AJAX requests to set and remove the featured images, respectively. These functions ensure security by verifying the nonce and return appropriate success or error messages based on the outcome.
