import $ from "jquery";
import "../sass/style.scss";
import Swiper from "swiper";
import Search from "./modules/search/Search";
import { homeSlider } from "./modules/sliders/HomeSlider";
import { shopSlider } from "./modules/sliders/ShopSlider";
import { addToCartAJAX } from "./modules/product/AddToCart";
import { productDetails, marker } from "./modules/product/ProductScripts";
import { qtyPlusMinus } from "./modules/product/Qty";
import { cutChart } from "./modules/product/CutChart";
import { clarityChart } from "./modules/product/ClarityChart";
import { colorChart } from "./modules/product/ColorChart";
import { productGallery } from "./modules/product/ProductGallery";
import { accountScripts } from "./modules/account/Account";
import { accountLoggedinScripts } from "./modules/account/Account-loggedin.js";
import Diamonds from "./modules/diamonds/Diamonds";
import MobileFilters from "./modules/diamonds/MobileFilters";
import JewelryMobileFilters from "./modules/jewelry/JewelryMobileFilters";
import Jewelry from "./modules/jewelry/Jewelry";

const isHome = document.body.classList.contains("home");
const isShop = document.body.classList.contains("woocommerce-shop");
const isAccount = document.body.classList.contains("woocommerce-account");
const isCart = document.body.classList.contains("woocommerce-cart");

const isAccountLoggedin =
  document.body.classList.contains("woocommerce-account") &&
  document.body.classList.contains("logged-in")
    ? true
    : false;

const isProduct = document.body.classList.contains("single-product");
const isDiamonds = document.body.classList.contains("page-template-diamonds");
const isJewelry = document.body.classList.contains("page-template-jewelry");

/* Search */
$(document).ready(function () {
  const search = new Search();
  // document.querySelector(".search-submit").value = "";
});

/* Home page */
if (isHome) {
  const slider = homeSlider();
  window.addEventListener("load", function () {
    slider.update();
  });
}

/* Shop page */
if (isShop) {
  shopSlider();
}

/* Cart page */
// if (isCart) {
//   qtyPlusMinus();
// }

/* Product page */
if (isProduct) {
  // addToCartAJAX();
  productDetails();
  marker();
  cutChart();
  clarityChart();
  colorChart();
  productGallery();

  $(window).resize(function () {
    marker();
  });
}

/* Account page */
if (isAccount) {
  accountScripts();
}
if (isAccountLoggedin) {
  accountLoggedinScripts();
}

/* Diamonds page */
if (isDiamonds) {
  window.addEventListener("load", (event) => {
    const diamonds = new Diamonds();

    diamonds.getProducts();

    diamonds.rangeSlider(
      "price-slider-1",
      "price-slider-2",
      "price-range-1",
      "price-range-2",
      "price-slider-track",
      "price"
    );

    diamonds.rangeSlider(
      "carat-slider-1",
      "carat-slider-2",
      "carat-range-1",
      "carat-range-2",
      "carat-slider-track",
      "carat"
    );

    diamonds.rangeSlider2(
      "color-slider-1",
      "color-slider-2",
      "color-slider-track",
      "color"
    );

    diamonds.rangeSlider2(
      "cut-slider-1",
      "cut-slider-2",
      "cut-slider-track",
      "cut"
    );

    diamonds.rangeSlider2(
      "clarity-slider-1",
      "clarity-slider-2",
      "clarity-slider-track",
      "clarity"
    );

    diamonds.rangeSlider(
      "lw-ratio-slider-1",
      "lw-ratio-slider-2",
      "lw-ratio-range-1",
      "lw-ratio-range-2",
      "lw-ratio-slider-track",
      "lw"
    );

    diamonds.rangeSlider2(
      "polish-slider-1",
      "polish-slider-2",
      "polish-slider-track",
      "polish"
    );

    diamonds.rangeSlider(
      "table-slider-1",
      "table-slider-2",
      "table-range-1",
      "table-range-2",
      "table-slider-track",
      "table"
    );

    diamonds.rangeSlider2(
      "fluor-slider-1",
      "fluor-slider-2",
      "fluor-slider-track",
      "fluor"
    );

    diamonds.rangeSlider2(
      "symmetry-slider-1",
      "symmetry-slider-2",
      "symmetry-slider-track",
      "symmetry"
    );

    diamonds.rangeSlider(
      "depth-slider-1",
      "depth-slider-2",
      "depth-range-1",
      "depth-range-2",
      "depth-slider-track",
      "depth"
    );

    const mobileFilters = new MobileFilters();
  });
}

/* Jewelry page */
if (isJewelry) {
  window.addEventListener("load", (event) => {
    const jewelry = new Jewelry();

    jewelry.getProducts();

    jewelry.rangeSlider(
      "price-slider-1",
      "price-slider-2",
      "price-range-1",
      "price-range-2",
      "price-slider-track"
    );

    const jewelryMobileFilters = new JewelryMobileFilters();
  });
}
