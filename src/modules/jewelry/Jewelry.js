import axios from "axios";
// import $ from "jquery";

class Jewelry {
  constructor() {
    this.results = document.querySelector(".jewelry__loop");
    this.resultsCount = document.querySelector(".jewelry__loop-header span");
    this.sortby = document.querySelectorAll(".sortby");
    this.isRTL = document.body.classList.contains("rtl");

    //Filters
    this.typeFields = document.querySelectorAll(
      ".filters__type fieldset input"
    );
    this.metalFields = document.querySelectorAll(
      ".filters__metal fieldset input"
    );
    this.gemstoneFields = document.querySelectorAll(
      ".filters__gemstone fieldset input"
    );
    this.filterTimer;

    //State for the whole app
    this.state = {
      type: [],
      priceMin: 0,
      priceMax: 112920,
      metal: [],
      gemstone: [],
      activeFilters: [],
      activeSorting: "",
    };

    this.events();
    this.page = 1;
    this.loader = document.querySelector(".loader");
    this.isLoaderVisible = true;
    this.canBeLoaded = true;
    this.initFilters();
  }

  initFilters() {
    if (document.body.classList.contains("page-child")) {
      const pathArray = window.location.pathname
        .split("/")
        .filter((part) => part !== "");

      const typePath = pathArray[pathArray.length - 1];

      if (window.location.href.indexOf(typePath) > -1) {
        document.getElementById(`j${typePath}`).checked = true;
        this.state.type = [typePath];
        this.state.activeFilters = ["type"];
      }
    }
    // console.log(this.state);
  }

  events() {
    window.onscroll = (e) => {
      this.loadOnScroll();
    };

    this.typeFields.forEach((item) => {
      item.addEventListener("change", (event) => {
        this.addActiveFilter("type");
        this.debounceFilter();
      });
    });

    this.metalFields.forEach((item) => {
      item.addEventListener("change", (event) => {
        this.addActiveFilter("metal");
        this.debounceFilter();
      });
    });

    this.gemstoneFields.forEach((item) => {
      item.addEventListener("change", (event) => {
        this.addActiveFilter("gemstone");
        this.debounceFilter();
      });
    });

    this.sortby.forEach((item) => {
      item.addEventListener("change", (e) => {
        this.state.activeSorting = e.target.value;
        this.debounceFilter();
      });
    });

    // this.sortby.addEventListener("change", (e) => {
    //   this.state.activeSorting = e.target.value;
    //   this.debounceFilter();
    // });
  }

  showLoader() {
    this.loader.classList.remove("hidden");
    this.isLoaderVisible = true;
  }

  hideLoader() {
    this.loader.classList.add("hidden");
    this.isLoaderVisible = false;
  }

  loadOnScroll() {
    let position = window.scrollY;
    let docHeight = document.documentElement.scrollHeight;
    let bottomOffset = 2000;
    // Mobile
    if (window.outerWidth < 480 || window.outerHeight < 480) {
      let bottomOffset = 2500;
    }
    // Desktop
    if (
      position > docHeight - bottomOffset &&
      this.canBeLoaded &&
      !this.isLoaderVisible
    ) {
      // console.log("scroll");
      this.page++;
      this.getProducts();
      this.canBeLoaded = false;
    }
  }

  addActiveFilter(filter) {
    if (this.state.activeFilters.indexOf(filter) === -1) {
      this.state.activeFilters.push(filter);
    }
  }

  debounceFilter() {
    clearTimeout(this.filterTimer);
    this.filterTimer = setTimeout(() => {
      this.filter();
    }, 500);
  }

  filter() {
    this.page = 1;
    this.getVars();
    this.setState();
    this.results.innerHTML = "";
    this.getProducts();
    // console.log(this.state);
  }

  rangeSlider(slider1, slider2, range1, range2, track) {
    const isRTL = this.isRTL;
    const sliderOne = document.getElementById(slider1);
    const sliderTwo = document.getElementById(slider2);
    const displayValOne = document.getElementById(range1);
    const displayValTwo = document.getElementById(range2);
    const minGap = 0;
    const sliderTrack = document.getElementById(track);
    const sliderMinValue = sliderOne.min;
    const sliderMaxValue = sliderOne.max;
    // console.log(this);
    const parent = this;

    // console.log(sliderOne);
    // console.log(sliderTwo);

    slideOne();
    slideTwo();
    events();

    function events() {
      sliderOne.addEventListener("input", function () {
        slideOne();
        parent.debounceFilter();
        parent.addActiveFilter("price");
        // this.debounceFilter();
      });

      sliderTwo.addEventListener("input", function () {
        slideTwo();
        parent.debounceFilter();
        parent.addActiveFilter("price");
      });

      displayValOne.addEventListener("change", function () {
        sliderOne.value = displayValOne.value;
        slideOne();
        parent.debounceFilter();
        parent.addActiveFilter("price");
      });

      displayValTwo.addEventListener("change", function () {
        sliderTwo.value = displayValTwo.value;
        slideTwo();
        parent.debounceFilter();
        parent.addActiveFilter("price");
      });
    }

    function slideOne() {
      if (parseFloat(sliderTwo.value) - parseFloat(sliderOne.value) <= minGap) {
        sliderOne.value = parseFloat(sliderTwo.value) - minGap;
      }
      displayValOne.value = sliderOne.value;

      fillColor();
    }

    function slideTwo() {
      if (parseFloat(sliderTwo.value) - parseFloat(sliderOne.value) <= minGap) {
        sliderTwo.value = parseFloat(sliderOne.value) + minGap;
      }
      displayValTwo.value = sliderTwo.value;

      fillColor();
    }

    function fillColor() {
      let percent1 =
        ((sliderOne.value - sliderMinValue) /
          (sliderMaxValue - sliderMinValue)) *
        100;
      let percent2 =
        ((sliderTwo.value - sliderMinValue) /
          (sliderMaxValue - sliderMinValue)) *
        100;

      sliderTrack.style.background = `linear-gradient(${
        isRTL ? "to left" : "to right"
      }, #C8C8C8 ${percent1}% , #7F573B ${percent1}% , #7F573B ${percent2}%, #C8C8C8 ${percent2}%)`;
    }
  }

