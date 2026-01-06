<div class="modal fade text-left" id="btn-cta-modal-<?php echo get_the_ID(); ?>" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="modal-copy">
          <h4 class="white"><?php the_field('heading'); ?></h4>

          <p><?php the_field('txt'); ?></p>

          <img src="/wp-content/uploads/2019/02/logo-white.png" alt="Blake Morgan Logo" style="bottom: 20px; max-width: 180px; position: absolute;">
        </div>

        <div class="modal-form">
          <?php
            $form_object = get_field('form');
            gravity_form_enqueue_scripts($form_object['id'], true);
            gravity_form($form_object['id'], false, false, false, '', true, 1);
          ?>
        </div>
      </div>
    </div>
  </div>
</div>
