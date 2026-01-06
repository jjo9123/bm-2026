<?php
/**
 * Template Name: Simple HARDCODED
 * The static page template.
 *
 * @package    WordPress
 * @subpackage BM
 * @since      BM 1.0
 */

get_header();
b4st_main_before(); ?>
<style>
  .txt p {
    padding-bottom: 20px;
    text-align: center;
  }
</style>
<main id="main">
  <div id="content" role="main">

    <section class="hero text-center" style="background: url('/wp-content/uploads/home/home_hero.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="header">International Reach</h1>
          </div>
        </div>
      </div>
    </section>


    <section class="txt">
      <div class="container">
        <div class="row">
          <div class="col-md-10 mx-auto">
            <h2 style="color: #a395b7; text-align: center;">International expertise</h2>
            <hr class="heading green" style="padding-bottom: 20px;">

            <p>At Blake Morgan we have a reputation for building life time relationships with international clients helping them navigate through the commercial affairs and business challenges that affect their organization as well as advising them on a range of personal issues.</p>

            <p>To support our client's international strategies we have developed strong relationships with legal and financial communities across all jurisdictions in the world.  As members of TAGLaw, our relationships with global firms ensure we are best placed to help you and your business. Whether its understanding changes to employment law in your subsidiaries or overseas tax requirements we have the resources to fulfil all your legal needs.</p>

            <p>We draw on the expertise of a network of specialist lawyers from across the globe in order to ensure that cross-border transactions are completed seamlessly and successfully.</p>

            <p>The commercial litigation team offers the full spectrum of City and international dispute resolution work in domestic and overseas courts and in international arbitration.  Our practice comprises complex international (often multi-jurisdictional) commercial disputes that have a UK dimension, and pre-litigation strategic advice and ongoing dispute resolution support for clients with disputes in offshore or other common law jurisdictions. For more information <a href="https://www.blakemorgan.co.uk/what-we-do/city-and-international-commercial-disputes/">click here</a>.</p>

            <p>By actively participating in TAGLaw practice working groups, our legal experts draw on the cultural understanding, wealth of local knowledge and language skills of fellow members, combining resources and expertise to achieve the best possible results for our clients.</p>

            <p>For more information about TAGLaw click here.</p>

            <p>For information on our worldwide recognition for intellectual property advice visit World Trademark Review.</p>

            <p>To download our free guide to setting up a business in the UK click here.</p>
            <img style="margin: auto; display: block; max-width: 200px;" src="/wp-content/themes/theme/img/international-logo.jpg">
          </div>
        </div>
      </div>
    </section>


    <section class="blog recent" style="background: url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container-fluid news" style="padding-bottom: 20px;">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="text-center">Download</h2>

              <hr class="heading green">
            </div>

            <div class="col-lg-3 text-center item">
              <div class="img" style="background: url('/wp-content/uploads/2019/01/download-pdf.jpg') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Investing in the UK guide</h6>
              </div>

              <div class="excerpt">
                <p></p>

                <a href="/wp-content/uploads/Downloads/PUBLIC_-_setting_up_in_the_uk_guide_v4.pdf" class="btn btn-purple">Download</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid articles" style="padding-bottom: 20px;">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="text-center">Articles</h2>

              <hr class="heading green">
            </div>

            <div class="col-lg-3 text-center item">
              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Brexit: EU nationals in the UK update</h6>
              </div>

              <div class="excerpt">
                <p>With the threat of a 'no deal' Brexit becoming ever more possible, where are we with the migrant status of EU nationals already in the UK and those who have yet to arrive?</p>

                <a href="javascript:void(0)" class="btn btn-dpurple">Read More</a>
              </div>
            </div>

            <div class="col-lg-3 text-center item">
              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Dispute resolution lessons to be learnt from Brexit negotiations</h6>
              </div>

              <div class="excerpt">
                <p>As the Prime Minister and her negotiating team prepare themselves for another tense round of negotiations in Brussels, Lee Fisher, a partner in Blake Morgan's Dispute Management team and  accredited mediator, considers what lessons may be learnt from the negotiations to date.</p>

                <a href="javascript:void(0)" class="btn btn-dpurple">Read More</a>
              </div>
            </div>

            <div class="col-lg-3 text-center item">
              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Data Protection: How to plan for Brexit</h6>
              </div>

              <div class="excerpt">
                <p>Following the defeat of the Government's EU Withdrawal Agreement in the House of Commons on 15 January, the risk of a no-deal Brexit has increased and there remains considerable uncertainty about how data protection laws will apply after 29 March 2019.</p>

                <a href="javascript:void(0)" class="btn btn-dpurple">Read More</a>
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
