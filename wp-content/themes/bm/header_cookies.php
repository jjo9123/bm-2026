<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.typekit.net/rbe3fzj.css">

  <?php if (get_field('sector') == 'org'): ?>
    <script data-cookieconsent="ignore">
      var dataLayer = window.dataLayer || [];
      dataLayer.push({
        "sector": "Organisations"
      });
    </script>
  <?php elseif (get_field('sector') == 'ind'): ?>
    <script data-cookieconsent="ignore">
      var dataLayer = window.dataLayer || [];
      dataLayer.push({
        "sector": "Individuals"
      });
    </script>
  <?php endif; ?>

  <?php wp_head(); ?>
  <script type='text/javascript' src='https://www.blakemorgan.co.uk/wp-content/plugins/search-filter-pro/public/assets/js/search-filter-build.min.js'></script>
  <script type='text/javascript' src='https://www.blakemorgan.co.uk/wp-content/plugins/search-filter-pro/public/assets/js/chosen.jquery.min.js'></script>
  <script type='text/javascript' src='/wp-content/themes/bm/theme/js/slick.min.js'></script>
  <script type='text/javascript' src='https://www.blakemorgan.co.uk/wp-content/themes/bm/theme/js/b4st.js'></script>

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

  <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="ee989279-a08f-4195-bd3f-418ca9f881f2" data-blockingmode="auto" type="text/javascript"></script>


</head>
<script type='text/javascript' src='https://www.blakemorgan.co.uk/wp-content/themes/bm/theme/js/slick.min.js'></script>

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

<nav id="navtop" class="navbar navbar-expand-md">
  <div class="container">
    <div class="row ml-auto">
        <div class="col-12">

            <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarDropdown" aria-controls="navbarDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button> -->

            <div class="topnav d-flex">
              <?php
                wp_nav_menu( array(
                  'theme_location'  => 'top',
                  'container'       => false,
                  'menu_class'      => '',
                  'fallback_cb'     => '__return_false',
                  'items_wrap'      => '<ul id="%1$s" class="navbar-nav mr-auto mt-2 mt-lg-0 %2$s">%3$s</ul>',
                  'depth'           => 4,
                  'walker'          => new b4st_walker_nav_menu2()
                ) );
              ?>

              <?php echo do_shortcode('[searchandfilter id="5671"]'); ?>
            </div>

        </div>
      </div>
  </div>
</nav>

<nav id="navbar" class="navbar navbar-expand-md navbar-light bg-light">
  <div class="container">


        <!-- <?php b4st_navbar_brand();?> -->

        <a class="navbar-brand" href="<?php echo esc_url( home_url('/') ); ?>">
          <img src="/wp-content/themes/bm/theme/img/bmfooter-logo.png" alt="Blake Morgan Logo" width="120px">
        </a>



        <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarDropdown" aria-controls="navbarDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button> -->


         <?php
            wp_nav_menu( array(
              'theme_location'  => 'navbar',
              'container'       => false,
              'menu_class'      => '',
              'fallback_cb'     => '__return_false',
              'items_wrap'      => '<ul id="%1$s" class="navbar-nav mr-auto mt-2 mt-lg-0 %2$s">%3$s</ul>',
              'depth'           => 4,
              'walker'          => new b4st_walker_nav_menu()
            ) );
          ?>




  </div>
</nav>

<?php b4st_navbar_after();?>
