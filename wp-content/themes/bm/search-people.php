<?php
    get_header();
    b4st_main_before();
?>

<main id="main" class="blog post-type-archive-people">
  <div id="content" role="main">

    <section class="hero" style="background: url('/wp-content/uploads/home/home_hero.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-7">
            <h1 class="header">Our People</h1>

          </div>
        </div>
      </div>
    </section>

    <section class="staff-details people-listing" style="background: url('/wp-content/uploads/2019/03/people_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container-fluid news">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="blog-filter text-center">
                <h2 class="dpurple">Search The Directory</h2>

                <hr class="heading green">

                <div class="alphabet">
                  <a href="?query=a">A</a>
                  <a href="?query=b">B</a>
                  <a href="?query=c">C</a>
                  <a href="?query=d">D</a>
                  <a href="?query=e">E</a>
                  <a href="?query=f">F</a>
                  <a href="?query=h">H</a>
                  <a href="?query=i">I</a>
                  <a href="?query=j">J</a>
                  <a href="?query=k">K</a>
                  <a href="?query=l">L</a>
                  <a href="?query=m">M</a>
                  <a href="?query=n">N</a>
                  <a href="?query=o">O</a>
                  <a href="?query=p">P</a>
                  <a href="?query=q">Q</a>
                  <a href="?query=r">R</a>
                  <a href="?query=s">S</a>
                  <a href="?query=t">T</a>
                  <a href="?query=u">U</a>
                  <a href="?query=v">V</a>
                  <a href="?query=w">W</a>
                  <a href="?query=x">X</a>
                  <a href="?query=y">Y</a>
                  <a href="?query=z">Z</a>
                </div>

                <?php echo do_shortcode('[searchandfilter id="680"]'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>



      <div class="container news">
        <h2 class="white text-center mt-5">Directory</h2>

        <hr class="heading green">

        <?php get_template_part('loops/people-loop'); ?>
      </div>
    </section>


  </div><!-- /#content -->
</main><!-- /.container -->

<?php
  b4st_main_after();
  get_footer();
?>
