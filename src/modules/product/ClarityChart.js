//Cut and clarity charts
export function clarityChart() {
  jQuery(document).ready(function ($) {
    let clarityWrapper = $(".clarity-legend__wrapper");
    let clarityLegend = $("#clarity-legend ");
    let clarityTriangle = clarityLegend.find(".graph-chart__triangle");

    let isRTL = document.body.classList.contains("rtl");

    switch (clarityLegend.data("clarity")) {
      case "I1":
      case "I2":
      case "I3":
        clarityWrapper.css("justify-content", "flex-start");
        clarityTriangle.css("left", "15%");
        if (isRTL) clarityTriangle.css("right", "15%");
        break;
      case "SI1":
      case "SI2":
        clarityWrapper.css("justify-content", "flex-start");
        clarityTriangle.css("left", "45%");
        if (isRTL) clarityTriangle.css("right", "45%");
        break;
      case "VS1":
      case "VS2":
        clarityWrapper.css("justify-content", "center");
        clarityTriangle.css("left", "30%");
        if (isRTL) clarityTriangle.css("right", "30%");
        break;
      case "VVS1":
      case "VVS2":
        clarityWrapper.css("justify-content", "center");
        clarityTriangle.css("left", "65%");
        if (isRTL) clarityTriangle.css("right", "65%");
        break;
      case "IF":
        clarityWrapper.css("justify-content", "flex-end");
        clarityTriangle.css("left", "50%");
        if (isRTL) clarityTriangle.css("right", "50%");
        break;
      case "FL":
        clarityWrapper.css("justify-content", "flex-end");
        clarityTriangle.css("left", "80%");
        if (isRTL) clarityTriangle.css("right", "80%");
        break;
    }
  });
}
