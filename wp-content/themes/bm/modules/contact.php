<?php $bg_class = get_sub_field('bg_colour') ?: 'bm-pink'; ?>

<section class="contact <?php echo esc_attr($bg_class); ?>">
  <div class="container">
    <div class="row" id="contact-footer">
      <div class="col-lg-12 mb-4">
        <h2 class="text-center">
          <?php the_sub_field('heading'); ?>
        </h2>
      </div>

      
        <?php
          /*
          if ( get_sub_field('txt_choice') == 'global' ): ?>
            <p><?php the_field('txt', 'options'); ?></p>
          <?php else: ?>
            <p><?php the_sub_field('txt'); ?></p>
          <?php endif;
          */
          ?>
      

      <div class="col-12 col-md-10 mx-auto">
       <?php
          $form_object = get_sub_field('form');

          if (is_array($form_object) && !empty($form_object['id'])) {

              $form_id = (int) $form_object['id'];

              gravity_form_enqueue_scripts($form_id, true);

              $GLOBALS['bm_contact_footer_form_id'] = $form_id;

              gravity_form(
                  $form_id,
                  false,
                  false,
                  false,
                  null,
                  true,
                  1
              );

              unset($GLOBALS['bm_contact_footer_form_id']);

          }
          ?>

      </div>
    </div>
  </div>
</section>