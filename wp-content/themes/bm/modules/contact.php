<section class="contact" style="background: #404040 url('<?php the_sub_field('bg_image'); ?>') 50%/cover no-repeat; color: #FFFFFF;">
  <div class="container">
    <div class="row" id="contact-footer">
      <div class="col-lg-12 mb-4">
        <h2 class="text-center white">
          <?php the_sub_field('heading'); ?>
        </h2>

        <hr class="heading purple">
      </div>

      <div class="col-lg-4 form-left">
      <h2><?php the_sub_field('heading'); ?></h2>
        <?php if( get_sub_field('txt_choice') == 'global'): ?>
          <p><?php the_field('txt', 'options'); ?></p>
        <?php else: ?>
          <p><?php the_sub_field('txt'); ?></p>
        <?php endif; ?>
      </div>

      <div class="col-lg-7 ml-auto">
        <?php
          $form_object = get_sub_field('form');
          gravity_form_enqueue_scripts($form_object['id'], true);
          gravity_form($form_object['id'], false, false, false, '', true, 1);
        ?>
      </div>
    </div>
  </div>
</section>