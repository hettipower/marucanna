function select_gp_postalcode() {

    if( jQuery('body').hasClass('page-template-page-appointment-booking') ) {
        jQuery("#input_1_121").on('change', function(){
            var selectedValues = jQuery(this).val();
            
            var lists = jQuery.grep(CUSTOM_PARAMS.gpLists, function(item) {
                return item.postal_code === selectedValues;
            });

            create_gp_lists(lists);
        })
    }

}

function create_gp_lists(lists) {

    var listDiv = document.getElementById("gp_list_wrap");
    var gpListModalEle = document.getElementById('gpListModal');
    var gpListModal = new bootstrap.Modal(gpListModalEle);
    var item;

    listDiv.innerHTML = '';

    for (i = 0; i < lists.length; i++) {

        item = document.createElement("DIV");
        item.setAttribute("data-id", lists[i].ID);
        item.setAttribute("class", 'item');
        item.innerHTML += "<p>"+lists[i].practice_name+"</p>";
        item.innerHTML += "<p>"+lists[i].address_line1+"</p>";
        item.innerHTML += "<p>"+lists[i].address_line2+"</p>";
        item.innerHTML += "<p>"+lists[i].address_line3+"</p>";
        item.innerHTML += "<p>"+lists[i].address_line4+"</p>";
        item.innerHTML += "<p>"+lists[i].town+"</p>";
        item.innerHTML += "<p>"+lists[i].phone+"</p>";
        item.innerHTML += "<p>"+lists[i].postal_code+"</p>";
        item.innerHTML += "<input type='hidden' value='" + lists[i].ID + "'>";

        item.addEventListener("click", function(e) {

            var clickedVal = parseInt(this.getElementsByTagName("input")[0].value);
            var selectedGP = jQuery.grep(CUSTOM_PARAMS.gpLists, function(item) {
                return item.ID === clickedVal;
            });

            jQuery('#input_1_103').val(selectedGP[0].practice_name);
            jQuery('#input_1_104_1').val(selectedGP[0].address_line1+ ' ' +selectedGP[0].address_line2);
            jQuery('#input_1_104_2').val(selectedGP[0].address_line3+ ' ' +selectedGP[0].address_line4);
            jQuery('#input_1_105').val(selectedGP[0].town);
            jQuery('#input_1_109').val(selectedGP[0].phone);

            gpListModal.hide();
        });

        listDiv.appendChild(item);
    }
    
    gpListModal.show();
}