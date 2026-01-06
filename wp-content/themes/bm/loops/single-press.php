<?php
/*
 * The Single Post
 */
?>

<?php /* Single post loop */ if(have_posts()): while(have_posts()): the_post(); ?>
  <article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>
    <div class="container single-content mb-2">
      <div class="row">
        <div class="col-12">
          <header class="">
            <h1><?php the_title()?></h1>

            <hr class="blog heading green">

            <div class="header-meta">Posted on <?php the_date('jS F Y'); ?></div>
          </header>

          <?php if( get_field('new_blog_layout') == 'no' OR get_field('new_blog_layout') == null ): ?>
            
            <section>
              <?php
                the_content();
                wp_link_pages();
              ?>
            </section>
          
          <?php endif; ?>
          
        </div>
      </div>
    </div>
    
    <!----- NEW LAYOUT ELSEIF STATEMENT ------>
          
                    
            <?php if( get_field('new_blog_layout') == 'yes' ): ?>
            
                  
                    <style>
                      .txt.new-blog blockquote::before, .txt.new-blog blockquote::after {
                        content: '';
                      }
                    </style>
                    <section class="txt new-blog" style="padding-bottom: 0;">
                      <div class="container">
                        <div class="row">
                          
                            <div class="col-12 col-lg-12 mx-auto">
                              
                               <?php the_field('blog_intro'); ?>
                    
                            </div>
                    
                        </div>
                      </div>
                    </section>

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
                        
                            endif;
                          endwhile;
                        endif; ?>

            <?php endif; ?>
            
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
                        
                        <a href="mailto:info@example.com?&subject=&body=<?php the_permalink(); ?>" target="_blank"> <img src="/wp-content/uploads/2020/09/mail-icon1.png" alt="e-mail share"> </a>
					</p>
				</div>
              </div>
            </div>
          </div>

    <?php if( get_field('form_show') == 'yes' ): ?>
      <?php get_template_part('modules/blog-form'); ?>
    <?php endif; ?>
    
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


    <section class="blog recent" style="background: url('/wp-content/uploads/2019/01/recent_bg.jpg') 50%/cover no-repeat; color: #FFFFFF;">
      <div class="container-fluid news">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <h2 class="text-center">Enjoy That? You Might Like These:</h2>

              <hr class="heading green">
            </div>

            <?php
               // the query
               $the_query = new WP_Query( array(
                 'post_type' => 'press',
                 'posts_per_page' => 3
               ));
            ?>

            <?php if ( $the_query->have_posts() ) : ?>
              <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <?php $post_orig = get_the_ID(); ?>

                <?php
                  $categories = get_the_category();
                  if ( ! empty( $categories ) ) {
                    $category = esc_html( $categories[0]->slug );
                  };
                ?>

                <div class="col-md-6 col-lg-4 text-center item i<?php echo $category; ?>">
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
                      $post = $post_orig;
                      setup_postdata( $post );
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
            <a href="/press" class="btn btn-green">Click here for more news features</a>
          </div>
        </div>
      </div>
    </section>
  </article>

<?php
  // This continues in the single post loop
  endwhile; else :
    get_template_part('loops/404');
  endif;
?>
