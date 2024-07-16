jQuery(document).ready(function ($) {
  function selectMedia(button) {
    var custom_uploader = wp.media({
      title: "Choose Image",
      button: {
        text: "Choose Image",
      },
      multiple: false, // Allow only single file selection
    });

    custom_uploader.on("select", function () {
      var attachment = custom_uploader
        .state()
        .get("selection")
        .first()
        .toJSON();

      // AJAX request to set the selected image as featured image
      var data = {
        action: "qfi_set_featured_image",
        post_id: $(button).data("post-id"),
        attachment_url: attachment.url,
        security: qfi_ajax_object.nonce,
      };

      $.post(qfi_ajax_object.ajax_url, data, function (response) {
        if (response === "success") {
          var imgElement = $(button)
            .closest(".qfi-featured-image-box")
            .find(".qfi-featured-image img");
          if (imgElement.length > 0) {
            imgElement.fadeOut(300, function () {
              imgElement.attr("src", attachment.url).fadeIn(300);
            });
          } else {
            var imageBox = $(button)
              .closest(".qfi-featured-image-box")
              .find(".qfi-featured-image");
            imageBox.find("p").fadeOut(300, function () {
              $(this).replaceWith(
                '<img width="150" height="150" src="' +
                  attachment.url +
                  '" class="attachment-thumbnail size-thumbnail wp-post-image" alt="' +
                  attachment.alt +
                  '" decoding="async" />'
              );
              imageBox.find("img").hide().fadeIn(300);
            });

            // Update button controls
            var controls = $(button).closest(".qfi-featured-image-controls");
            controls.html(
              '<a href="#" class="change-featured-image-button" data-post-id="' +
                data.post_id +
                '">Change Image</a>' +
                '<a href="#" class="remove-featured-image-button" data-post-id="' +
                data.post_id +
                '">Remove Image</a>'
            );
          }
        } else {
          console.log("Error updating image");
        }
      });

      custom_uploader.close();
    });

    custom_uploader.open();
  }

  function removeImage(button) {
    var data = {
      action: "qfi_remove_featured_image",
      post_id: $(button).data("post-id"),
      security: qfi_ajax_object.nonce,
    };

    $.post(qfi_ajax_object.ajax_url, data, function (response) {
      if (response === "success") {
        var imageBox = $(button)
          .closest(".qfi-featured-image-box")
          .find(".qfi-featured-image");
        imageBox.find("img").fadeOut(300, function () {
          $(this).replaceWith("<p>No Featured Image Set</p>").fadeIn(300);
        });

        // Update button controls
        var controls = $(button).closest(".qfi-featured-image-controls");
        controls.html(
          '<a href="#" class="choose-featured-image-button" data-post-id="' +
            data.post_id +
            '">Choose Image</a>'
        );
      } else {
        console.log("Error removing image");
      }
    });
  }

  $(document).on(
    "click",
    ".change-featured-image-button, .choose-featured-image-button",
    function (e) {
      e.preventDefault();
      selectMedia(this);
    }
  );

  $(document).on("click", ".remove-featured-image-button", function (e) {
    e.preventDefault();
    removeImage(this);
  });
});
