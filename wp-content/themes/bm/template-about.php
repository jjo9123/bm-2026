<?php
/**
 * Template Name: About Us
 * The static page template.
 *
 * @package    WordPress
 * @subpackage BM
 * @since      BM 1.0
 */

get_header();
b4st_main_before(); ?>

<style>
 .img-txt-row .row.regional-info {
  padding: 25px 0;
 }
 .img-txt-row .row.regional-info h3 {
  font-size: 1.2rem;
  margin-bottom: 20px;
 }
 section.img-txt-row {
  padding: 40px 0 60px;
 }
 section.img-txt-row .regional-info .col-lg-7 {
  padding-left: 30px;
 }
 section.infographic {
  padding: 40px 0 60px;
}
section.infographic .infographic-boxes .row {
  -webkit-box-pack: space-evenly;
        -ms-flex-pack: space-evenly;
            justify-content: space-evenly;
    padding: 20px 0 40px;
}
section.infographic .col-md-5.col-lg-4.col-xl-3.mx-auto {
  display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
  margin-bottom: 30px;
}
section.infographic .info-box-content {
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
}
section.infographic .info-box-content p {
  font-size: 1.2rem;
  font-weight: 500;
  text-transform: uppercase;
}
section.infographic .info-box-content p span {
  font-size: 2.5rem;
  font-weight: 600;
}

 header {
  position: relative;
  background-color: black;
  height: 75vh;
  min-height: 25rem;
  width: 100%;
  overflow: hidden;
}

header video {
  position: absolute;
  top: 50%;
  left: 50%;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  z-index: 0;
  -ms-transform: translateX(-50%) translateY(-50%);
  -moz-transform: translateX(-50%) translateY(-50%);
  -webkit-transform: translateX(-50%) translateY(-50%);
  transform: translateX(-50%) translateY(-50%);
}

header .container {
  position: relative;
  z-index: 2;
}

header .overlay {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: black;
  opacity: 0.5;
  z-index: 1;
}

@media (pointer: coarse) and (hover: none) {
  header {
    background: url('https://source.unsplash.com/XT5OInaElMw/1600x900') black no-repeat center center scroll;
  }
  header video {
    display: none;
  }
}
</style>

