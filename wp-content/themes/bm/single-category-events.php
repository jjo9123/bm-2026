<?php
    get_header();
    b4st_main_before();

    // get variables
    $event_details = get_field('event_details');
?>

<style>
  .category-events .txt li {
    font-size: 1.1rem;
  }
  .blog.events .hero {
    position: relative;
  }
  .blog.events .hero > .container {
    position: relative;
    z-index: 50;
  }
  .blog.events .hero:after{
    background: #333;
    content: '';
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 0;
    opacity: .4;
    border-radius: inherit;
    pointer-events: none;
  }
  .category-events .txt ul li:before {
    border-color: transparent #8ed300;
    border-style: solid;
    border-width: 0.65em 0 0.65em 0.75em;
    content: "";
    display: block;
    height: 0;
    width: 0;
    position: relative;
    left: -1.4em;
    top: 1.4em;
  }

  .category-events .txt ul {
    font-weight: 400;
    list-style: none;
    margin: 0.75em 0;
    padding: 0 2em;
    padding-bottom: 2em;
  }
  .category-events .txt h6 {
    padding-bottom: 1em;
  }
  .category-events .txt h2 {
    margin-top: 15px;
    margin-bottom: 30px;
  }
  .category-events .txt.hosts h2 {
    margin-bottom: 40px;
    color: #8ed300;
  }
  .category-events .txt h3, .category-events .txt h4, .category-events .txt h5 {
    text-transform: none;
    margin-bottom: 15px;
  }
  .category-events .txt.hosts .row.regional-info {
    padding-bottom: 20px;
  }
  .category-events .intro-text {
    font-size: 1.5rem;
    font-weight: 500;
    line-height: 1.8;
    /*-ms-flex-flow: wrap;
        flex-flow: wrap;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: normal;
        -ms-flex-direction: row;
            flex-direction: row;
    -webkit-box-pack: justify;
        -ms-flex-pack: justify;
            justify-content: space-between;
    -ms-flex-line-pack: center;
        align-content: center;*/
    padding: 30px;
  }
  body .category-events .single-content {
    padding-top: 0;
  }
  .category-events .info-box p {
    font-weight: 400;
  }
</style>

