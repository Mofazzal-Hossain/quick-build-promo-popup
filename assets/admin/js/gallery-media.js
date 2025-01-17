(function ($) {
    "use strict";
    $(document).ready(function () {

        function initializeMediaUploader() {
            $("body").off("click", "#qbppAddImage, #qbppEditImage");
            $("body").on("click", "#qbppAddImage, #qbppEditImage", function () {
                var that = this;

                var file_frame = wp.media.frames.file_frame = wp.media({
                    frame: 'post',
                    state: 'insert',
                    multiple: false,
                    title: 'Insert Popup Image', // Set the title here
                    button: {
                        text: 'Insert Popup Image' // Set the button text here
                    }
                });

                file_frame.on('insert', function () {
                    var data = file_frame.state().get('selection').first().toJSON();
                    var selected_id = data.id;
                    var container = $(".qbpp-image-preview");
                    var loader = '<div class="qbpp-loader"></div>';

                    if (selected_id) {
                        $("#qbppAddImage").hide();
                        $("#qbppEditImage, #qbppDeleteImage").show();
                        $("#qbpp-no-image").hide();
                    }

                    $(that).siblings('input').val(selected_id);
                    $(that).siblings('input').trigger('change');
                    container.html(loader);

                    if (data.sizes && data.sizes['medium']) {
                        try {
                            container.html("<img src='" + data.sizes['medium'].url + "' alt='Selected Image' width='250' height='250' />");
                        } catch (e) {
                            console.error("Error appending image: ", e);
                            container.html('');
                        }
                    } else {
                        container.html('');
                    }
                });

                file_frame.on('open', function () {
                    var selection = file_frame.state().get('selection');
                    var attid = $(that).siblings("input").val();
                    if (attid > 0) {
                        selection.add(wp.media.attachment(attid));
                    }
                });

                file_frame.open();
            });

            $("body").on("click", "#qbppDeleteImage", function () {
                $(this).hide();
                $("#qbppEditImage").hide();
                $("#qbppAddImage").show();
                $("#qbpp-no-image").show();
                var container = $(".qbpp-image-preview");
                container.html("");
                $(this).siblings('input').val('');
                $(this).siblings('input').trigger('change');
            });
        }

        function prefetch() {
            $("#qbpp_image_id").each(function () {
                var attid = $(this).val();
                var container = $(".qbpp-image-preview");
                var loader = '<div class="qbpp-loader"></div>';
                container.html(loader);

                if (attid) {
                    $("#qbppAddImage").hide();
                    $("#qbppEditImage, #qbppDeleteImage").show();
                    $("#qbpp-no-image").hide();
                    var attachment = new wp.media.model.Attachment.get(attid);
                    attachment.fetch({
                        success: function (att) {
                            if (att.attributes.sizes && att.attributes.sizes['medium']) {
                                container.html("<img src='" + att.attributes.sizes['medium'].url + "' width='250' height='250' />");
                            } else {
                                container.html('');
                            }
                        },
                        error: function () {
                            container.html('');
                        }
                    });
                } else {
                    $("#qbppAddImage").show();
                    $("#qbppEditImage, #qbppDeleteImage").hide();
                    $("#qbpp-no-image").show();
                    container.html('');
                }
            });
        }

        if (typeof wp !== 'undefined' && wp.media) {
            initializeMediaUploader();
        } else {
            $(document).on('wp.media.loaded', initializeMediaUploader);
        }

        prefetch();
    });
})(jQuery);
