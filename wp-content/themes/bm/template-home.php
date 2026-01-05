<?php
/**
 * Template Name: Home
 * The static page template.
 *
 * @package    WordPress
 * @subpackage BM
 * @since      BM 1.0
 */

get_header();
b4st_main_before(); ?>

<style>
  .btn {
    text-transform: uppercase;
  }
  .btn-purple {
    background: #a395b7;
    color: #ffffff;
  }

  .tabbed-navigation .left-tab .col-12, .tabbed-navigation .right-tab .col-12 {
    padding-top: 30px;
    padding-bottom: 30px;
  }
  .tabbed-navigation h2 {
    color: #a2c754;
    padding-bottom: 25px;
  }
  .tabbed-navigation a.nav-link {
    color: #ffffff;
    min-height: 40px;
  }
  .tabbed-navigation .left-tab a.nav-link {
    text-transform: uppercase;
  }
  .tabbed-navigation .right-tab a.nav-link {
    position: relative;
    margin: 0.75em 0;
    padding: 0 1em;
  }
  /*.tabbed-navigation .right-tab a.nav-link:hover {
    background-color: rgba(162, 199, 84, 0.7);
  }*/
    .tabbed-navigation .right-tab a.nav-link:before {
    border-color: transparent #a2c754;
    border-style: solid;
    border-width: 0.35em 0 0.35em 0.45em;
    content: "";
    display: block;
    visibility: hidden;
    height: 0;
    width: 0;
    position: relative;
    left: -1em;
    top: 1.2em;
  }
  .tabbed-navigation .right-tab a.nav-link:hover:before {
    border-color: transparent #a2c754;
    border-style: solid;
    border-width: 0.35em 0 0.35em 0.45em;
    content: "";
    display: block;
    height: 0;
    width: 0;
    position: relative;
    visibility: visible;
    left: -1em;
    top: 1.2em;
  }
  .tabbed-navigation .nav-pills .nav-link.active, .tabbed-navigation .nav-pills .show>.nav-link,
  .tabbed-navigation .nav-pills .nav-link:hover
  {
    background-color: #a2c754;
    border-radius: 0;
  }
  .tabbed-navigation .nav-pills .nav-link.active, .tabbed-navigation .nav-pills .show>.nav-link {
    border-radius: 0;
  }
  .right-tab .tab-content .tab-pane > a:first-of-type {
    font-weight: bold;
    text-transform: uppercase;
  }
  .mobile-tabbed-nav {
    padding-top: 30px;
    padding-bottom: 30px;
  }
  .mobile-tabbed-nav #accordion .card-header {
    background: #404040;
    border-radius: 0;
    border-bottom: 1px solid #a2c754;
    border-top: 1px solid #a2c754;
    text-align: left;
  }
  .mobile-tabbed-nav #accordion .card {
    border-radius: 0;
    border: 0;
  }
  .mobile-tabbed-nav #accordion .card-body {
    background: #363636;
    padding: 10px;
  }
  .mobile-tabbed-nav #accordion .card-body .nav-link:hover, .mobile-tabbed-nav #accordion .card-body .nav-link:active {
    background: #252525;
    color: #a2c754;
  }
  .mobile-tabbed-nav #accordion .card-header:hover, .mobile-tabbed-nav #accordion .card-header[aria-expanded="true"] {
    background: #a2c754;
  }
  .mobile-tabbed-nav #accordion .card-header h5 {
    color: #ffffff;
    font-weight: 300;
  }
  .mobile-tabbed-nav #accordion .card-header:hover {
    text-decoration: none;
  }
  .expand_caret {
    transform: scale(1.6);
    margin-left: 8px;
    margin-top: -4px;
}
.mobile-tabbed-nav #accordion .card-header[aria-expanded='false'] > .expand_caret {
    transform: scale(1.6) rotate(-90deg);
}

</style>

