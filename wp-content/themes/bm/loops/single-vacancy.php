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
          </header>
            
          <section>
            <?php
              the_content();
              wp_link_pages();
            ?>
          </section>
        </div>
      </div>
    </div>
  </article>

<?php
  // This continues in the single post loop
  endwhile; else :
    get_template_part('loops/404');
  endif;
?>
