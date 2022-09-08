import $ from "jquery";

export function addToCartAJAX() {
  jQuery(document).ready(function ($) {
    // $(".single_add_to_cart_button").on("click", function (e) {
    //   e.preventDefault();
    // });

    $(".single_add_to_cart_button").on("click", function (e) {
      e.preventDefault();
      let thisbutton = $(this);
      let form = thisbutton.closest("form.cart");
      let id = thisbutton.val();
      let product_qty = form.find("input[name=quantity]").val() || 1;
      let product_id = form.find("input[name=product_id]").val() || id;
      let variation_id = form.find("input[name=variation_id]").val() || 0;
      let data = {
        action: "agada_woocommerce_ajax_add_to_cart",
        product_id: product_id,
        product_sku: "",
        quantity: product_qty,
        variation_id: variation_id,
      };

      $.ajax({
        type: "post",
        url: wc_add_to_cart_params.ajax_url,
        data: data,
        beforeSend: function (response) {
          thisbutton.removeClass("added").addClass("loading");
        },
        complete: function (response) {
          thisbutton.addClass("added").removeClass("loading");
        },
        success: function (response) {
          console.log("success");
          if (response.error & response.product_url) {
            window.location = response.product_url;
            return;
          } else {
            $(document.body).trigger("added_to_cart", [
              response.fragments,
              response.cart_hash,
              thisbutton,
            ]);
          }
        },
      });
    });
  });
}
