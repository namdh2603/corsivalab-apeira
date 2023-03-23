jQuery(document).ready(function ($) {
  var body = $("body"),
    menuSidebar = $(".menu-mobile-sidebar");
  // $(".quantity").on("click", "button.plus, button.minus", function () {
  //   // Get current quantity values
  //   var qty = $(this).closest(".quantity").find(".qty");
  //   var val = parseFloat(qty.val());
  //   var max = parseFloat(qty.attr("max"));
  //   var min = parseFloat(qty.attr("min"));
  //   var step = parseFloat(qty.attr("step"));
  //   // Change the value if plus or minus
  //   if ($(this).is(".plus")) {
  //     if (max && max <= val) {
  //       qty.val(max);
  //     } else {
  //       qty.val(val + step);
  //     }
  //   } else {
  //     if (min && min >= val) {
  //       qty.val(min);
  //     } else if (val > 1) {
  //       qty.val(val - step);
  //     }
  //   }
  //   $(".update-cart").removeAttr("disabled");
  // });
  // $(".up-icon img").on("click", function () {
  //   $("html, body").animate({ scrollTop: $("#top").offset().top }, 500);
  //   return false;
  // });
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
  $("#btn-sidebar-expend").click(function () {
    $(".sidebar-product").toggleClass("active");
    if ($(".sidebar-product").hasClass("active")) {
      $("#btn-sidebar-expend").text("Close");
    } else {
      $("#btn-sidebar-expend").text("Filter");
    }
  });
  var image_promotion = $(".image-promotion").height();
  var inner_promotion = $(".inner-promotion").height();
  var content_promotion = image_promotion - 80;
  if (content_promotion <= inner_promotion) {
    $(".inner-promotion").height(content_promotion + "px");
  } else {
    $(".inner-promotion").removeClass("style-3");
    $(".inner-promotion").removeClass("active-scroll");
  }
  $(".middle-header").on("click", ".button-burger", function (e) {
    e.preventDefault();
    menuSidebar.toggleClass("active");
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
  home_posts_swiper();
  home_slide_swiper();
  topbar_swiper();
  our_team_swiper();
  fancybox_init();
});
