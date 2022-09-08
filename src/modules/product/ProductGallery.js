import $ from "jquery";

export function productGallery() {
  jQuery(document).ready(function ($) {
    let main = $("#product__main-image img");
    let gallery = $(".product__gallery img");

    $(gallery[0]).addClass("selected");

    gallery.on("click", function (e) {
      e.preventDefault();
      let newsrc = e.target.src;
      gallery.each(function (img) {
        $(this).removeClass("selected");
      });

      $(this).addClass("selected");
      main.attr("src", newsrc);
    });
  });
}
