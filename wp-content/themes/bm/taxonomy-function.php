<?php
    get_header();
    b4st_main_before();

    $banner_section = get_field('banner_section', 'option');
?>

<main id="main" class="blog press vacancy">
  <div id="content" role="main">

    <section class="hero text-center" style="background: url('https://www.blakemorgan.co.uk/wp-content/uploads/Images/Hero/Expertise-Families/F3A6520_edit.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <h1 class="header" style="font-size: 2.5rem; text-transform: uppercase;"><?php
              if (is_tax('function')) {
                  echo single_term_title('', false) . ' – at Blake Morgan';
              } else {
                  echo 'Vacancies at Blake Morgan';
              }
              ?></h1>

            <p>Progress your legal career</p>
          </div>
        </div>
      </div>
    </section>


    <section class="press-intro">
      <div class="container text-center">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <p>People are at the heart of our business - come and find out more...</p>
          </div>
        </div>
      </div>
    </section>


    <section class="blog" style="background: url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container">
        <div class="row">
          <div class="col-12 blog-filter">
            <div class="text-center">
              <h2 class="dpurple">Search Vacancies</h2>

              <hr class="heading green">
            </div>
          </div>
        </div>

        <div class="row search">
          <div class="col-12 col-md-10 mx-auto">
            <?php echo do_shortcode('[searchandfilter id="32422"]'); ?>
          </div>
        </div>
      </div>

      <div class="container news">
        <?php get_template_part('loops/vacancy-loop'); ?>
      </div>
    </section>

    <section class="vacancies-about">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-8 mx-auto">
            <?php echo get_field('vacancies_index-txt', 'option'); ?>
          </div>
        </div>
      </div>
    </section>

    <section class="cards" style="background-color: #E3E3E3;">
      <div class="container experts">
        <div class="row mb-5">
          <div class="col-lg-12 mb-4 text-center">
            <?php if( get_field('vacancies_index-experts_heading', 'option') ): ?>
              <h2 class="text-center dpurple"><?php echo get_field('vacancies_index-experts_heading', 'option'); ?></h2>

              <hr class="heading purple">
            <?php endif; ?>
          </div>

          <?php
          $posts = get_field('vacancies_index-experts_experts', 'option');
          if( $posts ): ?>
            <?php foreach( $posts as $post): ?>
              <?php setup_postdata($post);
                $details = get_field('contact_details');
                            $link = get_permalink(); ?>
              <div class="col-sm-6 col-md-3 mx-auto mb-4 text-center item">
                <div class="img title-box" style="background: url('<?php echo $details['img']; ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

                <div class="excerpt purple-bg">
                  <h5 style="color: #FFFFFF;">
                    <?php echo $details['first_name']; ?><br/><?php echo $details['last_name']; ?>
                  </h5>

                  <h6>
                    <?php echo $details['job_title']; ?>
                  </h6>

                  <?php
                      $post_object =  $details['location'];
                      if( $post_object ):
                        $post = $post_object;
                        setup_postdata( $post );
                      ?>
                        <p>
                          <?php echo get_the_title($post_object->ID); ?>
                        </p>

                        <?php wp_reset_postdata(); ?>
                      <? else: ?>
                      <p style="visibility: hidden;"></p>
                    <?php endif; ?>


                  <a href="<?php echo $link; ?>" class="btn btn-green">View Profile</a>
                </div>
              </div>
            <?php endforeach; ?>
            <?php wp_reset_postdata(); ?>
          <?php endif; ?>
        </div>
              <?php if( get_field('vacancies_index-experts_btn_show', 'option') == 'yes'): ?>
                <?php if( get_field('vacancies_index-experts_btn_type', 'option') == 'link'): ?>
                    <div class="row justify-content-center">
                        <a href="<?php echo get_field('vacancies_index-experts_btn_link', 'option'); ?>" class="btn btn-green header">
                            <?php echo get_field('vacancies_index-experts_btn_txt', 'option'); ?>
                        </a>
                    </div>
                <?php else: ?>
                    <?php $post_object = get_field('vacancies_index-experts_modal', 'option');
                        if( $post_object ):
                            $post = $post_object;
                    ?>
                        <?php setup_postdata($post); ?>

                        <div class="row justify-content-center">
                            <a href="<?php the_sub_field('btn_link'); ?>" class="btn btn-dpurple header" data-toggle="modal" data-target="#btn-cta-modal-<?php echo get_the_ID(); ?>">
                                <?php the_sub_field('btn_txt'); ?>
                            </a>
                        </div>

                        <?php get_template_part('modules/modal'); ?>

                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                <?php endif; ?>
              <?php endif; ?>
        </div>
      </section>

    <section class="vacancies-about">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-8 mx-auto">
            <?php echo get_field('vacancies_index-txt2', 'option'); ?>
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
