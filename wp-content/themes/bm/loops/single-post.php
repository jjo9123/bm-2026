<?php
/*
 * The Single Post
 */
$counsel = 0;
?>
<?php $categories = get_the_category();
  if ( ! empty( $categories ) ) {
    $category = esc_html( $categories[0]->slug );
  }; ?>

<?php /* Single post loop */ if(have_posts()): while(have_posts()): the_post(); $currentID = get_the_ID(); ?>
  <article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>
     <div class="container single-content">
      <div class="row">
        <div class="col-12">
          

           


          <!--- NEW BLOG LAYOUT CLOSE ABOVE CONTAINER FOR FULL WIDTH --->
          <?php if( get_field('new_blog_layout') == 'yes' ): ?>
              </div>
            </div>
          </div>

          <?php endif; ?>
          <!--- END OF NEW BLOG LAYOUT CLOSE ABOVE CONTAINER FOR FULL WIDTH --->


          <section>
            <!----- GUIDES LAYOUT------>
            <?php if( $category === "guides" ): ?>
              <div class="row">

                <div class="col-lg-5">
                  <?php $guide_cover = get_field('guide_cover'); ?>

                    <img style="max-width: 250px; margin:auto; display: block; padding-bottom: 20px;" src="<?php echo $guide_cover['url']; ?>" alt="<?php echo $guide_cover['alt']; ?>" />


                  </div>

                  <div class="col-lg-7">
                    <?php the_content(); ?>
                    <?php
                     $guide_btn_txt = get_field('button_txt');
                    if( !empty($guide_btn_txt) ): ?>
                      <a href="<?php echo the_field('button_link'); ?>" class="btn btn-green header ga4-guides" target="_blank" data-name="<?php the_title(); ?>"><?php echo $guide_btn_txt; ?></a>
                    <?php endif; ?>
                  </div>



              </div>
            <?php endif; ?>
            <!----- END OF GUIDE LAYOUT ------->

            <!----- NEW LAYOUT ELSEIF STATEMENT ------>
            <?php if( get_field('new_blog_layout') == 'no' OR get_field('new_blog_layout') == null && $category !== "guides" OR get_field('new_blog_layout') == 'no' && $category !== "guides" ): ?>

                    <?php
                      the_content();
                      wp_link_pages();
                    ?>

            <?php elseif( get_field('new_blog_layout') == 'yes' ): ?>


                    <style>
                      .txt.new-blog blockquote::before, .txt.new-blog blockquote::after {
                        content: '';
                      }
                    </style>
                    <section class="txt new-blog" style="padding-top: 0; padding-bottom: 0;">
                      <div class="container">
                        <div class="row">

                            <div class="col-12 col-lg-12 mx-auto">

                               <?php the_field('blog_intro'); ?>

                            </div>

                        </div>
                      </div>
                    </section>
                    <div class="new-blog-content">
                      <?php
                          if( have_rows('blog_modules') ):
                            while ( have_rows('blog_modules') ) : the_row();
                              if( get_row_layout() == 'text_block' ):
                                get_template_part('modules/new-blog-modules/txt_block');

                              elseif( get_row_layout() == 'pull_out' ):
                                get_template_part('modules/new-blog-modules/pullout');

                              elseif( get_row_layout() == 'quote' ):
                                get_template_part('modules/new-blog-modules/quote');

                              elseif( get_row_layout() == 'table' ):
                                get_template_part('modules/new-blog-modules/table');

                              elseif( get_row_layout() == 'accordion_block' ):
                                get_template_part('modules/new-blog-modules/accordion-block');

                              endif;
                            endwhile;
                          endif; ?>
                      </div>

            <?php endif; ?>
            <!----- END OF NEW LAYOUT ELSEIF STATEMENT ------>

          </section>

            <!--- OLD BLOG LAYOUT CLOSE ABOVE BLOG ROW AND CONTAINER --->
            <?php if( get_field('new_blog_layout') == 'no'  OR get_field('new_blog_layout') == null ): ?>

                </div>
              </div>
            </div>

            <?php endif; ?><!-- close end if for checking if new blog layout is no -->

          <?php get_template_part('modules/parts/single-post/social-share'); ?>

          <!--- AUTHOR INFO ---->
          <?php $featured_authors = get_field('author');
            if( $featured_authors ): ?>
                <footer class="pt-4 pb-3" style="background-color: #fff;">
                  <div class="author-bio media">
                    <div class="container">
                      <div class="row">
                        <div class="col-12">
                          <p>Written by</p>
                        </div>

                <?php foreach( $featured_authors as $post ): 
            
                    // Setup this post for WP functions (variable must be named $post).
                    setup_postdata($post); 
                     $details_post = get_field('contact_details'); ?>
                    <div class="col-12 col-md-2 text-center author-img">
                        <?php if ( !empty($details_post) ): ?>
                          <img src="<?php echo esc_url($details_post['img']); ?>" alt="<?php echo esc_attr($details_post['first_name'] . ' ' . $details_post['last_name']); ?>">
                        <?php endif; ?>
                    </div>

                    <div class="col-12 col-md-4 pb-3">
                        <div class="media-body author-detail">

                          <p class="h5 author-name">
                            <?php if (!empty($details_post['first_name']) || !empty($details_post['last_name'])) {
                              echo esc_html($details_post['first_name'] . ' ' . $details_post['last_name']);
                            } ?>
                          </p>

                          <p class="h5 author-title">
                            <?php if (!empty($details_post['job_title'])) {
                              echo esc_html($details_post['job_title']);
                            } ?>
                          </p>

                          <p class="author-bio mt-3">
                          </p>

                          <!--<a href="javascript:void(0)" class="btn btn-purple">Contact The Author</a>-->

                          <a href="<?php the_permalink(); ?>" class="btn btn-purple">View Author Profile</a>
                        </div>
                    </div>
                <?php endforeach; ?>
                    </div><!-- /.author-bio -->
                    </div>
                  </div>
                </footer>
                <?php 
                // Reset the global post object so that the rest of the page works correctly.
                wp_reset_postdata(); ?>
            <?php endif; ?>

    <!--- ADD FORM --->
    <?php if( get_field('form_show') == 'yes' ): ?>
      <?php get_template_part('modules/blog-form'); ?>
    <?php endif; ?>
    <!--- END OF ADD FORM --->

    <?php get_template_part('modules/parts/single-post/blog-cta'); ?>



    <?php get_template_part('modules/parts/single-post/related-posts'); ?>

  </article>

<?php
  // This continues in the single post loop
  endwhile; else :
    get_template_part('loops/404');
  endif;
?>