//Color chart
export function colorChart() {
  jQuery(document).ready(function ($) {
    let colorWrapper = $(".color-legend__wrapper");
    let colorLegend = $("#color-legend");
    let colorTriangle = colorLegend.find(".graph-chart__triangle");

    let isRTL = document.body.classList.contains("rtl");

    switch (colorLegend.data("color")) {
      case "D":
        colorWrapper.css("justify-content", "flex-start");
        colorTriangle.css("left", "5%");
        if (isRTL) colorTriangle.css("right", "5%");
        break;
      case "E":
        colorWrapper.css("justify-content", "flex-start");
        colorTriangle.css("left", "15%");
        if (isRTL) colorTriangle.css("right", "15%");
        break;
      case "F":
        colorWrapper.css("justify-content", "flex-start");
        colorTriangle.css("left", "25%");
        if (isRTL) colorTriangle.css("right", "25%");
        break;
      case "G":
        colorWrapper.css("justify-content", "flex-start");
        colorTriangle.css("left", "35%");
        if (isRTL) colorTriangle.css("right", "35%");
        break;
      case "H":
        colorWrapper.css("justify-content", "flex-start");
        colorTriangle.css("left", "45%");
        if (isRTL) colorTriangle.css("right", "45%");
        break;
      case "I":
        colorWrapper.css("justify-content", "flex-start");
        colorTriangle.css("left", "55%");
        if (isRTL) colorTriangle.css("right", "55%");
        break;
      case "J":
        colorWrapper.css("justify-content", "flex-start");
        colorTriangle.css("left", "60%");
        if (isRTL) colorTriangle.css("right", "60%");
        break;
      case "K":
        colorWrapper.css("justify-content", "flex-end");
        colorTriangle.css("right", "48%");
        if (isRTL) colorTriangle.css("left", "48%");
        break;
    }
  });
}
