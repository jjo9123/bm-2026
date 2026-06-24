<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge;chrome=1" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://use.typekit.net/rbe3fzj.css">
  <link rel="stylesheet" href="https://use.typekit.net/naz3qki.css">
  <style>
@import url('https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,700;1,700&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap');
</style>


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

  <script type="text/javascript" src="/wp-content/themes/bm/theme/js/jquery.lazy.min.js"></script>
  <script type="text/javascript" src="/wp-content/themes/bm/theme/js/jquery.lazy.plugins.min.js"></script>
  <!--<script type='text/javascript' src='https://www.blakemorgan.co.uk/wp-content/themes/bm/theme/js/b4st.js'></script>-->

  <!-- Google Tag Manager -->
  <script data-cookieconsent="ignore">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
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

<script>
jQuery(function() {
  jQuery('.lazy1').lazy({
    scrollDirection: 'vertical',
    effect: 'fadeIn',
    visibleOnly: true
  });
});

</script>


<nav id="navbar" class="navbar navbar-expand-md navbar-light bg-light">
  <div class="container">


        <!-- <?php b4st_navbar_brand();?> -->

        <a class="navbar-brand" href="<?php echo esc_url( home_url('/') ); ?>">
          <!--<img 
            src="<?php echo esc_url( get_template_directory_uri() ); ?>/theme/img/BM_Logo_white.svg"
            alt="Blake Morgan Logo"
            width="120"
          >-->
          <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/theme/img/BM_Pride_Web_WO-01.png" alt="Blake Morgan Pride Logo" width="120px">
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
          <!--<div class="nav-search">
              <button class="nav-search__toggle" type="button"
                      aria-expanded="false" aria-controls="navSearchPanel"
                      aria-label="Open site search">
                <svg class="nav-search__svg" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                  <g clip-path="url(#clip0_8002_162)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M21.6413 20.103L20.0563 21.6312L15.2853 17.0386L16.8703 15.5104L21.6413 20.103ZM8.15308 15.1427C4.60312 14.9711 1.8699 11.9229 2.03972 8.33543C2.20953 4.74794 5.22578 1.98582 8.77573 2.15743C12.2044 2.32904 14.8972 5.18105 14.8972 8.64596C14.8001 12.3152 11.7839 15.2162 8.15308 15.1345V15.1427ZM8.15308 2.90303e-05C3.4225 0.237016 -0.216403 4.29848 0.0100182 9.07907C0.236439 13.8597 4.26349 17.5371 8.99407 17.3082C13.5548 17.0794 17.1452 13.2795 17.1452 8.6623C17.0239 3.75913 12.9969 -0.114378 8.15308 2.90303e-05Z" fill="#AF8D41"/>
                  </g>
                  <defs>
                    <clipPath id="clip0_8002_162">
                      <rect width="21.6393" height="21.6393" fill="white"/>
                    </clipPath>
                  </defs>
                </svg>
              </button>

              <div id="navSearchPanel" class="nav-search__panel" hidden>
                <div role="search" aria-label="Site search">
                  <?php // echo do_shortcode('[searchandfilter id="5671"]'); ?>
                </div>
              </div>
            </div>-->





  </div>
</nav>

<?php b4st_navbar_after();?>
