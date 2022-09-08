import axios from "axios";
import $ from "jquery";

class Diamonds {
  constructor() {
    this.isRTL = document.body.classList.contains("rtl");
    this.table = document.querySelector(".table__body");
    this.lang = document.documentElement.lang;
    this.loader = document.querySelector(".loader");
    this.filterTimer;

    //Filters
    this.shapeFields = document.querySelectorAll(
      ".filters__shape fieldset input"
    );
    this.reportFields = document.querySelectorAll(
      ".filters__report fieldset input"
    );

    //Buttons
    this.btns = document.querySelectorAll(".lab-diamonds__btns button");
    this.allBtn = document.querySelector(".lab-diamonds__btn--all");
    this.allBtnCount = document.querySelector(".lab-diamonds__btn--all span");
    this.mostBtn = document.querySelector(".lab-diamonds__btn--most");
    this.mostBtnCount = document.querySelector(".lab-diamonds__btn--most span");
    this.compareBtn = document.querySelector(".lab-diamonds__btn--compare");
    this.compareBtnCount = document.querySelector(
      ".lab-diamonds__btn--compare span"
    );

    //Table head
    this.sortShapeBtn = document.querySelector(".table__head--shape");
    this.sortPriceBtn = document.querySelector(".table__head--price");
    this.sortCaratBtn = document.querySelector(".table__head--carat");
    this.sortCutBtn = document.querySelector(".table__head--cut");
    this.sortColorBtn = document.querySelector(".table__head--color");
    this.sortClarityBtn = document.querySelector(".table__head--clarity");
    this.sortReportBtn = document.querySelector(".table__head--report");

    this.isFiltered = false;
    this.allFilters = document.querySelectorAll(".lab-diamonds__filters input");

    //Mobile sorting
    this.mobSortBtn = document.querySelector(
      ".lab-diamonds__mobile-sorting span"
    );
    this.sortPLH = document.querySelector(".lab-diamonds__mobile-sorting--plh");
    this.sortPHL = document.querySelector(".lab-diamonds__mobile-sorting--phl");
    this.sortCLH = document.querySelector(".lab-diamonds__mobile-sorting--clh");
    this.sortCHL = document.querySelector(".lab-diamonds__mobile-sorting--chl");
    this.sortF = document.querySelector(".lab-diamonds__mobile-sorting--f");
    this.mobSortList = document.querySelector(
      ".lab-diamonds__mobile-sorting--list"
    );

    this.state = {
      shape: [
        "Round",
        "Oval",
        "Cushion",
        "Princess",
        "Pear",
        "Emerald",
        "Marquise",
        "Asscher",
        "Radiant",
        "Heart",
        "Trapezoid",
        "Baguette",
        "Triangle",
        "Taper",
      ],
      priceMin: 0,
      priceMax: 83961,
      caratMin: 0,
      caratMax: 14.76,
      colorMin: 0,
      colorMax: 7,
      cutMin: 0,
      cutMax: 5,
      clarityMin: 0,
      clarityMax: 8,
      report: ["IGI", "GIA", "HRD", "SGL"],
      lwMin: 0,
      lwMax: 2.75,
      polishMin: 0,
      polishMax: 3,
      tableMin: 0,
      tableMax: 100,
      fluorMin: 0,
      fluorMax: 5,
      symMin: 0,
      symMax: 3,
      depthMin: 0,
      depthMax: 100,
    };

    this.activeFilters = [];
    this.filterTimer;
    // this.scrollTimer;
    this.page = 1;
    this.totalPages = 1;
    this.totalDiamonds;
    this.canBeLoaded = true;
    this.isLoaderVisible = true;
    this.prepareItems();
    this.tableEvents();
    this.filterEvents();
    this.initFilters();
  }

  initFilters() {
    if (document.body.classList.contains("page-child")) {
      const pathArray = window.location.pathname
        .split("/")
        .filter((part) => part !== "");

      const shapePath = pathArray[pathArray.length - 1];

      if (window.location.href.indexOf(shapePath) > -1) {
        document.getElementById(`d${shapePath}`).checked = true;
        this.state.shape = [shapePath];
        this.activeFilters = ["shape"];
      }
    }
  }

  tableEvents() {
    window.onscroll = (e) => {
      this.loadOnScroll();
    };
  }

