function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {

        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/

        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
                    /*insert the value for the autocomplete text field:*/
                    var selectedVal = this.getElementsByTagName("input")[0].value;
                    inp.value = selectedVal;

                    var lists = jQuery.grep(CUSTOM_PARAMS.gpLists, function(item) {
                        return item.postal_code === selectedVal;
                    });

                    create_gp_lists(lists);

                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });

    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });

    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    function create_gp_lists(lists) {
        var listDiv = document.getElementById("gp_list_wrap");
        var gpListModalEle = document.getElementById('gpListModal');
        var gpListModal = new bootstrap.Modal(gpListModalEle);
        var item;

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

    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}