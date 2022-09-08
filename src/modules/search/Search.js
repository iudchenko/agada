class Search {
  constructor() {
    this.searchFormPrimary = document.querySelector(
      "#primary-menu .main-search"
    );
    this.searchFormMobile = document.querySelector("#mobile-menu .main-search");
    this.searchBtns = document.querySelectorAll(".menu__search");
    this.searchEvents();
  }

  searchEvents() {
    this.searchBtns.forEach((btn) => {
      btn.onclick = (e) => {
        // Desktop
        this.showHideSearchBox(this.searchFormPrimary);
        // Mobile
        if (window.outerWidth < 992) {
          this.showHideSearchBox(this.searchFormMobile);
        }
      };
    });
  }

  showHideSearchBox(form) {
    // Desktop
    if (form.classList.contains("hidden")) {
      form.classList.remove("hidden");
      setTimeout(
        function () {
          form.querySelector(".searchform__input").focus();
        }.bind(this),
        301
      );
    } else {
      form.classList.add("hidden");
    }
  }
}

export default Search;
