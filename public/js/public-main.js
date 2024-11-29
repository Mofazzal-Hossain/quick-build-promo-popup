document.addEventListener("DOMContentLoaded", function () {
  // select all qbpp ids
  var qbppopups = document.querySelectorAll('[id^="qbpPopupModal-"]');

  qbppopups.forEach(function (popup) {
    var qbppId = popup.id;
    var qbppDisplay = popup.getAttribute("data-display");
    var qbppDataSeconds = popup.getAttribute("data-delay");
    var qbppDataAutoClose = popup.getAttribute("data-close");
    var qbppDataSelector = popup.getAttribute("data-selector");

    var qbppDisplayed = false;
    var qbppModal = new bootstrap.Modal(document.getElementById(qbppId), {
      backdrop: "static",
      keyboard: false,
    });

    var qbppDisplayAfterDelay = qbppDataSeconds * 1000;

    // display on page load
    if (qbppDisplay === "1") {
      setTimeout(() => {
        qbppModal.show();

        // auto close popup
        if (qbppDataAutoClose) {
          var qbppHideDelay = qbppDataAutoClose * 1000;
          setTimeout(() => {
            qbppModal.hide();
          }, qbppHideDelay);
        }
      }, qbppDisplayAfterDelay);
    }

    // display on click
    if (qbppDisplay === "2") {
      document
        .querySelector(qbppDataSelector)
        .addEventListener("click", function (event) {
          event.preventDefault();
          qbppModal.show();

          // auto close popup
          if (qbppDataAutoClose) {
            var qbppHideDelay = qbppDataAutoClose * 1000;
            setTimeout(() => {
              qbppModal.hide();
            }, qbppHideDelay);
          }
        });
    }
    // diplay on exit
    if (qbppDisplay === "3") {
      window.addEventListener("beforeunload", function (event) {
        if (!qbppDisplayed) {
          event.preventDefault();
          qbppModal.show();
          qbppDisplayed = true;
          return "this is a custom message";
        }

        // auto close popup
        if (qbppDataAutoClose) {
          var qbppHideDelay = qbppDataAutoClose * 1000;
          setTimeout(() => {
            qbppModal.hide();
          }, qbppHideDelay);
        }
      });
    }
  });
});

jQuery(document).ready(function () {
  jQuery(".qbpp-modal").each(function () {
    var classes = jQuery(this).attr("class");
    var dimensions = classes.match(/qbpp-custom-(\d+)x(\d+)/);
    if (dimensions) {
      var width = dimensions[1];
      var height = dimensions[2];
      jQuery(".qbpp-modal .qbpp-popup-image").css({
        width: width + "px",
        height: height + "px",
      });
    }
  });
});
