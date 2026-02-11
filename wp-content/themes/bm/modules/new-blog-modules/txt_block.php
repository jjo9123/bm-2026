<style>
  .txt.new-blog blockquote::before, .txt.new-blog blockquote::after {
    content: '';
  }
  .txt.new-blog blockquote {
    padding-left: 50px;
    padding-right: 50px;
    padding-top: 20px;
  }
</style>
<section class="txt new-blog <?php if( get_sub_field('white_or_grey') == 'grey'): ?> bm-beige<?php endif; ?>">
  <div class="container">
    <div class="row">
      
        <div class="col-12 col-lg-12 mx-auto">
           <?php if( get_sub_field('title') ): ?>
                <h2>
                  <?php the_sub_field('title'); ?>
                </h2>
           <?php endif; ?>
           <?php the_sub_field('text'); ?>

        </div>

    </div>
  </div>
</section>
