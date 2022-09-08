import $ from "jquery";

export function accountScripts() {
  $("#billing_last_name").on("focus", function () {
    //do some stuff

    $(this).on("keydown", function (e) {
      var keyCode = e.keyCode || e.which;

      if (keyCode == 9) {
        e.preventDefault();
        $("#reg_email").focus();
      }
    });
  });

  $("#reg_password").on("focus", function () {
    //do some stuff

    $(this).on("keydown", function (e) {
      var keyCode = e.keyCode || e.which;

      if (keyCode == 9) {
        e.preventDefault();
        $("#news_subscribe_checkbox").focus();
      }
    });
  });

  $("#news_subscribe_checkbox").on("focus", function () {
    //do some stuff

    $(this).on("keydown", function (e) {
      var keyCode = e.keyCode || e.which;

      if (keyCode == 9) {
        e.preventDefault();
        $(".woocommerce-form-register__submit").focus();
      }
    });
  });
}
