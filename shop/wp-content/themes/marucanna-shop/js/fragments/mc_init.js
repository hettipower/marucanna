jQuery(document).ready(function ($) {
  toggle_mini_cart();
  menu_dropdown();
  mp_ajax_add_to_cart_single();

  // Increment quantity
  jQuery(document.body).on('click', '.mini_cart_item .quantity .plus', function () {
    var productKey = jQuery(this).data('product-key');
    var quantityInput = jQuery(this).closest('.mini_cart_item').find('.quantity input.qty');
    var currentVal = parseFloat(quantityInput.val());
    quantityInput.val(currentVal + 1);
    updateMiniCartQuantity(productKey, currentVal + 1);
  });

  // Decrement quantity
  jQuery(document.body).on('click', '.mini_cart_item .quantity .minus', function () {
    var productKey = jQuery(this).data('product-key');
    var quantityInput = jQuery(this).closest('.mini_cart_item').find('.quantity input.qty');
    var currentVal = parseFloat(quantityInput.val());
    if (currentVal > 1) {
      quantityInput.val(currentVal - 1);
      updateMiniCartQuantity(productKey, currentVal - 1);
    }
  });
});