  filterEvents() {
    //Filters
    this.allFilters.forEach((item) => {
      item.addEventListener("change", (event) => {
        this.isFiltered = true;
        // console.log("filter");
        // this.debounceFilter();
      });
    });

    this.shapeFields.forEach((item) => {
      item.addEventListener("change", (event) => {
        this.debounceFilter("shape");
      });
    });

    this.reportFields.forEach((item) => {
      item.addEventListener("change", (event) => {
        this.debounceFilter("report");
      });
    });

    //Listen to buttons
    this.allBtn.onclick = (e) => {
      this.toggleBtnClass(e);
      this.prepareItems();
      this.rowEvents();
      this.items.forEach((item) => $(item).show());
    };

    this.mostBtn.onclick = (e) => {
      this.toggleBtnClass(e);
      this.prepareItems();
      this.rowEvents();

      let result = this.filterFeatured();

      this.items.forEach((item) => {
        result.includes(item) ? $(item).show() : $(item).hide();
      });
    };

    this.compareBtn.onclick = (e) => {
      this.prepareItems();
      this.rowEvents();
      this.toggleBtnClass(e);

      let result = this.filterCheckboxes();

      this.items.forEach((item) => {
        result.includes(item) ? $(item).show() : $(item).hide();
      });
    };

    //Event listeners for sorting
    this.sortShapeBtn.onclick = (e) => {
      this.prepareItems();
      this.rowEvents();
      this.toggleSort(e);
      this.sortTable(this.directionSort(e), ".table__data--shape");
    };
    this.sortPriceBtn.onclick = (e) => {
      this.prepareItems();
      this.rowEvents();
      this.toggleSort(e);
      // this.sortTable(this.directionSort(e), ".table__data--price");
      this.sortPrice(this.directionSort(e));
    };
    this.sortCaratBtn.onclick = (e) => {
      this.prepareItems();
      this.rowEvents();
      this.toggleSort(e);
      this.sortTable(this.directionSort(e), ".table__data--carat");
    };
    this.sortCutBtn.onclick = (e) => {
      this.prepareItems();
      this.rowEvents();
      this.toggleSort(e);
      this.sortTable(this.directionSort(e), ".table__data--cut");
    };
    this.sortColorBtn.onclick = (e) => {
      this.prepareItems();
      this.rowEvents();
      this.toggleSort(e);
      this.sortTable(this.directionSort(e), ".table__data--color");
    };
    this.sortClarityBtn.onclick = (e) => {
      this.prepareItems();
      this.rowEvents();
      this.toggleSort(e);
      this.sortTable(this.directionSort(e), ".table__data--clarity");
    };
    this.sortReportBtn.onclick = (e) => {
      this.prepareItems();
      this.rowEvents();
      this.toggleSort(e);
      this.sortTable(this.directionSort(e), ".table__data--report");
    };

    this.mobSortBtn.onclick = () => this.mobSortList.classList.toggle("hidden");

    this.sortPLH.onclick = () => {
      this.mobSortList.classList.toggle("hidden");
      this.prepareItems();
      this.rowEvents();
      this.sortPrice("asc");
    };

    this.sortPHL.onclick = () => {
      this.prepareItems();
      this.rowEvents();
      this.sortPrice("desc");
      this.mobSortList.classList.add("hidden");
    };

    this.sortCLH.onclick = () => {
      this.prepareItems();
      this.rowEvents();
      this.sortTable("asc", ".table__data--carat");
      this.mobSortList.classList.add("hidden");
    };

    this.sortCHL.onclick = () => {
      this.prepareItems();
      this.rowEvents();
      this.sortTable("desc", ".table__data--carat");
      this.mobSortList.classList.add("hidden");
    };

    this.sortF.onclick = () => {
      this.prepareItems();
      this.rowEvents();

      let result = this.filterFeatured();

      this.items.forEach((item) => {
        result.includes(item) ? $(item).show() : $(item).hide();
      });
      this.mobSortList.classList.add("hidden");
    };
  }

