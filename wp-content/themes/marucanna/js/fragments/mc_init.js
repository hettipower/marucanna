jQuery(document).ready(function ($) {
    our_team_slider();
    sticky_header();
    menu_dropdown();
	patients_datatable();
    //mc_datepicker();
    //mc_dropZones();
});

function patients_datatable() {
	new DataTable('#patients_details');
}

/* function mc_datepicker() {
    jQuery('.mc-datepicker').datepicker({
        format: "dd/mm/yy"
    });
}

function mc_dropZones() {

    jQuery("#csrFile").dropzone({
		url: CUSTOM_PARAMS.ajaxUrl + '?action=mc_handle_file_upload',
		acceptedFiles: 'application/pdf,.jpeg',
		uploadMultiple: false,
		maxFilesize: 2,
		maxFiles: 1,
		dictDefaultMessage: "Drop your files here or click to upload",
		success: function (file, response) {
			file.previewElement.classList.add("dz-success");
			file['attachment_id'] = response; 
			jQuery('#csr_file').val(response);
		},
		error: function (file, response) {
			file.previewElement.classList.add("dz-error");
		},
		// update the following section is for removing image from library
		addRemoveLinks: true,
		removedfile: function(file) {
			var attachment_id = file.attachment_id;     
			var addedValue = jQuery('#csr_file').val(); 

			if( addedValue === attachment_id ) {
				jQuery('#csr_file').val('');
			}

			var _ref;
			return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
		},
		init: function() {

			this.on('error', function(file, errorMessage) {
				if( errorMessage ) {
                    
				}
			});

			this.on("maxfilesexceeded", function (file) {
				alert("You can not upload any more files.", "error");
            });
		}
	});

    jQuery("#photoId").dropzone({
		url: CUSTOM_PARAMS.ajaxUrl + '?action=mc_handle_file_upload',
		acceptedFiles: 'application/pdf,.jpeg',
		uploadMultiple: false,
		maxFilesize: 2,
		maxFiles: 1,
		dictDefaultMessage: "Drop your files here or click to upload",
		success: function (file, response) {
			file.previewElement.classList.add("dz-success");
			file['attachment_id'] = response; 
			jQuery('#photo_id').val(response);
		},
		error: function (file, response) {
			file.previewElement.classList.add("dz-error");
		},
		// update the following section is for removing image from library
		addRemoveLinks: true,
		removedfile: function(file) {
			var attachment_id = file.attachment_id;     
			var addedValue = jQuery('#photo_id').val(); 

			if( addedValue === attachment_id ) {
				jQuery('#photo_id').val('');
			}

			var _ref;
			return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
		},
		init: function() {

			this.on('error', function(file, errorMessage) {
				if( errorMessage ) {
                    
				}
			});

			this.on("maxfilesexceeded", function (file) {
				alert("You can not upload any more files.", "error");
            });
		}
	});

} */