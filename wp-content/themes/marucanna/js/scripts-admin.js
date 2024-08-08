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

    $('#send_consent').on('click' , function(e){
  
        var patient = $(this).data('patient');
    
        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, send it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                var data = {
                    action: 'sent_consent_form_action',
                    patient: patient
                };
        
                // Perform the AJAX request
                $.post(MC_ADMIN_PARAMS.ajaxUrl, data, function(response) {
                    // Parse the JSON response
                    var jsonResponse = JSON.parse(response);
                    
                    if( jsonResponse.status ) {
                        swalWithBootstrapButtons.fire({
                            title: "Sent!",
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
                /* swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Patient file is safe :)",
                    icon: "error"
                }); */
            }
        });
  
  
      return false;
    });

    $('#send_initial_consult').on('click' , function(e){

        var patient = $(this).data('patient');

        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        })
        .then((result) => {
            if (result.isConfirmed) {

                swalWithBootstrapButtons.fire({
                    title: "Fill Following Details",
                    focusConfirm: false,
                    showConfirmButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'submit',
                    html: '<div class="form-group"><label for="key_symptoms">Key Symptoms</label><input type="text" class="form-control" id="key_symptoms"></div><div class="form-group"><label for="current_diagnosis">Current Diagnosis</label><input type="text" class="form-control" id="current_diagnosis"></div><div class="form-group"><label for="previous_management">Previous Management</label><input type="text" class="form-control" id="previous_management"></div><div class="form-group"><label for="cannabinoid_history">Previous cannabinoid history</label><input type="text" class="form-control" id="cannabinoid_history"></div><div class="form-group"><label for="doctor">Doctor</label><input type="text" class="form-control" id="doctor"></div>',
                    preConfirm: () => {
                        let resultObject = {
                            key_symptoms: document.getElementById('key_symptoms').value,
                            current_diagnosis: document.getElementById('current_diagnosis').value,
                            previous_management: document.getElementById('previous_management').value,
                            cannabinoid_history: document.getElementById('cannabinoid_history').value,
                            doctor: document.getElementById('doctor').value
                        }
                        if (!resultObject.key_symptoms || !resultObject.current_diagnosis || !resultObject.previous_management || !resultObject.cannabinoid_history || !resultObject.doctor) {
                            swalWithBootstrapButtons.fire({
                                title: 'Error',
                                text: "You must complete all the fields to perform this operation.",
                                icon: 'error'
                            })
                            return null
                        }

                        return resultObject
                    },
                }).then((result) => {
                    if (result.isConfirmed && result.value) {

                        var data = {
                            action: 'send_initial_consult_letter_action',
                            patient: patient,
                            cannabinoid_history: result.value.cannabinoid_history,
                            current_diagnosis: result.value.current_diagnosis,
                            doctor: result.value.doctor,
                            key_symptoms: result.value.key_symptoms,
                            previous_management: result.value.previous_management
                        };
        
                        $('#letter-loading').addClass('show');
                
                        $.post(MC_ADMIN_PARAMS.ajaxUrl, data, function(response) {
                            // Parse the JSON response
                            var jsonResponse = JSON.parse(response);
                
                            $('#letter-loading').removeClass('show');
                            
                            if( jsonResponse.status ) {
                                swalWithBootstrapButtons.fire({
                                    title: "Sent!",
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
                    }
                });
                
            } else if ( result.dismiss === Swal.DismissReason.cancel ) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Initial Consult Letter didn't send.",
                    icon: "error"
                });
            }
        });

  
        return false;
    });

    $('#send_after_mdt').on('click' , function(e){
  
        $('#letter-loading').addClass('show');

        var patient = $(this).data('patient');

        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        })
        .then((result) => {
            if (result.isConfirmed) {

                var data = {
                    action: 'send_after_mdt_letter_action',
                    patient: patient
                };
        
                $.post(MC_ADMIN_PARAMS.ajaxUrl, data, function(response) {
                    // Parse the JSON response
                    var jsonResponse = JSON.parse(response);
        
                    $('#letter-loading').removeClass('show');
                    
                    if( jsonResponse.status ) {
                        swalWithBootstrapButtons.fire({
                            title: "Sent!",
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
                    text: "First Letter after MDT didn't send.",
                    icon: "error"
                });
            }
        });
  
        return false;
    });

    $('#send_refusal_following_mdt').on('click' , function(e){

        var patient = $(this).data('patient');

        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        })
        .then((result) => {
            if (result.isConfirmed) {

                swalWithBootstrapButtons.fire({
                    title: "Fill Following Details",
                    focusConfirm: false,
                    showConfirmButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'submit',
                    html: '<div class="form-group"><label for="refusal">Reason for Refusal</label><input type="text" class="form-control" id="refusal"></div><div class="form-group"><label for="doctor">Doctor</label><input type="text" class="form-control" id="doctor"></div>',
                    preConfirm: () => {
                        let resultObject = {
                            refusal: document.getElementById('refusal').value,
                            doctor: document.getElementById('doctor').value
                        }
                        if (!resultObject.key_symptoms || !resultObject.doctor) {
                            swalWithBootstrapButtons.fire({
                                title: 'Error',
                                text: "You must complete all the fields to perform this operation.",
                                icon: 'error'
                            })
                            return null
                        }

                        return resultObject
                    },
                }).then((result) => {
                    if (result.isConfirmed && result.value) {

                        var data = {
                            action: 'send_refusal_following_mdt_letter_action',
                            patient: patient,
                            refusal: result.value.refusal,
                            doctor: result.value.doctor
                        };
        
                        $('#letter-loading').addClass('show');
                
                        $.post(MC_ADMIN_PARAMS.ajaxUrl, data, function(response) {
                            // Parse the JSON response
                            var jsonResponse = JSON.parse(response);
                
                            $('#letter-loading').removeClass('show');
                            
                            if( jsonResponse.status ) {
                                swalWithBootstrapButtons.fire({
                                    title: "Sent!",
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
                    }
                });
                
            } else if ( result.dismiss === Swal.DismissReason.cancel ) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Initial Consult Letter didn't send.",
                    icon: "error"
                });
            }
        });

  
        return false;
    });

    $('#send_follow_up_letter').on('click' , function(e){
  
        $('#letter-loading').addClass('show');

        var patient = $(this).data('patient');
    
        var data = {
            action: 'send_follow_up_letter_action',
            patient: patient
        };

        // Perform the AJAX request
        $.post(MC_ADMIN_PARAMS.ajaxUrl, data, function(response) {
            // Parse the JSON response
            var jsonResponse = JSON.parse(response);

            $('#letter-loading').removeClass('show');
            
            if( jsonResponse.status ) {
                swalWithBootstrapButtons.fire({
                    title: "Sent!",
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
        
  
        return false;
    });

    $('#send_refusal_following_mdt').on('click' , function(e){

        var patient = $(this).data('patient');

        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        })
        .then((result) => {
            if (result.isConfirmed) {

                swalWithBootstrapButtons.fire({
                    title: "Fill Following Details",
                    focusConfirm: false,
                    showConfirmButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'submit',
                    html: '<div class="form-group"><label for="appointment_changes">Details of Changes</label><input type="text" class="form-control" id="appointment_changes"></div><div class="form-group"><label for="doctor">Doctor</label><input type="text" class="form-control" id="doctor"></div>',
                    preConfirm: () => {
                        let resultObject = {
                            appointment_changes: document.getElementById('appointment_changes').value,
                            doctor: document.getElementById('doctor').value
                        }
                        if (!resultObject.key_symptoms || !resultObject.doctor) {
                            swalWithBootstrapButtons.fire({
                                title: 'Error',
                                text: "You must complete all the fields to perform this operation.",
                                icon: 'error'
                            })
                            return null
                        }

                        return resultObject
                    },
                }).then((result) => {
                    if (result.isConfirmed && result.value) {

                        var data = {
                            action: 'send_after_followup_appointment_letter_action',
                            patient: patient,
                            appointment_changes: result.value.appointment_changes,
                            doctor: result.value.doctor
                        };
        
                        $('#letter-loading').addClass('show');
                
                        $.post(MC_ADMIN_PARAMS.ajaxUrl, data, function(response) {
                            // Parse the JSON response
                            var jsonResponse = JSON.parse(response);
                
                            $('#letter-loading').removeClass('show');
                            
                            if( jsonResponse.status ) {
                                swalWithBootstrapButtons.fire({
                                    title: "Sent!",
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
                    }
                });
                
            } else if ( result.dismiss === Swal.DismissReason.cancel ) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Initial Consult Letter didn't send.",
                    icon: "error"
                });
            }
        });

  
        return false;
    });

    $('#send_stopping_after_follow_up').on('click' , function(e){

        var patient = $(this).data('patient');

        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        })
        .then((result) => {
            if (result.isConfirmed) {

                swalWithBootstrapButtons.fire({
                    title: "Fill Following Details",
                    focusConfirm: false,
                    showConfirmButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'submit',
                    html: '<div class="form-group"><label for="discontinuation">Reason for Discontinuation</label><input type="text" class="form-control" id="discontinuation"></div><div class="form-group"><label for="doctor">Doctor</label><input type="text" class="form-control" id="doctor"></div>',
                    preConfirm: () => {
                        let resultObject = {
                            discontinuation: document.getElementById('discontinuation').value,
                            doctor: document.getElementById('doctor').value
                        }
                        if (!resultObject.key_symptoms || !resultObject.doctor) {
                            swalWithBootstrapButtons.fire({
                                title: 'Error',
                                text: "You must complete all the fields to perform this operation.",
                                icon: 'error'
                            })
                            return null
                        }

                        return resultObject
                    },
                }).then((result) => {
                    if (result.isConfirmed && result.value) {

                        var data = {
                            action: 'send_stopping_after_follow_up_action',
                            patient: patient,
                            discontinuation: result.value.discontinuation,
                            doctor: result.value.doctor
                        };
        
                        $('#letter-loading').addClass('show');
                
                        $.post(MC_ADMIN_PARAMS.ajaxUrl, data, function(response) {
                            // Parse the JSON response
                            var jsonResponse = JSON.parse(response);
                
                            $('#letter-loading').removeClass('show');
                            
                            if( jsonResponse.status ) {
                                swalWithBootstrapButtons.fire({
                                    title: "Sent!",
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
                    }
                });
                
            } else if ( result.dismiss === Swal.DismissReason.cancel ) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Initial Consult Letter didn't send.",
                    icon: "error"
                });
            }
        });

  
        return false;
    });
  
});