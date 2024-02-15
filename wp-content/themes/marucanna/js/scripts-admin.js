jQuery(document).ready(function ($) {

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "button action btn-success",
            cancelButton: "button action btn-danger"
        },
        buttonsStyling: false
    });
    
    $('.delete_patinet > a').on('click' , function(e){
  
        var patient = $(this).data('patient');
    
        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                var data = {
                    action: 'mc_patient_delete_action',
                    patient: patient
                };
        
                // Perform the AJAX request
                $.post(MC_ADMIN_PARAMS.ajaxUrl, data, function(response) {
                    // Parse the JSON response
                    var jsonResponse = JSON.parse(response);
                    
                    if( jsonResponse.status ) {
                        swalWithBootstrapButtons.fire({
                            title: "Deleted!",
                            text: jsonResponse.msg,
                            icon: "success"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload(true);
                            }
                        });
                    } else {
                        swalWithBootstrapButtons.fire({
                            title: "Error!",
                            text: jsonResponse.msg,
                            icon: "error"
                        });
                    }

                });
                
            } else if ( result.dismiss === Swal.DismissReason.cancel ) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Patient file is safe :)",
                    icon: "error"
                });
            }
        });
  
  
      return false;
    });
  
});