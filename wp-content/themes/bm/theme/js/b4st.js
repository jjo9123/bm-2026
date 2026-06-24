!function ($) {
  "use strict";

  function setCtaBannerBg($s) {
    var $c = $s.find(".slick-slide.slick-current");
    var k = $c.attr("data-bg");
    var bg = "";

    if (k === "bm-pink") bg = "#A93690";
    if (k === "bm-purple") bg = "#340F53";
    if (k === "bm-beige") bg = "#F1EFE6";

    if (bg) $s[0].style.backgroundColor = bg;
  }

  /* ------------------------------
     SLICK INITIALISATION
  ------------------------------ */

  $(window).on("load", function () {

    $(".home-slider").not(".slick-initialized").slick({
      arrows: true,
      dots: true,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 4000
    });

    $(".quotes-slider").not(".slick-initialized").slick({
      arrows: true,
      dots: false,
      infinite: true
    });

    $(".highlights-slider").not(".slick-initialized").slick({
      arrows: true,
      dots: true,
      infinite: true
    });

    /* CTA banner background colour updates */
    $("section.cta-banner.slider .home-slider").each(function () {
      var $s = $(this);
      $s.on("init afterChange", function () {
        setCtaBannerBg($s);
      });
      if ($s.hasClass("slick-initialized")) {
        setCtaBannerBg($s);
      }
    });

    /* ---------------------------------------
       Accessibility focus fix (NO SCROLL JUMP)
       Only moves focus if user is interacting
    --------------------------------------- */

    let sliderHadFocus = false;

    $(".quotes-slider, .highlights-slider, .home-slider")
      .on("focusin", function () {
        sliderHadFocus = true;
      })
      .on("focusout", function () {
        sliderHadFocus = false;
      })
      .on("afterChange", function (e, slick, current) {

        if (!sliderHadFocus) return;
        if (!slick || !slick.$slides || typeof current !== "number") return;

        var el = slick.$slides[current];
        if (el && el.focus) {
          el.setAttribute("tabindex", "-1");
          el.focus({ preventScroll: true });
        }
      });

    /* Recalculate layout on resize */
    $(window).on("resize orientationchange", function () {
      $(".home-slider.slick-initialized, .quotes-slider.slick-initialized, .highlights-slider.slick-initialized")
        .slick("setPosition");
    });

  });


  /* ------------------------------
     DOCUMENT READY
  ------------------------------ */

  $(document).ready(function () {

    var a;
    var b = document.getElementById("pojo-a11y-toolbar");
    if (b) b.setAttribute("aria-label", "Accessibility Toolbar");

    $(".commentlist li").addClass("card mb-3");
    $(".comment-reply-link").addClass("btn btn-secondary");
    $("select, input[type=text], input[type=email], input[type=password], textarea").addClass("form-control");
    $("input[type=submit]").addClass("btn btn-primary");
    $(".pagination .dots").addClass("page-link").parent().addClass("disabled");

    /* Video modal */
    $(".btn-herovid").click(function () {
      a = $(this).data("src");
    });

    $("#myModalvideo").on("shown.bs.modal", function () {
      $(".vimeo").attr("src", a + "?rel=0&showinfo=0&modestbranding=1&autoplay=1");
    });

    $("#myModalvideo").on("hidden.bs.modal", function () {
      $(".vimeo").attr("src", "");
      $("#video").attr("src", a);
    });

    /* Nav search toggle */
    /* Nav search toggle */
$(document).on("click", ".nav-search__toggle", function (e) {
  e.preventDefault();
  e.stopPropagation();

  var $toggle = $(this);
  var $panel = $("#" + $toggle.attr("aria-controls"));

  if ($panel.hasClass("is-open")) {
    $panel.removeClass("is-open").addClass("is-closed");
    $toggle.attr("aria-expanded", "false");
  } else {
    $panel.removeClass("is-closed").addClass("is-open");
    $toggle.attr("aria-expanded", "true");
  }
});

$(document).on("click", ".nav-search__panel", function (e) {
  e.stopPropagation();
});

$(document).on("click", function () {
  $(".nav-search__panel").removeClass("is-open").addClass("is-closed");
  $(".nav-search__toggle").attr("aria-expanded", "false");
});

    /* Gravity Forms textarea counter */
    function bindTextareaCounters() {
      $("textarea[data-maxlength]").each(function () {
        var $t = $(this);
        if ($t.hasClass("counter-bound")) return;

        var max = parseInt($t.data("maxlength"), 10);
        if (isNaN(max)) return;

        if (typeof $t.textareaCount === "function") {
          $t.textareaCount({
            maxCharacterSize: max,
            warningNumber: 20,
            displayFormat: "#input/#max"
          });
        }

        $t.addClass("counter-bound");
      });
    }

    $(document).on("gform_post_render", function () {
      setTimeout(bindTextareaCounters, 200);
    });

  });

}(jQuery);