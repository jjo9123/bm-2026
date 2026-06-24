<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.typekit.net/rbe3fzj.css">
  <link rel="stylesheet" href="https://use.typekit.net/naz3qki.css">
  <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="ee989279-a08f-4195-bd3f-418ca9f881f2" type="text/javascript" data-blockingmode="auto"></script>
  <?php wp_head(); ?>

  <?php if (get_field('sector') == 'org'): ?>
    <script>
      var dataLayer = window.dataLayer || [];
      dataLayer.push({
        "sector": "Organisations"
      });
    </script>
  <?php elseif (get_field('sector') == 'ind'): ?>
    <script>
      var dataLayer = window.dataLayer || [];
      dataLayer.push({
        "sector": "Individuals"
      });
    </script>
  <?php endif; ?>

  <script data-cookieconsent="ignore">
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag("consent", "default", {
        ad_storage: "denied",
        analytics_storage: "denied",
        wait_for_update: 500,
    });
    gtag("set", "ads_data_redaction", true);
  </script>

  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-52S53FM');</script>
  <!-- End Google Tag Manager -->
</head>

<body <?php body_class(); ?>>

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-52S53FM"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

<?php b4st_navbar_before();?>
<style>
body #quadmenu {
  background-color: transparent!important;
  color: #47484b!important;
  width: 100%;
}
body #quadmenu.quadmenu-default_theme .quadmenu-navbar-nav > li:not(.quadmenu-item-type-button) > a > .quadmenu-item-content {
  color: #47484b!important;
}
#quadmenu.quadmenu-default_theme .quadmenu-navbar-nav > li:not(.quadmenu-item-type-button).quadmenu-has-link:hover, #quadmenu.quadmenu-default_theme .quadmenu-navbar-nav > li:not(.quadmenu-item-type-button).quadmenu-has-link.open {
  border-bottom: 2px solid #a2c754;
  background-color: none!important;
}

/* test */
.dropdown-submenu {
  position: relative;
}

.dropdown-submenu a::after {
  transform: rotate(-90deg);
  position: absolute;
  right: 6px;
  top: .8em;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  left: 100%;
  margin-left: .1rem;
  margin-right: .1rem;
}
</style>

<nav id="navbar" class="navbar navbar-expand-md navbar-light bg-light">
  <div class="container">


        <!-- <?php b4st_navbar_brand();?> -->

        <a class="navbar-brand" href="<?php echo esc_url( home_url('/') ); ?>">
          <img 
            src="<?php echo esc_url( get_template_directory_uri() ); ?>/theme/img/BM_Logo_white.svg"
            alt="Blake Morgan Logo"
            width="120"
          >
        </a>


  </div>
</nav>

<?php b4st_navbar_after();?>
