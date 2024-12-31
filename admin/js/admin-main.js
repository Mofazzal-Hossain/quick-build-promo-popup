(function ($) {
  "use strict";
  $(document).ready(function () {
    // Element selectors
    var qbppDisplayDelay = $("#qbppDisplayDelay");
    var qbppElementSelector = $("#qbppElementSelector");

    // Toggle custom content visibility
    $("#qbpp_custom_content_active").click(function () {
      $("#qbppCustomContent").toggle(this.checked);
    });

    // Align popup content
    function setAlignment(selector, target, input) {
      $(selector).on("click", function () {
        var align = $(this).data("align");
        $(selector).removeClass("active");
        $(this).addClass("active");
        $(target).css("text-align", align);
        $(input).val(align);
      });
    }

    setAlignment(
      "#qbppPopupContentHeadingAlign span",
      "#qbp_popup_content_heading",
      "#qbpp_heading_align"
    );
    setAlignment(
      "#qbppPopupContentDescAlign span",
      "#qbp_popup_content_desc",
      "#qbpp_desc_align"
    );

    // Display settings
    $("#qbppDisplay input").on("change", function () {
      var value = $(this).val();
      qbppDisplayDelay.toggle(value == 1);
      qbppElementSelector.toggle(value == 2);
    });

    // Auto-hide popup
    $("#qbp_popup_auto_hide").on("change", function () {
      $("#qbppPopupHideDelay").toggle(this.checked);
    });

    // Popup size
    $("#qbp_popup_size").on("change", function () {
      console.log('working');
      var selectedValue = $(this).val();
      $("#qbppImageAlign").fadeOut();
      var infos = [
        "#qbppFitScreenInfo",
        "#qbppOriginalInfo",
        "#qbppLandscapeInfo",
        "#qbppPortraitInfo",
        "#qbppCustomSize",
      ];

      $(infos.join(", ")).fadeOut(800, function () {
        if (selectedValue === "fit-screen") {
          $("#qbppFitScreenInfo").fadeIn(1000);
        } else if (selectedValue === "original") {
          $("#qbppOriginalInfo").fadeIn(1000);
        } else if (selectedValue === "landscape") {
          $("#qbppLandscapeInfo").fadeIn(1000);
        } else if (selectedValue === "portrait") {
          $("#qbppPortraitInfo").fadeIn(1000);
        } else if (selectedValue === "custom") {
          $("#qbppCustomSize").fadeIn(1000);
        }
      });
    });

    // Copy to clipboard
    $("#qbppCopyButton").click(function () {
      var copyText = $("#qbppPopupShortcode").val();

      if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard
          .writeText(copyText)
          .then(function () {
            showCopyMessage("Copied the shortcode: " + copyText);
          })
          .catch(function (err) {
            console.error("Failed to copy: ", err);
            showCopyMessage("Failed to copy text. Please try again.");
          });
      } else {
        var tempInput = $("<input>").val(copyText).appendTo("body").select();
        try {
          document.execCommand("copy");
          showCopyMessage("Copied the shortcode: " + copyText);
        } catch (err) {
          console.error("Fallback: Oops, unable to copy", err);
          showCopyMessage("Failed to copy text. Please try again.");
        }
        tempInput.remove();
      }
    });

    function showCopyMessage(message) {
      $("#qbppPopupMessage").html(message).fadeIn().delay(4000).fadeOut();
    }
  });
})(jQuery);
