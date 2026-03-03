<?php
    get_header();
    b4st_main_before();
?>

<main id="main" class="blog post-type-archive-people">
  <div id="content" role="main">

    <section class="hero bm-pink">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-7">
            <h1 class="header">Our People</h1>

          </div>
        </div>
      </div>
    </section>

    <section class="staff-details people-listing">
      <div class="container">
          <div class="row">
              <div class="col-12 blog-filter text-center bm-purple">
                <h2>Search The Directory</h2>

                <div class="alphabet">
                  <a href="/people/?query=a">A</a>
                  <a href="/people/?query=b">B</a>
                  <a href="/people/?query=c">C</a>
                  <a href="/people/?query=d">D</a>
                  <a href="/people/?query=e">E</a>
                  <a href="/people/?query=f">F</a>
				  <a href="/people/?query=g">G</a>
                  <a href="/people/?query=h">H</a>
                  <a href="/people/?query=i">I</a>
                  <a href="/people/?query=j">J</a>
                  <a href="/people/?query=k">K</a>
                  <a href="/people/?query=l">L</a>
                  <a href="/people/?query=m">M</a>
                  <a href="/people/?query=n">N</a>
                  <a href="/people/?query=o">O</a>
                  <a href="/people/?query=p">P</a>
                  <a href="/people/?query=q">Q</a>
                  <a href="/people/?query=r">R</a>
                  <a href="/people/?query=s">S</a>
                  <a href="/people/?query=t">T</a>
                  <a href="/people/?query=u">U</a>
                  <a href="/people/?query=v">V</a>
                  <a href="/people/?query=w">W</a>
                  <a href="/people/?query=x">X</a>
                  <a href="/people/?query=y">Y</a>
                  <a href="/people/?query=z">Z</a>
                </div>
              </div>
            </div>


                <div class="row search bm-purple">
                  <div class="col-12 col-md-10 mx-auto">
                    <?php echo do_shortcode('[searchandfilter id="680"]'); ?>

                  </div>

                </div>
        </div>



      <div class="container news">
        <h2 class="white text-center mt-5">Directory</h2>

        <?php get_template_part('loops/people-loop'); ?>
      </div>
    </section>


  </div><!-- /#content -->
</main><!-- /.container -->

<?php
  b4st_main_after();
  get_footer();
?>
