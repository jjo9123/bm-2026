<?php
/**
 * Template Name: Home2
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
  }
  .tabbed-navigation .left-tab a.nav-link {
    text-transform: uppercase;
  }
  .tabbed-navigation .right-tab a.nav-link {
    position: relative;
  }
  .tabbed-navigation .right-tab a.nav-link:hover {
    background-color: rgba(162, 199, 84, 0.7);
  }
  .tabbed-navigation .nav-pills .nav-link.active, .tabbed-navigation .nav-pills .show>.nav-link {
    background-color: #a2c754;
  }
  .tabbed-navigation .nav-pills .nav-link.active, .tabbed-navigation .nav-pills .show>.nav-link {
    border-radius: 0;
  }
  .right-tab .tab-content .tab-pane > a:first-of-type {
    font-weight: bold;
    text-transform: uppercase;
  }
  .cards.infographic .info-content {
    max-width: 350px;
    margin: auto;
    margin-top: 30px;
}
  .cards.infographic .info-content h5 {
    margin-bottom: 20px;
    text-transform: none;
  }
  .cards.infographic .info-content span {
    font-weight: bold;
  }
  .cards.infographic .recent-item::after {
    border: 1px solid black;
  }
</style>
<main id="main">
  <div id="content" role="main">

    <?php if(have_posts()): while(have_posts()): the_post(); ?>
  <article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>
  
  <section class="cards infographic" style="background: url('/bm/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container-fluid practice">
        <div class="container">
          <div class="row">
            <div class="col-lg-10 text-center">

            
              <h2 class="text-center" style="color: #a2c754;">MAIN AREAS OF PRACTICE</h2>

              <hr class="heading purple">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fringilla faucibus feugiat. Etiam tempus euismod nunc ut aliquet. Pellentesque eu gravida felis. Pellentesque non sapien gravida, aliquet neque non, consectetur tortor.</p>
            </div>
          </div>
          
          <div class="col-10 mx-auto">
          <div class="row">
            <div class="col-md-5 mx-auto text-center recent-item">
              <div class="title-box">

                   <img src="/bm/wp-content/uploads/2019/03/Icon-Staff.png" alt="staff icon" class="info-icon">

              </div>

              <div class="info-content">
                <h5 class="purple">Staff</h5>
                
                <p><span class="green">Staff:</span> 700+</p>
                <p><span class="green">Partners:</span> 100+</p>

              </div>
            </div>

            <div class="col-md-5 mx-auto text-center recent-item">
              <div class="title-box">
                  
                   <img src="/bm/wp-content/uploads/2019/03/Icon-Staff.png" alt="staff icon" class="info-icon">
                  

              </div>

              <div class="info-content">
                <h5 class="purple">Offices</h5>
                
                <p><span class="green">Staff:</span> 700+</p>
                <p><span class="green">Partners:</span> 100+</p>

              </div>
            </div>

            <div class="col-md-5 mx-auto text-center recent-item">
              <div class="title-box">
                  
                   <img src="/bm/wp-content/uploads/2019/03/Icon-Staff.png" alt="staff icon" class="info-icon">
                  

              </div>

              <div class="info-content">
                <h5 class="purple">Legal 500</h5>
                
                <p><span class="green">32</span> Practice Areas Tier 1</p>
                <p><span class="green">30</span> Leading Individuals</p>
                <p><span class="green">166</span> Recommended Lawyers</p>

              </div>
            </div>
            
            <div class="col-md-5 mx-auto text-center recent-item">
              <div class="title-box">
                  
                   <img src="/bm/wp-content/uploads/2019/03/Icon-Staff.png" alt="staff icon" class="info-icon">
                  

              </div>

              <div class="info-content">
                <h5 class="purple">Offices</h5>
                
                <p><span>Staff:</span> 700+</p>
                <p><span>Partners:</span> 100+</p>

              </div>
            </div>
            
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php
    // check if the repeater field has rows of data
      if( have_rows('tabbed_menu') ):
        $counter = 1; ?>
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

              // loop through the rows of data

          <?php while ( have_rows('tabbed_menu') ) : the_row();
               $counter++; ?>

      <a class="nav-link active" id="v-pills-<?php echo $counter; ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $counter; ?>" role="tab" aria-controls="v-pills-<?php echo $counter; ?>" aria-selected="true">Owner managed business</a>



        <div class="right-tab col-12 col-md-6 text-left" style="background: url('/bm/content/uploads/2019/01/tab-nav-bg.jpg') 50%/cover no-repeat;">
            <div class="container">
              <div class="row">
                <div class="col-12">
                  <h2>What we do:</h2>
                    <div class="tab-content" id="v-pills-tabContent">

                  <?php if( have_rows('sub_menu_items') ): ?>

                    <div class="tab-pane fade show active" id="v-pills-<?php echo $counter; ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $counter; ?>-tab">

                      <?php while( have_rows('repeater_field_name') ): the_row(); ?>

                      <a href="#" class="nav-link">OWNER MANAGED BUSINESS</a>

                      <?php endwhile; ?>
                    </div>


                  <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

              <?php endwhile; ?>

          // no rows found

      <?php endif; ?>

      <?php endwhile; ?>
      <?php endif; ?>

  </article>




  </div><!-- /#content -->
</main><!-- /.container -->
