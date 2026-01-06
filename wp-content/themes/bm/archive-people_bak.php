<?php
    get_header();
    b4st_main_before();
?>

<main id="main" class="blog">
  <div id="content" role="main">

    <section class="hero text-center" style="background: url('/wp-content/uploads/2019/02/press-bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="header">Campaign Banner Area</h1>

          </div>
        </div>
      </div>
    </section>

    <section class="blog" style="background: url('/wp-content/uploads/2019/02/blog-bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container-fluid news">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="blog-filter text-center">
                <h2 class="white">Search People</h2>

                <hr class="heading green">

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php
      $args = array(
          'post_type' => 'people'
      );
      $query = new WP_Query( $args );
    ?>

    <section class="staff-details people-listing">
      <div class="container-fluid" style="background: url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat;">
        <div class="container">
          <div class="row staff">
              <?php if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post(); ?>
                <?php
                    // vars
                    $person = get_field('contact_details');

                    if( $person ): ?>
                    <div class="col-md-5 col-lg-4 col-xl-3 mx-auto staff-contact details">
                      <div class="img" style="background: url('<?php echo $person['img']; ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

                      <div class="header">
                        <h5><?php echo $person['first_name']; ?> <?php echo $person['last_name']; ?></h5>
                        <h6 class="dpurple"><?php echo $person['job_title']; ?></h6>
                        <p>Property management team</p>
                      </div>

                      <div class="excerpt">
                        <div class="contact-listing">
                          <p class="mobile"><?php echo $person['mobile_number']; ?></p>
                          <a href="mailto:<?php echo $person['email_address']; ?>"><p class="email">Email me</p></a>

                          <?php
                          $post_object = $person['location'];
                          if( $post_object ):
                            $post = $post_object;
                            setup_postdata( $post );
                          ?>

                            <p class="location">
                              <?php echo get_the_title($post_object->ID); ?>
                            </p>

                            <?php wp_reset_postdata(); ?>
                          <?php endif; ?>
                        </div>

                        <?php
                        if( $person['twitter_link'] && $person['linkedin_link'] ): ?>

                          <div class="social">
                            <?php if( $person['twitter_link'] ): ?>
                              <a href="<?php echo $person['twitter_link']; ?>">
                                <p class="twitter"></p>
                              </a>
                            <?php endif; ?>

                            <?php if( $person['linkedin_link'] ): ?>
                              <a href="<?php echo $person['linkedin_link']; ?>">
                                <p class="linkedin"></p>
                              </a>
                            <?php endif; ?>
                          </div>
                        <?php endif; ?>

                        <div class="view-profile">
                          <a href="<?php the_permalink(); ?>" class="btn btn-purple">View Profile</a>
                        </div>
                      </div>
                    </div>
                  <?php endif; endwhile; ?>

                <div class="row people-pagination">
                  <?php if ( function_exists('b4st_pagination') ) { b4st_pagination(); } else if ( is_paged() ) { ?>
                  <ul class="pagination">
                    <li class="page-item older">
                      <?php next_posts_link('<i class="fas fa-arrow-left"></i> ' . __('Previous', 'b4st')) ?></li>
                    <li class="page-item newer">
                      <?php previous_posts_link(__('Next', 'b4st') . ' <i class="fas fa-arrow-right"></i>') ?></li>
                  </ul>
                  <?php } ?>
                </div>

              <?php endif; wp_reset_postdata(); ?>

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
