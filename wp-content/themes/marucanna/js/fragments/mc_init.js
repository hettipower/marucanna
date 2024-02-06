Fancybox.bind("[data-fancybox]", {
	
});

jQuery(document).ready(function ($) {
    our_team_slider();
    sticky_header();
    menu_dropdown();
	patients_datatable();
});

function patients_datatable() {
	new DataTable('#patients_details' , {
        "language": {
          "emptyTable": "No patients available."
        }
    });
}