  rangeSlider(slider1, slider2, range1, range2, track, filter) {
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
        parent.debounceFilter(filter);
        // this.debounceFilter();
      });

      sliderTwo.addEventListener("input", function () {
        slideTwo();
        parent.debounceFilter(filter);
      });

      displayValOne.addEventListener("change", function () {
        sliderOne.value = displayValOne.value;
        slideOne();
        parent.debounceFilter(filter);
      });

      displayValTwo.addEventListener("change", function () {
        sliderTwo.value = displayValTwo.value;
        slideTwo();
        parent.debounceFilter(filter);
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

  rangeSlider2(slider1, slider2, track, filter) {
    const isRTL = this.isRTL;
    const sliderOne = document.getElementById(slider1);
    const sliderTwo = document.getElementById(slider2);
    const minGap = 0;
    const sliderTrack = document.getElementById(track);
    const sliderMaxValue = sliderOne.max;
    const parent = this;
    init();
    events();

    function init() {
      slideOne();
      slideTwo();
    }

    function events() {
      sliderOne.addEventListener("input", function () {
        slideOne();
        parent.debounceFilter(filter);
      });

      sliderTwo.addEventListener("input", function () {
        slideTwo();
        parent.debounceFilter(filter);
      });
    }

    function slideOne() {
      if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
        sliderOne.value = parseInt(sliderTwo.value) - minGap;
      }

      fillColor();
    }

    function slideTwo() {
      if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
        sliderTwo.value = parseInt(sliderOne.value) + minGap;
      }

      fillColor();
    }

    function fillColor() {
      let percent1 = (sliderOne.value / sliderMaxValue) * 100;
      let percent2 = (sliderTwo.value / sliderMaxValue) * 100;

      sliderTrack.style.background = `linear-gradient(${
        isRTL ? "to left" : "to right"
      }, #C8C8C8 ${percent1}% , #7F573B ${percent1}% , #7F573B ${percent2}%, #C8C8C8 ${percent2}%)`;
    }
  }

  sortTable(dir, element) {
    //Ascending order
    if (dir == "asc") {
      [...this.items]
        .sort((a, b) =>
          a.querySelector(element).innerText >
          b.querySelector(element).innerText
            ? 1
            : -1
        )
        .forEach((node) => this.table.appendChild(node));

      //Descending order
    } else if (dir == "desc") {
      [...this.items]
        .sort((a, b) =>
          a.querySelector(element).innerText <
          b.querySelector(element).innerText
            ? 1
            : -1
        )
        .forEach((node) => this.table.appendChild(node));
    }
  }

  sortPrice(dir) {
    //Ascending order
    if (dir == "asc") {
      [...this.items]
        .sort((a, b) =>
          Number(a.dataset.price) > Number(b.dataset.price) ? 1 : -1
        )
        .forEach((node) => this.table.appendChild(node));

      //Descending order
    } else if (dir == "desc") {
      [...this.items]
        .sort((a, b) =>
          Number(a.dataset.price) < Number(b.dataset.price) ? 1 : -1
        )
        .forEach((node) => this.table.appendChild(node));
    }
  }

  filter(filter) {
    this.page = 1;
    this.getVars();
    this.setState();
    this.table.innerHTML = "";
    if (this.activeFilters.indexOf(filter) === -1) {
      this.activeFilters.push(filter);
      // console.log(this.activeFilters);
    }
    this.getProducts();
    this.totalPages > 1
      ? (this.canBeLoaded = true)
      : (this.canBeLoaded = false);
    this.tableEvents();

    // console.log(this.state.activeFilters);
  }

  debounceFilter(filter) {
    clearTimeout(this.filterTimer);
    this.filterTimer = setTimeout(() => {
      this.filter(filter);
    }, 500);
  }

  prepareItems() {
    this.rows = document.querySelectorAll(".table__row");
    this.items = document.querySelectorAll(".table__item");
    this.checkboxes = document.querySelectorAll(".compare-checkbox");
    this.addDetails = document.querySelectorAll(".tab__info--arrow");
    // console.log(this.rows);
  }

  rowEvents() {
    //Event listeners for rows
    this.rows.forEach((row) => {
      row.onclick = (e) => {
        let targetRow = e.target.closest(".table__row");
        let isActiveRow = $(targetRow).hasClass("active");

        if (isActiveRow) {
          this.hideRows();
          $(targetRow)
            .removeClass("active")
            .next(".table__tab")
            .addClass("hidden");
        } else {
          this.hideRows();
          $(targetRow)
            .addClass("active")
            .next(".table__tab")
            .removeClass("hidden");
        }
      };
    });

    //Event listeners for additional details arrows
    this.addDetails.forEach((arrow) => {
      arrow.onclick = (e) => {
        $(e.target)
          .toggleClass("rotate")
          .closest(".tab__details")
          .next(".tab__add-details")
          .slideToggle();
      };
    });

    // Checkboxes
    this.checkboxes.forEach((checkbox) => {
      checkbox.onclick = () => {
        let count = this.filterCheckboxes().length;
        this.compareBtnCount.innerText = count;
      };
    });
  }

  hideRows() {
    this.rows.forEach((row) => {
      $(row).removeClass("active").next(".table__tab").addClass("hidden");
    });
  }

  filterCheckboxes() {
    let result = [...this.items].filter(
      (el) => el.querySelector(".compare-checkbox").checked
    );
    return result;
  }

  filterFeatured() {
    let featured = [...this.items].filter(
      (el) => el.dataset.featured == "true"
    );
    return featured;
  }

  getVars() {
    this.priceMin = document.getElementById("price-slider-1").value;
    this.priceMax = document.getElementById("price-slider-2").value;
    this.caratMin = document.getElementById("carat-slider-1").value;
    this.caratMax = document.getElementById("carat-slider-2").value;
    this.colorMin = document.getElementById("color-slider-1").value;
    this.colorMax = document.getElementById("color-slider-2").value;
    this.cutMin = document.getElementById("cut-slider-1").value;
    this.cutMax = document.getElementById("cut-slider-2").value;
    this.clarityMin = document.getElementById("clarity-slider-1").value;
    this.clarityMax = document.getElementById("clarity-slider-2").value;
    this.lwMin = document.getElementById("lw-ratio-slider-1").value;
    this.lwMax = document.getElementById("lw-ratio-slider-2").value;
    this.polishMin = document.getElementById("polish-slider-1").value;
    this.polishMax = document.getElementById("polish-slider-2").value;
    this.tableMin = document.getElementById("table-slider-1").value;
    this.tableMax = document.getElementById("table-slider-2").value;
    this.fluorMin = document.getElementById("fluor-slider-1").value;
    this.fluorMax = document.getElementById("fluor-slider-2").value;
    this.symMin = document.getElementById("symmetry-slider-1").value;
    this.symMax = document.getElementById("symmetry-slider-2").value;
    this.depthMin = document.getElementById("depth-slider-1").value;
    this.depthMax = document.getElementById("depth-slider-2").value;
    this.getShapes();
    this.getReport();
  }

  getShapes() {
    let checked = document.querySelectorAll(
      ".filters__shape fieldset input:checked"
    );
    let selection = [];
    checked.forEach(function (shape) {
      selection.push(shape.value);
    });

    this.shapes = selection;
  }

  getReport() {
    let checked = document.querySelectorAll(
      ".filters__report fieldset input:checked"
    );
    let selection = [];
    checked.forEach(function (shape) {
      selection.push(shape.value);
    });

    this.report = selection;
  }

  showLoader() {
    this.loader.classList.remove("hidden");
    this.isLoaderVisible = true;
    // this.canBeLoaded = false;
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

  setState() {
    this.state = {
      shape: this.shapes,
      priceMin: this.priceMin,
      priceMax: this.priceMax,
      caratMin: this.caratMin,
      caratMax: this.caratMax,
      colorMin: this.colorMin,
      colorMax: this.colorMax,
      cutMin: this.cutMin,
      cutMax: this.cutMax,
      clarityMin: this.clarityMin,
      clarityMax: this.clarityMax,
      report: this.report,
      lwMin: this.lwMin,
      lwMax: this.lwMax,
      polishMin: this.polishMin,
      polishMax: this.polishMax,
      tableMin: this.tableMin,
      tableMax: this.tableMax,
      fluorMin: this.fluorMin,
      fluorMax: this.fluorMax,
      symMin: this.symMin,
      symMax: this.symMax,
      depthMin: this.depthMin,
      depthMax: this.depthMax,
    };
  }

  toggleBtnClass(e) {
    if (e.target.nodeName == "BUTTON" || e.target.nodeName == "SPAN") {
      $(this.btns).removeClass("active");
      $(e.target).closest("button").addClass("active");
    }
  }

  toggleSort(e) {
    if (
      e.target.nodeName == "IMG" ||
      e.target.nodeName == "SPAN" ||
      e.target.nodeName == "DIV"
    ) {
      $(e.target)
        .closest("div")
        .find(".arrow-icon")
        .toggleClass("rotate-sort")
        .toggleClass("sorted");
    }
  }

  directionSort(e) {
    let direction = $(e.target)
      .closest("div")
      .find(".arrow-icon")
      .hasClass("sorted")
      ? "desc"
      : "asc";
    return direction;
  }

  getProducts() {
    // console.log(this.activeFilters);
    this.canBeLoaded = true;
    this.showLoader();

    const axios = require("axios").default;

    const bodyFormData = new FormData();

    bodyFormData.append("page", this.page);
    bodyFormData.append("action", "agada_filter_function");

    if (this.activeFilters.includes("shape")) {
      let shapes = [...this.state.shape];
      shapes.forEach((item) => {
        bodyFormData.append("shape[]", item);
      });
    }

    if (this.activeFilters.includes("price")) {
      bodyFormData.append("priceMin", this.state.priceMin);
      bodyFormData.append("priceMax", this.state.priceMax);
    }
    if (this.activeFilters.includes("carat")) {
      bodyFormData.append("caratMin", this.state.caratMin);
      bodyFormData.append("caratMax", this.state.caratMax);
    }
    if (this.activeFilters.includes("lw")) {
      bodyFormData.append("lwMin", this.state.lwMin);
      bodyFormData.append("lwMax", this.state.lwMax);
    }
    if (this.activeFilters.includes("table")) {
      bodyFormData.append("tableMin", this.state.tableMin);
      bodyFormData.append("tableMax", this.state.tableMax);
    }
    if (this.activeFilters.includes("depth")) {
      bodyFormData.append("depthMin", this.state.depthMin);
      bodyFormData.append("depthMax", this.state.depthMax);
    }
    if (this.activeFilters.includes("color")) {
      bodyFormData.append("colorMin", this.state.colorMin);
      bodyFormData.append("colorMax", this.state.colorMax);
    }
    if (this.activeFilters.includes("cut")) {
      bodyFormData.append("cutMin", this.state.cutMin);
      bodyFormData.append("cutMax", this.state.cutMax);
    }
    if (this.activeFilters.includes("clarity")) {
      bodyFormData.append("clarityMin", this.state.clarityMin);
      bodyFormData.append("clarityMax", this.state.clarityMax);
    }
    if (this.activeFilters.includes("polish")) {
      bodyFormData.append("polishMin", this.state.polishMin);
      bodyFormData.append("polishMax", this.state.polishMax);
    }
    if (this.activeFilters.includes("fluor")) {
      bodyFormData.append("fluorMin", this.state.fluorMin);
      bodyFormData.append("fluorMax", this.state.fluorMax);
    }
    if (this.activeFilters.includes("symmetry")) {
      bodyFormData.append("symMin", this.state.symMin);
      bodyFormData.append("symMax", this.state.symMax);
    }
    if (this.activeFilters.includes("report")) {
      let report = [...this.state.report];
      report.forEach((item) => {
        bodyFormData.append("report[]", item);
      });
    }

    axios
      .post(agadaData.ajaxurl, bodyFormData)
      .then(
        function (response) {
          // your action after success

          this.totalPages = Number(response.headers["total_pages"]);
          this.totalDiamonds = Number(response.headers["total_diamonds"]);
          this.totalFeatured = Number(response.headers["total_featured"]);

          response.data.map((item) => this.generateItems(item));

          this.allBtnCount.innerHTML = this.totalDiamonds;
          this.mostBtnCount.innerHTML = this.filterFeatured().length;

          if (response.data.length == 0) {
            this.table.innerHTML = `<p>${translation_object.noProductsText}</p>`;
            this.mostBtnCount.innerHTML = 0;
          }

          // console.log(response.data);
          // console.log(
          //   `Current page: ${Number(response.headers["current_page"])}`
          // );
          // console.log(`Total pages: ${this.totalPages}`);

          // console.log(`Total diamonds: ${this.totalDiamonds}`);
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
          this.hideLoader();
          this.page >= this.totalPages
            ? (this.canBeLoaded = false)
            : (this.canBeLoaded = true);

          this.prepareItems();
          this.rowEvents();
        }.bind(this)
      );
  }

  generateItems(item) {
    // console.log(item);
    let tableItem = this.generateTableItemHTML(item);
    this.table.innerHTML += tableItem;
    this.prepareItems();
    this.rowEvents();
  }

  generateTableItemHTML(item) {
    //Variables
    let diamond = item.title;
    let price = item.price;
    let link = item.permalink;
    let image = item.image;
    //Vars from attributes
    let btn_text = translation_object.btn_text;
    let cut_label = translation_object.cut_label;
    let cut = item.cut;
    let girdle_label = translation_object.girdle_label;
    let girdle = item.girdle;
    let origin_label = translation_object.origin_label;
    let origin = item.origin;
    let fluor_label = translation_object.fluor_label;
    let fluor = item.fluorescence;
    // let gemstone = item.attributes.find((x) => x.name === "Gemstone")
    //   .options[0];
    let culet_label = translation_object.culet_label;
    let culet = item.culet;
    let polish_label = translation_object.polish_label;
    let polish = item.polish;
    // let shape_label = translation_object.shape_label;
    let shape = item.shape;
    let symmetry_label = translation_object.symmetry_label;
    let symmetry = item.symmetry;

    //Vars from ACF
    let carat_label = translation_object.carat_label;
    let carat = item.carat;
    let color_label = translation_object.color_label;
    let color = item.color;
    let clarity_label = translation_object.clarity_label;
    let clarity = item.clarity;
    let measurements_label = translation_object.measurements_label;
    let length = item.diamond_length;
    let width = item.diamond_width;
    let height = item.diamond_height;
    let table_label = translation_object.table_label;
    let table = item.table;
    let depth_label = translation_object.depth_label;
    let depth = item.depth;
    let lw_label = translation_object.lw_label;
    let lwratio = item.lw;
    let report_label = translation_object.report_label;
    // let report = item.meta_data.find((x) => x.key === "report").value;
    let report = item.report;

    let add_details_label = translation_object.add_details_label;
    let delivery_label = translation_object.delivery_label;
    let shape_en = item.shape_en;
    let shape_icon;

    let featured = item.featured;

    switch (shape_en) {
      case "Asscher":
        shape_icon =
          agadaData.siteURL +
          "/wp-content/themes/agada/img/diamonds/table/diamond-icons/asscher.svg";
        break;

      case "Baguette":
        shape_icon =
          agadaData.siteURL +
          "/wp-content/themes/agada/img/diamonds/table/diamond-icons/baguette.svg";
        break;

      case "Cushion":
        shape_icon =
          agadaData.siteURL +
          "/wp-content/themes/agada/img/diamonds/table/diamond-icons/cushion.svg";
        break;

      case "Emerald":
        shape_icon =
          agadaData.siteURL +
          "/wp-content/themes/agada/img/diamonds/table/diamond-icons/emerald.svg";
        break;

      case "Heart":
        shape_icon =
          agadaData.siteURL +
          "/wp-content/themes/agada/img/diamonds/table/diamond-icons/heart.svg";
        break;

      case "Marquise":
        shape_icon =
          agadaData.siteURL +
          "/wp-content/themes/agada/img/diamonds/table/diamond-icons/marquise.svg";
        break;

      case "Oval":
        shape_icon =
          agadaData.siteURL +
          "/wp-content/themes/agada/img/diamonds/table/diamond-icons/oval.svg";
        break;

      case "Pear":
        shape_icon =
          agadaData.siteURL +
          "/wp-content/themes/agada/img/diamonds/table/diamond-icons/pear.svg";
        break;

      case "Princess":
        shape_icon =
          agadaData.siteURL +
          "/wp-content/themes/agada/img/diamonds/table/diamond-icons/princess.svg";
        break;

      case "Radiant":
        shape_icon =
          agadaData.siteURL +
          "/wp-content/themes/agada/img/diamonds/table/diamond-icons/radiant.svg";
        break;

      case "Round":
        shape_icon =
          agadaData.siteURL +
          "/wp-content/themes/agada/img/diamonds/table/diamond-icons/round.svg";
        break;

      case "Taper":
        shape_icon =
          agadaData.siteURL +
          "/wp-content/themes/agada/img/diamonds/table/diamond-icons/taper.svg";
        break;

      case "Trapezoid":
        shape_icon =
          agadaData.siteURL +
          "/wp-content/themes/agada/img/diamonds/table/diamond-icons/trapezoid.svg";
        break;

      case "Triangle":
        shape_icon =
          agadaData.siteURL +
          "/wp-content/themes/agada/img/diamonds/table/diamond-icons/triangle.svg";
        break;
      default:
        shape_icon =
          agadaData.siteURL +
          "/wp-content/themes/agada/img/diamonds/table/diamond-icons/round.svg";
    }

    return `
    <div class="table__item" data-shape=${shape_en} data-price=${price} data-featured=${featured}>

      <div class="table__row">

        <div class="table__data table__data--view">
            <img 
            src='${shape_icon}' 
            alt='agada-diamonds-table' 
            class="table__img diamond-icon"
          >
            <img 
            src='${
              agadaData.siteURL +
              "/wp-content/themes/agada/img/diamonds/table/video-icon.svg"
            }' 
            alt='agada-diamonds-table' 
            class="table__img video-icon"
          >
            <img 
            src='${
              agadaData.siteURL +
              "/wp-content/themes/agada/img/diamonds/table/arrow-down.svg"
            }' 
            alt='agada-diamonds-table' 
            class="table__img arrow-icon"
          >
        </div>

        <div class="table__data table__data--compare">
          <label class="checkmark-container">
            <input type="checkbox" name="compare" class="compare-checkbox"> 
            <span class="checkmark"></span>
          </label>
        </div>

        <div class="table__data table__data--shape">${shape}</div>
        <div class="table__data table__data--price">$${price}</div>
        <div class="table__data table__data--carat">${carat}</div>
        <div class="table__data table__data--cut">${cut}</div>
        <div class="table__data table__data--color">${color}</div>
        <div class="table__data table__data--clarity">${clarity}</div>
        <div class="table__data table__data--report">${report}</div>

      </div>
      
  <div class="table__tab tab hidden">
  <div class="tab__img">
    <img 
        src='${image ? image : ""}' 
        alt='agada-diamonds-table' 
        class="tab__img"
      >
  </div>

  <div class="tab__content">
    <h3 class="tab__title">${diamond}</h3>
    <div class="tab__details">
      <div class="tab__info">
        <p class="tab__info--price">$<span>${price}</span></p>
        <p class="tab__info--carat">${carat_label}&nbsp;<span>${carat}</span></p>
        <p class="tab__info--cut">${cut_label}&nbsp;<span>${cut}</span></p>
        <p class="tab__info--color">${color_label}&nbsp;<span>${color}</span></p>
        <p class="tab__info--clarity">${clarity_label}&nbsp;<span>${clarity}</span></p>
        <p class="tab__info--additional"><span>${add_details_label}</span>
          <span>
            <img 
            src='${
              agadaData.siteURL +
              "/wp-content/themes/agada/img/diamonds/table/add-arrow.svg"
            }' 
            alt='agada-diamonds-details' 
            class="tab__info--arrow"
            >
          </span>
        </p>
        

      </div>

      <div class="tab__link">
        <a href="${link}" class="tab__btn">${btn_text}</a>
      </div>
    </div>
    <div class="tab__add-details hidden">
    <div class="tab__info--grid">

          <div class="tab__info--lw">${lw_label}&nbsp;<br><span>${lwratio}</span></div>

          <div class="tab__info--fluor">${fluor_label}&nbsp;<br><span>${fluor}</span></div>

          <div class="tab__info--sym">${symmetry_label}&nbsp;<br><span>${symmetry}</span></div>

          <div class="tab__info--table">${table_label}<br><span>${table}%</span></div>

          <div class="tab__info--origin">${origin_label}&nbsp;<br><span>${origin}</span></div>

          <div class="tab__info--meas">${measurements_label}&nbsp;<br><span>
          ${length}mm x ${width}mm x ${height}mm
          </span></div>

          <div class="tab__info--culet">${culet_label}&nbsp;<br><span>
          ${culet}
          </span></div>

          <div class="tab__info--polish">${polish_label}&nbsp;<br><span>
          ${polish}
          </span></div>

          <div class="tab__info--girdle">${girdle_label}&nbsp;<br><span>
          ${girdle}
          </span></div>

          <div class="tab__info--depth">
          ${depth_label}&nbsp;<br><span>
          ${depth}%</span></div>

          <div class="tab__info--report">
          ${report_label}&nbsp;<br><span>
          ${report}
          </span></div>

          <div class="tab__info--created">
          ${delivery_label}&nbsp;<br>
          <span>Wednesday, May 18</span></div>

        </div>
    </div>
    
  </div>

    </div>
  `;
  }
}

export default Diamonds;
