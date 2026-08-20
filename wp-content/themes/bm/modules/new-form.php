<?php $bg_class = get_sub_field('bg_colour') ?: 'bm-pink';
$anchor_link = get_sub_field('anchor_link'); ?>

<section class="contact <?php echo esc_attr($bg_class); ?>">
  <div class="container">
    <div class="row"<?php if ($anchor_link) : ?> id="<?php echo esc_attr(sanitize_title($anchor_link)); ?>"<?php endif; ?>>
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

          gravity_form_enqueue_scripts($form_object['id'], true);

          // Set a global "current module form id" just for this render
          $GLOBALS['bm_contact_footer_form_id'] = (int) $form_object['id'];

          gravity_form(
            $form_object['id'],
            false,
            false,
            false,
            null,   // no field_values needed
            true,
            1
          );

          // Unset so it can't affect anything else later on the page
          unset($GLOBALS['bm_contact_footer_form_id']);
          ?>

      </div>
    </div>
  </div>
</section>