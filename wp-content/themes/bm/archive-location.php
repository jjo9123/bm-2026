<?php
/**
 * Template Name: Office Listing
 * The static page template.
 *
 * @package    WordPress
 * @subpackage BM
 * @since      BM 1.0
 */

get_header();
b4st_main_before(); ?>

<style>
section.map-section.infographic {
  padding: 40px 0 60px;
}
section.map-section.infographic .infographic-boxes .row {
  -webkit-box-pack: space-evenly;
        -ms-flex-pack: space-evenly;
            justify-content: space-evenly;
    padding: 20px 0 40px;
}
section.map-section.infographic .col-md-5 {
  display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
  margin-bottom: 30px;
  min-height: 250px;
}
section.map-section.infographic .info-box-content {
    padding: 30px 10px;
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    justify-self: center;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    text-align: center;
    position:relative;
}
section.map-section.infographic .info-box-content > a {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  height: 100%;
  width: 100%;
}
section.map-section.infographic .info-box-content p {
  font-size: 1.2rem;
  font-weight: 500;
  text-transform: uppercase;
}
section.map-section.infographic .info-box-content p span {
  font-size: 2rem;
  font-weight: 600;
}


</style>

<main id="main">
  <div id="content" role="main">

    <?php get_template_part('modules/header'); ?>

    <section class="hero text-center" style="background: url('/wp-content/uploads/home/home_hero.jpg') 50% center / cover no-repeat; color: #fff;">

                <div class="container">
                  <div class="row">
                    <div class="col-12">
                      <h1 class="header">Find an office</h1>
                    </div>
                  </div>
                </div>


    </section>


    <section class="txt text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h2 style="color: #a395b7;">About Blake Morgan</h2>

            <hr class="heading green">

            <p>Blake Morgan is a full service law firm with offices across the UK. With 130 partners and 1000 staff we use our unique blend of technical expertise, broader experience and commercial realism to get the best results possible for our clients - be they small businesses, corporates, individuals, families, government, or not for profits.</p>

            <a href="javascript:void(0)" class="btn btn-green header">Contact us for more information</a>
          </div>
        </div>
      </div>
    </section>


    <section class="map-section infographic text-center" style="background: url('/wp-content/uploads/2019/02/offices-img-bg.jpg') 50% / cover no-repeat;">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h2 style="color: #32214c">Blake Morgan in numbers</h2>

            <hr class="heading purple">
                        <p>Blake Morgan is a full service law firm with offices across the UK. With 130 partners and 1000 staff we use our unique blend of technical expertise, broader experience and commercial realism to get the best results possible for our clients - be they small businesses, corporates, individuals, families, government, or not for profits.</p>

          </div>

        <div class="col-md-12 mx-auto infographic-boxes">
          <div class="row">
            <div class="col-md-5 col-lg-4 mx-auto">
              <div class="info-box-content" style="background: url('/wp-content/uploads/2019/02/box-1.jpg') 50% / cover no-repeat; color: #FFFFFF;">
                <a href="#"></a>
                <p><span>Southampton</span></p>
              </div>
            </div>

            <div class="col-md-5 col-lg-4 mx-auto">
              <div class="info-box-content" style="background: url('/wp-content/uploads/2019/02/box-1.jpg') 50% / cover no-repeat; color: #FFFFFF;">
                <a href="#"></a>
                <p><span>Reading</span></p>
              </div>
            </div>

            <div class="col-md-5 col-lg-4 mx-auto">
              <div class="info-box-content" style="background: url('/wp-content/uploads/2019/02/box-1.jpg') 50% / cover no-repeat; color: #FFFFFF;">
                <a href="#"></a>
                <p><span>Cardiff</span></p>
              </div>
            </div>

            <div class="col-md-5 col-lg-4 mx-auto">
              <div class="info-box-content" style="background: url('/wp-content/uploads/2019/02/box-1.jpg') 50% / cover no-repeat; color: #FFFFFF;">
                <a href="#"></a>
                <p><span>London</span></p>
              </div>
            </div>

            <div class="col-md-5 col-lg-4 mx-auto">
              <div class="info-box-content" style="background: url('/wp-content/uploads/2019/02/box-1.jpg') 50% / cover no-repeat; color: #FFFFFF;">
                <a href="#"></a>
                <p><span>Portsmouth</span></p>
              </div>
            </div>

            <div class="col-md-5 col-lg-4 mx-auto">
              <div class="info-box-content" style="background: url('/wp-content/uploads/2019/02/box-1.jpg') 50% / cover no-repeat; color: #FFFFFF;">
                <a href="#"></a>
                <p><span>Oxford</span></p>
              </div>
            </div>


          </div>
        </div>

          </div>
        </div>
      </div>
    </section>

    <section class="contact" style="background: url('/wp-content/uploads/2019/01/contact_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2 class="text-center" style="color: #32214c;">Get in contact</h2>

            <hr class="heading white">
          </div>

          <div class="col-lg-5 text-right">
            <p>
              Need advice?<br/>
              Call 0800 543 2101<br/>
              Or Fill in The Form
            </p>

            <p>Our Experts are here to help</p>
          </div>

          <div class="col-lg-6 ml-auto">
          </div>
        </div>
      </div>
    </section>

  </div><!-- /#content -->
</main><!-- /.container -->

<?php
  b4st_main_after();
  get_footer();
?>
