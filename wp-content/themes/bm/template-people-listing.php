<?php
/**
 * Template Name: People listing
 * The static page template.
 *
 * @package    WordPress
 * @subpackage BM
 * @since      BM 1.0
 */

get_header();
b4st_main_before(); ?>
<style>
  body.page-template-template-people-listing .excerpt {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: distribute;
        justify-content: space-around;
    -ms-flex-wrap: wrap;
        flex-wrap: wrap;
    font-size: 0.9rem;
    padding: 0 25px;
  }
  .page-template-template-people-listing .contact-listing {
    padding-top: 15px;
    padding-bottom: 15px;
  }
  .page-template-template-people-listing section .staff-contact {
    display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
        -ms-flex-direction: column;
            flex-direction: column;
  }
  .page-template-template-people-listing .header {
    padding: 10px 20px;
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
  .page-template-template-people-listing .header h5 {
    font-size: 1rem;
  }
  .page-template-template-people-listing .header p {
    font-size: 0.8rem;
  }
  .page-template-template-people-listing .header h5, .page-template-template-people-listing .header h6,
  .page-template-template-people-listing .header p {
    font-weight: 500;
    text-transform: uppercase;

  }
  section .staff-contact.details .excerpt p.linkedin:before {
    content: url(/wp-content/themes/bm/theme/img/white-linkedin.png);
  }
  section .staff-contact.details .excerpt p.twitter:before {
    content: url(/wp-content/themes/bm/theme/img/white-twitter.png);
  }
  section .staff-contact.details .excerpt p.location:before {
    content: url(/wp-content/themes/bm/theme/img/staff-location.png);
    width: 30px;
    height: 30px;
    position: relative;
    right: 13px;
    top: 5px;
    left: auto;
    bottom: 0;
  }
  section.people-listing .row.staff {
    padding-top: 50px;
    padding-bottom: 30px;
  }
  section .staff-contact.details .excerpt .social {
    background: #e8e5e5;
    padding: 5px;
    padding-top: 21px;
    margin-bottom: 20px;
  }
  section .staff-contact.details .excerpt .social p:before {
    right: 0;
  }
  section.people-listing .card-body {
    background: #fff;
    padding: 0;
  }
  section.people-listing .view-profile {
    -webkit-box-pack: center;
        -ms-flex-pack: center;
            justify-content: center;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
  }
  .view-profile a {
    padding: 3px 40px;
    margin-bottom: 10px;
  }
</style>

<main id="main">
  <div id="content" role="main">

    <section class="hero text-center" style="background: url('/bm/wp-content/uploads/home/home_hero.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="header green">Bradley Albuery</h1>
            <h5>Partner</h5>
          </div>
        </div>
      </div>
    </section>

    <section class="txt">
      <div class="container text-center">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <p>Welcome to the Blake Morgan news room where you will find the latest updates on what is happening across the firm. If you have a media enquiry please contact our PR team on <strong>blakemorgan@camargue.uk</strong> or call XXX </p>
          </div>
        </div>
      </div>
    </section>

    <section class="staff-details people-listing">
      <div class="container-fluid" style="background: url('/bm/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat;">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="blog-filter text-center">
                <h2 class="dpurple">Search The Directory</h2>

                <hr class="heading green">
              </div>
            </div>
          </div>

          <div class="row staff">

            <div class="col-md-5 col-lg-4 col-xl-3 mx-auto staff-contact details">


                <div class="img" style="background: url('/bm/wp-content/uploads/2019/01/bradley-albuery@2x-copy.jpg') 50%/cover no-repeat; color: #FFFFFF;"></div>

                  <div class="header">
                    <h5>Marisa Abrahams</h5>
                    <h6 class="dpurple">Senior Solicitor TEST</h6>
                    <p>Property management team</p>
                  </div>

                  <div class="excerpt">
                      <div class="contact-listing">
                        <p class="mobile">0207 8146 909</p>
                        <p class="email">Email Bradley</p>
                        <p class="location">Location</p>
                      </div>
                      <div class="social">
                        <p class="twitter"></p>
                        <p class="linkedin"></p>
                      </div>
                      <div class="view-profile">
                        <a href="javascript:void(0)" class="btn btn-purple">View Profile</a>
                      </div>
                    </div>

              </div>

             <div class="col-md-5 col-lg-4 col-xl-3 mx-auto staff-contact details">


                <div class="img" style="background: url('/bm/wp-content/uploads/2019/01/bradley-albuery@2x-copy.jpg') 50%/cover no-repeat; color: #FFFFFF;"></div>

                  <div class="header">
                    <h5>Bradley Albuery</h5>
                    <h6 class="dpurple">Partner</h6>
                    <p>Head of professional and business regulatory group</p>
                  </div>

                  <div class="excerpt">
                      <div class="contact-listing">
                        <p class="mobile">0207 8146 909</p>
                        <p class="email">Email Bradley</p>
                        <p class="location">Location</p>
                      </div>
                      <div class="social">
                        <p class="twitter"></p>
                        <p class="linkedin"></p>
                      </div>
                      <div class="view-profile">
                        <a href="javascript:void(0)" class="btn btn-purple">View Profile</a>
                      </div>
                    </div>

              </div>

             <div class="col-md-5 col-lg-4 col-xl-3 mx-auto staff-contact details">


                <div class="img" style="background: url('/bm/wp-content/uploads/2019/01/bradley-albuery@2x-copy.jpg') 50%/cover no-repeat; color: #FFFFFF;"></div>

                  <div class="header">
                    <h5>Philip Allen</h5>
                    <h6 class="dpurple">Associate S&T</h6>
                    <p>Wills, probate, tax and trust</p>
                  </div>

                  <div class="excerpt">
                      <div class="contact-listing">
                        <p class="mobile">0207 8146 909</p>
                        <p class="email">Email Bradley</p>
                        <p class="location">Location</p>
                      </div>
                      <div class="social">
                        <p class="twitter"></p>
                        <p class="linkedin"></p>
                      </div>
                      <div class="view-profile">
                        <a href="javascript:void(0)" class="btn btn-purple">View Profile</a>
                      </div>
                    </div>

              </div>



              <div class="col-md-5 col-lg-4 col-xl-3 mx-auto staff-contact details">

                <div class="img" style="background: url('/bm/wp-content/uploads/2019/01/bradley-albuery@2x-copy.jpg') 50%/cover no-repeat; color: #FFFFFF;"></div>

                  <div class="header">
                    <h5>Christopher Allingham</h5>
                    <h6 class="dpurple">Associate</h6>
                    <p>ASSOCIATE PLANNING & INFRASTRUCTURE</p>
                  </div>

                  <div class="excerpt">
                      <div class="contact-listing">
                        <p class="mobile">0207 8146 909</p>
                        <p class="email">Email Bradley</p>
                        <p class="location">Location</p>
                      </div>
                      <div class="social">
                        <p class="twitter"></p>
                        <p class="linkedin"></p>
                      </div>
                      <div class="view-profile">
                        <a href="javascript:void(0)" class="btn btn-purple">View Profile</a>
                      </div>
                    </div>


            </div>

             <div class="col-md-5 col-lg-4 col-xl-3 mx-auto staff-contact details">


                <div class="img" style="background: url('/bm/wp-content/uploads/2019/01/bradley-albuery@2x-copy.jpg') 50%/cover no-repeat; color: #FFFFFF;"></div>

                  <div class="header">
                    <h5>Kate Allred</h5>
                    <h6 class="dpurple">Associate S&T</h6>
                    <p>Wills, inheritance, tax and trust</p>
                  </div>

                 <div class="excerpt">
                      <div class="contact-listing">
                        <p class="mobile">0207 8146 909</p>
                        <p class="email">Email Bradley</p>
                        <p class="location">Location</p>
                      </div>
                      <div class="social">
                        <p class="twitter"></p>
                        <p class="linkedin"></p>
                      </div>
                      <div class="view-profile">
                        <a href="javascript:void(0)" class="btn btn-purple">View Profile</a>
                      </div>
                    </div>

             </div>



             <div class="col-md-5 col-lg-4 col-xl-3 mx-auto staff-contact details">


                <div class="img" style="background: url('/bm/wp-content/uploads/2019/01/bradley-albuery@2x-copy.jpg') 50%/cover no-repeat; color: #FFFFFF;"></div>

                  <div class="header">
                    <h5>Stephen Archibald</h5>
                    <h6 class="dpurple">Partner</h6>
                    <p>Corporate transactions</p>
                  </div>


                    <div class="excerpt">
                      <div class="contact-listing">
                        <p class="mobile">0207 8146 909</p>
                        <p class="email">Email Bradley</p>
                        <p class="location">Location</p>
                      </div>
                      <div class="social">
                        <p class="twitter"></p>
                        <p class="linkedin"></p>
                      </div>
                      <div class="view-profile">
                        <a href="javascript:void(0)" class="btn btn-purple">View Profile</a>
                      </div>
                    </div>



            </div>

             <div class="col-md-5 col-lg-4 col-xl-3 mx-auto staff-contact details">


                <div class="img" style="background: url('/bm/wp-content/uploads/2019/01/bradley-albuery@2x-copy.jpg') 50%/cover no-repeat; color: #FFFFFF;"></div>

                  <div class="header">
                    <h5>Eleanor Armstrong</h5>
                    <h6 class="dpurple">Senior Associate</h6>
                    <p>Travel team</p>
                  </div>

                  <div class="excerpt">
                      <div class="contact-listing">
                        <p class="mobile">0207 8146 909</p>
                        <p class="email">Email Bradley</p>
                        <p class="location">Location</p>
                      </div>
                      <div class="social">
                        <p class="twitter"></p>
                        <p class="linkedin"></p>
                      </div>
                      <div class="view-profile">
                        <a href="javascript:void(0)" class="btn btn-purple">View Profile</a>
                      </div>
                    </div>

             </div>



             <div class="col-md-5 col-lg-4 col-xl-3 mx-auto staff-contact details">


                <div class="img" style="background: url('/bm/wp-content/uploads/2019/01/bradley-albuery@2x-copy.jpg') 50%/cover no-repeat; color: #FFFFFF;"></div>

                  <div class="header">
                    <h5>Eleanor Armstrong</h5>
                    <h6 class="dpurple">Legal Director</h6>
                    <p>Construction, Development and engineering</p>
                  </div>

                  <div class="excerpt">
                      <div class="contact-listing">
                        <p class="mobile">0207 8146 909</p>
                        <p class="email">Email Bradley</p>
                        <p class="location">Location</p>
                      </div>
                      <div class="social">
                        <p class="twitter"></p>
                        <p class="linkedin"></p>
                      </div>
                      <div class="view-profile">
                        <a href="javascript:void(0)" class="btn btn-purple">View Profile</a>
                      </div>
                  </div>

            </div>

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