<main id="main">
  <div id="content" role="main">

    <section class="hero slider text-center">

            <div class="home-slider">
              <div class="home-slide" style="background: url('wp-content/uploads/home/home_hero.jpg') 50%/cover no-repeat; color: #FFFFFF;">
                <div class="container">
                  <div class="row">
                    <div class="col-12">
                      <p class="header">RELEVANT REALISTIC SOLUTIONS</p>

                      <p class="regular">What can we do for you?</p>

                      <a href="javascript:void(0)" class="btn btn-green header">WATCH OUR VIDEO</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="home-slide" style="background: url('wp-content/uploads/home/home_hero.jpg') 50%/cover no-repeat; color: #FFFFFF;">
                <div class="container">
                  <div class="row">
                    <div class="col-12">
                      <p class="header">RELEVANT REALISTIC SOLUTIONS</p>

                      <p class="regular">What can we do for you?</p>

                      <a href="javascript:void(0)" class="btn btn-green header">WATCH OUR VIDEO</a>
                    </div>
                  </div>
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

            <a href="javascript:void(0)" class="btn btn-green header">CONTACT US FOR MORE INFORMATION</a>
          </div>
        </div>
      </div>
    </section>


    <section class="txt text-center" style="background: url('wp-content/uploads/2019/01/home_expertise.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h2 style="color: #a2c754;">Our Expertise</h2>

            <hr class="heading purple">

            <p>We are trusted by many of the leading players within the areas in which we specialsie in. Including, twenty local authorities, central government depts as well as devolved regional government. Four major high street and corporate banks, leading super markets, four of the top ten house builders. The UK's largest coffee chain and 100 schools, academies and universities trust our judgement an advice on a wide range of legal issues.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="tabbed-navigation" style="background-color: #404040;">
      <div class="container-fluid">

        <div class="row">
            <div class="left-tab col-12 col-md-4 ml-auto text-right">
              <div class="container">
                <div class="row">
                  <div class="col-12">
                  <h2>Who we help:</h2>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                      <a class="nav-link active" id="v-pills-owner-tab" data-toggle="pill" href="#v-pills-owner" role="tab" aria-controls="v-pills-owner" aria-selected="true">Owner managed business</a>
                      <a class="nav-link" id="v-pills-corporate-tab" data-toggle="pill" href="#v-pills-corporate" role="tab" aria-controls="v-pills-corporate" aria-selected="false">Corporates</a>
                      <a class="nav-link" id="v-pills-builtenvironment-tab" data-toggle="pill" href="#v-pills-builtenvironment" role="tab" aria-controls="v-pills-builtenvironment" aria-selected="false">Built environment</a>
                      <a class="nav-link" id="v-pills-litigation-tab" data-toggle="pill" href="#v-pills-litigation" role="tab" aria-controls="v-pills-litigation" aria-selected="false">Litigation and dispute resolution</a>
                      <a class="nav-link" id="v-pills-banking-tab" data-toggle="pill" href="#v-pills-banking" role="tab" aria-controls="v-pills-banking" aria-selected="false">Banking and finance</a>

                      <a class="nav-link" id="v-pills-individuals-tab" data-toggle="pill" href="#v-pills-individuals" role="tab" aria-controls="v-pills-individuals" aria-selected="false">Individuals and families</a>
                      <a class="nav-link" id="v-pills-professional-tab" data-toggle="pill" href="#v-pills-professional" role="tab" aria-controls="v-pills-professional" aria-selected="false">Professional regulators</a>
                      <a class="nav-link" id="v-pills-government-tab" data-toggle="pill" href="#v-pills-government" role="tab" aria-controls="v-pills-government" aria-selected="false">Government</a>
                      <a class="nav-link" id="v-pills-charities-tab" data-toggle="pill" href="#v-pills-charities" role="tab" aria-controls="v-pills-charities" aria-selected="false">Charities</a>
                      <a class="nav-link" id="v-pills-farming-tab" data-toggle="pill" href="#v-pills-farming" role="tab" aria-controls="v-pills-farming" aria-selected="false">Farming</a>
                      <a class="nav-link" id="v-pills-social-tab" data-toggle="pill" href="#v-pills-social" role="tab" aria-controls="v-pills-social" aria-selected="false">Social housing</a>
                      <a class="nav-link" id="v-pills-education-tab" data-toggle="pill" href="#v-pills-education" role="tab" aria-controls="v-pills-education" aria-selected="false">Education</a>
                      <a class="nav-link" id="v-pills-retail-tab" data-toggle="pill" href="#v-pills-retail" role="tab" aria-controls="v-pills-retail" aria-selected="false">Retail and leisure</a>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <div class="right-tab col-12 col-md-6 text-left" style="background: url('/bm/wp-content/uploads/2019/01/tab-nav-bg.jpg') 50%/cover no-repeat;">
            <div class="container">
              <div class="row">
                <div class="col-12">
                <h2>What we do:</h2>
                  <div class="tab-content" id="v-pills-tabContent">

                    <div class="tab-pane fade show active" id="v-pills-owner" role="tabpanel" aria-labelledby="v-pills-owner-tab">

                        <a href="#" class="nav-link">OWNER MANAGED BUSINESS</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>

                    </div>

                    <div class="tab-pane fade" id="v-pills-corporate" role="tabpanel" aria-labelledby="v-pills-corporate-tab">

                        <a href="#" class="nav-link">CORPORATES</a>
                        <a href="#" class="nav-link">Corporate and shareholder disputes</a>
                        <a href="#" class="nav-link">Corporate crime & investigations</a>
                        <a href="#" class="nav-link">Corporate tax</a>
                        <a href="#" class="nav-link">Corporate transactions</a>

                    </div>

                    <div class="tab-pane fade" id="v-pills-builtenvironment" role="tabpanel" aria-labelledby="v-pills-builtenvironment-tab">

                        <a href="#" class="nav-link">BUILT ENVIRONMENT</a>
                        <a href="#" class="nav-link">Construction</a>
                        <a href="#" class="nav-link">Planning</a>
                        <a href="#" class="nav-link">Real estate</a>
                        <a href="#" class="nav-link">Project management and cost management</a>

                    </div>

                    <div class="tab-pane fade" id="v-pills-litigation" role="tabpanel" aria-labelledby="v-pills-litigation-tab">

                        <a href="#" class="nav-link">LITIGATION AND DISPUTE RESOLUTION</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>

                    </div>

                    <div class="tab-pane fade" id="v-pills-banking" role="tabpanel" aria-labelledby="v-pills-banking-tab">

                        <a href="#" class="nav-link">BANKING AND FINANCE</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>


                    </div>

                    <div class="tab-pane fade" id="v-pills-individuals" role="tabpanel" aria-labelledby="v-pills-individuals-tab">

                        <a href="#" class="nav-link">INDIVIDUALS AND FAMILIES</a>
                        <a href="#" class="nav-link">Estates and farms</a>
                        <a href="#" class="nav-link">Individuals</a>
                        <a href="#" class="nav-link">Homeowners</a>
                        <a href="#" class="nav-link">Families</a>
                        <a href="#" class="nav-link">Business Owners</a>


                    </div>

                    <div class="tab-pane fade" id="v-pills-professional" role="tabpanel" aria-labelledby="v-pills-professional-tab">

                        <a href="#" class="nav-link">PROFESSIONAL REGULATORS</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>


                    </div>

                    <div class="tab-pane fade" id="v-pills-government" role="tabpanel" aria-labelledby="v-pills-government-tab">

                        <a href="#" class="nav-link">GOVERNMENT</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>


                    </div>

                    <div class="tab-pane fade" id="v-pills-charities" role="tabpanel" aria-labelledby="v-pills-charities-tab">

                        <a href="#" class="nav-link">CHARITIES</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>


                    </div>

                    <div class="tab-pane fade" id="v-pills-farming" role="tabpanel" aria-labelledby="v-pills-farming-tab">

                        <a href="#" class="nav-link">FARMING</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>


                    </div>

                    <div class="tab-pane fade" id="v-pills-social" role="tabpanel" aria-labelledby="v-pills-social-tab">

                        <a href="#" class="nav-link">SOCIAL HOUSING</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>


                    </div>

                    <div class="tab-pane fade" id="v-pills-education" role="tabpanel" aria-labelledby="v-pills-education-tab">

                        <a href="#" class="nav-link">EDUCATION</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>


                    </div>

                    <div class="tab-pane fade" id="v-pills-retail" role="tabpanel" aria-labelledby="v-pills-retail-tab">

                         <a href="#" class="nav-link">RETAIL AND LEISURE</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>
                        <a href="#" class="nav-link">Driver defense</a>


                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