<main id="main" class="blog events">
  <?php /* Single post loop */ if(have_posts()): while(have_posts()): the_post(); ?>

  <!----- START OF USE OLD LAYOUT IF STATEMENT ------>
  <?php if( get_field('use_old_layout') == 'yes' ):  ?>
  <section class="hero text-center" style="background: url('<?php echo get_the_post_thumbnail_url(); ?>') 50%/cover no-repeat; color: #FFFFFF;">
    <div class="container">
      <div class="row">
        <div class="col-12 TEST">
          <h1><?php the_title()?></h1>

		       <p><?php echo get_field('event_date'); ?></p>

           <a href="<?php the_field('event_button_link'); ?>" class="btn btn-green header ga-event">
             <?php the_field('event_button_text'); ?>
           </a>
        </div>
      </div>
    </div>
  </section>



        <section class="category-events single">
          <div id="content" role="main">
            <div class="container">
              <div class="col-lg-9 mx-auto purple-bg text-center">
                <div class="row event-container d-flex justify-content-center">
                  <div class="col-lg-3  event-col d-flex align-items-stretch flex-column">
                    <h4>DATE & TIME</h4>
                      <?php echo $event_details['date_time']; ?>
                  </div>
                  <div class="col-lg-3  event-col d-flex align-items-stretch flex-column">
                    <h4>Location</h4>
                    <?php echo $event_details['location']; ?>
                  </div>
                  <div class="col-lg-3  event-col d-flex align-items-stretch flex-column">
                    <h4>Cost</h4>
                    <?php echo $event_details['cost']; ?>
                  </div>
                </div>
              </div>
              <div class="col-lg-9 mx-auto purple-bg text-center" style="padding: 20px 0;">
                <a href="<?php the_field('event_button_link'); ?>" class="btn btn-green header ga-event">
                  <?php the_field('event_button_text'); ?>
                </a>
              </div>
            </div>
          </div>

        <article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>
          <div class="container single-content">
            <div class="row">
              <div class="col-12">
                <header class="mb-5">

                  <div class="header-meta" style="padding-top: 20px;">
                    <?php
                      $post_object = get_field('author');
                      $date = get_the_date('jS F Y');
                      $post = $post_object;
                      $details_post = get_field('contact_details');
                      ?>
                        Posted on <?php echo $date; wp_reset_postdata(); ?>
                  </div><?php the_tags(); ?>
                </header>

                <section>


                  <?php
                            the_content();
                          ?>


                </section>
              </div>
            </div>
          </div>
          <?php
            $post_object = get_field('author');
            $date = get_the_date('jS F Y');
            $post = $post_object;
            $details_post = get_field('contact_details');
            wp_reset_postdata();
            ?>




        <?php if( $event_details['add_list'] == 'yes' ): ?>
             <?php if( $event_details['bullet_point_list'] ): ?>
                  <section class="txt pull-out" style="background: url('/wp-content/uploads/2019/04/bullet-bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-10 mx-auto">
                          <h3 class="purple"><?php echo $event_details['bullet_title']; ?></h3>
                            <?php

                            if( have_rows('event_details') ): while ( have_rows('event_details') ) : the_row();
                              if( have_rows('bullet_point_list') ): ?>
                                <ul class="styled">
                                  <?php while ( have_rows('bullet_point_list') ) : the_row(); ?>
                                    <li class="dpurple"><?php echo the_sub_field('bullet_point'); ?></li>
                                  <?php endwhile; ?>
                                </ul>
                                <?php else : ?>
                              <?php endif; ?>
                          <?php endwhile; endif; ?>
                        </div>
                      </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>

        <?php if( $event_details['add_quote'] == 'yes' ): ?>
            <section class="quote-section">
             <div class="highlights-slide">
              <div class="col-10 mx-auto text-center">
                <blockquote>
                 <p class="purple"><?php echo $event_details['quote']; ?></p>
                 <footer class="dpurple"><?php echo $event_details['quote_by']; ?></footer>
               </blockquote>
                <a href="<?php the_field('event_button_link'); ?>" class="btn btn-green header"><?php the_field('event_button_text'); ?></a>
              </div>
             </div>
            </section>
        <?php endif; ?>


         <?php if( $event_details['hosts'] ): ?>
                  <section class="txt hosts">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-10 mx-auto">
                          <h2 class="green text-center">About the hosts</h2>
                            <?php

                            if( have_rows('event_details') ): while( have_rows('event_details') ) : the_row();
                              if( have_rows('hosts') ): ?>
                                <?php while ( have_rows('hosts') ) : the_row(); ?>
                                  <div class="row regional-info mx-auto">

                                    <div class="col-lg-3" style="background: url('<?php echo the_sub_field('host_photo'); ?>') 50%/cover no-repeat; color: #FFFFFF; min-height:200px; max-height: 200px; margin-bottom: 20px;"></div>

                                    <div class="col-lg-8 mx-auto">
                                      <h4 class="purple" style="margin-top: 0;"><?php echo the_sub_field('host_name'); ?></h4>
                                      <p class="purple" style="text-transform: uppercase;"><?php echo the_sub_field('host_title'); ?></p>
                                      <?php echo the_sub_field('host_description'); ?>
                                    </div>
                                  </div>
                                <?php endwhile; ?>
                              <?php endif; ?>
                          <?php endwhile; endif; ?>

                          <div class="text-center">
                            <a href="<?php the_field('event_button_link'); ?>" class="btn btn-green header ga-event">
                              <?php the_field('event_button_text'); ?>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                </section>
        <?php endif; ?>

        <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="social-share">
					<p>Share:</p>
					  <p>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"> <img src="/wp-content/uploads/2020/09/fb-icon.png" alt="Facebook share"> </a>

                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=&summary=&source=" target="_blank"> <img src="/wp-content/uploads/2020/09/linkedin-icon.png" alt="LinkedIn share"> </a>

                        <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank"> <img src="/wp-content/uploads/2020/09/twitter-icon.png" alt="Twitter share"> </a>

                        <a href="mailto:info@example.com?&subject=&body=<?php the_permalink(); ?>" target="_blank"> <img src="/wp-content/uploads/2020/09/mail-icon1.png" alt="e-mail share"> </a>
					</p>
				</div>
              </div>
            </div>
          </div>

          <?php if( get_field('form_show') == 'yes' ): ?>
            <?php get_template_part('modules/blog-form'); ?>
          <?php endif; ?>

          <?php if( $event_details['related_expertise'] ): ?>
          <section class="txt text-center" style="background-color: #E3E3E3;">
              <div class="container">
                  <div class="row">
                      <div class="col-md-8 mx-auto">
                          <h2 style="color: #32214c;">Related Expertise</h2>

                          <hr class="heading purple">

                          <?php $expertises = $event_details['related_expertise'];
                              if( $expertises ): ?>
                                  <ul class="related-expertise">
                                  <?php foreach( $expertises as $post): ?>
                                          <?php setup_postdata($post); ?>
                                  <li>
                                              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                  </li>
                                  <?php endforeach; ?>
                              </ul>
                                  <?php wp_reset_postdata(); ?>
                              <?php endif;
                          ?>
                      </div>
                  </div>
              </div>
          </section>
          </article>
          <?php endif; ?>




    <!----- NEW LAYOUT ELSEIF STATEMENT ------>
    <?php elseif( get_field('use_old_layout') == 'no' ): ?>

        <section class="hero text-center" style="background: url('<?php echo get_the_post_thumbnail_url(); ?>') 50%/cover no-repeat; color: #FFFFFF;">
        <div class="container">
          <div class="row">
            <div class="col-12 TEST">
              <h1><?php the_title()?></h1>

                   <p><?php echo get_field('event_date2'); ?></p>

               <?php if(get_field('add_event_button') == 'yes'): ?>
                 <a href="<?php the_field('event_button_link'); ?>" class="btn btn-green header ga-event">
                   <?php the_field('event_button_text'); ?>
                 </a>
               <?php endif; ?>
            </div>
          </div>
        </div>
      </section>

      <section class="category-events">
        <div id="content" role="main">
          <div class="container">

            <div class="row">

              <div class="col-12 col-lg-7 mx-auto intro-text">
                <p><?php the_field('intro_title'); ?></p>
              </div>

              <div class="col-12 col-lg-2 mr-auto purple-bg text-center info-box" style="padding-top: 20px; padding-bottom: 20px;">


                    <h5 class="white">DATE & TIME</h5>
                    <p><?php the_field('date_time'); ?></p>


                    <h5 class="white">Location</h5>
                    <p><?php the_field('event_location'); ?></p>


                    <h5 class="white">Cost</h5>
                    <p><?php the_field('cost'); ?></p>


              </div>


            </div>


          </div>
        </div>

        <article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>
        <div class="single-content">



      <?php if( have_rows('event_modules') ):
              while ( have_rows('event_modules') ) : the_row();

                if( get_row_layout() == 'text_block' ): ?>
                    <section class="txt" <?php if( get_sub_field('add_bg_img') == 'yes'): ?>style="background: url('<?php the_sub_field('background_image'); ?>') 50% / cover no-repeat; color: #FFFFFF; "<?php endif; ?>>
                      <div class="container">
                        <div class="row">

                            <div class="col-12 col-lg-10 mx-auto">
                               <?php if( get_sub_field('title') ): ?>
                                    <h2 class="purple">
                                      <?php the_sub_field('title'); ?>
                                    </h2>
                              <?php endif; ?>
                                    <div <?php if( get_sub_field('add_bg_img') == 'yes'): ?> style="color: #32214c;" <?php else : ?> <?php endif; ?>>
                                    <?php the_sub_field('text'); ?>
                                    </div>
                            </div>

                            <?php if( get_sub_field('show_event_button') == 'yes'): ?>
                            <div class="col-12 col-lg-7 mx-auto">
                              <a href="<?php the_field('event_button_link'); ?>" class="btn btn-green header ga-event" style="width: 100%; margin-bottom: 20px;">
                                <?php the_field('event_button_text'); ?>
                              </a>
                            </div>
                            <?php endif; ?>






                        </div>
                      </div>
                    </section>

                <?php elseif( get_row_layout() == 'cta_row'): ?>

                  <section class="cta-banner text-center" style="background: url('<?php echo the_sub_field('bg_img'); ?>') 50%/cover no-repeat; color: #FFFFFF;">
                    <div class="container">
                      <div class="row">
                        <?php if( get_sub_field('add_image') == 'yes' ): ?>
                          <div class="col-8 col-md-6 ml-auto">

                            <?php $image = get_sub_field('image');

                              if( !empty($image) ): ?>

                                <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

                              <?php endif; ?>

                          </div>

                          <div class="col-12 w-image col-md-6" style="text-align: left;">
                            <div>
                              <h2 class="header"><?php the_sub_field('title'); ?></h2>

                              <p class="regular"><?php the_sub_field('sub_title'); ?></p>

                              <?php if( get_sub_field('add_button') == 'yes' ): ?>
                                <a href="<?php the_sub_field('button_link'); ?>" class="btn btn-green header" tabindex="0"><?php the_sub_field('button_text'); ?></a>
                              <?php endif; ?>
                            </div>
                          </div>

                              <?php else: ?>
                                <div class="col-12">

                                  <h2 class="header"><?php the_sub_field('title'); ?></h2>

                                  <p class="regular"><?php the_sub_field('sub_title'); ?></p>

                                  <?php if( get_sub_field('add_button') == 'yes' ): ?>
                                    <a href="<?php the_sub_field('button_link'); ?>" class="btn btn-green header" tabindex="0"><?php the_sub_field('button_text'); ?></a>
                                  <?php endif; ?>

                                </div>
                              <?php endif; ?>

                      </div>
                    </div>
                  </section>


                <?php elseif( get_row_layout() == 'speakers' ): ?>

                  <section class="txt hosts grey-bg">
                    <div class="container">
                      <div class="row">
                        <div class="col-md-10 mx-auto">
                          <?php if( get_sub_field('title') ): ?>
                              <h2 class="green">
                                <?php the_sub_field('title'); ?>
                              </h2>
                          <?php endif; ?>

                          <?php


                          if( have_rows('speaker') ): ?>
                            <?php while ( have_rows('speaker') ) : the_row(); ?>

                              <?php if( get_sub_field('is_bm_staff') == 'yes'): ?>

                                <?php
                                    $post_object = get_sub_field('blake_morgan_staff');
                                    $post = $post_object;
                                    $details_post = get_field('contact_details');
                                    ?>
                                  <?php if ( get_field('contact_details') ) : ?>

                                    <div class="row regional-info mx-auto">

                                            <div class="col-6 col-lg-3" style="background: url('<?php echo $details_post['img']; ?>') 50%/cover no-repeat; color: #FFFFFF; min-height:200px; max-height: 200px; margin-bottom: 20px;"></div>

                                            <div class="col-lg-8 mx-auto">
                                              <h4 class="purple" style="margin-top: 0;"><?php echo $details_post['first_name']; ?> <?php echo $details_post['last_name']; ?></h4>
                                              <p class="purple" style="text-transform: uppercase;"><?php echo $details_post['job_title']; ?></p>
                                              <?php echo the_sub_field('speaker_bio'); ?>
                                            </div>


                                    </div>

                                <?php endif; ?><?php wp_reset_postdata(); ?>

                              <?php elseif( get_sub_field('is_bm_staff') == 'no'): ?>

                                  <div class="row regional-info mx-auto">

                                            <div class="col-6 col-lg-3" style="background: url('<?php echo the_sub_field('external_speaker_photo'); ?>') 50%/cover no-repeat; color: #FFFFFF; min-height:200px; max-height: 200px; margin-bottom: 20px;"></div>

                                            <div class="col-lg-8 mx-auto">
                                              <h4 class="purple" style="margin-top: 0;"><?php echo the_sub_field('external_speaker_name'); ?></h4>
                                              <p class="purple" style="text-transform: uppercase;"><?php echo the_sub_field('external_speaker_title'); ?></p>
                                              <?php echo the_sub_field('speaker_bio'); ?>
                                            </div>


                                  </div>


                              <?php endif; ?>

                            <?php endwhile; ?>
                          <?php endif; ?>

                        </div>

                      </div>
                    </div>
                  </section>

              <?php endif; ?>




     <?php
        endwhile;
          endif; ?>

    </div>

     <div class="container">
      <div class="row">
        <div class="col-md-10 mx-auto">
          <div class="social-share">
              <p>Share:</p>
                <p>
                  <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"> <img src="/wp-content/uploads/2020/09/fb-icon.png" alt="Facebook share"> </a>

                  <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=&summary=&source=" target="_blank"> <img src="/wp-content/uploads/2020/09/linkedin-icon.png" alt="LinkedIn share"> </a>

                  <a href="https://twitter.com/home?status=<?php the_permalink(); ?>" target="_blank"> <img src="/wp-content/uploads/2020/09/twitter-icon.png" alt="Twitter share"> </a>

                  <a href="mailto:info@example.com?&subject=&body=<?php the_permalink(); ?>" target="_blank"> <img src="/wp-content/uploads/2020/09/mail-icon1.png" alt="e-mail share"> </a>
              </p>
          </div>
        </div>
      </div>
    </div>

    <!---- blog cta ------>
  <?php if( get_field('add_blog_cta') == 'yes' ): ?>
    <?php $cta_post_object = get_field('choose_cta');
          if( $cta_post_object ):
            $post = $cta_post_object;
          ?>
    <?php setup_postdata($post); ?>
    <?php if( get_field('blog_or_page') == 'blog' ): ?>
          <section class="cta-banner text-center" style="background: url('<?php echo the_field('background_image'); ?>') 50%/cover no-repeat; color: #FFFFFF;">
            <div class="container">
              <div class="row">
                <!--- if you want to include image on cta --->
                <?php if( get_field('add_image') == 'yes' ): ?>
                  <div class="col-8 col-md-6 ml-auto">

                    <?php $image = get_field('image');

                      if( !empty($image) ): ?>

                        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

                      <?php endif; ?>

                  </div>

                  <div class="col-12 w-image col-md-6" style="text-align: left;">
                    <div>
                      <h2 class="header"><?php the_field('title'); ?></h2>

                      <p class="regular"><?php the_field('sub_title'); ?></p>

                      <?php if( get_field('add_button') == 'yes' ): ?>

                        <?php if( get_field('popup_or_pagelink') == 'pagelink' ): ?>

                        <a href="<?php the_field('button_link'); ?>" class="btn btn-green header" tabindex="0"><?php the_field('button_text'); ?></a>

                        <?php elseif( get_field('popup_or_pagelink') == 'external' ): ?>

                          <a href="<?php the_field('external_link'); ?>" class="btn btn-green header" tabindex="0"><?php the_field('button_text'); ?></a>

                        <?php elseif( get_field('popup_or_pagelink') == 'popup' ): ?>

                            <a href="javascript:void(0)" class="btn btn-green header" data-toggle="modal" data-name="<?php echo $mypost->post_title; ?>" data-target="#btn-customcta-modal-<?php echo get_the_ID(); ?>145">
                              <?php the_field('button_text'); ?>
                            </a>

                            <?php get_template_part('modules/modal-cta'); ?>

                        <?php endif; ?>
                      <?php endif; ?>
                    </div>
                  </div>

                  <?php elseif( get_field('add_image') == 'no' ): ?>
                   <!---- if you want a full width column with no image just text ---->

                  <div class="col-12">

                    <h2 class="header"><?php the_field('title'); ?></h2>

                    <p class="regular"><?php the_field('sub_title'); ?></p>

                    <?php if( get_field('add_button') == 'yes' ): ?>

                        <?php if( get_field('popup_or_pagelink') == 'pagelink' ): ?>

                        <a href="<?php the_field('button_link'); ?>" class="btn btn-green header" tabindex="0"><?php the_field('button_text'); ?></a>

                        <?php elseif( get_field('popup_or_pagelink') == 'external' ): ?>

                          <a href="<?php the_field('external_link'); ?>" class="btn btn-green header" tabindex="0"><?php the_field('button_text'); ?></a>

                        <?php elseif( get_field('popup_or_pagelink') == 'popup' ): ?>

                            <a href="javascript:void(0)" class="btn btn-green header" data-toggle="modal" data-name="<?php echo $mypost->post_title; ?>" data-target="#btn-customcta-modal-<?php echo get_the_ID(); ?>145">
                              <?php the_field('button_text'); ?>
                            </a>

                            <?php get_template_part('modules/modal-cta'); ?>

                        <?php endif; ?>
                      <?php endif; ?>

                  </div>


              <?php endif; ?>
              </div>

            </div>
          </section>
        <?php wp_reset_postdata(); ?>
      <?php endif; ?>
    <?php endif; ?>
  <?php endif; ?>
  <!---- end of blog cta ------>
  </article>




    <?php endif; ?><!----- END OF OLD LAYOUT IF STATEMENT ------>

        </article>


<?php
  // This continues in the single post loop
  endwhile; else :
    get_template_part('loops/404');
  endif;
?>



    </div><!-- /#content -->
  </section>

</main><!-- /.container -->

<?php
    b4st_main_after();
    get_footer();
?>
