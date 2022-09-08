import $ from "jquery";

export function accountLoggedinScripts() {
  // console.log("loggedin");
  // Billing last name on TAB key press function
  $("#billing_last_name").on("focus", function () {
    //do some stuff

    $(this).on("keydown", function (e) {
      var keyCode = e.keyCode || e.which;

      if (keyCode == 9) {
        e.preventDefault();
        $("#account_email").focus();
      }
    });
  });

  //Update info on click

  function upateInfo(value, color) {
    let form = $("form.woocommerce-EditAccountForm");
    let btn = $("#account-update-info");

    let firstName = $("#billing_first_name");
    let lastName = $("#billing_last_name");
    let email = $("#account_email");
    let currentPassword = $("#password_current");
    let password1 = $("#password_1");
    let password2 = $("#password_2");
    let password1wrapper = $("#password_1__wrapper");
    let password2wrapper = $("#password_2__wrapper");

    let updateText = translation_object.updateText;
    let cancelText = translation_object.cancelText;

    if (value) {
      btn.removeClass("active");
      form.removeClass("active");
      btn.html(updateText);
    } else {
      btn.addClass("active");
      form.addClass("active");
      btn.html(cancelText);
    }

    firstName.prop("readonly", value).css("background-color", color);
    lastName.prop("readonly", value).css("background-color", color);
    email.prop("readonly", value).css("background-color", color);
    currentPassword.prop("readonly", value).css("background-color", color);
    password1.prop("readonly", value).css("background-color", color);
    password2.prop("readonly", value).css("background-color", color);

    password1wrapper.css("display", value ? "none" : "flex");
    password2wrapper.css("display", value ? "none" : "flex");
  }

  $(document).ready(function () {
    upateInfo(true, "#fff");
  });

  $("#account-update-info").on("click", function () {
    if ($(this).hasClass("active")) {
      upateInfo(true, "#fff");
    } else {
      upateInfo(false, "#f8f8f8");
    }
  });
}
