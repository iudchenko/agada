import $ from "jquery";

export function qtyPlusMinus() {
  jQuery(document).ready(function ($) {
    $(".woocommerce-cart-form").on(
      "click",
      "button.plus, button.minus",
      function () {
        // Get current quantity values
        let qty = $(this).parent(".product-quantity").find(".qty");
        let val = parseFloat(qty.val());
        let max = parseFloat(qty.attr("max"));
        let min = parseFloat(qty.attr("min"));
        let step = parseFloat(qty.attr("step"));

        // Change the value if plus or minus
        if ($(this).is(".plus")) {
          qty.trigger("change");
          if (max && max <= val) {
            qty.val(max);
          } else {
            qty.val(val + step);
          }
        } else {
          qty.trigger("change");
          if (min && min >= val) {
            qty.val(min);
          } else if (val > 0) {
            qty.val(val - step);
          }
        }
      }
    );
  });
}
