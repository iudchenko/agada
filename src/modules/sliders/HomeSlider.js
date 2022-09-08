/* Swiper JS */

// import Swiper bundle with all modules installed
import Swiper, { Pagination } from "swiper/bundle";

// import "swiper/css/bundle";

export function homeSlider() {
  const swiper = new Swiper(".swiper", {
    // Optional parameters
    direction: "horizontal",
    loop: true,
    effect: "fade",
    fadeEffect: {
      crossFade: true,
    },
    speed: 600,

    zoom: {
      toggle: false,
    },

    autoHeight: true,

    autoplay: {
      delay: 3000,
    },

    updateOnWindowResize: true,
    observer: true,
    observeSlideChildren: true,
    resizeObserver: true,

    // If we need pagination
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });

  return swiper;
}
