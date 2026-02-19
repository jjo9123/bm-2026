<?php
/*
 * The Single Post
 */
?>

<?php /* Single post loop */ if(have_posts()): while(have_posts()): the_post(); ?>
  <article role="article" id="post_<?php the_ID()?>" <?php post_class()?>>
    
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


    <?php get_template_part('modules/parts/single-post/related-press'); ?>
<?php
  // This continues in the single post loop
  endwhile; else :
    get_template_part('loops/404');
  endif;
?>
