/*! css 1.0.0 filename.js 2024-02-27 2:04:16 AM */

jQuery(document).ready(function($) {
    toggle_mini_cart();
    menu_dropdown();
    jQuery(document.body).on("click", ".mini_cart_item .quantity .plus", function() {
        var productKey = jQuery(this).data("product-key");
        var quantityInput = jQuery(this).closest(".mini_cart_item").find(".quantity input.qty");
        var currentVal = parseFloat(quantityInput.val());
        quantityInput.val(currentVal + 1);
        updateMiniCartQuantity(productKey, currentVal + 1);
    });
    jQuery(document.body).on("click", ".mini_cart_item .quantity .minus", function() {
        var productKey = jQuery(this).data("product-key");
        var quantityInput = jQuery(this).closest(".mini_cart_item").find(".quantity input.qty");
        var currentVal = parseFloat(quantityInput.val());
        if (currentVal > 1) {
            quantityInput.val(currentVal - 1);
            updateMiniCartQuantity(productKey, currentVal - 1);
        }
    });
});

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

function toggle_mini_cart() {
    var targetElement = jQuery("#mp-minicart-wrap");
    jQuery("#sliding_cart").on("click", function() {
        jQuery("body").toggleClass("open-minicart");
        jQuery("#mp-minicart-wrap").toggleClass("active");
        return false;
    });
    jQuery("#minicart-close").on("click", function() {
        jQuery("body").toggleClass("open-minicart");
        jQuery("#mp-minicart-wrap").toggleClass("active");
        return false;
    });
    jQuery(document).click(function(event) {
        if (!targetElement.is(event.target) && !targetElement.has(event.target).length) {
            jQuery("body").removeClass("open-minicart");
            jQuery("#mp-minicart-wrap").removeClass("active");
        }
    });
    jQuery(document).ready(function($) {
        $(document).on("added_to_cart", function(event, fragments, cart_hash, $button) {
            jQuery("body").toggleClass("open-minicart");
            jQuery("#mp-minicart-wrap").toggleClass("active");
        });
    });
}

function updateMiniCartQuantity(productKey, quantity) {
    jQuery.ajax({
        type: "POST",
        url: woocommerce_params.ajax_url,
        data: {
            action: "update_mini_cart_quantity",
            product_key: productKey,
            quantity: quantity
        },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                jQuery(".widget_shopping_cart_content").html(response.data);
            }
        }
    });
}