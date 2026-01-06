<?php

 $categories = get_the_category();
 if ( ! empty( $categories ) ) {
   $category = esc_html( $categories[0]->slug );
 };

?>

<div class="col-md-6 col-lg-4 text-center item">
  <div class="header">
    <a href="<?php the_permalink(); ?>">
      <h6><?php the_title(); ?></h6>
    </a>
  </div>

  <div class="excerpt">
    <div class="excerpt-top">
      <div class="tags">
        <?php echo strip_tags(get_the_term_list( $post->ID, 'expertise', '', ' | ', '' )); ?>
      </div>

      <?php $post_intro = get_field('blog_intro'); ?>
      <?php if ( $post_intro ): ?>
      
        <?php echo wp_trim_words( $post_intro, 30, '...'); ?>
        
      <?php else: ?>
        
        <?php $excerpt = get_the_content(); echo wp_trim_words( $excerpt, 30, '...' ); ?>
      
      <?php endif; ?>
    </div>

    <div class="excerpt-bottom">
      <a href="<?php the_permalink(); ?>" class="btn btn-purple">Read More</a>
    </div>
  </div>
</div>
