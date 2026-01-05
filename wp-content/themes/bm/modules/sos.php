<div id="sos-modal" class="modal hide fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <h5 class="modal-title" style="font-size: 1.5rem;"><?php the_sub_field('sos_header'); ?></h5>
        <p style="padding-top: 30px; font-size: 1.1rem;"><?php the_sub_field('sos_copy'); ?></p>

        <?php if( get_sub_field('sos_btn-show') == 'yes' ): ?>
          <a href="<?php the_sub_field('sos_btn-link'); ?>" class="btn btn-purple header cookie" style="margin-left: auto; margin-right: auto; display: block; min-width: 200px; max-width: 200px;"><?php the_sub_field('sos_btn-txt'); ?></a>
        <?php endif; ?>
      </div>

      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<style>
  #sos-modal .modal-body {
    flex-direction: column;
  }
</style>

<script>
(function ($) {

	'use strict';
  jQuery(document).ready(function() {
    jQuery('#sos-modal').modal({
      backdrop: 'static',
      keyboard: false
    });
  });
  }(jQuery));
</script>
