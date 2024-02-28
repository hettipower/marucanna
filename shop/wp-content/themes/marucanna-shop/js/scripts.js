/*! css 1.0.0 filename.js 2024-02-27 10:16:51 AM */

jQuery(document).ready(function($) {
    toggle_mini_cart();
    menu_dropdown();
    mp_ajax_add_to_cart_single();
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
        url: CUSTOM_PARAMS.ajaxUrl,
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

function mp_ajax_add_to_cart_single() {
    jQuery(document).on("click", ".single_add_to_cart_button", function(e) {
        e.preventDefault();
        var $this = jQuery(this), $form = $this.closest("form.cart"), all_data = $form.serialize(), product_qty = $form.find("input[name=quantity]").val() || 1, product_id = $form.find("input[name=product_id]").val() || $this.val(), variation_id = $form.find("input[name=variation_id]").val() || 0;
        var item = {}, variations = $form.find("select[name^=attribute]");
        if (!variations.length) {
            variations = $form.find("[name^=attribute]:checked");
        }
        if (!variations.length) {
            variations = $form.find("input[name^=attribute]");
        }
        variations.each(function() {
            var $thisitem = $(this), attributeName = $thisitem.attr("name"), attributevalue = $thisitem.val(), index, attributeTaxName;
            $thisitem.removeClass("error");
            if (attributevalue.length === 0) {
                index = attributeName.lastIndexOf("_");
                attributeTaxName = attributeName.substring(index + 1);
                $thisitem.addClass("required error");
            } else {
                item[attributeName] = attributevalue;
            }
        });
        var data = {
            product_id: product_id,
            product_sku: "",
            quantity: product_qty,
            variation_id: variation_id,
            variations: item,
            all_data: all_data
        };
        var alldata = data.all_data + "&product_id=" + data.product_id + "&product_sku=" + data.product_sku + "&quantity=" + data.quantity + "&variation_id=" + data.variation_id + "&variations=" + JSON.stringify(data.variations) + "&action=woolentor_single_insert_to_cart";
        jQuery(document.body).trigger("adding_to_cart", [ $this, alldata ]);
        jQuery.ajax({
            type: "post",
            url: $form.attr("action") + "/?wc-ajax=mp_single_insert_to_cart",
            data: alldata,
            beforeSend: function(response) {
                $this.removeClass("added").addClass("loading");
            },
            complete: function(response) {
                $this.addClass("added").removeClass("loading");
            },
            success: function(response) {
                if (response.error & response.product_url) {
                    window.location = response.product_url;
                    return;
                } else {
                    jQuery(document.body).trigger("added_to_cart", [ response.fragments, response.cart_hash, $this ]);
                }
            }
        });
        return false;
    });
}