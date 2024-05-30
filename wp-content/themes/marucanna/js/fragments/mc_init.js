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