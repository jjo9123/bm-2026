<?php
/**
 * Template Name: Blog
 * The static page template.
 *
 * @package    WordPress
 * @subpackage BM
 * @since      BM 1.0
 */

get_header();
b4st_main_before(); ?>

<main id="main" class="blog">
  <div id="content" role="main">

    <section class="hero text-center" style="background: url('/bm/wp-content/uploads/2019/02/press-bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="header">Campaign Banner Area</h1>

            <p class="regular">Link to gated piece of content</p>

            <a href="javascript:void(0)" class="btn btn-green header">DOWNLOAD NOW</a>
          </div>
        </div>
      </div>
    </section>


    <section class="blog" style="background: url('/bm/wp-content/uploads/2019/02/blog-bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container-fluid news">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="blog-filter text-center">
                <h2 class="white">Search Articles</h2>

                <hr class="heading green">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 col-lg-4 text-center item iblog">
              <div class="title">
                <p>Blog</p>
              </div>

              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Simple is not necessarily better when making a Will</h6>
              </div>

              <div class="excerpt">
                <div class="date">28 January - Samuel Hardy</div>

                <p>We at Blake Morgan have blogged before on the importance of making a Will if you want to control what happens to your estate after death. But what actually makes a Will a 'good' or 'proper' one that does what you want it to do? Is legal jargon necessary?</p>

                <a href="javascript:void(0)" class="btn btn-purple">Read More</a>
              </div>
            </div>

            <div class="col-md-6 col-lg-4 text-center item inews">
              <div class="title">
                <p>Newsletter</p>
              </div>

              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Welsh Government confirms support for Cardiff Parkway station</h6>
              </div>

              <div class="excerpt">
                <div class="date">Posted on 18 December 2018</div>

                <p>Blake Morgan is proud to be an advisor to SWIL. James Egan is the Partner at Blake Morgan who has led on the deal.</p>

                <a href="javascript:void(0)" class="btn btn-purple">Read More</a>
              </div>
            </div>

            <div class="col-md-6 col-lg-4 text-center item iguide">
              <div class="title">
                <p>Guides</p>
              </div>

              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Real Estate: Proposals for Enfranchisement Reform</h6>
              </div>

              <div class="excerpt">
                <div class="date">Posted on 13 December 2018</div>

                <p>After being invited to attend the Law Commission Symposium on 5 November 2018 to hear the proposals for enfranchisement reform and discuss how they will work in practice, Louise Uphill examines the key points.</p>

                <a href="javascript:void(0)" class="btn btn-purple">Read More</a>
              </div>
            </div>

            <div class="col-md-6 col-lg-4 text-center item ics">
              <div class="title">
                <p>Case Study</p>
              </div>

              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Not guilty – Client accused of permitting the use of a vehicle without insurance and speeding</h6>
              </div>

              <div class="excerpt">
                <div class="date">Posted on 12 December 2018</div>

                <p>Blake Morgan successfully advised a client accused of permitting the use of a vehicle without insurance and speeding.</p>

                <a href="javascript:void(0)" class="btn btn-purple">Read More</a>
              </div>
            </div>

            <div class="col-md-6 col-lg-4 text-center item ievent">
              <div class="title">
                <p>EVENT: 7 FEB - CARDIFFF</p>
              </div>

              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Blake Morgan's Insolvency Practitioner lunch and learn programme</h6>
              </div>

              <div class="excerpt">
                <div class="date">Posted on 4 December 2018</div>

                <p>We would like to invite you to our next Insolvency Practitioner lunch and learn programme on Thursday 7 February in our Cardiff office.</p>

                <a href="javascript:void(0)" class="btn btn-purple">Read More</a>
              </div>
            </div>

            <div class="col-md-6 col-lg-4 text-center item iblog">
              <div class="title">
                <p>Blog</p>
              </div>

              <div class="img" style="background: url('https://via.placeholder.com/300x175.png?text=Placeholder') 50%/cover no-repeat; color: #FFFFFF;"></div>

              <div class="header">
                <h6>Simple is not necessarily better when making a Will</h6>
              </div>

              <div class="excerpt">
                <div class="date">Posted on 2 December 2018</div>

                <p>We at Blake Morgan have blogged before on the importance of making a Will if you want to control what happens to your estate after death. But what actually makes a Will a 'good' or 'proper' one that does what you want it to do? Is legal jargon necessary?</p>

                <a href="javascript:void(0)" class="btn btn-purple">Read More</a>
              </div>
            </div>
          </div>

          <div class="row pagination">
            <div class="col-12">
              <div class="pagination justify-content-center">
                <p><span class="active">1</span> 2 3 4 5</p>
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
