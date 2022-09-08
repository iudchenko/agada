import $ from "jquery";
//Details toggle
export function productDetails() {
  jQuery(document).ready(function ($) {
    $(".details").on("click", function () {
      $(this).next(".tab").slideToggle();
      $(this).toggleClass("hidden");
      $(this).find(".details__arrow").toggleClass("rotate");
    });
  });
}

//Carat size marker position
export function marker() {
  jQuery(document).ready(function ($) {
    let marker = $("#carat-marker");
    let caratWidth = 2 - 0.125;
    let sliderWidth = ($("#carat-slider").outerWidth() / 8) * 7.5;
    let position = ((marker.data("carat") - 0.125) / caratWidth) * sliderWidth;
    let isRTL = document.body.classList.contains("rtl");

    if (isRTL) {
      marker.css("right", position);
    } else {
      marker.css("left", position);
    }
  });
}
