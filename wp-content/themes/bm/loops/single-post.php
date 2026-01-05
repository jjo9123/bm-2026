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
          <header class="mb-2">
            <h1><?php the_title()?></h1>

            <hr class="blog heading green">

            <div class="header-meta">
              <?php
                $post_object = get_field('author');
                $date = get_the_date('jS F Y');
              	$post = $post_object;
                $details_post = get_field('contact_details');
                ?>
                <?php if( $category === "guides" ): ?>

                <?php else: ?>
                 <p><?php echo $date; wp_reset_postdata(); ?></p>
                <?php endif; ?>
            </div><?php wp_reset_postdata(); ?>
          </header>

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

                    <div class="col-12 col-md-4">
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

          <div class="container">
            <div class="row">
              <div class="col-12">
                <p><?php the_tags(); ?></p>
                <div class="social-share">
					<p>Share:</p>
					  <p>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"> <img src="/wp-content/uploads/2020/09/fb-icon.png" alt="Facebook share"> </a>

                        <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=&summary=&source=" target="_blank"> <img src="/wp-content/uploads/2020/09/linkedin-icon.png" alt="LinkedIn share"> </a>

                        <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" target="_blank"> <img src="/wp-content/themes/bm/theme/img/x-icon.png" alt="x share"> </a>

                        <a href="mailto:?&subject=&body=<?php the_permalink(); ?>" target="_blank"> <img src="/wp-content/uploads/2020/09/mail-icon1.png" alt="e-mail share"> </a>
					</p>
				</div>
              </div>
            </div>
          </div>

    <!--- ADD FORM --->
    <?php if( get_field('form_show') == 'yes' ): ?>
      <?php get_template_part('modules/blog-form'); ?>
    <?php endif; ?>
    <!--- END OF ADD FORM --->

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

                            <a href="javascript:void(0)" class="btn btn-green header" data-toggle="modal" data-name="<?php echo esc_attr(get_the_title()); ?>" data-target="#btn-customcta-modal-<?php echo get_the_ID(); ?>145">
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


  <?php
    $terms = get_the_terms( get_the_ID(), 'expertise' );
    $terms_array = array();
    foreach ( $terms as $term ) {
      $terms_array [] = $term->slug;
    }
    $expertise = join( ", ", $terms_array );

    $tags = get_the_tags();
    if ( $tags ) {
      foreach( $tags as $tag ) {
        if ($tag->name == 'counsel plus') {
          $counsel = 1;
        }
      }
    }

    if( $terms OR $tags ): ?>

    <?php if($terms_array[0] == 'medical-accident-and-injury'): ?>

      <section class="blog recent" style="background: url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
        <div class="container-fluid news">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <h2 class="text-center">Enjoy That? You Might Like These:</h2>

                <hr class="heading green">
              </div>

              <?php
            		$the_query = new WP_Query(array(
            			'showposts' => '3',
            			'post_type' => 'post',
                  'post__not_in' => array($currentID),
                  'cat' => '-27070',
            			'tax_query' => array(
            				array(
            				'taxonomy' => 'expertise',
            				'field' => 'slug',
            				'terms' => 'medical-accident-and-injury')
            			))
            		); ?>

              <?php if ( $the_query->have_posts() ) : ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                  <?php $post_orig = get_the_ID(); ?>

                  <?php
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                      $category = esc_html( $categories[0]->slug );
                    };
                  ?>

                  <div class="col-sm-6 col-md-4 text-center item i<?php echo $category; ?>">
                    <div class="title">
                      <p>
                        <?php if ( ! empty( $categories ) ) {
                          echo mb_strtolower($category, 'utf8');
                        }; ?>
                    </p>
                    </div>

                    <div class="img" style="background: url('<?php echo the_post_thumbnail_url( 'recent_fimg' ); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

                    <div class="header">
                      <a href="<?php the_permalink(); ?>">
                        <h6><?php the_title(); ?></h6>
                      </a>
                    </div>

                    <div class="excerpt">
                      <?php
                        $post_object = get_field('author');
                        $post = $post_object;
                        $details_recent = get_field('contact_details');
                      ?>

                      <div class="date"><?php the_time('j F'); ?> <?php if ( $post_object ): ?>- <?php echo $details_recent['first_name']; ?> <?php echo $details_recent['last_name']; ?><?php endif; ?></div>

                      <?php $post_intro = get_field('blog_intro'); ?>
                      <?php if ( $post_intro ): ?>

                        <?php echo wp_trim_words( $post_intro, 30, '...'); ?>

                      <?php else: ?>

                        <?php $excerpt = get_the_content(); echo wp_trim_words( $excerpt, 30, '...' ); ?>

                      <?php endif; ?>

                      <a href="<?php the_permalink(); ?>" class="btn btn-purple">Read More</a>
                    </div>
                  </div>



                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>

              <?php else : ?>
                <p><?php __('No Posts'); ?></p>
              <?php endif; ?>
            </div>
            <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
              <a href="/blog" class="btn btn-green">Click here for more Insights</a>
            </div>
          </div>
        </div>
      </section>

    <?php elseif( $counsel === 1 ): ?>

      <section class="blog recent" style="background: url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
        <div class="container-fluid news">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <h2 class="text-center">Enjoy That? You Might Like These:</h2>

                <hr class="heading green">
              </div>

              <?php
            		$the_query = new WP_Query(array(
            			'showposts' => '3',
            			'post_type' => 'post',
                  'tag'       => 'counsel-plus',
                  'post__not_in' => array($currentID)
            			)
            		); ?>

              <?php if ( $the_query->have_posts() ) : ?>
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                  <?php $post_orig = get_the_ID(); ?>

                  <?php
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) {
                      $category = esc_html( $categories[0]->slug );
                    };
                  ?>

                  <div class="col-sm-6 col-md-4 text-center item i<?php echo $category; ?>">
                    <div class="title">
                      <p>
                        <?php if ( ! empty( $categories ) ) {
                          echo mb_strtolower($category, 'utf8');
                        }; ?>
                    </p>
                    </div>

                    <div class="img" style="background: url('<?php echo the_post_thumbnail_url( 'recent_fimg' ); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

                    <div class="header">
                      <a href="<?php the_permalink(); ?>">
                        <h6><?php the_title(); ?></h6>
                      </a>
                    </div>

                    <div class="excerpt">
                      <?php
                        $post_object = get_field('author');
                        $details_recent = get_field('contact_details');
                      ?>

                      <div class="date"><?php the_date('j F'); ?> <?php if ( $post_object ): ?> <?php echo $details_recent['first_name']; ?> <?php echo $details_recent['last_name']; ?><?php endif; ?></div>

                      <?php $post_intro = get_field('blog_intro'); ?>
                      <?php if ( $post_intro ): ?>

                        <?php echo wp_trim_words( $post_intro, 30, '...'); ?>

                      <?php else: ?>

                        <?php $excerpt = get_the_content(); echo wp_trim_words( $excerpt, 30, '...' ); ?>

                      <?php endif; ?>

                      <a href="<?php the_permalink(); ?>" class="btn btn-purple">Read More</a>
                    </div>
                  </div>



                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>

              <?php else : ?>
                <p><?php __('No Posts'); ?></p>
              <?php endif; ?>
            </div>
            <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
              <a href="/blog" class="btn btn-green">Click here for more Insights</a>
            </div>
          </div>
        </div>
      </section>

    <?php else: ?>

    <section class="blog recent" style="background: url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container-fluid news">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="text-center">Enjoy That? You Might Like These:</h2>

              <hr class="heading green">
            </div>

            <?php
          		$the_query = new WP_Query(array(
          			'showposts' => '3',
          			'post_type' => 'post',
                'post__not_in' => array($currentID),
                'cat' => '-27070',
          			'tax_query' => array(
          				array(
          				'taxonomy' => 'expertise',
          				'field' => 'slug',
          				'terms' => $terms_array[0])
          			))
          		); ?>

            <?php if ( $the_query->have_posts() ) : ?>
              <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <?php $post_orig = get_the_ID(); ?>

                <?php
                  $categories = get_the_category();
                  if ( ! empty( $categories ) ) {
                    $category = esc_html( $categories[0]->slug );
                  };
                ?>

                <div class="col-sm-6 col-md-4 text-center item i<?php echo $category; ?>">
                  <div class="title">
                    <p>
                      <?php if ( ! empty( $categories ) ) {
                        echo mb_strtolower($category, 'utf8');
                      }; ?>
                  </p>
                  </div>

                  <div class="img" style="background: url('<?php echo the_post_thumbnail_url( 'recent_fimg' ); ?>') 50%/cover no-repeat; color: #FFFFFF;"></div>

                  <div class="header">
                    <a href="<?php the_permalink(); ?>">
                      <?php if($categories[0]->slug == 'events'): ?>
                        <h6><?php echo get_the_title($the_query->post->ID); ?> - <?php echo get_field('event_date'); ?></h6>
                      <?php else: ?>
                        <h6><?php the_title(); ?></h6>
                      <?php endif; ?>
                    </a>
                  </div>

                  <div class="excerpt">
                    <?php
                      $post_object = get_field('author');
                      $post = $post_object;
                      $details_recent = get_field('contact_details');
                      $post = $post_orig;
                      setup_postdata( $post );
                    ?>

                    <div class="date">
                      <?php the_time('j F'); ?>
                      <?php if ( $post_object && !empty($details_recent) ): ?>
                        - <?php echo esc_html($details_recent['first_name'] . ' ' . $details_recent['last_name']); ?>
                      <?php endif; ?>
                    </div>
                    <?php $post_intro = get_field('blog_intro'); ?>
                    <?php if ( $post_intro ): ?>

                      <?php echo wp_trim_words( $post_intro, 30, '...'); ?>

                    <?php else: ?>

                      <?php $excerpt = get_the_content(); echo wp_trim_words( $excerpt, 30, '...' ); ?>

                    <?php endif; ?>

                    <a href="<?php the_permalink(); ?>" class="btn btn-purple">Read More</a>
                  </div>
                </div>



              <?php endwhile; ?>
              <?php wp_reset_postdata(); ?>

            <?php else : ?>
              <p><?php __('No Posts'); ?></p>
            <?php endif; ?>
          </div>
          <div class="row justify-content-center" style="padding-top:20px; padding-bottom: 40px;">
            <a href="/blog" class="btn btn-green">Click here for more Insights</a>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>
  <?php endif; ?>

  </article>

<?php
  // This continues in the single post loop
  endwhile; else :
    get_template_part('loops/404');
  endif;
?>