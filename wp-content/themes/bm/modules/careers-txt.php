<section class="careers <?php if( get_sub_field('left_or_centred') == 'centred'): ?>text-center<?php endif; ?> <?php if( get_sub_field('background_colour') == 'grey'): ?> grey<?php endif; ?>" <?php if( get_sub_field('bgimg')): ?>style="background: url('<?php echo the_sub_field('bgimg'); ?>') 50%/cover no-repeat;"<?php endif; ?>>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <?php if( get_sub_field('heading') ): ?>
          <h2><?php the_sub_field('heading'); ?></h2>

        <?php endif; ?>

        <?php the_sub_field('txt'); ?>
      </div>
    </div>

    <?php
      if( get_sub_field('btn_show') == 'yes'):
        $link = get_sub_field('btn_link'); ?>
          <div class="row" style="text-align: center;">
            <div class="col-12">
              <a href="<?php echo the_sub_field('btn_link'); ?>" class="btn btn-purple header">
                <?php echo the_sub_field('btn_txt'); ?>
              </a>
            </div>
          </div>
        <?php endif;
      ?>
  </div>
</section>

<style>
.careers p {
    margin-bottom: 40px;
}
</style>