  getVars() {
    this.type = this.getCheckboxes(".filters__type fieldset input:checked");
    this.priceMin = document.getElementById("price-slider-1").value;
    this.priceMax = document.getElementById("price-slider-2").value;
    this.metal = this.getCheckboxes(".filters__metal fieldset input:checked");
    this.gemstone = this.getCheckboxes(
      ".filters__gemstone fieldset input:checked"
    );
  }

  getCheckboxes(element) {
    let checked = document.querySelectorAll(element);
    let selection = [];
    checked.forEach(function (el) {
      selection.push(el.value);
    });

    return selection;
  }

  setState() {
    this.state.type = this.type;
    this.state.priceMin = this.priceMin;
    this.state.priceMax = this.priceMax;
    this.state.metal = this.metal;
    this.state.gemstone = this.gemstone;
  }

  generateItems(item) {
    let price = new Intl.NumberFormat("en-US", {
      style: "currency",
      currency: "USD",
      minimumFractionDigits: 0,
    }).format(item.price);

    function getMetalAtts(item) {
      let metals = item.metal;

      let metalsOutput = ``;

      metals.map((metal) => {
        metalsOutput += `<li aria-checked="false" tabindex="-1" data-wvstooltip="${metal}" class="variable-item color-variable-item color-variable-item-${metal
          .trim()
          .replace(" ", "-")
          .toLowerCase()}" title="${metal}" data-title="${metal}" role="radio">
        </li>`;
      });

      return metalsOutput;
    }

    let resultItem = `<div class="loop-item">
      <a href="${item.permalink}">
        <img class="loop-item__img" src="${item.image}" alt="${item.title}">

				<ul role="radiogroup" aria-label="Metal" class="variable-items-wrapper color-variable-items-wrapper wvs-style-rounded custom-color-swatch-buttons">
				${getMetalAtts(item)}
				</ul>

        <p class="loop-item__title">${item.title}</p>
        <p class="loop-item__price">${price}</p>
      </a>
    </div>`;

    this.results.innerHTML += resultItem;
  }

  getProducts() {
    this.showLoader();

    const axios = require("axios").default;
    const bodyFormData = new FormData();

    bodyFormData.append("page", this.page);
    bodyFormData.append("action", "agada_filter_products");

    if (this.state.activeFilters.includes("type")) {
      let types = [...this.state.type];
      types.forEach((type) => {
        bodyFormData.append("type[]", type);
      });
    }

    if (this.state.activeSorting.length) {
      bodyFormData.append("sorting", this.state.activeSorting);
    }

    if (this.state.activeFilters.includes("price")) {
      bodyFormData.append("priceMin", this.state.priceMin);
      bodyFormData.append("priceMax", this.state.priceMax);
    }

    if (this.state.activeFilters.includes("metal")) {
      let metal = [...this.state.metal];
      metal.forEach((item) => {
        bodyFormData.append("metal[]", item);
      });
    }

    if (this.state.activeFilters.includes("gemstone")) {
      let gemstone = [...this.state.gemstone];
      gemstone.forEach((item) => {
        bodyFormData.append("gemstone[]", item);
      });
    }

    axios
      .post(agadaData.ajaxurl, bodyFormData)
      .then(
        function (response) {
          // your action after success

          this.totalPages = Number(response.headers["total_pages"]);
          this.totalProducts = Number(response.headers["total_products"]);
          this.totalFeatured = Number(response.headers["total_featured"]);

          // this.results.innerHTML = "";
          response.data.map((item) => this.generateItems(item));
          this.resultsCount.innerHTML = this.totalProducts;
          this.hideLoader();

          if (response.data.length == 0) {
            this.results.innerHTML = `<p>${translation_object.noProductsText}</p>`;
            // console.log("no data");
          }

          // console.log(response.data);
          // console.log(
          //   `Current page: ${Number(response.headers["current_page"])}`
          // );
          // console.log(`Total pages: ${this.totalPages}`);
          // console.log(`Total products: ${this.totalProducts}`);
          // console.log(`Total featured: ${this.totalFeatured}`);

          // console.log(response.data.length);
        }.bind(this)
      )
      .catch(function (error) {
        // your action on error success
        console.log(error);
      })
      .finally(
        function () {
          // this.hideLoader();
          this.page >= this.totalPages
            ? (this.canBeLoaded = false)
            : (this.canBeLoaded = true);
        }.bind(this)
      );
  }
}

export default Jewelry;
