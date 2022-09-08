import Swiper from "swiper/bundle";

export function shopSlider() {
  const swiper = new Swiper(".swiper", {
    slidesPerView: 4,
    spaceBetween: 10,
    initialSlide: 2,
    centeredSlides: true,
    direction: "horizontal",
    loop: true,
    breakpoints: {
      // when window width is >= 300px
      300: {
        slidesPerView: 2,
        spaceBetween: 10
      },
      // when window width is >= 600px
      600: {
        slidesPerView: 4,
        spaceBetween: 10
      }
    },

    autoplay: {
      delay: 6000,
    },


  });

  return swiper;
}
