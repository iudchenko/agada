//Cut and clarity charts
export function cutChart() {
  jQuery(document).ready(function ($) {
    let cutWrapper = $(".cut-legend__wrapper");
    let cutLegend = $("#cut-legend");
    let cutTriangle = cutLegend.find(".graph-chart__triangle");

    let isRTL = document.body.classList.contains("rtl");

    switch (cutLegend.data("cut")) {
      case "Super Ideal":
        cutWrapper.css("justify-content", "flex-end");
        cutTriangle.css("right", "15%");
        if (isRTL) cutTriangle.css("left", "15%");
        break;
      case "Ideal":
        cutWrapper.css("justify-content", "flex-end");
        cutTriangle.css("right", "45%");
        if (isRTL) cutTriangle.css("left", "45%");
        break;
      case "Very Good":
        cutWrapper.css("justify-content", "center");
        cutTriangle.css("right", "30%");
        if (isRTL) cutTriangle.css("left", "30%");
        break;
      case "Good":
        cutWrapper.css("justify-content", "center");
        cutTriangle.css("right", "65%");
        if (isRTL) cutTriangle.css("left", "65%");
        break;
      case "Fair":
        cutWrapper.css("justify-content", "flex-start");
        cutTriangle.css("right", "50%");
        if (isRTL) cutTriangle.css("left", "50%");
        break;
      case "Poor":
        cutWrapper.css("justify-content", "flex-start");
        cutTriangle.css("right", "80%");
        if (isRTL) cutTriangle.css("left", "80%");
        break;
    }
  });
}