<div class="mobile-tabbed-nav col-12 text-left">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <h2>What we do:</h2>
                  <div id="accordion">
                    <div class="card">
                      <div class="card-header btn btn-link" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h5 class="mb-0">
                            Owner Managed Business
                        </h5>
                      </div>

                      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                          <div class="card-body">
                          <a href="#" class="nav-link">OWNER MANAGED BUSINESS</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h5 class="mb-0">
                            Corporates
                        </h5>
                      </div>
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">

                          <a href="#" class="nav-link">OWNER MANAGED BUSINESS</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>

                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header btn btn-link collapsed" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h5 class="mb-0">

                            Built Environment

                        </h5>
                      </div>
                      <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                        <div class="card-body">

                          <a href="#" class="nav-link">OWNER MANAGED BUSINESS</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>

                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header btn btn-link collapsed" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <h5 class="mb-0">

                            Litigation and dispute resolution

                        </h5>
                      </div>
                      <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                        <div class="card-body">

                          <a href="#" class="nav-link">OWNER MANAGED BUSINESS</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>

                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header btn btn-link collapsed" id="headingFive" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <h5 class="mb-0">

                            Banking and finance

                        </h5>
                        <div class="expand_caret caret"></div>
                      </div>
                      <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                        <div class="card-body">

                          <a href="#" class="nav-link">OWNER MANAGED BUSINESS</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>

                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header btn btn-link collapsed" id="headingSix" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        <h5 class="mb-0">

                            Individuals and families

                        </h5>
                      </div>
                      <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                        <div class="card-body">

                          <a href="#" class="nav-link">OWNER MANAGED BUSINESS</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>

                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header btn btn-link collapsed" id="headingSeven" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        <h5 class="mb-0">

                            Professional Regulators

                        </h5>
                      </div>
                      <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
                        <div class="card-body">

                          <a href="#" class="nav-link">OWNER MANAGED BUSINESS</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>

                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header btn btn-link collapsed" id="headingEight" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        <h5 class="mb-0">

                            Government

                        </h5>
                      </div>
                      <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion">
                        <div class="card-body">

                          <a href="#" class="nav-link">OWNER MANAGED BUSINESS</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>

                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header btn btn-link collapsed" id="headingNine" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                        <h5 class="mb-0">

                            Charities

                        </h5>
                      </div>
                      <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
                        <div class="card-body">

                          <a href="#" class="nav-link">OWNER MANAGED BUSINESS</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>

                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header btn btn-link collapsed" id="headingTen" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                        <h5 class="mb-0">

                            Farming

                        </h5>
                      </div>
                      <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordion">
                        <div class="card-body">

                          <a href="#" class="nav-link">OWNER MANAGED BUSINESS</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>

                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header btn btn-link collapsed" id="headingEleven" data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                        <h5 class="mb-0">

                            Social housing

                        </h5>
                      </div>
                      <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven" data-parent="#accordion">
                        <div class="card-body">

                          <a href="#" class="nav-link">OWNER MANAGED BUSINESS</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>

                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header btn btn-link collapsed" id="headingTwelve" data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                        <h5 class="mb-0">

                            Education

                        </h5>
                      </div>
                      <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#accordion">
                        <div class="card-body">

                          <a href="#" class="nav-link">OWNER MANAGED BUSINESS</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>

                        </div>
                      </div>
                    </div>

                    <div class="card">
                      <div class="card-header btn btn-link collapsed" id="headingThirteen" data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                        <h5 class="mb-0">

                            Retail and leisure

                        </h5>
                      </div>
                      <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen" data-parent="#accordion">
                        <div class="card-body">

                          <a href="#" class="nav-link">OWNER MANAGED BUSINESS</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>
                          <a href="#" class="nav-link">Driver defense</a>

                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>


    <section class="map" style="background: url('/bm/wp-content/uploads/2019/03/map_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <h2 class="text-center dpurple">Our Offices</h2>

            <hr class="heading purple">

            <p class="text-center dpurple">We are full service in every region we serve.</p>
          </div>
        </div>

        <div class="row mt-5">
          <div class="col">
            <?php echo do_shortcode('[wpgmza id="1"]'); ?>
          </div>
        </div>
      </div>
    </section>


    <section class="blog recent" style="background: url('wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container-fluid news">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="text-center">News</h2>

              <hr class="heading green">
            </div>

            <div class="col-lg-3 text-center item">
              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>When does inconsistent conduct amount to a variation of contract?</h6>
              </div>

              <div class="excerpt">
                <p>An issue which often arises in a commercial setting is where two companies agree a contract for goods or services but do not put the terms in writing, instead relying on verbal agreement or letters of intent.</p>

                <a href="javascript:void(0)" class="btn btn-purple">Read More</a>
              </div>
            </div>

            <div class="col-lg-3 text-center item">
              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Time to prepare for data limbo? A no-deal Brexit and its impact on cross-border data flows</h6>
              </div>

              <div class="excerpt">
                <p>As a no-deal Brexit becomes a distinct possibility the UK government is to start producing guidance to deal with this eventuality.</p>

                <a href="javascript:void(0)" class="btn btn-purple">Read More</a>
              </div>
            </div>

            <div class="col-lg-3 text-center item">
              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Real Estate lawyers attending 2018 RESI convention</h6>
              </div>

              <div class="excerpt">
                <p>Top Blake Morgan Real Estate lawyers are attending the prestigious RESI Convention on 12-14 September at Celtic Manor, Newport.</p>

                <a href="javascript:void(0)" class="btn btn-purple">Read More</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid articles">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="text-center">Articles</h2>

              <hr class="heading green">
            </div>

            <div class="col-lg-3 text-center item">
              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Holding the PRs to account</h6>
              </div>

              <div class="excerpt">
                <p>You know that you have been named as a beneficiary under a Will or are entitled under a relative's intestacy. After the initial emotions experienced in learning this news have bedded in,</p>

                <a href="javascript:void(0)" class="btn btn-dpurple">Read More</a>
              </div>
            </div>

            <div class="col-lg-3 text-center item">
              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Freehold vs leasehold: what's the difference?</h6>
              </div>

              <div class="excerpt">
                <p>Freehold and leasehold are the two main types of property ownership in the UK. Here we explain how these types of ownership differ and the considerations to note when buying a leasehold property.</p>

                <a href="javascript:void(0)" class="btn btn-dpurple">Read More</a>
              </div>
            </div>

            <div class="col-lg-3 text-center item">
              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Successful Inheritance Act claim for perceived "lodger"</h6>
              </div>

              <div class="excerpt">
                <p>Testamentary freedom, or a person's freedom to dispose of their property upon death as they see fit, is a fundamental principle of English and Welsh law.</p>

                <a href="javascript:void(0)" class="btn btn-dpurple">Read More</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid events">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="text-center">Events</h2>

              <hr class="heading green">
            </div>

            <div class="col-lg-3 text-center item">
              <div class="recent-event">
                <p>Cardiff 11 September 2018</p>
              </div>

              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Employment Club Seminar Cardiff 11 Sep</h6>
              </div>

              <div class="excerpt">
                <p>Come and join us at our Employment Club Seminar in Cardiff on 11 September. Let us know you're coming and follow the conversation - #BMEmpClubs. Find us @BlakeMorganLLP.</p>

                <a href="javascript:void(0)" class="btn btn-green">Read More</a>
              </div>
            </div>

            <div class="col-lg-3 text-center item">
              <div class="recent-event">
                <p>Cardiff 12 September 2018</p>
              </div>

              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Blake Morgan's Insolvency Practitioner lunch and learn programme</h6>
              </div>

              <div class="excerpt">
                <p>We would like to invite you to our next Insolvency Practitioner lunch and learn programme on Wednesday 12 September in our Cardiff office.</p>

                <a href="javascript:void(0)" class="btn btn-green">Read More</a>
              </div>
            </div>

            <div class="col-lg-3 text-center item">
              <div class="recent-event">
                <p>Swansea 13 September 2018</p>
              </div>

              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Employment Club Seminar Swansea 13 Sep</h6>
              </div>

              <div class="excerpt">
                <p>Come and join us at our Employment Club Seminar in Cardiff on 11 September. Let us know you're coming and follow the conversation - #BMEmpClubs. Find us @BlakeMorganLLP.</p>

                <a href="javascript:void(0)" class="btn btn-green">Read More</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <section class="contact" style="background: url('/bm/wp-content/uploads/2019/01/contact_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mb-4">
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
            <?php gravity_form(1, false, false, false, '', true, 12); ?>
          </div>
        </div>
      </div>
    </section>


<?php
  b4st_main_after();
  get_footer();
?>