<main id="main">
  <div id="content" role="main">

    <section class="video-hero text-center">

  <header>
    <div class="overlay"></div>
      <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
        <source src="https://storage.googleapis.com/coverr-main/mp4/Mt_Baker.mp4" type="video/mp4">
      </video>
      <div class="container h-100">
        <div class="d-flex h-100 text-center align-items-center">
          <div class="w-100 text-white">
           <h1 class="display-3">Video Header</h1>
           <p class="lead mb-0"></p>

          </div>
        </div>
      </div>
  </div>
  </header>


    </section>


    <section class="txt text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h2 style="color: #a395b7;">About Blake Morgan - keyword driven</h2>

            <hr class="heading green">

            <p>Keyword specific intro and header - Blake Morgan is a full service law firm with offices across the UK. With 130 partners and 1000 staff we use our unique blend of technical expertise, broader experience and commercial realism to get the best results possible for our clients - be they small businesses, corporates, individuals, families, government, or not for profits.</p>

            <p>Keyword specific intro and header - Blake Morgan is a full service law firm with offices across the UK. With 130 partners and 1000 staff we use our unique blend of technical expertise, broader experience and commercial realism to get the best results possible for our clients - be they small businesses, corporates, individuals, families, government, or not for profits.</p>

            <p>Keyword specific intro and header - Blake Morgan is a full service law firm with offices across the UK. With 130 partners and 1000 staff we useour unique blend of technical expertise, broader experience and commercial realism to get the best results possible for our clients - be they small businesses, corporates, individuals, families, government, or not for profits.</p>
            
            <a href="javascript:void(0)" class="btn btn-green header">CONTACT US FOR MORE INFORMATION</a>
          </div>
        </div>
      </div>
    </section>


    <section class="infographic text-center" style="background: url('/bm/wp-content/uploads/2019/02/infographic-bg_1500x910.jpg') 50% / cover no-repeat; color: #FFFFFF;">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h2 style="color: #a2c754;">Blake Morgan in numbers</h2>

            <hr class="heading purple">
          </div>

        <div class="col-md-12 mx-auto infographic-boxes">
          <div class="row">
            <div class="col-md-5 col-lg-4 col-xl-3 mx-auto">
              <div class="info-box-content" style="background: url('/bm/wp-content/uploads/2019/02/box-1.jpg') 50% / cover no-repeat; color: #FFFFFF;">
                <p><span>100</span><br>Deals</p>
              </div>
            </div>

            <div class="col-md-5 col-lg-4 col-xl-3 mx-auto">
              <div class="info-box-content" style="background: url('/bm/wp-content/uploads/2019/02/box-1.jpg') 50% / cover no-repeat; color: #FFFFFF;">
                <p><span>1200</span><br>Staff members</p>
              </div>
            </div>

            <div class="col-md-5 col-lg-4 col-xl-3 mx-auto">
              <div class="info-box-content" style="background: url('/bm/wp-content/uploads/2019/02/box-1.jpg') 50% / cover no-repeat; color: #FFFFFF;">
                <p><span>Top 5 banks</span><br></p>
              </div>
            </div>

            <div class="col-md-5 col-lg-4 col-xl-3 mx-auto">
              <div class="info-box-content" style="background: url('/bm/wp-content/uploads/2019/02/box-1.jpg') 50% / cover no-repeat; color: #FFFFFF;">
                <p><span>50%</span><br>OF OUR</p>
              </div>
            </div>

            <div class="col-md-5 col-lg-4 col-xl-3 mx-auto">
              <div class="info-box-content" style="background: url('/bm/wp-content/uploads/2019/02/box-1.jpg') 50% / cover no-repeat; color: #FFFFFF;">
                <p><span>100</span><br>Deals</p>
              </div>
            </div>

            <div class="col-md-5 col-lg-4 col-xl-3 mx-auto">
              <div class="info-box-content" style="background: url('/bm/wp-content/uploads/2019/02/box-1.jpg') 50% / cover no-repeat; color: #FFFFFF;">
                <p><span>1200</span><br>Staff members</p>
              </div>
            </div>

            <div class="col-md-5 col-lg-4 col-xl-3 mx-auto">
              <div class="info-box-content" style="background: url('/bm/wp-content/uploads/2019/02/box-1.jpg') 50% / cover no-repeat; color: #FFFFFF;">
                <p><span>Top 5 banks</span><br></p>
              </div>
            </div>

            <div class="col-md-5 col-lg-4 col-xl-3 mx-auto">
              <div class="info-box-content" style="background: url('/bm/wp-content/uploads/2019/02/box-1.jpg') 50% / cover no-repeat; color: #FFFFFF;">
                <p><span>50%</span><br>OF OUR</p>
              </div>
            </div>
          </div>
        </div>

          </div>
        </div>
      </div>
    </section>



    <section class="awards text-center" style="background-color: #fff;">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h2 class="text-center" style="color: #a395b7;">Awards and Accolades</h2>

            <hr class="heading green">
          </div>
        </div>

        <div class="row">
          <div class="col-lg-2 client-logo">
            <img src="/bm/wp-content/uploads/2019/01/clientlogo.jpg">
          </div>

          <div class="col-lg-2 client-logo">
            <img src="/bm/wp-content/uploads/2019/01/clientlogo.jpg">
          </div>

          <div class="col-lg-2 client-logo">
            <img src="/bm/wp-content/uploads/2019/01/clientlogo.jpg">
          </div>

          <div class="col-lg-2 client-logo">
            <img src="/bm/wp-content/uploads/2019/01/clientlogo.jpg">
          </div>
        </div>
      </div>
    </section>

    <section class="txt text-center" style="background: #ebebeb;">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h2 style="color: #a395b7;">HISTORY OF  Blake Morgan</h2>

            <hr class="heading green">

            <p>Keyword specific intro and header - Blake Morgan is a full service law firm with offices across the UK. With 130 partners and 1000 staff we use our unique blend of technical expertise, broader experience and commercial realism to get the best results possible for our clients - be they small businesses, corporates, individuals, families, government, or not for profits.</p>

            <p>Keyword specific intro and header - Blake Morgan is a full service law firm with offices across the UK. With 130 partners and 1000 staff we use our unique blend of technical expertise, broader experience and commercial realism to get the best results possible for our clients - be they small businesses, corporates, individuals, families, government, or not for profits.</p>

            <p>Keyword specific intro and header - Blake Morgan is a full service law firm with offices across the UK. With 130 partners and 1000 staff we useour unique blend of technical expertise, broader experience and commercial realism to get the best results possible for our clients - be they small businesses, corporates, individuals, families, government, or not for profits.</p>
            <a href="javascript:void(0)" class="btn btn-green header">CONTACT US FOR MORE INFORMATION</a>
          </div>
        </div>
      </div>
    </section>

    <section class="cta-banner text-center" style="background: url('/bm/wp-content/uploads/home/home_hero.jpg') 50%/cover no-repeat; color: #FFFFFF;">

                <div class="container">
                  <div class="row">
                    <div class="col-6 mx-auto">
                      <h2 class="header">THINKING OF A CAREER WITH BLAKE MORGAN?</h2>

                      <p class="regular">Flexible content</p>

                      <a href="javascript:void(0)" class="btn btn-green header">CLICK HERE</a>
                    </div>
                  </div>
                </div>
              </div>

    </section>


    <section class="contact" style="background: url('/bm/wp-content/uploads/2019/01/contact_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2 class="text-center" style="color: #32214c;">Get In Contact</h2>

            <hr class="heading white">
          </div>

          <div class="col-lg-5 text-right">
            <p>
              Need Advice?<br/>
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
