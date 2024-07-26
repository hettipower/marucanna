if( jQuery('body').hasClass('author') || jQuery('body').hasClass('page-template-page-patient-dashboard') ) {
  Fancybox.bind("[data-fancybox]", {
    
  });
}

jQuery(document).ready(function ($) {
  our_team_slider();
  sticky_header();
  menu_dropdown();
	patients_datatable();
  mobile_menu();
  
  if( $('body').hasClass('page-template-page-appointment-booking') && CUSTOM_PARAMS.gpPostalCodes ) {
    autocomplete(document.getElementById("input_1_106"), CUSTOM_PARAMS.gpPostalCodes);
  }
});

function patients_datatable() {
  if( jQuery('body').hasClass('page-template-page-doctor-dashboard') ) {
    new DataTable('#patients_details' , {
      "language": {
        "emptyTable": "No patients available."
      }
    });
  }
}