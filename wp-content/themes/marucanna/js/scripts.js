/*! css 1.0.0 filename.js 2024-01-01 3:04:36 PM */

Dropzone.autoDiscover = false;

jQuery(document).ready(function($) {
    our_team_slider();
    sticky_header();
    menu_dropdown();
    mc_datepicker();
    mc_dropZones();
});

function mc_datepicker() {
    jQuery(".mc-datepicker").datepicker({
        format: "dd/mm/yy"
    });
}

function mc_dropZones() {
    jQuery("#csrFile").dropzone({
        url: CUSTOM_PARAMS.ajaxUrl + "?action=mc_handle_file_upload",
        acceptedFiles: "application/pdf,.jpeg",
        uploadMultiple: false,
        maxFilesize: 2,
        maxFiles: 1,
        dictDefaultMessage: "Drop your files here or click to upload",
        success: function(file, response) {
            file.previewElement.classList.add("dz-success");
            file["attachment_id"] = response;
            jQuery("#csr_file").val(response);
        },
        error: function(file, response) {
            file.previewElement.classList.add("dz-error");
        },
        addRemoveLinks: true,
        removedfile: function(file) {
            var attachment_id = file.attachment_id;
            var addedValue = jQuery("#csr_file").val();
            if (addedValue === attachment_id) {
                jQuery("#csr_file").val("");
            }
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        init: function() {
            this.on("error", function(file, errorMessage) {
                if (errorMessage) {}
            });
            this.on("maxfilesexceeded", function(file) {
                alert("You can not upload any more files.", "error");
            });
        }
    });
    jQuery("#photoId").dropzone({
        url: CUSTOM_PARAMS.ajaxUrl + "?action=mc_handle_file_upload",
        acceptedFiles: "application/pdf,.jpeg",
        uploadMultiple: false,
        maxFilesize: 2,
        maxFiles: 1,
        dictDefaultMessage: "Drop your files here or click to upload",
        success: function(file, response) {
            file.previewElement.classList.add("dz-success");
            file["attachment_id"] = response;
            jQuery("#photo_id").val(response);
        },
        error: function(file, response) {
            file.previewElement.classList.add("dz-error");
        },
        addRemoveLinks: true,
        removedfile: function(file) {
            var attachment_id = file.attachment_id;
            var addedValue = jQuery("#photo_id").val();
            if (addedValue === attachment_id) {
                jQuery("#photo_id").val("");
            }
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        init: function() {
            this.on("error", function(file, errorMessage) {
                if (errorMessage) {}
            });
            this.on("maxfilesexceeded", function(file) {
                alert("You can not upload any more files.", "error");
            });
        }
    });
}

function sticky_header() {
    jQuery(window).scroll(function() {
        var scrollPosition = jQuery(this).scrollTop();
        if (scrollPosition >= 510) {
            jQuery("body").addClass("sticky-header");
        } else {
            jQuery("body").removeClass("sticky-header");
        }
    });
}

function menu_dropdown() {
    jQuery(".nav-item.dropdown").hover(function() {
        jQuery(this).find(".dropdown-menu").addClass("show");
    }, function() {
        jQuery(this).find(".dropdown-menu").removeClass("show");
    });
    jQuery(".nav-item.dropdown .dropdown-toggle").on("click", function() {
        var link = jQuery(this).attr("href");
        window.location.href = link;
    });
}

function our_team_slider() {
    jQuery(".team_slider").slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        arrow: true,
        responsive: [ {
            breakpoint: 600,
            settings: {
                slidesToShow: 2
            }
        }, {
            breakpoint: 480,
            settings: {
                slidesToShow: 1
            }
        } ]
    });
}