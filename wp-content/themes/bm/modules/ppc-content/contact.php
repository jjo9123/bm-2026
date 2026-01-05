<section class="contact" style="background: url('<?php the_sub_field('bg_image'); ?>') 50%/cover no-repeat; color: #FFFFFF;">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 mb-4" id="contact-footer">
        <h2 class="text-center white">
          <?php the_sub_field('heading'); ?>
        </h2>

        <hr class="heading purple">
      </div>

      <div class="col-lg-5 form-left">
        <?php if( get_sub_field('txt_choice') == 'global'): ?>
          <p><?php the_field('txt', 'options'); ?></p>
        <?php else: ?>
          <p><?php the_sub_field('txt'); ?></p>
        <?php endif; ?>
      </div>

      <div class="col-lg-6 ml-auto">
        <?php
          $form_object = get_sub_field('form');
          gravity_form_enqueue_scripts($form_object['id'], true);
          gravity_form($form_object['id'], false, false, false, '', true, 1);
        ?>
      </div>
    </div>
  </div>
</section>
