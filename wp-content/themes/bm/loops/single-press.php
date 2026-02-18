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
            
            <?php get_template_part('modules/parts/single-post/social-share'); ?>

    <?php if( get_field('form_show') == 'yes' ): ?>
      <?php get_template_part('modules/blog-form'); ?>
    <?php endif; ?>
    
    <?php get_template_part('modules/parts/single-post/blog-cta'); ?>


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
