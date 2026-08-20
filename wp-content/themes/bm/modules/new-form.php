<?php
$bg_class   = get_sub_field('bg_colour') ?: 'bm-pink';
$anchor_link = get_sub_field('anchor_link');
?>

<section class="contact new-form <?php echo esc_attr($bg_class); ?>">
  <div class="container">
    <div class="row"<?php if ($anchor_link) : ?> id="<?php echo esc_attr(sanitize_title($anchor_link)); ?>"<?php endif; ?>>

      <div class="col-12 mb-4">
        <h2>
          <?php the_sub_field('heading'); ?>
        </h2>
      </div>

      <!-- Text -->
      <div class="col-12 col-md-6 mb-4 mb-lg-0">
        <div class="contact__text">
          <?php the_sub_field('txt'); ?>
        </div>
      </div>

      <!-- Form -->
      <div class="col-12 col-md-6">
        <div class="contact__form">
          <?php
          $form_object = get_sub_field('form');

          if ($form_object && !empty($form_object['id'])) {
              $form_id = (int) $form_object['id'];

              gravity_form_enqueue_scripts($form_id, true);

              gravity_form(
                  $form_id,
                  false,
                  false,
                  false,
                  null,
                  true,
                  1
              );
          }
          ?>
        </div>
      </div>

    </div>
  </div>
</section>