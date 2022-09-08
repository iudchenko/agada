// import Diamonds from "./Diamonds";
import $ from "jquery";

class MobileFilters {
  constructor() {
    // super();
    this.mobFiltersBtn = document.querySelector(
      ".lab-diamonds__mobile-filtering"
    );
    this.backBtn = document.querySelector(".lab-diamonds__back span");
    this.filterBtn = document.querySelector(".lab-diamonds__mobile-btn button");
    this.filtersTab = document.querySelector(".lab-diamonds__filters");
    this.main = document.querySelector(".page-template-diamonds main");
    this.isFiltersTabOpen = false;
    this.mobSortList = document.querySelector(
      ".lab-diamonds__mobile-sorting--list"
    );
    this.mobileFiltersEvents();
  }

  mobileFiltersEvents() {
    this.mobFiltersBtn.onclick = (e) => {
      this.toggleOpen();
      this.addAnimate();
      this.mobSortList.classList.add("hidden");
    };

    this.backBtn.onclick = (e) => {
      this.toggleOpen();
    };

    this.filterBtn.onclick = (e) => {
      this.toggleOpen();
      setTimeout(function () {
        $("html, body").animate({ scrollTop: 0 }, "slow");
      }, 300);
    };

    window.onorientationchange = () => {
      this.removeOpen();
      this.removeAnimate();
    };

    // this.main.onclick = (e) => {
    //   if (
    //     this.isFiltersTabOpen &&
    //     !e.target.closest(".lab-diamonds__mobile-filtering") &&
    //     !e.target.closest(".lab-diamonds__filters") &&
    //     e.target != this.backBtn
    //   ) {
    //     this.toggleOpen();
    //   }
    // };
  }

  toggleOpen() {
    this.filtersTab.classList.toggle("open");
    this.main.classList.toggle("overlay");
    this.isFiltersTabOpen = !this.isFiltersTabOpen;
  }
  removeOpen() {
    this.filtersTab.classList.remove("open");
    this.main.classList.remove("overlay");
    this.isFiltersTabOpen = false;
  }

  addAnimate() {
    this.filtersTab.classList.add("animate");
  }
  removeAnimate() {
    this.filtersTab.classList.remove("animate");
  }
}
export default MobileFilters;
