jQuery(document).ready(function ($) {
  var body = $("body"),
    head = $(".header"),
    product = $(".container-product"),
    minicart = $(".minicart-container"),
    overlay = $(".corsivalab-overlay"),
    menuSidebar = $(".menu-mobile-sidebar");

  // Mobile menu
  var navToggle = $(".header .navbar-toggle"),
    navOverlay = $(".navbar-overlay");
  navToggle.on("click", function (e) {
    //$(this).toggleClass('open');
    body.toggleClass("navbarmobile-is-active");
  });
  navOverlay.on("click", this, function (e) {
    navToggle.trigger("click");
  });
  // end mobile menu
  body.on("click", ".search-icon img", function (e) {
    e.preventDefault();
    $(".search-icon").toggleClass("active");
  });

  $(".count").each(function () {
    $(this)
      .prop("Counter", 0)
      .animate(
        {
          Counter: $(this).text(),
        },
        {
          duration: 10000,
          easing: "swing",
          step: function (now) {
            $(this).text(Math.ceil(now));
          },
        }
      );
  });
  // $(".close-sidebar-setion").on("click", ".close-btn", function (e) {
  //   e.preventDefault();
  //   if (cartSidebar.hasClass("active")) {
  //     cartSidebar.removeClass("active");
  //   }
  // });
  function topbar_swiper() {
    var topbar_swiper = new Swiper(".top-header .swiper", {
      // slidesPerView: 3,
      roundLengths: true,
      loop: true,
      slidesPerView: "auto",
      centeredSlides: true,
      spaceBetween: 30,
      // loopAdditionalSlides: 30,
      // navigation: {
      //   nextEl: ".swiper-button-next",
      //   prevEl: ".swiper-button-prev",
      // },
    });
  }
  function home_slide_swiper() {
    var home_slide_swiper = new Swiper(".banner-slide-container .swiper", {
      slidesPerView: 1,
      // roundLengths: true,
      // loop: true,
      // slidesPerView: "auto",
      // centeredSlides: true,
      // spaceBetween: 30,
      // loopAdditionalSlides: 30,
      pagination: {
        el: ".swiper-pagination",
      },
      // navigation: {
      //   nextEl: ".swiper-button-next",
      //   prevEl: ".swiper-button-prev",
      // },
    });
  }
  function home_posts_swiper() {
    var home_posts_swiper = new Swiper(".posts-carousel .swiper", {
      loop: true,
      spaceBetween: 30,
      slidesPerView: 2,
      navigation: {
        nextEl: ".swiper-button-next-unique",
        prevEl: ".swiper-button-prev-unique",
      },
    });
  }
  function our_team_swiper() {
    var our_team_swiper = new Swiper(".ourteam-carousel .swiper", {
      loop: true,
      spaceBetween: 30,
      slidesPerView: 6,
      freeMode: true,
      centeredSlides: true,
    });
  }
  function fancybox_init() {
    Fancybox.bind("[data-fancybox]", {
      // Your custom options
    });
  }
  function categories_shop_swiper() {
    if ($(".categories-slide-inner").length) {
      var categories_shop_swiper = new Swiper(
        ".categories-slide-inner .swiper",
        {
          loop: true,
          spaceBetween: 30,
          slidesPerView: 7,
          navigation: {
            nextEl: ".swiper-button-next-unique",
            prevEl: ".swiper-button-prev-unique",
          },
        }
      );
    }
  }

  function overlay_active() {
    overlay.addClass("active");
    body.addClass("overflow-hidden");
  }
  function overlay_deactivate() {
    overlay.removeClass("active");
    body.removeClass("overflow-hidden");
  }

  function overlay_trigger() {
    body.on("click", ".corsivalab-overlay.active", function () {
      $(".filter-container").removeClass("active");
      minicart.removeClass("active");
      overlay_deactivate();
    });
  }

  function filter_init() {
    product.on("click", ".filter-btn", function () {
      var $this = $(this);
      $this.next().addClass("active");
      overlay_active();
    });

    product.on("click", ".close-filter", function () {
      var $this = $(this);
      $(".filter-container").removeClass("active");
      overlay_deactivate();
    });
  }

  function minicart_init() {
    head.on("click", ".cart-icon", function () {
      minicart.addClass("active");
      overlay_active();
    });

    head.on("click", ".close-minicart", function () {
      minicart.removeClass("active");
      overlay_deactivate();
    });
  }

  home_posts_swiper();
  home_slide_swiper();
  topbar_swiper();
  our_team_swiper();
  categories_shop_swiper();
  fancybox_init();
  filter_init();
  minicart_init();
  overlay_trigger();
});
