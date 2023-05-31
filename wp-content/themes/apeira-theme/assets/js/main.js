jQuery(document).ready(function ($) {
  var body = $("body"),
    head = $(".header"),
    product = $(".container-product"),
    minicart = $(".minicart-container"),
    overlay = $(".corsivalab-overlay"),
    navToggle = $(".header .navbar-toggle"),
    menuSidebar = $(".menu-mobile-sidebar");
  // Mobile menu
  navToggle.on("click", function (e) {
    //$(this).toggleClass('open');
    body.toggleClass("navbarmobile-is-active");
    overlay_active();
  });
  overlay.on("click", this, function (e) {
    navToggle.trigger("click");
    // overlay_deactivate();
    // body.removeClass("navbarmobile-is-active");
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
  // e.preventDefault();
  // if (cartSidebar.hasClass("active")) {
  // cartSidebar.removeClass("active");
  // }
  // });
  function topbar_swiper() {
    var topbar_swiper = new Swiper(".top-header .swiper", {
      // slidesPerView: 4,
      // roundLengths: true,
      // loop: true,
      // slidesPerView: "auto",
      // centeredSlides: true,
      // spaceBetween: 30,
      loop: true,
      slidesPerView: 1,
      spaceBetween: 30,
      freeMode: true,
      centeredSlides: true,
      speed: 6000,
      allowTouchMove: false,
      autoplay: {
        delay: 0,
        disableOnInteraction: false,
        // reverseDirection: true,
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 50,
        },
      },
      // loopAdditionalSlides: 30,
      // navigation: {
      // nextEl: ".swiper-button-next",
      // prevEl: ".swiper-button-prev",
      // },
    });
  }
  function menu_mobile_func() {
	  $(".navbar-mobile").on("click", ".arrow", function (e) {
  e.preventDefault();
		  console.log('check');
		  var $this = $(this);
		  $this.parent().next().toggle('slow');
	  });
  }
  function topbar_ticker() {}
  function home_slide_swiper() {
    var home_slide_swiper = new Swiper(".banner-slide-container .swiper", {
      effect: "fade",
      speed: 2000,
      slidesPerView: 1,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      // roundLengths: true,
      // loop: true,
      // slidesPerView: "auto",
      // centeredSlides: true,
      // spaceBetween: 30,
      // loopAdditionalSlides: 30,
      autoplay: {
        delay: 4000,
      },
      // navigation: {
      // nextEl: ".swiper-button-next",
      // prevEl: ".swiper-button-prev",
      // },
    });
  }
  function home_products_swiper() {
    var home_products_swiper = new Swiper(".products-carousel .swiper", {
      loop: true,
      slidesPerView: 2,
      spaceBetween: 20,
      navigation: {
        nextEl: ".swiper-button-next-unique",
        prevEl: ".swiper-button-prev-unique",
      },
      breakpoints: {
        768: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 4,
          spaceBetween: 20,
        },
      },
    });
  }
	
	  function related_products_swiper() {
    var related_products_swiper = new Swiper(".products-related-carousel .swiper", {
      loop: true,
      slidesPerView: 2,
      spaceBetween: 20,
      navigation: {
        nextEl: ".swiper-button-next-unique",
        prevEl: ".swiper-button-prev-unique",
      },
      breakpoints: {
        768: {
          slidesPerView: 3,
          spaceBetween: 20,
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 20,
        },
      },
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
  function similar_posts_swiper() {
    var similar_posts_swiper = new Swiper("#relatedpost-cat .swiper", {
      loop: true,
      slidesPerView: 2,
      spaceBetween: 30,
      navigation: {
        nextEl: ".swiper-button-next-unique",
        prevEl: ".swiper-button-prev-unique",
      },
      breakpoints: {
        1024: {
          slidesPerView: 3,
          spaceBetween: 30,
        },
      },
    });
  }
  function our_team_swiper() {
    var our_team_swiper = new Swiper(".ourteam-carousel .swiper", {
      loop: true,
      slidesPerView: 3,
      spaceBetween: 23,
      freeMode: true,
      centeredSlides: true,
      breakpoints: {
        768: {
          slidesPerView: 4,
          spaceBetween: 23,
        },
        1024: {
          slidesPerView: 6,
          spaceBetween: 23,
        },
      },
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
          slidesPerView: 3,
          spaceBetween: 30,
          observer: true,
          observeParents: true,
          navigation: {
            nextEl: ".swiper-button-next-unique",
            prevEl: ".swiper-button-prev-unique",
          },
          breakpoints: {
            768: {
              slidesPerView: 4,
              spaceBetween: 30,
            },
            1024: {
              slidesPerView: 7,
              spaceBetween: 30,
            },
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
      body.removeClass("navbarmobile-is-active");
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
    });
    head.on("click", ".close-minicart", function () {
      minicart.removeClass("active");
    });
  }
  function timeline() {
    body.on("click", ".timeline li", function () {
      $(".timeline li").removeClass("active");
      $(this).addClass("active");
      $(".comment-form-field").find("#fit").val($(this).data("fit"));
    });
  }
  function size_calculator() {
    $(".size-calculator input").change(function () {
      // $(this).data("formValues", $(this).val());
      console.log("changed!");
      var inputWeight = $("#inputWeight").val();
      var inputHeight = $("#inputHeight").val();
      $(this)
        .parents(".size-calculator")
        .find(".result")
        .html(inputWeight * inputHeight);
    });
  }
  function countdown_hiden() {
    body.on("click", ".countdown-close", function () {
      var $this = $(this);
      $this.parent().addClass("active");
    });
  }
  function applyModalAutoFill() {
    if ($(".careers-list").length) {
      body.on("click", ".career-btn", function (e) {
        e.preventDefault();
        var $this = $(this);
        var title = $this.data("title");
        // console.log(title);
        $("#sizeApplyModal").find('input[name="your-subject"]').val(title);
      });
    }
  }
  function seeMoreProductShortDesc() {
    if ($(".woocommerce-product-details__short-description").length) {
      // var paragraphCount;
      // paragraphCount = $(".woocommerce-product-details__short-description > p").size();
      // var message_lines = $(".woocommerce-product-details__short-description")[0].getClientRects();
      // var amount_of_lines = message_lines.length;
      // console.log(amount_of_lines);
      //
      var desc = $(".woocommerce-product-details__short-description");
      var height = desc.height();
      var line = height / 10;
      console.log(line);
      if (line > 4) {
        desc.after('<span id="see-more">See more</span>');
        desc.css("height", "4.5rem");
      }
      $("#see-more").click(function () {
        // $(this).prev().slideToggle();
        if ($(this).text() == "See more") {
          $(this).text("See less");
          $(this).prev().animate({ height: height });
        } else {
          $(this).text("See more");
          $(this).prev().animate({ height: "4.5rem" });
        }
      });
    }
  }
	

	function visit_time_popup(){
		var get_Cookies = Cookies.get('wp_visit_time_popup');
		if(!get_Cookies){
			$("#welcomeModal").modal('show');
		}
// 		$('#welcomeModal').on('hidden.bs.modal', function (e) {
		$('#welcomeModal').on('click', '.close', function (e) {
			var day_number = $("#welcomeModal").data('days');
			Cookies.set('wp_visit_time_popup', '1', { expires: day_number });
		});
	}
  // topbar_swiper();
  home_products_swiper();
  home_posts_swiper();
  home_slide_swiper();
  our_team_swiper();
  categories_shop_swiper();
  fancybox_init();
  filter_init();
  minicart_init();
  overlay_trigger();
  // size_calculator();
  similar_posts_swiper();
  timeline();
  applyModalAutoFill();
  countdown_hiden();
  seeMoreProductShortDesc();
	related_products_swiper();
	visit_time_popup();
	menu_mobile_func();
    $('body').on('click', '.js-clicking-side-guide', function(){
        $(this).parents('.side-guide-quick-view').find('.showing-side-guide-quick-view').toggle(300);
    });
});
