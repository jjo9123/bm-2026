<section class="careers">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 mx-auto">
        <?php if( get_sub_field('heading') ): ?>
          <h2 class="pb-4"><?php the_sub_field('heading'); ?></h2>
        <?php endif; ?>

        <?php the_sub_field('txt'); ?>
      </div>
    </div>

    <?php
      if( get_sub_field('btn_show') == 'yes'):
        $link = get_sub_field('btn_link'); ?>
          <div class="row">
            <div class="col-12">
              <a href="<?php echo the_sub_field('btn_link'); ?>" class="btn btn-green header">
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
