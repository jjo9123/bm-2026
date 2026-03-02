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

  // ---- Slick init (run once per element) ----
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

    // CTA banner bg updates
    $("section.cta-banner.slider .home-slider").each(function () {
      var $s = $(this);
      $s.on("init afterChange", function () {
        setCtaBannerBg($s);
      });
      if ($s.hasClass("slick-initialized")) setCtaBannerBg($s);
    });

    // Reduce "Blocked aria-hidden..." warnings:
    // If focus is inside a slide when Slick hides it, move focus to the new active slide.
    $(".quotes-slider, .highlights-slider, .home-slider").on("afterChange", function (e, slick, current) {
      if (!slick || !slick.$slides || typeof current !== "number") return;
      $(slick.$slides[current]).attr("tabindex", "-1").trigger("focus");
    });

    // If anything changes layout after load, this helps prevent insane widths.
    $(window).on("resize orientationchange", function () {
      $(".home-slider.slick-initialized, .quotes-slider.slick-initialized, .highlights-slider.slick-initialized")
        .slick("setPosition");
    });
  });

  // ---- Your existing DOMReady stuff ----
  $(document).ready(function () {
    var a;
    var b = document.getElementById("pojo-a11y-toolbar");
    if (b) b.setAttribute("aria-label", "Accessibility Toolbar");

    $(".commentlist li").addClass("card mb-3");
    $(".comment-reply-link").addClass("btn btn-secondary");
    $("select, input[type=text], input[type=email], input[type=password], textarea").addClass("form-control");
    $("input[type=submit]").addClass("btn btn-primary");
    $(".pagination .dots").addClass("page-link").parent().addClass("disabled");

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

    var c = $(".nav-search__toggle"),
      d = $("#navSearchPanel");

    function closeNavSearch() {
      d.attr("hidden", true);
      c.attr("aria-expanded", "false");
    }

    if (c.length && d.length) {
      c.on("click", function (e) {
        e.preventDefault();
        if (d.is("[hidden]")) {
          d.removeAttr("hidden");
          c.attr("aria-expanded", "true");
          d.find("input, select, textarea, button").first().focus();
        } else {
          closeNavSearch();
        }
      });

      $(document).on("click", function (e) {
        if (
          !d.is("[hidden]") &&
          !c.is(e.target) &&
          !c.has(e.target).length &&
          !d.is(e.target) &&
          !d.has(e.target).length
        ) {
          closeNavSearch();
        }
      });

      $(document).on("keydown", function (e) {
        if (e.key === "Escape") closeNavSearch();
      });
    }

    function bindTextareaCounters() {
      $("textarea[data-maxlength]").each(function () {
        var $t = $(this);
        if ($t.hasClass("counter-bound")) return;

        var max = parseInt($t.data("maxlength"), 10);
        if (isNaN(max)) return;

        // NOTE: your original code had "$el.textareaCount" which looks like a bug.
        // I'm keeping the intent, but calling it on the textarea itself:
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