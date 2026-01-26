<section class="img-txt-row" style="background-color: #E3E3E3;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h2 class="text-center green"><?php the_sub_field('title'); ?></h2>

      </div>
    </div>

    <?php
    if( have_rows('content_row') ):
      while ( have_rows('content_row') ) : the_row(); ?>
        <div class="row regional-info mx-auto">

          <div class="col-lg-3 client-logo" style="background: url('<?php the_sub_field('image'); ?>') 50%/cover no-repeat; color: #FFFFFF; background-size: contain;"></div>

          <div class="col-lg-7">
            <h3><?php the_sub_field('title'); ?></h3>
            <?php the_sub_field('content'); ?>
          </div>
        </div>
      <?php endwhile;
    endif;?>
  </div>
</section>
